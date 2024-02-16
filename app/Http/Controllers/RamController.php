<?php

namespace App\Http\Controllers;

use App\Models\Ram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ramsQuery = Ram::query();

        switch ($request->input('trashed')) {
            case 'with':
                $ramsQuery->withTrashed();
                break;

            case 'only':
                $ramsQuery->onlyTrashed();
                break;
        }

        if ($request->has('search')) {
            $searchTerm = '%' . $request->input('search') . '%';

            $ramsQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('commentary', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm)
                    ->orWhere('content', 'like', $searchTerm);
            });
        }

        $rams = $ramsQuery->get();

        return view('rams.table', compact('rams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rams.form');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:rams,name',
            'commentary' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'manufacturer' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:0',
            'type' => 'required|string',
            'power' => 'required|integer|min:0',
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

            'manufacturer.max' => 'Длина производителя не должна превышать :max символов.',
            'capacity.required' => 'Поле "Объем" обязательно для заполнения.',
            'capacity.integer' => 'Поле "Объем" должно быть целым числом.',
            'capacity.min' => 'Поле "Объем" должно быть не меньше :min.',
            'type.required' => 'Поле "Тип" обязательно для заполнения.',
            'power.required' => 'Поле "Мощность" обязательно для заполнения.',
            'power.integer' => 'Поле "Мощность" должно быть целым числом.',
            'power.min' => 'Поле "Мощность" должно быть не меньше :min.',
        ]);


        $ram = Ram::create($validatedData);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img/rams', $imageName);

            $ram->image = $imageName;
        }

        $ram->save();

        return redirect()->route('rams.show', compact('ram'))->with('success', 'Оперативка успешно создана');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ram = Ram::withTrashed()->find($id);
        return view('rams.item', compact('ram'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ram = Ram::withTrashed()->find($id);
        return view('rams.form', compact('ram'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ram = Ram::withTrashed()->find($id);

        $validatedData = $request->validate([
            'name' => 'required|string|unique:rams,name,' . $id,
            'commentary' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'manufacturer' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:0',
            'type' => 'required|string',
            'power' => 'required|integer|min:0',
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
            
            'manufacturer.max' => 'Длина производителя не должна превышать :max символов.',
            'capacity.required' => 'Поле "Объем" обязательно для заполнения.',
            'capacity.integer' => 'Поле "Объем" должно быть целым числом.',
            'capacity.min' => 'Поле "Объем" должно быть не меньше :min.',
            'type.required' => 'Поле "Тип" обязательно для заполнения.',
            'power.required' => 'Поле "Мощность" обязательно для заполнения.',
            'power.integer' => 'Поле "Мощность" должно быть целым числом.',
            'power.min' => 'Поле "Мощность" должно быть не меньше :min.',
        ]);


        $ram->fill($validatedData);

        if ($request->hasFile('image')) {
            if ($ram->image) {
                Storage::delete('public/img/rams/' . $ram->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img/rams', $imageName);

            $ram->image = $imageName;
        }

        $ram->save();

        return redirect()->route('rams.show', compact('ram'))->with('success', 'Информация о оперативке успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ram = Ram::withTrashed()->find($id);

        if (!$ram) {
            return redirect()->back()->with('error', 'Оперативка не найдена');
        }

        if ($ram->trashed()) {
            $ram->restore();
            return redirect()->back()->with('success', 'Оперативка успешно восстановлена');
        } else {
            $ram->delete();
            return redirect()->back()->with('success', 'Оперативка успешно удалена');
        }
    }
}
