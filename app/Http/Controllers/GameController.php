<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user() && Auth::user()->is_admin) {
            $games = Game::withTrashed()->get();
        } else {
            $games = Game::all();
        }
        
        $content = json_decode(file_get_contents(storage_path('content/games.json')), true);

        if ($request->has('search')) {
            $search = $request->input('search');
            $games = $games->filter(function ($game) use ($search) {
                $fillable = $game->getFillable();
                foreach ($fillable as $field) {
                    if (Str::contains($game->$field, $search)) {
                        return true;
                    }
                }
                return false;
            });
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            if ($request->has('direction')) {
                $direction = $request->input('direction');
                if ($direction === 'asc') {
                    $games = $games->sortBy($sort);
                } else if ($direction === 'desc') {
                    $games = $games->sortByDesc($sort);
                }
            }
        }
    
        return view('games.index', compact('games', 'content'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:games,name',
            'commentary' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'autor' => 'nullable|string|max:255',
            'release' => 'nullable|date',
        ], [
            'name.required' => 'Поле "Наименование" обязательно для заполнения.',
            'name.unique' => 'Такое "Наименование" уже существует.',
            'commentary.required' => 'Поле "Комментарий" обязательно для заполнения.',
            'commentary.max' => 'Длина комментария не должна превышать :max символов.',
            'description.max' => 'Длина описания не должна превышать :max символов.',
            'content.max' => 'Длина контента не должна превышать :max символов.',
            'image.image' => 'Загруженный файл должен быть изображением.',
            'image.mimes' => 'Поддерживаются только следующие форматы изображений: :values.',
            'image.max' => 'Максимальный размер файла изображения не должен превышать :max КБ.',

            'autor.max' => 'Длина автора не должна превышать :max символов.',
            'release.date' => 'Поле "Релиз" должно быть датой в формате ГГГГ-ММ-ДД.',
        ]);

        $game = Game::create($validatedData);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img/games', $imageName);

            $game->image = $imageName;
        }

        $game->save();

        return redirect()->route('games.edit', compact('game'))->with('success', 'Игра успешно создана');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Auth::user() && Auth::user()->is_admin) {
            $game = Game::withTrashed()->find($id);
        } else {
            $game = Game::findOrFail($id);
        }

        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Auth::user() && Auth::user()->is_admin) {
            $game = Game::withTrashed()->find($id);
        } else {
            $game = Game::find($id);
        }

        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $game = Game::withTrashed()->find($id);

        $validatedData = $request->validate([
            'name' => 'required|string|unique:games,name,' . $id,
            'commentary' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'autor' => 'nullable|string|max:255',
            'release' => 'nullable|date',
        ], [
            'name.required' => 'Поле "Наименование" обязательно для заполнения.',
            'name.unique' => 'Такое "Наименование" уже существует.',
            'commentary.required' => 'Поле "Комментарий" обязательно для заполнения.',
            'commentary.max' => 'Длина комментария не должна превышать :max символов.',
            'description.max' => 'Длина описания не должна превышать :max символов.',
            'content.max' => 'Длина контента не должна превышать :max символов.',
            'image.image' => 'Загруженный файл должен быть изображением.',
            'image.mimes' => 'Поддерживаются только следующие форматы изображений: :values.',
            'image.max' => 'Максимальный размер файла изображения не должен превышать :max КБ.',

            'autor.max' => 'Длина автора не должна превышать :max символов.',
            'release.date' => 'Поле "Релиз" должно быть датой в формате ГГГГ-ММ-ДД.',
        ]);

        $game->fill($validatedData);

        if ($request->hasFile('image')) {
            if ($game->image) {
                Storage::delete('public/img/games/' . $game->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img/games', $imageName);

            $game->image = $imageName;
        }

        $game->save();

        return redirect()->route('games.show', compact('game'))->with('success', 'Информация об игре успешно обновлена');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth::user() && Auth::user()->is_admin) {
            $game = Game::withTrashed()->find($id);
        } else {
            $game = Game::find($id);
        }

        if (!$game) {
            return redirect()->back()->with('error', 'Игра не найдена');
        }

        if ($game->trashed()) {
            $game->restore();
            return redirect()->route('games.show', $id)->with('success', 'Игра успешно восстановлена');
        } else {
            $game->delete();
            return redirect()->route('games.show', $id)->with('success', 'Игра успешно удалена');
        }
    }
}
