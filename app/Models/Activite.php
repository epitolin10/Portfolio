<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Activite extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'description_courte',
        'description',
        'type',           // 'stage', 'ap', 'projet'
        'outils',
        'lien_externe',
        'ap',
        'date_realisation',
        'visible',
        'mise_en_avant',
        'stage_id',
        'entreprise_ap_id',
    ];

    protected $casts = [
        'date_realisation' => 'date',
        'visible'          => 'boolean',
        'mise_en_avant'    => 'boolean',
    ];

    // ─── Auto-slug ──────────────────────────────────────────────────────────
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($activite) {
            $activite->slug = Str::slug($activite->titre) . '-' . uniqid();
        });
    }

    // ─── Relations ──────────────────────────────────────────────────────────
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function entrepriseAp()
    {
        return $this->belongsTo(EntrepriseAp::class, 'entreprise_ap_id');
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'activite_competence');
    }

    public function sousCompetences()
    {
        return $this->belongsToMany(SousCompetence::class, 'activite_sous_competence');
    }

    public function captures()
    {
        return $this->hasMany(Capture::class);
    }

    // ─── Scopes ─────────────────────────────────────────────────────────────
    public function scopeVisible($query)
    {
        return $query->where('visible', true);
    }

    public function scopeMisEnAvant($query)
    {
        return $query->where('mise_en_avant', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByCompetence($query, $competenceId)
    {
        return $query->whereHas('competences', fn($q) => $q->where('competences.id', $competenceId));
    }
}