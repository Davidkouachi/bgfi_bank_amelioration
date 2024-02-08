<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Amelioration;
use App\Models\Processuse;
use App\Models\Objectif;
use App\Models\Autorisation;
use App\Models\Cause;
use App\Models\Rejet;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Pdf_file;
use App\Models\Reclamation;
use App\Models\User;
use App\Models\Historique_action;
use App\Models\Poste;


use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Twilio\Rest\Client;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use PDF;

/*use Barryvdh\DomPDF\Facade\Pdf;*/

class EtatController extends Controller
{

    public function index_etat_processus(Request $request)
    {
        $processu = Processuse::find($request->id);

        $objectifData = [];

        if ($processu) {

            $processu->nbre = Objectif::where('processus_id', $processu->id)->count();
            $objectifs = Objectif::where('processus_id', $processu->id)->get();

            $objectifData[$processu->id] = [];
            foreach($objectifs as $objectif)
            {
                $objectifData[$processu->id][] = [
                    'objectif' => $objectif->nom,
                ];
            }
        }

        return view('etat.processus', ['processu' => $processu, 'objectifData' => $objectifData]);
    }

    public function index_etat_reclamation(Request $request)
    {

        $am = Amelioration::find($request->id);

        $actionsData = [];

        if ($am) {

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

        return view('etat.reclamation', ['am' => $am, 'actionsData' => $actionsData ]);
    }

}
