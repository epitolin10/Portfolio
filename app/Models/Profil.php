<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'email', 'option',
        'bio', 'photo', 'linkedin', 'github',
    ];
}