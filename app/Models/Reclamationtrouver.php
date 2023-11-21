<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamationtrouver extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'reclamation_id',
        'amelioration_id',
    ];

    public function reclamation()
    {
        return $this->belongsTo(Reclamation::class, 'reclamation_id');
    }

    public function amelioration()
    {
        return $this->belongsTo(Amelioration::class, 'amelioration_id');
    }
}
