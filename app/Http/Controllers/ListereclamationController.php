<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Events\NotificationAcorrective;

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

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ListereclamationController extends Controller
{
    public function index()
    {
        if (Auth::check() === false ) {
            return redirect()->route('login');
        }

        $ams = Amelioration::all();

        $actionsData = [];

        foreach ($ams as $am) {
            $am->nbre_action = Suivi_action::where('amelioration_id', '=', $am->id)->count();

            $suivi = Suivi_action::where('amelioration_id', '=', $am->id)->get();
            $actionsData[$am->id] = [];
            foreach ($suivi as $suivis) {

                    $action= null;

                    $action = Action::join('postes', 'actions.poste_id', 'postes.id')
                                    ->join('causes', 'actions.cause_id', 'causes.id')
                                    ->join('reclamations', 'causes.reclamation_id', 'reclamations.id')
                                    ->join('processuses', 'reclamations.processus_id', 'processuses.id')
                                    ->where('actions.id', '=', $suivis->action_id)
                                    ->select('actions.nom as action', 'postes.nom as poste', 'processuses.nom as processus', 'reclamations.nom as reclamation', 'causes.nom as cause')
                                    ->first();

                if ($action) {
                    $actionsData[$am->id][] = [
                        'action' => $action->action,
                        'responsable' => $action->poste,
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

        return view('liste.reclamation', ['ams' => $ams, 'actionsData' => $actionsData ]);
    }

    public function index_cause()
    {
        $causes = Cause::join('reclamations', 'causes.reclamation_id', 'reclamations.id')
                    ->join('processuses', 'reclamations.processus_id', 'processuses.id')
                    ->select('causes.*','processuses.nom as processus', 'reclamations.nom as reclamation')
                    ->get();

        $actionsData = [];

        foreach ($causes as $key => $cause) {

            $cause->nbre_action = Action::where('cause_id', $cause->id)->count();

            $action = Action::join('postes', 'actions.poste_id', 'postes.id')
                            ->where('cause_id', $cause->id)
                            ->select('actions.*','postes.nom as poste')
                            ->first();

            if ($action) {

                $actionsData[$cause->id][] = [
                    'action' => $action->nom,
                    'poste' => $action->poste,
                ];
            }
            
        }

        return view('liste.cause', ['causes' => $causes, 'actionsData' => $actionsData ]);
    }

    public function index_modif_cause(Request $request)
    {
        $rech = Cause::where('id', $request->cause_id)->first();
        
        if ($rech) {

            $rech->nom = $request->cause;
            $rech->update();

            $his = new Historique_action();
            $his->nom_formulaire = 'Liste des Causes';
            $his->nom_action = 'Mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()
                ->back()
                ->with('valider', 'Mise à jour éffectuée.');
        }
    }
}
