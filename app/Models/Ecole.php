<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ecole extends Model
{
    /** @use HasFactory<\Database\Factories\EcoleFactory> */
    use HasFactory;

    protected $fillable = ['nom', 'diocese_id'];

    // Relation avec le diocèse
    public function diocese()
    {
        return $this->belongsTo(Diocese::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ecole_user');
    }

}
