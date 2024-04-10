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
        'cause_id',
        'actions',
    ];

    public function cause()
    {
        return $this->belongsTo(Cause::class, 'cause_id');
    }
}
