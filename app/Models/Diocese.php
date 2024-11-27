<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diocese extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function ecoles()
    {
        return $this->hasMany(Ecole::class);
    }

}
