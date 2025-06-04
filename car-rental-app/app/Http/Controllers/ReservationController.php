<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car; // N'oubliez pas d'importer le modèle Car
use App\Models\Reservation; // Et le modèle Reservation
use Carbon\Carbon; // Pour la gestion des dates

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created reservation in storage.
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire de réservation
        $validated = $request->validate([
            'nom_client' => 'required|string|max:100',
            'email_client' => 'required|email|max:100',
            'voiture_id' => 'required|exists:cars,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        // Récupère la voiture à réserver
        $car = Car::findOrFail($validated['voiture_id']);
        
        // Vérifie la disponibilité de la voiture pour les dates demandées
        if (!$car->estDisponible($validated['date_debut'], $validated['date_fin'])) {
            return back()->with('error', 'Voiture non disponible pour ces dates !');
        }

        // Calcule le nombre de jours de réservation
        $jours = Carbon::parse($validated['date_debut'])->diffInDays($validated['date_fin']) + 1;
        // Calcule le prix total de la réservation
        $prix_total = $jours * $car->prix_par_jour;

        // Crée la réservation dans la base de données
        Reservation::create([
            'nom_client' => $validated['nom_client'],
            'email_client' => $validated['email_client'],
            'voiture_id' => $car->id,
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'prix_total' => $prix_total,
        ]);

        // Redirige avec un message de succès
        return redirect()->route('cars.index')->with('success', 'Réservation confirmée !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
