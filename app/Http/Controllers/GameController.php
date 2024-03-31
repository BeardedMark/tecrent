<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Computer;
use App\Models\Gpu;
use App\Models\Cpu;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Game::query();
        $query = $this->getFiltered($query, $request);
        $games = $query->get();

        $title = 'Игровые системные требования';
        $description = 'Найдите подходящуюя для себя конфигурацию';
        $content = 'На нашей платформе вы можете воспользоваться широким выбором высокопроизводительных компьютеров для аренды. Независимо от ваших потребностей — будь то ресурсоемкие задачи в области программирования, креативные проекты или игровые мероприятия — мы предоставляем надежные и мощные системы. Гибкие условия аренды и передовое оборудование обеспечат вас необходимыми ресурсами для успешного выполнения задач. Перейдите к выбору и оптимизируйте свой опыт работы с нашими выдающимися компьютерами на прокат';

        if ($request->query()) {
            $title = 'Результаты поиска ' . $title;
            $description = 'Результаты поиска процессоров на основе введенных параметров';
        }

        return view('games.index', compact('games', 'title', 'description', 'content'));
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
        ], [
            'name.required' => 'Поле "Название" обязательно для заполнения.',
            'name.string' => 'Поле "Название" должно быть строкой.',
            'name.unique' => 'Такое название уже используется.',
        ]);

        $game = Game::create($validatedData);
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
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'video' => 'nullable|string|max:255',

            'autor' => 'nullable|string|max:255',
            'trailer' => 'nullable|string|max:255',
            'gameplay' => 'nullable|string|max:255',
            'developer' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'is_server' => 'nullable',
            'release' => 'nullable|date',
        ], [
            'name.required' => 'Поле "Название" обязательно для заполнения.',
            'name.string' => 'Поле "Название" должно быть строкой.',
            'name.unique' => 'Такое название уже используется.',

            'commentary.string' => 'Поле "Комментарий" должно быть строкой.',
            'commentary.max' => 'Поле "Комментарий" не должно превышать :max символов.',

            'description.string' => 'Поле "Описание" должно быть строкой.',

            'content.string' => 'Поле "Содержание" должно быть строкой.',

            'image.string' => 'Поле "Изображение" должно быть строкой.',
            'image.max' => 'Поле "Изображение" не должно превышать :max символов.',

            'video.string' => 'Поле "Видео" должно быть строкой.',
            'video.max' => 'Поле "Видео" не должно превышать :max символов.',

            'trailer.string' => 'Поле "Трейлер" должно быть строкой.',
            'trailer.max' => 'Поле "Трейлер" не должно превышать :max символов.',

            'gameplay.string' => 'Поле "Геймплей" должно быть строкой.',
            'gameplay.max' => 'Поле "Геймплей" не должно превышать :max символов.',
            
            'autor.string' => 'Поле "Автор" должно быть строкой.',
            'autor.max' => 'Поле "Автор" не должно превышать :max символов.',

            'developer.string' => 'Поле "Разработчик" должно быть строкой.',
            'developer.max' => 'Поле "Разработчик" не должно превышать :max символов.',

            'publisher.string' => 'Поле "Издатель" должно быть строкой.',
            'publisher.max' => 'Поле "Издатель" не должно превышать :max символов.',

            'is_server.boolean' => 'Поле "Серверная игра" должно быть логическим значением.',

            'release.date' => 'Поле "Дата выпуска" должно быть датой.',
        ]);


        $game->fill($validatedData);
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
            return redirect()->route('games.index')->with('success', 'Игра успешно удалена');
        }
    }

    public function list(Request $request)
    {
        $query = Game::query();
        $query = $this->getFiltered($query, $request);

        $games = $query->get();

        return response()->json([
            'view' => view('games.components.grid', compact('games'))->render(),
        ]);
    }
    
    private function getFiltered($query, Request $request)
    {
        $games = $query;

        // if (Auth::user() && Auth::user()->is_admin) {
        //     $games->withTrashed();
        // }  

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

        if ($request->has('search')) {
            $search = $request->input('search');
            $query = $query->where(function ($query) use ($search) {
                $fillable = $query->getModel()->getFillable();
                foreach ($fillable as $field) {
                    $query->orWhere($field, 'like', '%' . $search . '%');
                }
            });
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

        if ($request->has('computer')) {
            $computerId = $request->input('computer');
            $computer = Computer::findOrFail($computerId);
            $games = $computer->games();
        }

        if ($request->has('gpu_id')) {
            $gpuId = $request->input('gpu_id');
            $gpu = Gpu::find($gpuId);
            if ($gpu) {
                $gpuPower = $gpu->power;

                $games = $games->whereHas('requirements', function ($games) use ($gpuPower) {
                    $games->where(function ($games) use ($gpuPower) {
                        $games = $games->whereHas('gpus', function ($query) use ($gpuPower) {
                            $query->where('power', '<=', $gpuPower);
                        });
                    });
                });
            }
        }

        if ($request->has('cpu_id')) {
            $cpuId = $request->input('cpu_id');
            $cpu = Cpu::find($cpuId);
            if ($cpu) {
                $cpuPower = $cpu->power;

                $games = $games->whereHas('requirements', function ($games) use ($cpuPower) {
                    $games->where(function ($games) use ($cpuPower) {
                        $games = $games->whereHas('cpus', function ($query) use ($cpuPower) {
                            $query->where('power', '<=', $cpuPower);
                        });
                    });
                });
            }
        }

        if ($request->has('limit')) {
            $limit = $request->input('limit');
            $query = $query->limit($limit);
        }

        return $games;
    }
}
