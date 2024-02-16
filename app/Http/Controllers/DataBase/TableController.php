<?php

namespace App\Http\Controllers\DataBase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Excel\UniversalExport;
use App\Excel\UniversalImport;
use Maatwebsite\Excel\Facades\Excel;


class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $tables = DB::table('information_schema.tables')
            ->where('table_schema', env('DB_DATABASE'))
            ->get();


        // $tablesData = [];
        // $tables = DB::select('SHOW TABLES');

        // foreach ($tables as $table) {
        //     $tableName = current($table);

        //     // Получение комментария к таблице и количества строк
        //     $tableInfo = DB::select("SELECT table_comment, table_rows FROM information_schema.tables WHERE table_schema = ? AND table_name = ?", [env('DB_DATABASE'), $tableName]);

        //     if (!empty($tableInfo)) {
        //         $tableComment = $tableInfo[0]->table_comment ?: $tableName;
        //         $rowCount = $tableInfo[0]->table_rows;

        //         $tablesData[] = [
        //             'name' => $tableName,
        //             'comment' => $tableComment,
        //             'count' => $rowCount,
        //         ];
        //     }
        // }

        return view('database.tables.index', ['tables' => $tables]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    

    public function clean($tableName)
    {
        if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'deleted_at')) {
            DB::table($tableName)->whereNotNull('deleted_at')->delete();
            return redirect()->back()->with('success', "Корзина таблицы $tableName успешно очищена");;
        } else {
            return redirect()->back()->with('error', "Корзина таблицы $tableName не очищена");;
        }
    }

    public function export(Request $request, $table)
    {
        switch ($request->input('trashed')) {
            case 'only':
                $data = DB::table($table)->onlyTrashed()->get();
                break;

            case 'with':
                $data = DB::table($table)->withTrashed()->get();
                break;

            default:
                $data = DB::table($table)->get();
        }

        $file = new UniversalExport($data, $table);

        return Excel::download($file, "{$table}.xlsx");
    }

    public function import(Request $request, $table)
    {
        $file = $request->file('excel');
        $clearId = $request->input('clear_id');

        if (!$file) {
            return redirect()->back()->with('error', "Файл для загрузки не указан");
        }

        Excel::import(new UniversalImport($table, $clearId), $file);
        return redirect()->back()->with('success', "Файл $file успешно импортирован в таблицу $table");
    }
}
