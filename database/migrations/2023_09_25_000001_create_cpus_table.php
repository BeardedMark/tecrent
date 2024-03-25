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
        Schema::create('cpus', function (Blueprint $table) {
            $table->comment('Процессоры');
            
            $table->id()->comment('Номер');
            $table->string('name')->comment('Наименование');
            $table->string('commentary')->nullable()->comment('Комментарий');
            $table->text('description')->nullable()->comment('Описание');
            $table->text('content')->nullable()->comment('Контент');
            $table->string('image')->nullable()->comment('Изображение');

            $table->integer('power')->comment('Мощность')->default(100);

            $table->string('model')->nullable()->comment('Модель');
            $table->float('frequency')->nullable()->comment('Частота');
            $table->integer('cores_count')->nullable()->comment('Количество ядер');
            $table->integer('threads_count')->nullable()->comment('Количество потоков');
            $table->string('cache')->nullable()->comment('Кэш-память');
            $table->string('socket')->nullable()->comment('Сокет');
            $table->string('manufacturer')->nullable()->comment('Производитель');

            $table->timestamps();
            $table->softDeletes();
            
            $table->unique(['name', 'manufacturer'], 'unique_name_manufacturer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpus');
    }
};
