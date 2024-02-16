<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Game;
use App\Models\Gpu;
use App\Models\Cpu;
use App\Models\Ram;
use App\Models\Drive;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $computersQuery = Computer::query();
    
        // if (Auth::user() && Auth::user()->is_admin) {
        //     switch ($request->input('trashed')) {
        //         case 'with':
        //             $computersQuery->withTrashed();
        //             break;
    
        //         case 'only':
        //             $computersQuery->onlyTrashed();
        //             break;
        //     }
        // }
    
        if ($request->has('gpu')) {
            $computersQuery->where('gpu_id', $request->input('gpu'));
        }
        if ($request->has('cpu')) {
            $computersQuery->where('cpu_id', $request->input('cpu'));
        }
        if ($request->has('ram')) {
            $computersQuery->where('ram_id', $request->input('ram'));
        }
        if ($request->has('drive')) {
            $computersQuery->where('drive_id', $request->input('drive'));
        }
        if ($request->has('search')) {
            $searchTerm = '%' . $request->input('search') . '%';
    
            $computersQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                      ->orWhere('commentary', 'like', $searchTerm)
                      ->orWhere('description', 'like', $searchTerm)
                      ->orWhere('content', 'like', $searchTerm);
            });
        }
    
        $computers = $computersQuery->get();
    
        // if (Auth::user() && Auth::user()->is_admin) {
        //     return view('computers.table', compact('computers'));
        // } else {
        //     return view('computers.index', compact('computers'));
        // }
        
        $content = json_decode(file_get_contents(storage_path('content/computers.json')), true);
        return view('computers.index', compact('computers', 'content'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gpus = Gpu::all();
        $cpus = Cpu::all();
        $rams = Ram::all();
        $drives = Drive::all();

        return view('computers.form', compact('gpus', 'cpus', 'rams', 'drives'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:computers,name',
            'commentary' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'price' => 'integer|min:0',
            'gpu_id' => 'nullable|exists:gpus,id',
            'cpu_id' => 'nullable|exists:cpus,id',
            'ram_id' => 'nullable|exists:rams,id',
            'drive_id' => 'nullable|exists:drives,id',
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

            'price.integer' => 'Поле "Цена" должно быть целым числом.',
            'price.min' => 'Поле "Цена" должно быть не меньше :min.',
            'gpu_id.exists' => 'Выбранная видеокарта не существует.',
            'cpu_id.exists' => 'Выбранный процессор не существует.',
            'ram_id.exists' => 'Выбранная оперативка не существует.',
            'drive_id.exists' => 'Выбранный накопитель не существует.',
        ]);
        

        $computer = Computer::create($validatedData);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img/computers', $imageName);

            $computer->image = $imageName;
        }

        $computer->save();

        return redirect()->route('computers.show', compact('computer'))->with('success', "Компьютер №$computer->id успешно создан.");
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $computer = Computer::find($id);
        return view('computers.show', compact('computer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $computer = Computer::withTrashed()->find($id);

        $gpus = Gpu::all();
        $cpus = Cpu::all();
        $rams = Ram::all();
        $drives = Drive::all();

        return view('computers.form', compact('computer', 'gpus', 'cpus', 'rams', 'drives'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $computer = Computer::withTrashed()->find($id);

        $validatedData = $request->validate([
            'name' => 'required|string|unique:computers,name,' . $id,
            'commentary' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'price' => 'integer|min:0',
            'gpu_id' => 'nullable|exists:gpus,id',
            'cpu_id' => 'nullable|exists:cpus,id',
            'ram_id' => 'nullable|exists:rams,id',
            'drive_id' => 'nullable|exists:drives,id',
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
            
            'price.integer' => 'Поле "Цена" должно быть целым числом.',
            'price.min' => 'Поле "Цена" должно быть не меньше :min.',
            'gpu_id.exists' => 'Выбранная видеокарта не существует.',
            'cpu_id.exists' => 'Выбранный процессор не существует.',
            'ram_id.exists' => 'Выбранная оперативка не существует.',
            'drive_id.exists' => 'Выбранный накопитель не существует.',
        ]);
        

        $computer->fill($validatedData);

        if ($request->hasFile('image')) {
            if ($computer->image) {
                Storage::delete('public/img/computers/' . $computer->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img/computers', $imageName);

            $computer->image = $imageName;
        }

        $computer->save();

        return redirect()->route('computers.show', compact('computer'))->with('success', "Информация о компьютере №$id успешно обновлена.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $computer = Computer::withTrashed()->find($id);

        if (!$computer) {
            return redirect()->back()->with('error', "Компьютер №$id не найден");
        }

        if ($computer->trashed()) {
            $computer->restore();
            return redirect()->back()->with('success', "Компьютер №$id успешно восстановлен");
        } else {
            $computer->delete();
            return redirect()->back()->with('success', "Компьютер №$id успешно удален");
        }
    }
}
