<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $table = 'utilisateurs'; // Indique que le modèle utilise la table 'utilisateurs'

    protected $fillable = [
        'name',
        'email',
        'password',
        'droit',
    ];

     // Assure-toi que le mot de passe est toujours haché
     protected $hidden = [
        'password',
    ];

    // Méthode pour compter les utilisateurs avec le droit 'inscrire'
    public static function countInscrits()
    {
        return self::where('droit', 'inscrire')->count();
    }
}
