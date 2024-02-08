<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suivi_action extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'nature',
        'efficacite',
        'commentaires',
        'commentaire_am',
        'statut',
        'date_action',
        'date_suivi',
        'action_id',
        'amelioration_id',
        'action_id',
    ];
    
    public function action()
    {
        return $this->belongsTo(Action::class, 'action_id');
    }

    public function amelioration()
    {
        return $this->belongsTo(Amelioration::class, 'amelioration_id');
    }

    public function poste()
    {
        return $this->belongsTo(Poste::class, 'poste_id');
    }
    
}
