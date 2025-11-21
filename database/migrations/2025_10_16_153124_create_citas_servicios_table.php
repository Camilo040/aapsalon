<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('citasServicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citaId')->constrained('citas')->onDelete('cascade');
            $table->foreignId('servicioId')->constrained('servicios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('citasServicios');
    }
};