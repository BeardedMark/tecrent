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
        Schema::create('complects', function (Blueprint $table) {

            $table->comment('Комплекты');
            
            $table->id()->comment('Номер');
            $table->string('name')->unique()->comment('Наименование');
            $table->string('commentary')->nullable()->comment('Комментарий');
            $table->text('description')->nullable()->comment('Описание');
            $table->text('content')->nullable()->comment('Контент');
            $table->string('image')->nullable()->comment('Изображение');

            $table->integer('price')->default(0)->comment('Цена');
            $table->integer('period')->nullable()->comment('Минимум дней');

            $table->unsignedBigInteger('computer_id')->nullable()->comment('Компьютер');
            $table->foreign('computer_id')->references('id')->on('computers')->onDelete('SET NULL');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complects');
    }
};
