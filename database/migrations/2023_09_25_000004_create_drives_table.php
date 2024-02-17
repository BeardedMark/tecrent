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
        Schema::create('drives', function (Blueprint $table) {
            $table->comment('Накопители');
            
            $table->id()->comment('Номер');
            $table->string('name')->comment('Наименование');
            $table->string('commentary')->nullable()->comment('Комментарий');
            $table->text('description')->nullable()->comment('Описание');
            $table->text('content')->nullable()->comment('Контент');
            $table->string('image')->nullable()->comment('Изображение');
            
            $table->string('manufacturer')->nullable()->comment('Производитель');
            $table->integer('capacity')->comment('Объем');
            $table->string('type')->comment('Тип');
            $table->integer('power')->comment('Мощность')->default(100);

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['name', 'capacity', 'manufacturer'], 'unique_name_capacity_manufacturer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drives');
    }
};
