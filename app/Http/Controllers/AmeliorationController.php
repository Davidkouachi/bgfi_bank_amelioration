<?php

namespace App\Http\Controllers;

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

use App\Events\NotificationEvent;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AmeliorationController extends Controller
{
    public function index()
    {
        $risques = Risque::join('postes', 'risques.poste_id', '=', 'postes.id')
                ->select('risques.*','postes.nom as validateur')
                ->get();

        $causesData = [];
        $actionsData = [];

        foreach($risques as $risque)
        {
            $processus = Processuse::where('id', $risque->processus_id)->first();
            $risque->nom_processus = $processus->nom;

            $actions = Action::join('postes', 'actions.poste_id', '=', 'postes.id')
                ->where('actions.risque_id', $risque->id)
                ->select('actions.*','postes.nom as responsable')
                ->get();

            $actionsData[$risque->id] = [];
            
            foreach($actions as $action)
            {
               $Suivi_action = Suivi_action::where('action_id', $action->id)->first();
               $actionsData[$risque->id][] = [
                    'action' => $action->action,
                    'delai' => $action->delai,
                    'type' => $action->type,
                    'responsable' => $action->responsable,
                    'statut' => $action->statut,
                    'date_action' => $Suivi_action->date_action,
                    'date_suivi' => $Suivi_action->date_suivi,
                    'efficacite' => $Suivi_action->efficacite,
                ];
            }

            $causes = Cause::where('causes.risque_id', $risque->id)->get();
            $risque->nbre_cause = count($causes);
            
            $causesData[$risque->id] = [];
            
            foreach($causes as $cause)
            {
                $causesData[$risque->id][] = [
                    'cause' => $cause->nom,
                    'dispositif' => $cause->dispositif,
                ];
            }
        }


        $causes_selects = Cause::all();

        $causesData2 = [];
        $actionsData2 = [];

        $Suivi_action2 = null;
        $caus2 = null;

        foreach($causes_selects as $causes_select)
        {

            $risques2 = Risque::join('postes', 'risques.poste_id', '=', 'postes.id')
                    ->where('risques.id', $causes_select->risque_id )
                    ->select('risques.*','postes.nom as validateur')
                    ->first();

            $causes_select->nom_risque = $risques2->nom;
            $causes_select->vraisemblence = $risques2->vraisemblence;
            $causes_select->gravite = $risques2->gravite;
            $causes_select->evaluation = $risques2->evaluation;
            $causes_select->cout = $risques2->cout;
            $causes_select->vraisemblence_residuel = $risques2->vraisemblence_residuel;
            $causes_select->gravite_residuel = $risques2->gravite_residuel;
            $causes_select->evaluation_residuel = $risques2->evaluation_residuel;
            $causes_select->cout_residuel = $risques2->cout_residuel;
            $causes_select->statut = $risques2->statut;
            $causes_select->date_validation = $risques2->date_validation;
            $causes_select->traitement = $risques2->traitement;
            $causes_select->validateur = $risques2->validateur;

            $processus2 = Processuse::where('id', $risques2->processus_id)->first();
            $causes_select->nom_processus = $processus2->nom;

            $causes2 = Cause::where('causes.risque_id', $causes_select->risque_id)->get();

            $causesData2[$causes_select->risque_id] = [];

            foreach($causes2 as $caus2)
            {
               $causesData2[$caus2->risque_id][] = [
                    'cause' => $caus2->nom,
                    'dispositif' => $caus2->dispositif,
                ];
            }

            $actions2 = Action::join('postes', 'actions.poste_id', '=', 'postes.id')
                  ->where('actions.risque_id', $causes_select->risque_id)
                  ->select('actions.*','postes.nom as responsable')
                  ->get();

            $actionsData2[$causes_select->risque_id] = [];

                  
            foreach($actions2 as $action2)
            {
               $Suivi_action2 = Suivi_action::where('action_id', $action2->id)->first();
               $actionsData2[$Suivi_action2->risque_id][] = [
                    'action' => $action2->action,
                    'delai' => $action2->delai,
                    'type' => $action2->type,
                    'responsable' => $action2->responsable,
                    'statut' => $action2->statut,
                    'date_action' => $Suivi_action2->date_action,
                    'date_suivi' => $Suivi_action2->date_suivi,
                    'efficacite' => $Suivi_action2->efficacite,
                ];
            }
              
        }

        $postes = Poste::all();
        $processuss = Processuse::all();

        return view('add.ficheamelioration', 
            ['risques' => $risques, 'causesData' => $causesData, 'actionsData' => $actionsData, 
            'causes_selects' => $causes_selects, 'Suivi_action2' => $Suivi_action2, 'caus2' => $caus2, 'causesData2' => $causesData2, 'actionsData2' => $actionsData2, 'postes' => $postes, 'processuss' => $processuss]);
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
