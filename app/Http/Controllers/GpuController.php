<?php

namespace App\Http\Controllers;

use App\Models\Gpu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GpuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $gpusQuery = Gpu::query();
        
        switch ($request->input('trashed')) {
            case 'with':
                $gpusQuery->withTrashed();
                break;

            case 'only':
                $gpusQuery->onlyTrashed();
                break;
        }
        
        if ($request->has('search')) {
            $searchTerm = '%' . $request->input('search') . '%';
    
            $gpusQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                      ->orWhere('commentary', 'like', $searchTerm)
                      ->orWhere('description', 'like', $searchTerm)
                      ->orWhere('content', 'like', $searchTerm);
            });
        }
    
        $gpus = Gpu::all();//$gpusQuery->get();
        
        // return view('gpus.table', compact('gpus'));
        return response()->json([
            'view' => view('gpus.components.list', compact('gpus'))->render(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gpus.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:gpus,name',
            'commentary' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

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

            'power.required' => 'Поле "Мощность" обязательно для заполнения.',
            'power.integer' => 'Поле "Мощность" должно быть целым числом.',
            'power.min' => 'Поле "Мощность" должно быть не меньше :min.',
        ]);
        

        $gpu = Gpu::create($validatedData);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img/gpus', $imageName);

            $gpu->image = $imageName;
        }
        
        $gpu->save();

        return redirect()->route('gpus.show', compact('gpu'))->with('success', 'Видеокарта успешно создана');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gpu = Gpu::withTrashed()->find($id);
        // return view('gpus.item', compact('gpu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gpu = Gpu::withTrashed()->find($id);
        return view('gpus.form', compact('gpu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $gpu = Gpu::withTrashed()->find($id);

        $validatedData = $request->validate([
            'name' => 'required|string|unique:gpus,name,' . $id,
            'commentary' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            
            'manufacturer' => 'nullable|string|max:255',
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
            'power.required' => 'Поле "Мощность" обязательно для заполнения.',
            'power.integer' => 'Поле "Мощность" должно быть целым числом.',
            'power.min' => 'Поле "Мощность" должно быть не меньше :min.',
        ]);
        
        
        $gpu->fill($validatedData);

        if ($request->hasFile('image')) {
            if ($gpu->image) {
                Storage::delete('public/img/gpus/' . $gpu->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img/gpus', $imageName);

            $gpu->image = $imageName;
        }
          
        $gpu->save();

        return redirect()->route('gpus.show', compact('gpu'))->with('success', 'Информация о видеокарте успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gpu = Gpu::withTrashed()->find($id);

        if (!$gpu) {
            return redirect()->back()->with('error', 'Видеокарта не найдена');
        }

        if ($gpu->trashed()) {
            $gpu->restore();
            return redirect()->back()->with('success', 'Видеокарта успешно восстановлена');
        } else {
            $gpu->delete();
            return redirect()->back()->with('success', 'Видеокарта успешно удалена');
        }
    }
}
