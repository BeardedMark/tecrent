<?php

namespace App\Http\Controllers;

use App\Models\Gpu;
use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GpuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $gpus = $this->getFiltered($request);
        $title = 'Видеокарты';
        $description = 'Наша личная абра-кадабра';
        
        if ($request->query()) {
            $title = 'Результаты поиска видеокарт';
            $description = 'Результаты поиска видеокарт на основе введенных параметров';
        }
        
        return view('gpus.index', compact('gpus', 'title', 'description'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gpus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:gpus,name',
            'manufacturer' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Поле "Наименование" обязательно для заполнения.',
            'name.unique' => 'Такое "Наименование" уже существует.',
            'manufacturer.max' => 'Длина производителя не должна превышать :max символов.',
        ]);
        

        $gpu = Gpu::create($validatedData);

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->storeAs('public/img/gpus', $imageName);

        //     $gpu->image = $imageName;
        // }
        
        $gpu->save();

        return redirect()->route('gpus.show', compact('gpu'))->with('success', 'Видеокарта успешно создана');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gpu = Gpu::withTrashed()->find($id);
        $gpus = Gpu::inRandomOrder()->take(4)->get();
        $computers = $gpu->computers->take(4);
        $games = $gpu->games();

        return view('gpus.show', compact('gpu', 'gpus', 'computers', 'games'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gpu = Gpu::withTrashed()->find($id);
        return view('gpus.edit', compact('gpu'));
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
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image' => 'nullable|string|max:255',
            
            'manufacturer' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'memory_type' => 'nullable|string|max:255',
            'interface' => 'nullable|string|max:255',
            'memory_size' => 'nullable|integer',
            'gpu_frequency' => 'nullable|integer',
            'power' => 'nullable|integer|min:0',
        ], [
            'name.required' => 'Поле "Наименование" обязательно для заполнения.',
            'name.unique' => 'Такое "Наименование" уже существует.',
            'commentary.required' => 'Поле "Комментарий" обязательно для заполнения.',
            'commentary.max' => 'Длина комментария не должна превышать :max символов.',
            'description.max' => 'Длина описания не должна превышать :max символов.',
            'content.max' => 'Длина контента не должна превышать :max символов.',
            // 'image.image' => 'Загруженный файл должен быть изображением.',
            // 'image.mimes' => 'Поддерживаются только следующие форматы изображений: :values.',
            // 'image.max' => 'Максимальный размер файла изображения не должен превышать :max КБ.',

            'manufacturer.max' => 'Длина производителя не должна превышать :max символов.',
            
            'model.max' => '"Модель" не должна превышать :max символов.',
            'memory_type.max' => '"Тип памяти" не должн превышать :max символов.',
            'interface.max' => '"Интерфейс подключения" не должн превышать :max символов.',
            'memory_size.integer' => 'Поле "Объем видеопамяти" должно быть целым числом.',
            'gpu_frequency.integer' => 'Поле "Частота" должно быть целым числом.',

            // 'power.required' => 'Поле "Мощность" обязательно для заполнения.',
            'power.integer' => 'Поле "Мощность" должно быть целым числом.',
            'power.min' => 'Поле "Мощность" должно быть не меньше :min.',
        ]);
        
        
        $gpu->fill($validatedData);

        // if ($request->hasFile('image')) {
        //     if ($gpu->image) {
        //         Storage::delete('public/img/gpus/' . $gpu->image);
        //     }

        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->storeAs('public/img/gpus', $imageName);

        //     $gpu->image = $imageName;
        // }
          
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
            return redirect()->route('gpus.show', compact('gpu'))->with('success', 'Видеокарта успешно восстановлена');
        } else {
            $gpu->delete();
            return redirect()->route('gpus.index', compact('gpu'))->with('success', 'Видеокарта успешно удалена');
        }
    }

    public function list(Request $request)
    {
        $gpus = $this->getFiltered($request);
        
        return response()->json([
            'view' => view('gpus.components.list', compact('gpus'))->render(),
        ]);
    }
    
    private function getFiltered(Request $request)
    {
        $query = Gpu::query();

        if (Auth::user() && Auth::user()->is_admin) {
            $query->withTrashed();
        }
        
        if ($request->has('search')) {
            $search = $request->input('search');
            $query = $query->where(function ($query) use ($search) {
                $fillable = $query->getModel()->getFillable();
                foreach ($fillable as $field) {
                    $query->orWhere($field, 'like', '%' . $search . '%');
                }
            });
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            if ($request->has('direction')) {
                $direction = $request->input('direction');
                if ($direction === 'asc') {
                    $query = $query->sortBy($sort);
                } else if ($direction === 'desc') {
                    $query = $query->sortByDesc($sort);
                }
            }
        }

        if ($request->has('limit')) {
            $limit = $request->input('limit');
            $query = $query->limit($limit);
        }

        return $query->get();
    }
}
