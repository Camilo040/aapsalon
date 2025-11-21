<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('telefono', 20)->nullable();
            $table->boolean('admin')->default(false);
            $table->boolean('confirmado')->default(false);
            $table->string('token', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};