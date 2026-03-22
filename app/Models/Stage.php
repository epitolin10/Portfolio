<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'entreprise',
        'secteur',
        'ville',
        'date_debut',
        'date_fin',
        'description',
        'logo',
        'maitre_stage',
        'annee', // 1 ou 2
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin'   => 'date',
    ];

    public function activites()
    {
        return $this->hasMany(Activite::class);
    }

    public function getDureeAttribute()
    {
        $weeks = (int) round($this->date_debut->diffInWeeks($this->date_fin));
        $label = $weeks > 1 ? 'semaines' : 'semaine';

        return $weeks . ' ' . $label;
    }
}