<?php

namespace App\Http\Controllers;

use App\Models\Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $drivesQuery = Drive::query();
        
        switch ($request->input('trashed')) {
            case 'with':
                $drivesQuery->withTrashed();
                break;

            case 'only':
                $drivesQuery->onlyTrashed();
                break;
        }
        
        if ($request->has('search')) {
            $searchTerm = '%' . $request->input('search') . '%';
    
            $drivesQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                      ->orWhere('commentary', 'like', $searchTerm)
                      ->orWhere('description', 'like', $searchTerm)
                      ->orWhere('content', 'like', $searchTerm);
            });
        }
    
        $drives = $drivesQuery->get();
        
        return view('drives.table', compact('drives'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('drives.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:drives,name',
            'commentary' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'manufacturer' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:0',
            'ssd' => 'boolean',
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
            'ssd.boolean' => 'Поле "SSD" должно иметь значение true или false.',
            'power.required' => 'Поле "Мощность" обязательно для заполнения.',
            'power.integer' => 'Поле "Мощность" должно быть целым числом.',
            'power.min' => 'Поле "Мощность" должно быть не меньше :min.',
        ]);
        

        $drive = Drive::create($validatedData);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img/drives', $imageName);

            $drive->image = $imageName;
        }
        
        $drive->save();

        return redirect()->route('drives.show', compact('drive'))->with('success', 'Накопитель успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $drive = Drive::withTrashed()->find($id);
        return view('drives.item', compact('drive'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $drive = Drive::withTrashed()->find($id);
        return view('drives.form', compact('drive'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $drive = Drive::withTrashed()->find($id);

        $validatedData = $request->validate([
            'name' => 'required|string|unique:drives,name,' . $id,
            'commentary' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'manufacturer' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:0',
            'ssd' => 'boolean',
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
            'ssd.boolean' => 'Поле "SSD" должно иметь значение true или false.',
            'power.required' => 'Поле "Мощность" обязательно для заполнения.',
            'power.integer' => 'Поле "Мощность" должно быть целым числом.',
            'power.min' => 'Поле "Мощность" должно быть не меньше :min.',
        ]);
        
        
        $drive->fill($validatedData);

        if ($request->hasFile('image')) {
            if ($drive->image) {
                Storage::delete('public/img/drives/' . $drive->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img/drives', $imageName);

            $drive->image = $imageName;
        }
          
        $drive->save();

        return redirect()->route('drives.show', compact('drive'))->with('success', 'Информация о накопителе успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $drive = Drive::withTrashed()->find($id);

        if (!$drive) {
            return redirect()->back()->with('error', 'Накопитель не найден');
        }

        if ($drive->trashed()) {
            $drive->restore();
            return redirect()->back()->with('success', 'Накопитель успешно восстановлен');
        } else {
            $drive->delete();
            return redirect()->back()->with('success', 'Накопитель успешно удален');
        }
    }
}
