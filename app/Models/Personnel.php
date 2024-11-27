<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    public function ecole()
    {
        return $this->belongsTo(Ecole::class);
    }
    // Ajoutez ici les colonnes autorisées pour l'assignation massive
    protected $fillable = [
        'nbre_de_femmes',
        'nbre_de_hommes',
        'nbre_religieux',
        'nbre_religieuse',
        'nbre_pretre',
        'nbre_soeur',
        'nbre_autres_religieux',
        'nbre_enseignant_f',
        'nbre_enseignant_h',
        'annee_id',
        'ecole_id',
        'user_id',
    ];

    // Relation avec Year
    public function annee()
    {
        return $this->belongsTo(Year::class, 'annee_id');
    }


}
