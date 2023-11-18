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
        'consequence',
        'cause',
        'reclamation',
        'nature',
        'commentaire',
        'action_id',
        'processus_id',
        'cause_id',
        'reclamation_id',
    ];

    public function action() 
    {
        return $this->belongsTo(Action::class, 'action_id');
    }

    public function processus()
    {
        return $this->belongsTo(Processus::class, 'processus_id');
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
