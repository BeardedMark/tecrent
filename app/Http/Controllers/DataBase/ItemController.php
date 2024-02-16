<?php

namespace App\Http\Controllers\DataBase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\Classes\TableClass;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($table)
    {
        $tableClass = new TableClass($table);

        return view('database.tables.items.index', [
            'table' => $tableClass->getTable(),
            'columns' => $tableClass->getColumns(),
            'data' => $tableClass->getData(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($table)
    {
        $tableClass = new TableClass($table);

        return view('database.tables.items.create', [
            'table' => $tableClass->getTable(),
            'columns' => $tableClass->getColumns(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $table)
    {
        $tableName = $table;
        $requestData = $request->only(Schema::getColumnListing($tableName));

        $requestData['created_at'] = now();

        DB::table($tableName)->insert($requestData);
        $id = DB::getPdo()->lastInsertId();

        return redirect()->route('items.show', ['table' => $tableName, 'id' => $id])->with('success', "Запись с номером $id успешно создана в таблице $tableName");
    }

    /**
     * Display the specified resource.
     */
    public function show($table, $id)
    {
        $tableClass = new TableClass($table);

        return view('database.tables.items.show', [
            'table' => $tableClass->getTable(),
            'item' => $tableClass->getItem($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($table, $id)
    {
        $tableClass = new TableClass($table);

        return view('database.tables.items.edit', [
            'table' => $tableClass->getTable(),
            'columns' => $tableClass->getColumns(),
            'item' => $tableClass->getItem($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $tableName, $id)
    {
        $requestData = array_intersect_key(
            $request->except(['id']),
            $request->only(Schema::getColumnListing($tableName))
        );

        $requestData['updated_at'] = now();
        DB::table($tableName)->where('id', $id)->update($requestData);

        return redirect()->route('items.show', ['table' => $tableName, 'id' => $id])->with('success', "Запись с номером $id успешно обновлена в таблице $tableName");;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($table, $id)
    {
        $tableName = $table;
        $item = DB::table($tableName)->find($id);

        if (!$item) {
            return redirect()->back()->with('error', 'Запись не найдена');
        }

        if (collect(Schema::getColumnListing($tableName))->contains('deleted_at')) {
            if ($item->deleted_at) {
                DB::table($tableName)->where('id', $id)->update(['deleted_at' => null]);
                return redirect()->route('items.index', ['table' => $tableName])->with('success', "Запись $id успешно раскрыта");
            } else {
                DB::table($tableName)->where('id', $id)->update(['deleted_at' => now()]);
                return redirect()->route('items.index', ['table' => $tableName])->with('success', "Запись $id успешно скрыта");
            }
        } else {
            DB::table($tableName)->where('id', $id)->delete();
            return redirect()->route('items.index', ['table' => $tableName])->with('success', "Запись $id перманентно удалена");
        }
    }
}
