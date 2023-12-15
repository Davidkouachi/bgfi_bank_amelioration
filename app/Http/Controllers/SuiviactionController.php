<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Processuse;
use App\Models\Cause;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\User;
use App\Models\Historique_action;

use App\Events\NotificationAe;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class SuiviactionController extends Controller
{
    public function index_suiviaction()
    {

        $actions = Suivi_action::join('actions', 'suivi_actions.action_id', '=', 'actions.id')
                    ->join('postes', 'actions.poste_id', '=', 'postes.id')
                    ->join('ameliorations', 'suivi_actions.amelioration_id', '=', 'ameliorations.id')
                    ->join('causes', 'actions.cause_id', '=', 'causes.id')
                    ->join('reclamations', 'suivi_actions.reclamation_id', '=', 'reclamations.id')
                    ->join('processuses', 'suivi_actions.processus_id', '=', 'processuses.id')
                    ->where('suivi_actions.statut', 'non-realiser')
                    ->where('ameliorations.statut', 'valider')
                    ->select('suivi_actions.*','postes.nom as responsable','reclamations.nom as reclamation','processuses.nom as processus', 'actions.nom as action', 'causes.nom as cause', 'postes.nom as poste')
                    ->get();

        return view('traitement.suiviaction',  ['actions' => $actions]);
    }

    public function add_suivi_action(Request $request, $id)
    {
        if (Auth::check() === false ) {
            return redirect()->route('login');
        }

        $suivi = Suivi_action::where('id', $id)->first();
        if ($suivi)
        {
            $suivi->efficacite = $request->input('efficacite');
            $suivi->commentaires = $request->input('commentaire');
            $suivi->date_action = $request->input('date_action');
            $suivi->statut = 'realiser';
            $suivi->date_suivi = now()->format('Y-m-d\TH:i');
            $suivi->update();

            if($suivi)
            {

                $his = new Historique_action();
                $his->nom_formulaire = 'Tableau du suivi des actions';
                $his->nom_action = 'Suivi';
                $his->user_id = Auth::user()->id;
                $his->save();

                event(new NotificationAe());

                return redirect()
                    ->back()
                    ->with('valider', 'Suivi éffectué.');

            }

        }

        return redirect()
            ->back()
            ->with('error', 'Enregistrement a échoué.');
    }

    public function index_historique()
    {
        if (Auth::check() === false ) {
            return redirect()->route('login');
        }

        $historiques = Historique_action::join('users', 'historique_actions.user_id', '=', 'users.id')
                ->join('postes', 'users.poste_id', '=', 'postes.id')
                ->orderBy('historique_actions.created_at', 'desc')
                ->select('historique_actions.*', 'postes.nom as poste', 'users.name as nom', 'users.matricule as matricule')
                ->get();

       return view('historique.historique', ['historiques' => $historiques]);
    }

    public function index_historique_profil()
    {
        if (Auth::check() === false ) {
            return redirect()->route('login');
        }
        
        $historiques = Historique_action::join('users', 'historique_actions.user_id', '=', 'users.id')
                ->join('poste', 'users.poste_id', '=', 'postes.id')
                ->orderBy('historique_actions.created_at', 'desc')
                ->where('historique_actions.user_id', Auth::user()->id)
                ->select('historique_actions.*', 'postes.nom as poste', 'users.name as nom', 'users.matricule as matricule')
                ->get();

       return view('historique.historique_profil', ['historiques' => $historiques]);
    }


}
