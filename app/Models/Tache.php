<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_tache',
        'libelle_tache',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
