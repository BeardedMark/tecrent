<?php

namespace App\Http\Controllers\DataBase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // Форма авторизации
    public function loginForm()
    {
        return view('auth.login');
    }

    // Авторизация
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'login' => 'required|string|min:4|max:255',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
        ], [
            'login.required' => 'Поле "Наименование" обязательно для заполнения',
            'login.min' => 'Поле "Наименование" должно содержать не менее :min символов',
            'login.max' => 'Поле "Наименование" не должно превышать :max символов',
            'password.required' => 'Поле "Пароль" обязательно для заполнения',
            'password.min' => 'Пароль должен содержать не менее :min символов',
            'password.regex' => 'Пароль должен содержать минимум 1 заглавную букву и 1 цифру',
        ]);

        $user = User::where('name',  $validatedData['login'])
            ->orWhere('email',  $validatedData['login'])
            ->first();

        if (!$user) {
            return back()->withErrors('Неверный логин или адрес электронной почты');
        }

        // if (!$user->hasVerifiedEmail()) {
        //     return redirect()->route('verification.notice')->with('error', 'Требуется подтверждение почты');
        // }

        if (
            Auth::attempt(['name' => $user->name, 'password' => $validatedData['password']]) ||
            Auth::attempt(['email' => $user->email, 'password' => $validatedData['password']])
        ) {
            return redirect()->route('main', $user)->with('success', 'Добро пожаловать в свой аккаунт, ' . $user->name . '!');
        }

        return back()->withErrors('Неверный пароль');
    }

    // Выход пользователя
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login')->with('warning', 'Выход успешно совершен');
    }

    // Форма регистрации
    public function registerForm()
    {
        return view('auth.register');
    }

    // Регистрация
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:4|unique:users,name|max:255',
            'email' => 'required|string|email|unique:users,email|max:255|regex:/^[a-zA-Z0-9._-]+@+[a-zA-Z0-9.-]+\.[a-zA-Z]{2,9}$/',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
        ], [
            'name.required' => 'Поле "Наименование" обязательно для заполнения',
            'name.unique' => 'Такое "Наименование" уже существует',
            'name.min' => 'Поле "Наименование" должно содержать не менее :min символов',
            'name.max' => 'Поле "Наименование" не должно превышать :max символов',
            'email.required' => 'Поле "Почта" обязательно для заполнения',
            'email.email' => 'Поле "Почта" должно быть корректным адресом электронной почты',
            'email.unique' => 'Такая "Почта" уже используется',
            'email.max' => 'Поле "Почта" не должно превышать :max символов',
            'email.regex' => 'Поле "Почта" должно соответствовать маске "---@---.---"',
            'password.required' => 'Поле "Пароль" обязательно для заполнения',
            'password.min' => 'Пароль должен содержать не менее :min символов',
            'password.confirmed' => 'Поле "Пароль" и поле "Подтверждение пароля" не совпадают',
            'password.regex' => 'Пароль должен содержать минимум 1 заглавную букву и 1 цифру',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // $user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice')->with('success', 'Регистрация успешно пройдена');
    }














    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
        ], [
            'password.required' => 'Поле "Пароль" обязательно для заполнения',
            'password.min' => 'Пароль должен содержать не менее :min символов',
            'password.confirmed' => 'Поле "Пароль" и поле "Подтверждение пароля" не совпадают',
            'password.regex' => 'Пароль должен содержать минимум 1 заглавную букву и 1 цифру',
        ]);

        $user = User::find(Auth::user()->id);

        if (password_verify($request->old_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->route('users.edit', $user)->with('success', 'Пароль успешно изменен');
        } else {
            return back()->withErrors(['old_password' => 'Неверный старый пароль']);
        }
    }

    public function changeUsername(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'name' => 'required|string|min:4|unique:users,name|max:255',
        ], [
            'name.required' => 'Поле "Логин" обязательно для заполнения',
            'name.unique' => 'Указаный Логин уже занят',
            'name.min' => 'Поле "Логин" должно содержать не менее :min символов',
            'name.max' => 'Поле "Логин" не должно превышать :max символов',
            'password.required' => 'Поле "Пароль" обязательно для заполнения',
            'password.min' => 'Пароль должен содержать не менее :min символов',
            'password.confirmed' => 'Поле "Пароль" и поле "Подтверждение пароля" не совпадают',
            'password.regex' => 'Пароль должен содержать минимум 1 заглавную букву и 1 цифру',
        ]);

        $user = User::find(Auth::user()->id);

        if (password_verify($request->password, $user->password)) {
            $user->name = $request->name;
            $user->save();

            return redirect()->route('users.edit', $user)->with('success', 'Логин успешно изменен');
        } else {
            return back()->withErrors(['password' => 'Неверный пароль']);
        }
    }

    public function destroy(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
        ], [
            'password.required' => 'Поле "Пароль" обязательно для заполнения',
            'password.min' => 'Пароль должен содержать не менее :min символов',
            'password.confirmed' => 'Поле "Пароль" и поле "Подтверждение пароля" не совпадают',
            'password.regex' => 'Пароль должен содержать минимум 1 заглавную букву и 1 цифру',
        ]);

        $user = User::find(Auth::user()->id);

        if (password_verify($request->password, $user->password)) {
            if ($user->trashed()) {
                $user->restore();
                return redirect()->back()->with('success', 'Пользователь успешно восстановлен');
            } else {
                $user->delete();
                return redirect()->back()->with('success', 'Пользователь успешно удален');
            }
        } else {
            return back()->withErrors(['password' => 'Неверный пароль']);
        }
    }
















    // Форма отправки ссылки на сброс пароля
    public function showLinkRequestForm()
    {
        return view('auth.request');
    }

    // Отправка ссылки на сброс пароля
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Поле "Почта или логин" обязательно для заполнения',
        ]);

        $user = User::where('name', $request['name'])->orWhere('email', $request['name'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Пользователь с указанной почтой или логином не найден']);
        }

        $response = Password::sendResetLink($user->only('email'));
        return $response == Password::RESET_LINK_SENT
            ? redirect()->route('login')->with('success', 'Инструкции по восстановлению пароля отправлены на почту ' . $user->email)
            : back()->withErrors(['email' => 'Не удалось отправить инструкции по восстановлению пароля']);

        // return redirect()->route('login')->with('success', 'Инструкции по восстановлению пароля отправлены на вашу почту');
    }



    // Форма установки нового пароля
    public function showResetForm(Request $request)
    {
        return view('auth.reset', compact('request'));
    }

    // Установка пароля
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required',
        ]);

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        return $response == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Пароль успешно сброшен')
            : back()->withErrors(['email' => 'Не удалось сбросить пароль']);
    }










    // Показывает страницу с уведомлением о необходимости подтверждения
    public function show()
    {
        return view('auth.verify');
    }

    // Обрабатывает запрос на подтверждение
    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));

        if ($user->markEmailAsVerified()) {
            event(new \Illuminate\Auth\Events\Verified($user));
        }

        return redirect()->route('login')->with('success', 'Почта успешно подтверждена');
    }

    // Повторно отправляет письмо для подтверждения
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('login')->with('success', 'Почта уже подтверждена');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Письмо подтверждения успешно отправлено на почту');
    }
}
