<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    // Définir la relation avec le modèle Car
    // Une réservation appartient à une seule voiture
    // La clé étrangère dans la table reservations est 'voiture_id'
    // Cela permet d'accéder à la voiture associée à cette réservation
    public function car() {
        return $this->belongsTo(Car::class, 'voiture_id'); // 'voiture_id' est la clé étrangère dans la table reservations
    }

    // Calculer le nombre de jours entre la date de début et la date de fin de la réservation
    // Cette méthode utilise Carbon pour analyser les dates de début et de fin
    // Les champs 'date_debut' et 'date_fin' sont supposés être présents dans la table reservations
    // Le +1 permet d'inclure à la fois la date de début et la date de fin dans le calcul
    public function getNombreJoursAttribute() {
        return Carbon::parse($this->date_debut)
            ->diffInDays(Carbon::parse($this->date_fin)) + 1;
    }
}
