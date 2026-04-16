<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $fillable = [
        'intitule',
        'intitule_court',
        'description_courte',
        'icone',
        'ordre',
    ];

    public function sousCompetences()
    {
        return $this->hasMany(SousCompetence::class);
    }
}
