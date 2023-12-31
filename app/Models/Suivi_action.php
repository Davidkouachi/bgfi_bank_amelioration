<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suivi_action extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'efficacite',
        'commentaires',
        'nature',
        'commentaire_am',
        'delai',
        'statut',
        'date_action',
        'date_suivi',
        'action_id',
        'amelioration_id',
        'processus_id',
        'cause_id',
        'reclamation_id',
    ];
    
    public function action()
    {
        return $this->belongsTo(Action::class, 'action_id');
    }

    public function amelioration()
    {
        return $this->belongsTo(Amelioration::class, 'amelioration_id');
    }
    
    public function processus()
    {
        return $this->belongsTo(Processuse::class, 'processus_id');
    }

    public function cause()
    {
        return $this->belongsTo(Cause::class, 'cause_id');
    }

    public function reclamation()
    {
        return $this->belongsTo(Reclamation::class, 'reclamation_id');
    }
}
