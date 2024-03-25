<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        $title = 'Посты';
        $description = 'Наша личная абра-кадабра';

        return view('posts.index', compact('posts', 'title', 'description'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:posts,name',
        ], [
            'name.required' => 'Поле "Наименование" обязательно для заполнения.',
            'name.unique' => 'Такое "Наименование" уже существует.',
        ]);
        

        $post = Post::create($validatedData);
        $post->save();

        return redirect()->route('posts.edit', compact('post'))->with('success', "Пост №$post->id успешно создан.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $posts = Post::inRandomOrder()->take(3)->get();
        return view('posts.show', compact('post', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post = Post::withTrashed()->findOrFail($post->id);

        $validatedData = $request->validate([
            'name' => 'required|string|unique:computers,name,' . $post->name,
            'commentary' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'content' => 'nullable|string|max:5000',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image' => 'nullable',
            'emoji' => 'nullable|string|max:5',
            'link' => 'nullable|string|max:1000',
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
            'emoji.max' => 'Длина эмоции не должна превышать :max символов.',
            'link.max' => 'Длина ссылки не должна превышать :max символов.',
        ]);
        

        $post->fill($validatedData);
        $post->save();

        return redirect()->route('posts.show', compact('post'))->with('success', "Информация о посте №$post->id успешно обновлена.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
