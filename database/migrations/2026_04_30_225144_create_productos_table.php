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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            // FK: id_categoria (Relación con la tabla categorias) 
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->string('nombre', 150);
            $table->text('descripcion');
            $table->decimal('precio', 10, 2);
            // stock: INT >= 0 (Usamos unsigned para garantizar que no sea negativo) 
            $table->unsignedInteger('stock');
            $table->string('url_imagen', 255)->nullable();
            $table->enum('estado', ['Activo', 'Inactivo']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
