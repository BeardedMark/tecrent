<?php

namespace App\Http\Controllers;

use App\Models\Cpu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CpuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cpus = $this->getFiltered($request);
        $title = 'Процессоры';
        $description = 'Наша личная абра-кадабра';
        
        if ($request->query()) {
            $title = 'Результаты поиска процессоров';
            $description = 'Результаты поиска процессоров на основе введенных параметров';
        }
        
        return view('cpus.index', compact('cpus', 'title', 'description'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cpus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:cpus,name',
            'manufacturer' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Поле "Наименование" обязательно для заполнения.',
            'name.unique' => 'Такое "Наименование" уже существует.',
            'manufacturer.max' => 'Длина производителя не должна превышать :max символов.',
        ]);

        $cpu = Cpu::create($validatedData);        
        $cpu->save();

        return redirect()->route('cpus.show', compact('cpu'))->with('success', 'Процессор успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cpu = Cpu::withTrashed()->find($id);
        $cpus = Cpu::inRandomOrder()->take(4)->get();
        $computers = $cpu->computers->take(4);
        $games = $cpu->games(4);

        return view('cpus.show', compact('cpu', 'cpus', 'computers', 'games'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cpu = Cpu::withTrashed()->find($id);
        return view('cpus.edit', compact('cpu'));
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
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image' => 'nullable|string|max:255',
            
            'manufacturer' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'cache' => 'nullable|string|max:255',
            'socket' => 'nullable|string|max:255',
            'frequency' => 'nullable|integer',
            'cores_count' => 'nullable|integer',
            'threads_count' => 'nullable|integer',
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
            'cache.max' => '"Кэш-память" не должна превышать :max символов.',
            'socket.max' => '"Сокет" не должна превышать :max символов.',
            'frequency.integer' => 'Поле "Частота" должно быть целым числом.',
            'cores_count.integer' => 'Поле "Количество ядер" должно быть целым числом.',
            'threads_count.integer' => 'Поле "Количество потоков" должно быть целым числом.',
            'power.min' => 'Поле "Мощность" должно быть не меньше :min.',
        ]);
        
        $cpu->fill($validatedData);          
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
            return redirect()->route('cpus.show', compact('cpu'))->with('success', 'Процессор успешно восстановлен');
        } else {
            $cpu->delete();
            return redirect()->route('cpus.index')->with('success', 'Процессор успешно удален');
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

        if (Auth::user() && Auth::user()->is_admin) {
            $query->withTrashed();
        }
        
        switch ($request->input('trashed')) {
            case 'with':
                $query->withTrashed();
                break;

            case 'only':
                $query->onlyTrashed();
                break;

            case 'not':
                $query->whereNull('deleted_at');
                break;
        }

        $fillable = $query->getModel()->getFillable();

        // Отбор по параметрам
        foreach ($request->query() as $key => $value) {
            if (in_array($key, $fillable)) {
                $query->where($key, $value);
            }
        }

        // Сортировка
        if ($request->has('sort')) {
            $sort = $request->input('sort');
            if ($request->has('direction')) {
                $direction = $request->input('direction');
                $query->orderBy($sort, $direction);
            } else {
                $query->orderBy($sort);
            }
        }

        // Ограничение количества записей
        if ($request->has('limit')) {
            $limit = $request->input('limit');
            $query->limit($limit);
        }

        return $query->get();
    }
}
