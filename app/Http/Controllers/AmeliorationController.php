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
               $Suivi_action = Suivi_action::where('action_id', $action->id)->first();
               $actionsData[$recla->id][] = [
                    'action' => $action->nom,
                    'delai' => $action->delai,
                    'responsable' => $action->responsable,
                    'statut' => $action->statut,
                    'date_action' => $Suivi_action->date_action,
                    'date_suivi' => $Suivi_action->date_suivi,
                    'efficacite' => $Suivi_action->efficacite,
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
        $type = $request->input('type');
        $date_fiche = $request->input('date_fiche');
        $lieu = $request->input('lieu');
        $detecteur = $request->input('detecteur');
        $non_conformite = $request->input('non_conformite');
        $consequence = $request->input('consequence');
        $cause = $request->input('cause');
        $choix_select = $request->input('choix_select');

        $nature = $request->input('nature');
        $processus_id = $request->input('processus_id');
        $risque = $request->input('risque');
        $resume = $request->input('resume');
        $action = $request->input('action');
        $poste_id = $request->input('poste_id');
        $date_action = $request->input('date_action');
        $commentaire = $request->input('commentaire');

        foreach ($nature as $index => $valeur) {

            if ($nature[$index] !== '0') {
                $hasNonZeroNature = true;

                $am = new Amelioration();
                $am->type = $type;
                $am->date_fiche = $date_fiche;
                $am->lieu =$lieu;
                $am->detecteur = $detecteur;
                $am->non_conformite = $non_conformite;
                $am->consequence = $consequence;
                $am->cause = $cause;
                $am->choix_select = $choix_select;
                $am->nature = $nature[$index];
                $am->risque = $risque[$index];
                $am->resume = $resume[$index];
                $am->action = $action[$index];
                $am->date_action = $date_action[$index];
                $am->commentaire = $commentaire[$index];
                $am->processus_id = $processus_id[$index];
                $am->poste_id = $poste_id[$index];
                $am->save();
            }
            
        }

        return redirect()
            ->back()
            ->with('ajouter', 'Enregistrement éffectuée.');

    }

}
