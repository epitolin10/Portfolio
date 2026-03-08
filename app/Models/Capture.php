<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capture extends Model
{
    protected $fillable = ['activite_id', 'chemin', 'nom'];

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }
}