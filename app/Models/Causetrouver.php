<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Causetrouver extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cause_id',
        'amelioration_id',
    ];

    public function cause()
    {
        return $this->belongsTo(Cause::class, 'cause_id');
    }

    public function amelioration()
    {
        return $this->belongsTo(Amelioration::class, 'amelioration_id');
    }
}
