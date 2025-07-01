<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Ajouter cette ligne

class Pointage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_pointage',
        'heure_arrivee',
        'heure_depart',
        'justificatif_retard',
        'statut',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
