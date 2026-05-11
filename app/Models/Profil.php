<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'email', 'titre',
        'bio', 'photo', 'cv', 'linkedin', 'github',
    ];
}