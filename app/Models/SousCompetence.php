<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousCompetence extends Model
{
    use HasFactory;

    protected $fillable = ['competence_id', 'intitule'];

    public function competence()
    {
        return $this->belongsTo(Competence::class);
    }

    public function activites()
    {
        return $this->belongsToMany(Activite::class, 'activite_sous_competence');
    }
}
