<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amelioration extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type',
        'date_fiche',
        'lieu',
        'detecteur',
        'non_conformite',
        'consequence',
        'cause',
        'choix_select',
        'nature',
        'processus_id',
        'risque',
        'resume',
        'action',
        'poste_id',
        'date_action',
        'commentaire',
    ];

    public function poste() 
    {
        return $this->belongsTo(Poste::class, 'poste_id');
    }

    public function processus()
    {
        return $this->belongsTo(Processus::class, 'processus_id');
    }
}
