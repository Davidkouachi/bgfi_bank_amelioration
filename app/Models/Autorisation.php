<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autorisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'new_user',
        'list_user',
        'new_poste',
        'list_poste',
        'historiq',
        'stat',
        'new_proces',
        'list_proces',
        'new_recla',
        'list_recla',
        'list_cause',
        'suivi_act',
        'act_eff',
        'list_act',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
