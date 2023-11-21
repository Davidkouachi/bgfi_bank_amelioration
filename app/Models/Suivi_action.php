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
        'delai',
        'statut',
        'date_action',
        'date_suivi',
        'action_id',
        'amelioration_id',
        'processus_id',
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
}
