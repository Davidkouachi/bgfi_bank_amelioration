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
        if (Auth::check() === false ) {
            return redirect()->route('login');
        }

        $users = User::join('postes', 'users.poste_id', 'postes.id')
                    ->join('autorisations', 'autorisations.user_id', 'users.id')
                    ->select('users.*','autorisations.new_user as new_user', 'autorisations.list_user as list_user' ,'autorisations.new_poste as new_poste', 'autorisations.list_poste as list_poste' , 'postes.nom as poste','autorisations.historiq as historiq','autorisations.stat as stat','autorisations.new_proces as new_proces','autorisations.list_proces as list_proces','autorisations.new_recla as new_recla','autorisations.list_recla as list_recla', 'autorisations.list_cause as list_cause','autorisations.suivi_act as suivi_act','autorisations.act_eff as act_eff','autorisations.list_act as list_act')
                    ->get();

        return view('liste.user',['users' => $users]);
    }

    public function index_modif(Request $request)
    {
        $auto = Autorisation::where('user_id', $request->user_id)->first();
        $auto->new_user = $request->nouveau_user;
        $auto->list_user = $request->liste_user;
        $auto->new_poste = $request->nouveau_poste;
        $auto->list_poste = $request->liste_poste;
        $auto->historiq = $request->historique;
        $auto->stat = $request->statistique;
        $auto->new_proces = $request->nouveau_proces;
        $auto->list_proces = $request->liste_proces;
        $auto->new_recla = $request->nouvelle_recla;
        $auto->list_recla = $request->liste_recla;
        $auto->list_cause = $request->liste_cause;
        $auto->suivi_act = $request->suivi;
        $auto->act_eff = $request->action_e;
        $auto->list_act = $request->liste_action;
        $auto->update();

        if ($auto) {

            $his = new Historique_action();
            $his->nom_formulaire = 'Liste des Utilisateurs';
            $his->nom_action = 'Mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return back()->with('valider', 'Mise à jour éffectuée.');
        } else {
            return back()->with('echec', 'Mise à jour non éffectuée.');
        }
    }
}
