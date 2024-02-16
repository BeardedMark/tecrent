<?php

namespace App\Http\Controllers\DataBase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folderPath = storage_path('content');
        $files = File::allFiles($folderPath);
        return view('database.editor', ['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('database.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $folderPath = storage_path('content');
        $fileName = $request->input('filename');
        $fileContent = $request->input('filecontent');

        $filePath = $folderPath . '/' . $fileName . '.json';
        File::put($filePath, $fileContent);

        return redirect()->route('content.index')->with('success', 'Файл успешно создан.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $filePath = storage_path('content/' . $id . '.json');

        if (File::exists($filePath)) {
            $fileContent = File::get($filePath);
            return view('database.show', ['fileContent' => $fileContent]);
        } else {
            return redirect()->route('content.index')->with('error', 'Файл не найден.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $filePath = storage_path('content/' . $id . '.json');

        if (File::exists($filePath)) {
            $fileContent = File::get($filePath);
            return view('database.edit', ['fileContent' => $fileContent, 'fileName' => $id]);
        } else {
            return redirect()->route('content.index')->with('error', 'Файл не найден.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $folderPath = storage_path('content');
        $fileContent = $request->input('filecontent');

        $filePath = $folderPath . '/' . $id . '.json';
        File::put($filePath, $fileContent);

        return redirect()->route('content.index')->with('success', 'Файл успешно обновлен.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $filePath = storage_path('content/' . $id . '.json');

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->route('content.index')->with('success', 'Файл успешно удален.');
        } else {
            return redirect()->route('content.index')->with('error', 'Файл не найден.');
        }
    }
}
