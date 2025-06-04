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
        // Create the 'reservations' table
        Schema::create('reservations', function (Blueprint $table) {
    $table->id();// Auto-incrementing primary key
    $table->string('nom_client');// Client's name
    $table->string('email_client');// Client's email
    $table->foreignId('voiture_id')->constrained('cars')->onDelete('cascade');// Foreign key referencing the 'cars' table// Deletes reservations if the car is deleted
    $table->date('date_debut');// Start date of the reservation
    $table->date('date_fin');// End date of the reservation
    $table->decimal('prix_total', 10, 2);// Total price for the reservation
    $table->timestamps();// Timestamps for created_at and updated_at
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
