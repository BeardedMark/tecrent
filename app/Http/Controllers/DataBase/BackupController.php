<?php

namespace App\Http\Controllers\DataBase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folderPath = storage_path('backups');
        $files = File::allFiles($folderPath);
        $compareFunction = function ($a, $b) {
            return filemtime($b->getRealPath()) - filemtime($a->getRealPath());
        };

        usort($files, $compareFunction);
        return view('database.backups.index', ['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = DB::table('information_schema.tables')
            ->where('table_schema', env('DB_DATABASE'))
            ->get();

        return view('database.backups.create', ['tables' => $tables]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $allKeys = $request->keys();
        $tables = DB::table('information_schema.tables')
            ->select('table_name')
            ->whereIn('table_name', $allKeys)
            ->get();

        $data = [];

        foreach ($tables as $table) {
            $tableName = reset($table);
            $tableData = DB::table($tableName)->get();
            $data[$tableName] = $tableData;
        }

        $fileName = now()->format('YmdHis') . '.json';
        $jsonContent = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $filePath = storage_path('backups/' . $fileName);
        File::put($filePath, $jsonContent);

        return redirect()->route('backups.show', $fileName)->with('success', "Резервная копия создана");
    }

    /**
     * Display the specified resource.
     */
    public function show($fileName)
    {
        $filePath = storage_path("backups/" . $fileName);
        $fileContent = File::get($filePath);

        return view('database.backups.show', ['fileContent' => $fileContent, 'fileName' => $fileName]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $fileName)
    {
        $filePath = storage_path("backups/" . $fileName);
        $fileContent = File::get($filePath);

        return view('database.backups.edit', ['fileContent' => $fileContent, 'fileName' => $fileName]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $fileName)
    {
        $truncateTables = $request->has('truncateTables');
        $filePath = storage_path('backups/' . $fileName);
    
        if (File::exists($filePath)) {
            $jsonContent = File::get($filePath);
            $data = json_decode($jsonContent, true);
    
            // Собираем информацию о таблицах и времени их создания
            $tableInfo = [];
            foreach ($data as $tableName => $tableData) {
                $createdAt = DB::table('information_schema.tables')
                    ->where('table_name', $tableName)
                    ->value('create_time');
    
                $tableInfo[$tableName] = $createdAt;
            }
    
            // Сортировка таблиц по времени создания
            asort($tableInfo);
    
            foreach ($tableInfo as $tableName => $createdAt) {
                $tableData = $data[$tableName];
                $tableColumns = Schema::getColumnListing($tableName);
                $insertData = [];
    
                if ($truncateTables) {
                    DB::table($tableName)->truncate();
                }
    
                foreach ($tableData as $row) {
                    // Фильтрация данных по столбцам таблицы
                    $filteredRow = array_intersect_key($row, array_flip($tableColumns));
                    $insertData[] = $filteredRow;
                }
    
                // Вставка данных с использованием insertOrIgnore
                DB::table($tableName)->insertOrIgnore($insertData);
            }
        }
    
        return redirect()->route('backups.show', $fileName)->with('success', "Резервная копия восстановлена");
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($fileName)
    {
        $filePath = storage_path("backups/" . $fileName);

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->route('backups.index')->with('success', 'Бекап успешно удален.');
        }

        return redirect()->route('backups.index')->with('error', 'Не удалось найти бекап.');
    }

    public function downloadBackup($fileName)
    {
        $filePath = storage_path("backups/" . $fileName);
        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/json',
        ]);
    }
}
