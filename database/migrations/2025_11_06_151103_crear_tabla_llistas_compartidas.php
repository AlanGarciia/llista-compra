<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('llistas_compartidas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('remitente_id')->constrained('users')->onDelete('cascade'); // Quien comparte
            $table->foreignId('receptor_id')->constrained('users')->onDelete('cascade');  // Quien recibe
            $table->foreignId('llista_original_id')->constrained('llistas')->onDelete('cascade'); // Qué lista se compartió
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('llistas_compartidas');
    }
};
