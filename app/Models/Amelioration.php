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
        'nature',
        'choix_select',
        'commentaires',
        'action_id',
        'processus_id',
        'reclamation_id',
    ];

    public function action()
    {
        return $this->belongsTo(Action::class, 'action_id');
    }

    public function processus()
    {
        return $this->belongsTo(Processuse::class, 'processus_id');
    }

    public function reclamation()
    {
        return $this->belongsTo(Reclamation::class, 'reclamation_id');
    }

}
