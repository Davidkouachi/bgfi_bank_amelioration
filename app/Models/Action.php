<?php

namespace App\Models;

use App\Models\Risque;
use App\Models\Resva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'delai',
        'statut',
        'poste_id',
        'reclamation_id',
        'actions',
    ];

    public function poste()
    {
        return $this->belongsTo(Poste::class, 'poste_id');
    }

    public function reclamation()
    {
        return $this->belongsTo(Reclamation::class, 'reclamation_id');
    }
}
