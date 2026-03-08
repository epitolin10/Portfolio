<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competence extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'intitule',
        'intitule_court',
        'description_courte',
        'icone',
        'ordre',
    ];

    public function activites()
    {
        return $this->belongsToMany(Activite::class, 'activite_competence');
    }

    public function sousCompetences()
    {
        return $this->hasMany(SousCompetence::class);
    }
}