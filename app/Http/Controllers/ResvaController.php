<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Poste;
use App\Models\User;
use App\Models\Autorisation;
use Illuminate\Support\Facades\Auth;

class ResvaController extends Controller
{
    public function index_add_resva()
    {
        $postes = Poste::where('occupe', 'non')->get();
        return view('add.res-va', ['postes' => $postes]);
    }

    public function index_user_modif(Request $request)
    {
        $user = User::join('autorisations', 'autorisations.user_id', 'users.id')
                    ->where('users.id', $request->id)
                    ->select('users.*','autorisations.new_user as new_user', 'autorisations.list_user as list_user' ,'autorisations.new_poste as new_poste', 'autorisations.list_poste as list_poste','autorisations.historiq as historiq','autorisations.stat as stat','autorisations.new_proces as new_proces','autorisations.list_proces as list_proces','autorisations.new_recla as new_recla','autorisations.list_recla as list_recla', 'autorisations.list_cause as list_cause','autorisations.suivi_act as suivi_act','autorisations.act_eff as act_eff','autorisations.list_act as list_act')
                    ->first();

        return view('liste.user_modif',['user' => $user]);
    }

}
