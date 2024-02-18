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
        Schema::create('computers', function (Blueprint $table) {
            $table->comment('Компьютеры');
            
            $table->id()->comment('Номер');
            $table->string('name')->unique()->comment('Наименование');
            $table->string('commentary')->nullable()->comment('Комментарий');
            $table->text('description')->nullable()->comment('Описание');
            $table->text('content')->nullable()->comment('Контент');
            $table->string('image')->nullable()->comment('Изображение');

            $table->integer('price')->default(0)->comment('Цена');
            $table->integer('ram_count')->default(1)->comment('Количество оперативки');

            $table->unsignedBigInteger('gpu_id')->nullable()->comment('Видеокарта');
            $table->foreign('gpu_id')->references('id')->on('gpus')->onDelete('SET NULL');

            $table->unsignedBigInteger('cpu_id')->nullable()->comment('Процессор');
            $table->foreign('cpu_id')->references('id')->on('cpus')->onDelete('SET NULL');

            $table->unsignedBigInteger('ram_id')->nullable()->comment('Оперативка');
            $table->foreign('ram_id')->references('id')->on('rams')->onDelete('SET NULL');

            $table->unsignedBigInteger('drive_id')->nullable()->comment('Накопитель');
            $table->foreign('drive_id')->references('id')->on('drives')->onDelete('SET NULL');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computers');
    }
};
