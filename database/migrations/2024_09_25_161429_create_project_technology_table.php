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
        Schema::create('project_technology', function (Blueprint $table) {
            // foreignId è una funzione che mi crea automaticamente un unsignedBigInt
            // constrained è una funzione che mi collega automaticamente i campi (project_id, technology_id) alle tabelle (projects, technologies)
            //https://laravel.com/docs/11.x/migrations#foreign-key-constraints
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('technology_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
