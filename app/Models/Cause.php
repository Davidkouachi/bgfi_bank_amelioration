<?php

namespace App\Models;

use App\Models\Risque;
use App\Models\Resva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'reclamation_id',
    ];

    public function reclamation()
    {
        return $this->belongsTo(Reclamation::class, 'reclamation_id');
    }

}
