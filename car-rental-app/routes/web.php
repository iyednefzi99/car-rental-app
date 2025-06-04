<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;

// ====================
// Routes publiques
// ====================

// Page d'accueil affichant la liste des voitures
Route::get('/', [CarController::class, 'index'])->name('cars.index');

// Affichage des voitures (index, show uniquement)
Route::resource('cars', CarController::class)->only(['index', 'show']);

// Création et enregistrement des réservations (public)
Route::resource('reservations', ReservationController::class)->only(['create', 'store']);


// ====================
// Routes administrateur
// ====================

Route::prefix('admin')->group(function () {
    // Gestion des voitures (toutes les actions sauf index et show)
    Route::resource('cars', CarController::class)->except(['index', 'show']);

    // Affichage des réservations côté admin
    //Route::get('reservations', [AdminController::class, 'reservations'])->name('admin.reservations');
});
