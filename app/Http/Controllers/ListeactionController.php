<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Processuse;
use App\Models\Objectif;
use App\Models\Resva;
use App\Models\Cause;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Poste;
use App\Models\User;
use App\Models\Amelioration;
use App\Models\Reclamation;
use App\Models\Risquetrouver;
use App\Models\Causetrouver;

use App\Events\NotificationEvent;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ListeactionController extends Controller
{
    public function index()
    {
        if (Auth::check() === false ) {
            return redirect()->route('login');
        }

        $actions = Action::join('causes', 'actions.cause_id', 'causes.id')
                        ->join('reclamations', 'causes.reclamation_id', 'reclamations.id')
                        ->join('processuses', 'reclamations.processus_id', 'processuses.id')
                        ->join('postes', 'actions.poste_id', 'postes.id')
                        ->select('actions.*', 'causes.nom as cause', 'reclamations.nom as reclamation', 'processuses.nom as processus', 'postes.nom as poste')
                        ->get();

        return view('liste.action', ['actions' => $actions ]);
    }

    public function index_effectuer()
    {
        if (Auth::check() === false ) {
            return redirect()->route('login');
        }
        
        $actions = Suivi_action::join('actions', 'suivi_actions.action_id', '=', 'actions.id')
                    ->join('postes', 'actions.poste_id', '=', 'postes.id')
                    ->join('causes', 'actions.cause_id', '=', 'causes.id')
                    ->join('reclamations', 'suivi_actions.reclamation_id', '=', 'reclamations.id')
                    ->join('processuses', 'suivi_actions.processus_id', '=', 'processuses.id')
                    ->where('suivi_actions.statut', 'realiser')
                    ->select('suivi_actions.*','postes.nom as responsable','reclamations.nom as reclamation','processuses.nom as processus', 'actions.nom as action', 'causes.nom as cause', 'postes.nom as poste')
                    ->get();

        return view('traitement.actione',  ['actions' => $actions]);
    }
}
