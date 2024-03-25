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
        Schema::create('gpus', function (Blueprint $table) {
            $table->comment('Видеокарты');
            
            $table->id()->comment('Номер');
            $table->string('name')->comment('Наименование');
            $table->string('commentary')->nullable()->comment('Комментарий');
            $table->text('description')->nullable()->comment('Описание');
            $table->text('content')->nullable()->comment('Контент');
            $table->string('image')->nullable()->comment('Изображение');

            $table->string('manufacturer')->nullable()->comment('Производитель');
            $table->integer('power')->comment('Мощность')->default(100);

            $table->string('model')->nullable()->comment('Модель');
            $table->integer('memory_size')->nullable()->comment('Объем видеопамяти');
            $table->string('memory_type')->nullable()->comment('Тип памяти');
            $table->float('gpu_frequency')->nullable()->comment('Частота GPU');
            $table->string('interface')->nullable()->comment('Интерфейс подключения');
            
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
        Schema::dropIfExists('gpus');
    }
};
