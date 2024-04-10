<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdf_file extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'pdf_nom',
        'pdf_chemin',
        'processus_id',
    ];

    public function processus()
    {
        return $this->belongsTo(Processus::class, 'processus_id');
    }
}
