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
        Schema::create('images', function (Blueprint $table) {
            $table->comment('Изображения');

            $table->id()->comment('Номер');
            $table->string('name')->nullable()->comment('Наименование');
            $table->text('alt')->nullable()->comment('Альтернативный текст');
            $table->string('path')->nullable()->comment('Локальный путь');
            $table->string('url')->nullable()->comment('Внешняя ссылка');
            
            $table->unsignedBigInteger('imageable_id')->comment('Номер владельца');
            $table->string('imageable_type')->comment('Тип владельца');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
