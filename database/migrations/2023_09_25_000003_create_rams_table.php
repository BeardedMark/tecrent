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
        Schema::create('rams', function (Blueprint $table) {
            $table->comment('Оперативки');
            
            $table->id()->comment('Номер');
            $table->string('name')->comment('Наименование');
            $table->string('commentary')->nullable()->comment('Комментарий');
            $table->text('description')->nullable()->comment('Описание');
            $table->text('content')->nullable()->comment('Контент');
            $table->string('image')->nullable()->comment('Изображение');

            $table->string('manufacturer')->nullable()->comment('Производитель');
            $table->integer('capacity')->comment('Объем памяти');
            $table->string('type')->comment('Тип памяти');
            $table->integer('power')->comment('Мощность')->default(100);

            $table->float('frequency')->comment('Частота работы');

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['name', 'capacity', 'type'], 'unique_name_capacity_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rams');
    }
};
