<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amelioration extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date_fiche',
        'date_limite',
        'lieu',
        'detecteur',
        'consequences',
        'causes',
        'reclamations',
        'choix_select',
        'statut',
        'date_validation',
        'date_cloture1',
        'nbre_traitement',
        'escaladeur',
        'date1',
        'date2',
        'efficacite',
        'date_eff',
        'commentaire_eff',
        'cause_id',
        'reclamation_id',
    ];
}
