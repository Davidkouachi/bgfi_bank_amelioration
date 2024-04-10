<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Processuse;
use App\Models\Objectif;
use App\Models\Resva;
use App\Models\Reclamation;
use App\Models\Cause;
use App\Models\Rejet;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Poste;
use App\Models\User;
use App\Models\Amelioration;
use App\Models\Historique_action;
use App\Models\Reclamationtrouver;
use App\Models\Causetrouver;

use App\Events\NotificationUpdateRecla;

use Carbon\Carbon;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EscaladeurController extends Controller
{

    public function index_accueil_escaladeur()
    {

        $ams = Amelioration::where('date_limite', '<', \Carbon\Carbon::now()->translatedFormat('j F Y'))
                            ->get();

        $actionsData = [];

        foreach ($ams as $am) {

            $am->nbre_action = Suivi_action::where('amelioration_id', '=', $am->id)->count();
            $am->nbre_action_eff = Suivi_action::where('amelioration_id', '=', $am->id)
                                                ->where('statut', 'realiser')
                                                ->count();
            $am->nbre_action_non = Suivi_action::where('amelioration_id', '=', $am->id)
                                                ->where('statut', 'non-realiser')
                                                ->count();

            $suivi = Suivi_action::join('postes', 'suivi_actions.poste_id', 'postes.id')
                                    ->where('amelioration_id', '=', $am->id)
                                    ->select('suivi_actions.*', 'postes.nom as poste')
                                    ->get();
            $actionsData[$am->id] = [];
            foreach ($suivi as $suivis) {

                    $action= null;

                    $action = Action::join('causes', 'actions.cause_id', 'causes.id')
                                    ->join('reclamations', 'causes.reclamation_id', 'reclamations.id')
                                    ->join('processuses', 'reclamations.processus_id', 'processuses.id')
                                    ->where('actions.id', '=', $suivis->action_id)
                                    ->select('actions.nom as action', 'processuses.nom as processus', 'reclamations.nom as reclamation', 'causes.nom as cause')
                                    ->first();

                if ($action) {
                    $actionsData[$am->id][] = [
                        'action' => $action->action,
                        'responsable' => $suivis->poste,
                        'delai' => $suivis->delai,
                        'date_action' => $suivis->date_action,
                        'date_suivi' => $suivis->date_suivi,
                        'statut' => $suivis->statut,
                        'processus' => $action->processus,
                        'reclamation' => $action->reclamation,
                        'cause' => $action->cause,
                        'commentaire_am' => $suivis->commentaire_am,
                    ];
                }

            }
        }

        return view('escaladeur.index', ['ams' => $ams, 'actionsData' => $actionsData ]);
    }

    public function index_profil() 
    {
        return view('escaladeur.profil');
    }
}
