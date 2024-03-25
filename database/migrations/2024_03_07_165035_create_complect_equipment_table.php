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
        Schema::create('complect_equipment', function (Blueprint $table) {
            $table->comment('Оборудование для комплектов');
            
            $table->id()->comment('Номер');
            
            $table->unsignedBigInteger('complect_id')->comment('Комплект');
            $table->foreign('complect_id')->references('id')->on('complects')->onDelete('CASCADE');

            $table->unsignedBigInteger('equipment_id')->comment('Оборудование');
            $table->foreign('equipment_id')->references('id')->on('equipment')->onDelete('CASCADE');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complect_equipment');
    }
};
