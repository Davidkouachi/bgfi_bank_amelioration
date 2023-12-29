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
        'commentaire_eff',
    ];

}
