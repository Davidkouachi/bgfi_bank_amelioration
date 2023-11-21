<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

class AmeliorationController extends Controller
{
    public function index()
    {
        $reclas = Reclamation::join('processuses', 'reclamations.processus_id', '=', 'processuses.id')
                ->select('reclamations.*','processuses.nom as processus')
                ->get();

        $causesData = [];
        $actionsData = [];

        foreach($reclas as $recla)
        {

            $actions = Action::join('reclamations', 'actions.reclamation_id', '=', 'reclamations.id')
                ->join('postes', 'actions.poste_id', '=', 'postes.id')
                ->select('actions.*','reclamations.nom as reclamation','postes.nom as responsable')
                ->get();

            $actionsData[$recla->id] = [];

            foreach($actions as $action)
            {
               $actionsData[$recla->id][] = [
                    'action' => $action->nom,
                    'responsable' => $action->responsable,
                ];
            }

            $causes = Cause::where('causes.reclamation_id', $recla->id)->get();
            $recla->nbre_cause = count($causes);
            
            $causesData[$recla->id] = [];
            
            foreach($causes as $cause)
            {
                $causesData[$recla->id][] = [
                    'cause' => $cause->nom,
                ];
            }
        }

        $postes = Poste::all();
        $processuss = Processuse::all();

        return view('add.ficheamelioration',
            ['reclas' => $reclas, 'causesData' => $causesData, 'actionsData' => $actionsData,
            'postes' => $postes, 'processuss' => $processuss]);
    }

    public function get_cause_info($id)
    {
        $cause = Cause::find($id);
        $risque = Risque::find($cause->risque_id);
        $actions = Action::join('postes', 'actions.poste_id', '=', 'postes.id')
                      ->where('actions.risque_id', $risque->id)
                      ->where('actions.type', 'corrective')
                      ->select('actions.*', 'postes.nom as responsable')
                      ->get();

        foreach ($actions as $action) {

            $action->risque = $risque->nom;

            $processus = Processuse::find($risque->processus_id);
            $action->processus = $processus->nom;
            $action->processus_id = $processus->id;

            $action->nature="cause";


        }

        return response()->json([
            'actions' => $actions,
        ]);
    }

    public function get_risque_info($id)
    {
        $risque = Risque::find($id);
        $actions = Action::join('postes', 'actions.poste_id', '=', 'postes.id')
                      ->where('actions.risque_id', $risque->id)
                      ->where('actions.type', 'corrective')
                      ->select('actions.*', 'postes.nom as responsable')
                      ->get();

        foreach ($actions as $action) {

            $action->risque = $risque->nom;

            $processus = Processuse::find($risque->processus_id);
            $action->processus = $processus->nom;
            $action->processus_id = $processus->id;

            $action->nature="risque";

        }

        return response()->json([
            'actions' => $actions,
        ]);
    }

    public function index_add(Request $request) 
    {
        $date_fiche = $request->input('date_fiche');
        $nbre_jour = $request->input('nbre_jour');
        $date_limite = $request->input('date_limite');

        $lieu = $request->input('lieu');
        $detecteur = $request->input('detecteur');

        $reclamations = $request->input('reclamations');
        $causes = $request->input('causes');
        $consequences = $request->input('consequences');

        $choix_recla = $request->input('choix_recla');

        $choix_select = $request->input('choix_select');

        $nature = $request->input('nature');
        $processus_id = $request->input('processus_id');
        $poste_id = $request->input('poste_id');
        $reclamation = $request->input('reclamation');
        $cause = $request->input('cause');
        $actions = $request->input('actions');
        $commentaires = $request->input('commentaires');
        $action = $request->input('action');

        foreach ($nature as $index => $valeur) {

            if ($nature[$index] === 'new') {

                $recla = new Reclamation();
                $recla->nom = $reclamation[$index];
                $recla->processus_id = $processus_id[$index];
                $recla->save();

                $caus = new Cause();
                $caus->nom = $cause[$index];
                $caus->reclamation_id = $recla->id;
                $caus->save();

                $actio = new Action();
                $actio->nom = $action[$index];
                $actio->actions = $actions[$index];
                $actio->poste_id = $poste_id[$index];
                $actio->reclamation_id = $recla->id;
                $actio->save();

                $am = new Amelioration();
                $am->date_fiche = $date_fiche;
                $am->lieu =$lieu;
                $am->detecteur = $detecteur;
                $am->reclamations = $reclamations;
                $am->consequences = $consequences;
                $am->causes = $causes;
                $am->nature = $nature[$index];
                $am->choix_select = 'neant';
                $am->commentaires = $commentaires[$index];
                $am->action_id = $actio->id;
                $am->reclamation_id = $recla->id;
                $am->processus_id = $processus_id[$index];
                $am->save();

                $suivi = new Suivi_action();
                $suivi->action_id = $actio->id;
                $suivi->amelioration_id = $am->id;
                $suivi->processus_id = $processus_id[$index];
                $suivi->delai = $date_limite;
                $suivi->statut = 'non-realiser';
                $suivi->save();

            }
            
        }

        return redirect()
            ->back()
            ->with('ajouter', 'Enregistrement éffectuée.');

    }

}
