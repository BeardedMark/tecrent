<?php

namespace App\Http\Controllers;

use App\Models\Cpu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CpuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $gpus = $this->getFiltered($request);
        
        return view('gpus.index', compact('gpus'));



        $cpusQuery = Cpu::query();
        
        switch ($request->input('trashed')) {
            case 'with':
                $cpusQuery->withTrashed();
                break;

            case 'only':
                $cpusQuery->onlyTrashed();
                break;
        }
        
        if ($request->has('search')) {
            $searchTerm = '%' . $request->input('search') . '%';
    
            $cpusQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                      ->orWhere('commentary', 'like', $searchTerm)
                      ->orWhere('description', 'like', $searchTerm)
                      ->orWhere('content', 'like', $searchTerm);
            });
        }
    
        $cpus = $cpusQuery->get();
        
        return view('cpus.table', compact('cpus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cpus.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:cpus,name',
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

        $cpu = Cpu::create($validatedData);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img/cpus', $imageName);

            $cpu->image = $imageName;
        }
        
        $cpu->save();

        return redirect()->route('cpus.show', compact('cpu'))->with('success', 'Процессор успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cpu = Cpu::withTrashed()->find($id);
        return view('cpus.item', compact('cpu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cpu = Cpu::withTrashed()->find($id);
        return view('cpus.form', compact('cpu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cpu = Cpu::withTrashed()->find($id);

        $validatedData = $request->validate([
            'name' => 'required|string|unique:cpus,name,' . $id,
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
        
        $cpu->fill($validatedData);

        if ($request->hasFile('image')) {
            if ($cpu->image) {
                Storage::delete('public/img/cpus/' . $cpu->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img/cpus', $imageName);

            $cpu->image = $imageName;
        }
          
        $cpu->save();

        return redirect()->route('cpus.show', compact('cpu'))->with('success', 'Информация о процессоре успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cpu = Cpu::withTrashed()->find($id);

        if (!$cpu) {
            return redirect()->back()->with('error', 'Процессор не найден');
        }

        if ($cpu->trashed()) {
            $cpu->restore();
            return redirect()->back()->with('success', 'Процессор успешно восстановлен');
        } else {
            $cpu->delete();
            return redirect()->back()->with('success', 'Процессор успешно удален');
        }
    }
    
    public function list(Request $request)
    {
        $cpus = $this->getFiltered($request);
        
        return response()->json([
            'view' => view('cpus.components.list', compact('cpus'))->render(),
        ]);
    }
    
    private function getFiltered(Request $request)
    {
        $query = Cpu::query();
        
        switch ($request->input('trashed')) {
            case 'with':
                $query->withTrashed();
                break;

            case 'only':
                $query->onlyTrashed();
                break;
        }
        
        if ($request->has('search')) {
            $searchTerm = '%' . $request->input('search') . '%';
    
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                      ->orWhere('commentary', 'like', $searchTerm)
                      ->orWhere('description', 'like', $searchTerm)
                      ->orWhere('content', 'like', $searchTerm);
            });
        }

        return $query->get();
    }
}
