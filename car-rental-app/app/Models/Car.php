<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /**
     * Définir la relation avec le modèle Reservation.
     * Une voiture peut avoir plusieurs réservations.
     * La clé étrangère dans la table reservations est 'voiture_id'.
     * Cela permet d'accéder à toutes les réservations d'une voiture spécifique.
     */
    public function reservations() {
        return $this->hasMany(Reservation::class, 'voiture_id'); // 'voiture_id' est la clé étrangère dans la table reservations
    }

    /**
     * Vérifie si la voiture est disponible pour une plage de dates donnée.
     * Cette méthode vérifie s'il existe des réservations qui se chevauchent avec la plage de dates donnée.
     * Si aucune réservation ne chevauche, la voiture est disponible.
     * Retourne true si la voiture est disponible, false sinon.
     *
     * @param string $date_debut
     * @param string $date_fin
     * @return bool
     */
    public function estDisponible($date_debut, $date_fin) {
        return !$this->reservations()
            ->where(function($query) use ($date_debut, $date_fin) {
                $query->whereBetween('date_debut', [$date_debut, $date_fin])
                      ->orWhereBetween('date_fin', [$date_debut, $date_fin]);
            })->exists();
    }
}
