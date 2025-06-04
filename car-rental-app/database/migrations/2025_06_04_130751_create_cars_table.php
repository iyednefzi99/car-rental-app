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
        // Create the 'cars' table
       Schema::create('cars', function (Blueprint $table) {
            // Define the columns for the 'cars' table

    $table->id();// Auto-incrementing primary key
    $table->string('marque');// Car brand 
    $table->string('modèle');// Car model
    $table->string('immatriculation')->unique();// Unique registration number
    $table->decimal('prix_par_jour', 10, 2);// Daily rental price
    $table->string('image')->nullable();// Optional image URL for the car
    $table->boolean('disponible')->default(true);// Availability status, default is true (available)
    $table->timestamps();// Timestamps for created_at and updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
