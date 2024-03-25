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
        Schema::create('comments', function (Blueprint $table) {
            $table->comment('Комментарии');

            $table->id()->comment('Номер');
            
            $table->unsignedBigInteger('commentable_id')->comment('Номер владельца');
            $table->string('commentable_type')->comment('Тип владельца');

            $table->unsignedBigInteger('user_id')->comment('Пользователь');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->text('content')->comment('Контент');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
