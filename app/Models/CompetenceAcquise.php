<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompetenceAcquise extends Model
{
    use HasFactory;

    protected $table = 'competences_acquises';

    protected $fillable = [
        'nom',
        'categorie',
        'image',
        'ordre',
    ];
}
