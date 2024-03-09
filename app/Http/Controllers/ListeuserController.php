<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Processuse;
use App\Models\Objectif;
use App\Models\Resva;
use App\Models\Risque;
use App\Models\Cause;
use App\Models\Rejet;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Poste;
use App\Models\User;
use App\Models\Amelioration;
use App\Models\Autorisation;
use App\Models\Historique_action;
use App\Models\Pdf_file;
use App\Events\NotificationEvent;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ListeuserController extends Controller
{
    public function index ()
    {

        $users = User::join('postes', 'users.poste_id', 'postes.id')
                    ->join('autorisations', 'autorisations.user_id', 'users.id')
                    ->select('users.*','autorisations.new_user as new_user', 'autorisations.list_user as list_user' ,'autorisations.new_poste as new_poste', 'autorisations.list_poste as list_poste' , 'postes.nom as poste','autorisations.historiq as historiq','autorisations.stat as stat','autorisations.new_proces as new_proces','autorisations.list_proces as list_proces','autorisations.new_recla as new_recla','autorisations.verif_recla as verif_recla','autorisations.list_recla as list_recla', 'autorisations.recla_non_a as recla_non_a', 'autorisations.list_cause as list_cause', 'autorisations.list_r_r as list_r_r','autorisations.controle_action as controle_action','autorisations.list_action as list_action')
                    ->get();

        return view('liste.user',['users' => $users]);
    }

    public function index_modif_auto(Request $request)
    {
        $auto = Autorisation::where('user_id', $request->user_id)->first();
        
        $auto->new_user = $request->new_user;
        $auto->list_user = $request->list_user;
        $auto->new_poste = $request->new_poste;
        $auto->list_poste = $request->list_poste;
        $auto->historiq = $request->historiq;
        $auto->stat = $request->stat;

        $auto->new_proces = $request->new_proces;
        $auto->list_proces = $request->list_proces;

        $auto->new_recla = $request->new_recla;
        $auto->verif_recla = $request->verif_recla;
        $auto->recla_non_a = $request->recla_non_a;
        $auto->list_recla = $request->list_recla;

        $auto->list_cause = $request->list_cause;
        $auto->list_r_r = $request->list_r_r;

        $auto->controle_action = $request->controle_action;
        $auto->list_action = $request->list_action;
        $auto->update();

        if ($auto) {

            $his = new Historique_action();
            $his->nom_formulaire = 'Liste des Utilisateurs';
            $his->nom_action = 'Mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()->route('index_liste_resva')->with('success', 'Mise à jour éffectuée.');
        } else {
            return redirect()->route('index_liste_resva')->with('error', 'Mise à jour non éffectuée.');
        }
    }
}
