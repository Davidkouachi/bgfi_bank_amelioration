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

class ListeController extends Controller
{
    public function index_list_cause()
    {
        $causes = Cause::join('reclamations', 'causes.reclamation_id', 'reclamations.id')
                    ->join('processuses', 'reclamations.processus_id', 'processuses.id')
                    ->select('causes.*','processuses.nom as processus', 'reclamations.nom as reclamation', 'reclamations.id as reclamation_id')
                    ->get();

        $reclamations = Reclamation::all();

        $nbre_total = Amelioration::all()->count();

        $actionsData = [];

        foreach ($causes as $key => $cause) {

            $cause->nbre = Amelioration::where('cause_id', $cause->id)->count();

            $cause->progess = ($cause->nbre / $nbre_total) * 100;
            $cause->progess = number_format($cause->progess, 2);

            $cause->nbre_action = Action::where('cause_id', $cause->id)->count();

            $action = Action::where('cause_id', $cause->id)->first();

            if ($action) {

                $actionsData[$cause->id][] = [
                    'action' => $action->nom,
                    'poste' => $action->poste,
                ];
            }

        }

        return view('liste.cause', ['causes' => $causes, 'actionsData' => $actionsData, 'reclamations' => $reclamations ]);
    }

    public function index_list_recla()
    {
        $reclas = Reclamation::join('processuses', 'reclamations.processus_id', 'processuses.id')
                    ->select('reclamations.*','processuses.nom as processus','processuses.id as processus_id')
                    ->get();

        $processus = Processuse::all();

        $nbre_total = Amelioration::all()->count();

        $causeData = [];

        foreach ($reclas as $key => $recla) {

            $recla->nbre = Amelioration::where('reclamation_id', $recla->id)->count();

            $recla->progess = ($recla->nbre / $nbre_total) * 100;
            $recla->progess = number_format($recla->progess, 2);

            $causes = Cause::where('reclamation_id', $recla->id)->get();
            $recla->nbre_cause = count($causes);

            if ($causes) {

                    foreach ($causes as $cause) {
                        $causeData[$recla->id][] = [
                        'cause' => $cause->nom,
                    ];
                }
            }

        }

        return view('liste.recla', ['reclas' => $reclas, 'causeData' => $causeData, 'processus' => $processus ]);
    }

    public function index_modif_cause(Request $request)
    {
        $rech = Cause::where('id', $request->cause_id)->first();

        if ($rech) {

            $rech->nom = $request->cause;
            $rech->reclamation_id = $request->reclamation_id;
            $rech->update();

            $his = new Historique_action();
            $his->nom_formulaire = 'Liste des Causes';
            $his->nom_action = 'Mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()
                ->back()
                ->with('success', 'Mise à jour éffectuée.');
        }

        return redirect()
                ->back()
                ->with('error', 'Echec de la mise à jour.');
    }

    public function index_modif_recla(Request $request)
    {
        $rech = Reclamation::where('id', $request->reclamation_id)->first();

        if ($rech) {

            $rech->nom = $request->reclamation;
            $rech->processus_id = $request->processus_id;
            $rech->update();

            $his = new Historique_action();
            $his->nom_formulaire = 'Liste du résume des réclamations';
            $his->nom_action = 'Mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()
                ->back()
                ->with('success', 'Mise à jour éffectuée.');
        }

        return redirect()
                ->back()
                ->with('error', 'Echec de la mise à jour.');
    }

}
