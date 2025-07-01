<?php

namespace App\Models;

use App\Models\Tache;
use App\Models\Pointage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'first_name',
        'created_by',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => null,
        'password' => 'hashed',
    ];

    public function taches()
    {
        return $this->hasMany(Tache::class);
    }

    public function pointages()
    {
        return $this->hasMany(Pointage::class);
    }
}
