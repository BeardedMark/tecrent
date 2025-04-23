<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            // Стандартное
            $table->id(); // Уникальный идентификатор

            // Содержимое
            $table->string('type')->nullable()->comment('Тип записи');
            $table->string('group')->nullable()->comment('Группа записи');
            $table->string('name')->nullable()->comment('Название предложения');
            $table->text('description')->nullable()->comment('Краткое описание');
            $table->longText('content')->nullable()->comment('Полное содержимое');
            $table->text('comment')->nullable()->comment('Комментарии к предложению');
            $table->string('tags')->nullable()->comment('Теги через запятую');

            // Параметры
            $table->string('template')->nullable()->comment('Шаблон отображения');
            $table->integer('rating')->nullable()->comment('Рейтинг записи');
            $table->json('data')->nullable()->comment('Дополнительные параметры');

            // Медиаконтент
            $table->string('image')->nullable()->comment('Главное изображение');
            $table->string('wallpaper')->nullable()->comment('Фоновое изображение');
            $table->json('gallery')->nullable()->comment('Галерея изображений');
            $table->string('video')->nullable()->comment('Ссылка на видео');
            $table->string('link')->nullable()->comment('Ссылка на сторонний ресурс');

            // Метаданные
            $table->string('meta_title')->nullable()->comment('SEO заголовок');
            $table->text('meta_description')->nullable()->comment('SEO описание');
            $table->text('meta_keywords')->nullable()->comment('SEO ключевые слова');
            $table->text('meta_favicon')->nullable()->comment('SEO иконка страницы');

            // Даты
            $table->timestamps(); // created_at и updated_at
            $table->softDeletes(); // deleted_at для мягкого удаления
            $table->timestamp('main_at')->nullable()->comment('Дата главенства');
            $table->timestamp('favorited_at')->nullable()->comment('Дата публикации');
            $table->timestamp('published_at')->nullable()->comment('Дата публикации');
            $table->timestamp('archived_at')->nullable()->comment('Дата архивации');

            // Предложение
            $table->decimal('price', 10, 2)->nullable()->comment('Цена предложения');
            $table->decimal('sale', 10, 2)->nullable()->comment('Новая цена');
            $table->string('code')->nullable()->unique()->comment('Уникальный код предложения');
            $table->string('unit', 50)->nullable()->comment('Единица измерения');
            $table->integer('stock')->nullable()->comment('Общее количество');
            $table->integer('min')->nullable()->comment('Минимальное количество');
            $table->integer('step')->nullable()->comment('Шаг увеличения количества');
            $table->integer('max')->nullable()->comment('Максимальное количество');

            // Статистика
            $table->unsignedBigInteger('stat_views')->default(0)->comment('Количество просмотров');
        });
    }

    public function down()
    {
        Schema::dropIfExists('offers');
    }
};
