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
    ];

}
