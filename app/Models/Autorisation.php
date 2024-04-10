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
        'verif_recla',
        'recla_non_a',
        'list_recla',

        'list_cause',
        'list_r_r',

        'controle_action',
        'list_action',

        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
