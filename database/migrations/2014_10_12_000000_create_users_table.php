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
        Schema::create('users', function (Blueprint $table) {
            $table->comment('Пользователи');
            $table->id()->comment('Номер');
            $table->string('name')->nullable()->comment('Имя');
            $table->string('login')->unique()->comment('Логин');
            $table->string('email')->unique()->comment('Почта');
            $table->timestamp('email_verified_at')->nullable()->comment('Дата подтверждения');
            $table->string('password')->comment('Пароль');

            $table->boolean('is_admin')->default(false)->comment('Администратор');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
