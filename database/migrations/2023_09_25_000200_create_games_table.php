<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->comment('Игры');
            
            $table->id()->comment('Номер');
            $table->string('name')->comment('Наименование');
            $table->string('commentary')->nullable()->comment('Комментарий');
            $table->text('description')->nullable()->comment('Описание');
            $table->text('content')->nullable()->comment('Контент');
            $table->string('image')->nullable()->comment('Изображение');
            $table->string('video')->nullable()->comment('Видео');
            $table->string('link')->nullable()->comment('Ссылка');
            
            $table->string('autor')->nullable()->comment('Автор');
            $table->string('developer')->nullable()->comment('Разработчик');
            $table->string('publisher')->nullable()->comment('Издатель');
            $table->date('release')->nullable()->comment('Релиз');
            $table->boolean('is_server')->default(false)->comment('Можно открыть сервер');
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->unique(['name', 'autor', 'release'], 'unique_name_autor_release');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
