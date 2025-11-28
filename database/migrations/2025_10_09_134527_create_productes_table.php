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
        Schema::create('productes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('llista_id')->constrained('llistas')->onDelete('cascade');
            $table->foreignId('categoria_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->string('nom');
            $table->integer('quantitat')->default(1);
            $table->boolean('comprat')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productes');
    }
};
