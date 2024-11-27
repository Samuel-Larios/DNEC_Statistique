<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'serie',
        'annee_id',
        'ecole_id',
        'total_inscrit',
        'fille',
        'garcon',
        'total_admis',
        'fille_admis',
        'garcon_admis',
        'total_passable',
        'fille_passable',
        'garcon_passable',
        'total_bien',
        'fille_bien',
        'garcon_bien',
        'total_tbien',
        'fille_tbien',
        'garcon_tbien',
        'total_honorable',
        'fille_honorable',
        'garcon_honorable',
    ];


    public function year()
    {
        return $this->belongsTo(Year::class, 'annee_id');
    }


    public function ecole()
    {
        return $this->belongsTo(Ecole::class);
    }
}
