<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use Illuminate\Http\Request;

use App\Models\Gpu;
use App\Models\Cpu;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;


class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $requirementsQuery = Requirement::query();

        if (Auth::user() && Auth::user()->is_admin) {
            switch ($request->input('trashed')) {
                case 'with':
                    $requirementsQuery->withTrashed();
                    break;

                case 'only':
                    $requirementsQuery->onlyTrashed();
                    break;
            }
        }

        if ($request->has('game')) {
            $requirementsQuery->where('game_id', $request->input('game'));
        }
        if ($request->has('search')) {
            $searchTerm = '%' . $request->input('search') . '%';

            $requirementsQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('commentary', 'like', $searchTerm);
                //   ->orWhere('description', 'like', $searchTerm)
                //   ->orWhere('content', 'like', $searchTerm);
            });
        }

        $requirements = $requirementsQuery->get();

        if (Auth::user() && Auth::user()->is_admin) {
            return view('requirements.table', compact('requirements'));
        } else {
            return view('requirements.index', compact('requirements'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $games = Game::all();
        $gameId = $request->input('game');

        return view('requirements.create', compact('gpus', 'cpus', 'games', 'gameId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'commentary' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:5000',

            'drive_require' => 'required|integer|min:0',
            'ram_require' => 'required|integer|min:0',
            'game_id' => 'required|exists:games,id',
        ], [
            'name.required' => 'Поле "Наименование" обязательно для заполнения.',
            'commentary.required' => 'Поле "Комментарий" обязательно для заполнения.',
            'commentary.max' => 'Длина комментария не должна превышать :max символов.',
            'description.max' => 'Длина описания не должна превышать :max символов.',
            'content.max' => 'Длина контента не должна превышать :max символов.',

            'drive_require.required' => 'Поле "Требование к накопителю" обязательно для заполнения.',
            'drive_require.integer' => 'Поле "Требование к накопителю" должно быть целым числом.',
            'drive_require.min' => 'Поле "Требование к накопителю" должно быть не меньше :min.',
            'ram_require.required' => 'Поле "Требование к оперативной памяти" обязательно для заполнения.',
            'ram_require.integer' => 'Поле "Требование к оперативной памяти" должно быть целым числом.',
            'ram_require.min' => 'Поле "Требование к оперативной памяти" должно быть не меньше :min.',
            'game_id.required' => 'Поле "Игра" обязательно для заполнения.',
            'game_id.exists' => 'Выбранная игра не существует.',
        ]);

        $request->validate([
            'gpus' => 'nullable|array',
            'cpus' => 'nullable|array',
        ], [
            'gpus.array' => 'Поле "Видеокарты" должно быть массивом.',
            'cpus.array' => 'Поле "Процессоры" должно быть массивом.',
        ]);


        $requirement = Requirement::create($validatedData);

        if ($request->has('gpus')) {
            $gpus = $request->input('gpus');
            $requirement->gpus()->attach($gpus);
        }

        if ($request->has('cpus')) {
            $cpus = $request->input('cpus');
            $requirement->cpus()->attach($cpus);
        }

        $requirement->save();

        return redirect()->route('requirements.edit', compact('requirement'))->with('success', "Требование №$requirement->id успешно создано");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Auth::user() && Auth::user()->is_admin) {
            $requirement = Requirement::withTrashed()->find($id);
            return view('requirements.item', compact('requirement'));
        } else {
            $requirement = Requirement::find($id);
            return view('requirements.show', compact('requirement'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $requirement = Requirement::withTrashed()->find($id);

        $gpus = Gpu::all();
        $cpus = Cpu::all();
        $games = Game::all();

        return view('requirements.edit', compact('requirement', 'gpus', 'cpus', 'games'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requirement = Requirement::withTrashed()->findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'commentary' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:5000',

            'drive_require' => 'required|integer|min:0',
            'ram_require' => 'required|integer|min:0',
            'game_id' => 'required|exists:games,id',
        ], [
            'name.required' => 'Поле "Наименование" обязательно для заполнения.',
            'commentary.required' => 'Поле "Комментарий" обязательно для заполнения.',
            'commentary.max' => 'Длина комментария не должна превышать :max символов.',
            'description.max' => 'Длина описания не должна превышать :max символов.',
            'content.max' => 'Длина контента не должна превышать :max символов.',
            
            'drive_require.required' => 'Поле "Требование к накопителю" обязательно для заполнения.',
            'drive_require.integer' => 'Поле "Требование к накопителю" должно быть целым числом.',
            'drive_require.min' => 'Поле "Требование к накопителю" должно быть не меньше :min.',
            'ram_require.required' => 'Поле "Требование к оперативной памяти" обязательно для заполнения.',
            'ram_require.integer' => 'Поле "Требование к оперативной памяти" должно быть целым числом.',
            'ram_require.min' => 'Поле "Требование к оперативной памяти" должно быть не меньше :min.',
            'game_id.required' => 'Поле "Игра" обязательно для заполнения.',
            'game_id.exists' => 'Выбранная игра не существует.',
        ]);


        $request->validate([
            'gpus' => 'nullable|array',
            'cpus' => 'nullable|array',
        ], [
            'gpus.array' => 'Поле "Видеокарты" должно быть массивом.',
            'cpus.array' => 'Поле "Процессоры" должно быть массивом.',
        ]);


        $requirement->fill($validatedData);

        if ($request->has('gpus')) {
            $gpus = $request->input('gpus');
            $requirement->gpus()->sync($gpus);
        } else {
            $requirement->gpus()->detach();
        }

        if ($request->has('cpus')) {
            $cpus = $request->input('cpus');
            $requirement->cpus()->sync($cpus);
        } else {
            $requirement->cpus()->detach();
        }

        $requirement->save();

        return redirect()->route('games.show', $request->input('game_id'))->with('success', "Требование №$id успешно обновлено");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $requirement = Requirement::withTrashed()->find($id);

        if (!$requirement) {
            return redirect()->back()->with('error', "Требование №$id не найдено");
        }

        if ($requirement->trashed()) {
            $requirement->restore();
            return redirect()->back()->with('success', "Требование №$id успешно восстановлено");
        } else {
            $requirement->delete();
            return redirect()->back()->with('success', "Требование №$id успешно удалено");
        }
    }
}
