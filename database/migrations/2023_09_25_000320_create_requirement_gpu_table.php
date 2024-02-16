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
        Schema::create('requirement_gpu', function (Blueprint $table) {
            $table->comment('Видеокарты для требований');
            $table->id()->comment('Номер');
            
            $table->unsignedBigInteger('requirement_id')->comment('Требование');
            $table->foreign('requirement_id')->references('id')->on('requirements')->onDelete('CASCADE');

            $table->unsignedBigInteger('gpu_id')->comment('Видеокарта');
            $table->foreign('gpu_id')->references('id')->on('gpus')->onDelete('CASCADE');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirement_gpu');
    }
};
