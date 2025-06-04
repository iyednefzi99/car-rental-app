<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car; // Add this import

class CarController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'marque' => 'required|string|max:100',
            'modèle' => 'required|string|max:100',
            'immatriculation' => 'required|string|max:50|unique:cars',
            'prix_par_jour' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Vérifie si une image a été envoyée et la stocke
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/cars');
            // On enlève 'public/' pour ne garder que le chemin relatif
            $validated['image'] = str_replace('public/', '', $path);
        }

        // Création de la voiture dans la base de données
        Car::create($validated);

        // Redirection avec un message de succès
        return redirect()->route('admin.cars.index')->with('success', 'Voiture ajoutée !');
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
