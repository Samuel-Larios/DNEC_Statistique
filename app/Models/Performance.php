<?php

namespace App\Models;

use App\Models\Year;
use App\Models\Ecole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Performance extends Model
{
    use HasFactory;


    protected $fillable = [
        'classe',
        'eleveInscrit',
        'nbreFille',
        'nbreGarcon',
        'nbreMoyenne',
        'nbreMfille',
        'nbreMgarcon',
        'nbreAbandon',
        'annee_id',
        'ecole_id'
    ];

    public function annee()
    {
        return $this->belongsTo(Year::class);
    }

    public function ecole()
    {
        return $this->belongsTo(Ecole::class);
    }
}
