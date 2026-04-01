<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntrepriseAp extends Model
{
    use HasFactory;

    protected $table = 'entreprises_ap';

    protected $fillable = [
        'nom',
        'logo',
    ];

    public function activites()
    {
        return $this->hasMany(Activite::class, 'entreprise_ap_id');
    }
}
