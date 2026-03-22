<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etude extends Model
{
    use HasFactory;

    protected $fillable = [
        'intitule',
        'etablissement',
        'ville',
        'niveau',
        'mention',
        'date_debut',
        'date_fin',
        'en_cours',
        'description',
        'ordre',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin'   => 'date',
        'en_cours'   => 'boolean',
    ];

    public function getDureeAttribute(): string
    {
        $debut = $this->date_debut->format('Y');
        $fin   = $this->en_cours ? 'aujourd\'hui' : ($this->date_fin?->format('Y') ?? '?');
        return $debut . ' – ' . $fin;
    }
}
