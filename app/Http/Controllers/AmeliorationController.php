<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Processuse;
use App\Models\Cause;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Poste;
use App\Models\User;
use App\Models\Amelioration;
use App\Models\Reclamation;
use App\Models\Reclamationtrouver;
use App\Models\Causetrouver;
use App\Models\Historique_action;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use App\Events\NotificationNewRecla;

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

            $actions = Action::join('causes', 'actions.cause_id', '=', 'causes.id')
                ->join('postes', 'actions.poste_id', '=', 'postes.id')
                ->select('actions.*','causes.nom as cause','postes.nom as responsable')
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

        $postes = Poste::where('occupe', 'oui')->where('nom', '!=', 'ESCALADEUR')->get();
        $processuss = Processuse::all();

        return view('add.ficheamelioration',
            ['reclas' => $reclas, 'causesData' => $causesData, 'actionsData' => $actionsData,
            'postes' => $postes, 'processuss' => $processuss]);
    }

    public function get_cause($id)
    {
        $causes = Cause::where('reclamation_id', $id)->get();
        $nbre_cause = $causes->count();

        if($causes->isEmpty()) {
            return response()->json(['error' => true]);
        }

        return response()->json([
            'causes' => $causes,
            'nbre_cause' => $nbre_cause,
        ]);
    }

    public function get_cause_new($id)
    {
        $reclamations = Reclamation::find($id);
        $processus = Processuse::where('id', $reclamations->processus_id)->first();

        if($reclamations || $processus) {
            return response()->json([
                'reclamations' => $reclamations,
                'processus' => $processus,
            ]);
        } else {
            return response()->json(['error' => true]);
        }

    }

    public function get_action($id)
    {

        $actions = Action::join('causes', 'actions.cause_id', '=', 'causes.id')
                    ->where('actions.cause_id', '=', $id)
                    ->select('actions.*','causes.nom as cause','causes.reclamation_id as reclamation_id','causes.id as cause_id')
                    ->get();

        $nbre_action = $actions->count();

        foreach ($actions as $action) {

            $recla = Reclamation::where('id', $action->reclamation_id)->first();
            $action->reclamation = $recla->nom;

            $processus = Processuse::where('id', $recla->processus_id)->first();
            $action->processus = $processus->nom;
            $action->processus_id = $processus->id;

        }

        if($nbre_action === 0 ) {
            return response()->json(['error' => true]);
        }

        return response()->json([
            'actions' => $actions,
            'nbre_action' => $nbre_action,
        ]);
    }

    public function index_add(Request $request) 
    {
        //dd($request->all());

        $date_fiche = $request->input('date_fiche');
        $nbre_jour = $request->input('nbre_jour');

        $date2 = $request->input('date_limite');
        $dateObj2 = \DateTime::createFromFormat('d/m/Y', $date2);
        $date_limite = $dateObj2->format('Y-m-d');


        $lieu = $request->input('lieu');
        $detecteur = $request->input('detecteur');

        $reclamations = $request->input('reclamations');
        $causes = $request->input('causes');
        $consequences = $request->input('consequences');

        $choix_select = $request->input('choix_select');
        $select_recla = $request->input('select_recla');
        $select_cause = $request->input('select_cause');

        $nature = $request->input('nature');
        $processus_id = $request->input('processus_id');
        $poste_id = $request->input('poste_id');
        $reclamation = $request->input('reclamation');
        $reclamation_id = $request->input('reclamation_id');
        $cause = $request->input('cause');
        $cause_id = $request->input('cause_id');
        $actions = $request->input('actions');
        $commentaires = $request->input('commentaires');
        $action = $request->input('action');
        $action_id = $request->input('action_id');

        $choix_alert_alert = $request->input('choix_alert_alert');
        $choix_alert_email = $request->input('choix_alert_email');
        $choix_alert_sms = $request->input('choix_alert_sms');

        $am = new Amelioration();
        $am->date_fiche = $date_fiche;
        $am->date_limite = $date_limite;
        $am->lieu =$lieu;
        $am->detecteur = $detecteur;
        $am->reclamations = $reclamations;
        $am->consequences = $consequences;
        $am->causes = $causes;
        $am->choix_select = $choix_select;
        $am->statut = 'soumis';
        $am->escaladeur = 'non';
        if($choix_select === 'cause'){ $am->cause_id = $select_cause; }
        elseif($choix_select === 'reclamation'){ $am->reclamation_id = $select_recla; }
        $am->nbre_traitement = $nbre_jour;
        $am->save();

        if ($am) {

            if ($nature) {

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
                        $actio->cause_id = $caus->id;
                        $actio->save();

                        $suivi = new Suivi_action();
                        $suivi->action_id = $actio->id;
                        $suivi->amelioration_id = $am->id;
                        $suivi->commentaire_am = $commentaires[$index];
                        $suivi->nature = $nature[$index];
                        $suivi->statut = 'non-realiser';
                        $suivi->poste_id = $poste_id[$index];
                        $suivi->save();

                    } else if ($nature[$index] === 'trouve') {

                        $suivi = new Suivi_action();
                        $suivi->action_id = $action_id[$index];
                        $suivi->amelioration_id = $am->id;
                        $suivi->commentaire_am = $commentaires[$index];
                        $suivi->nature = $nature[$index];
                        $suivi->statut = 'non-realiser';
                        $suivi->poste_id = $poste_id[$index];
                        $suivi->save();

                    } else if ($nature[$index] === 'new_cause') {

                        $caus = new Cause();
                        $caus->nom = $cause[$index];
                        $caus->reclamation_id = $reclamation_id[$index];
                        $caus->save();

                        $actio = new Action();
                        $actio->nom = $action[$index];
                        $actio->actions = $actions[$index];
                        $actio->cause_id = $caus->id;
                        $actio->save();

                        $suivi = new Suivi_action();
                        $suivi->action_id = $actio->id;
                        $suivi->amelioration_id = $am->id;
                        $suivi->statut = 'non-realiser';
                        $suivi->commentaire_am = $commentaires[$index];
                        $suivi->nature = $nature[$index];
                        $suivi->poste_id = $poste_id[$index];
                        $suivi->save();

                    }
                }

                event(new NotificationNewRecla());

                $his = new Historique_action();
                $his->nom_formulaire = 'Fiche de réclamation';
                $his->nom_action = 'Ajouter';
                $his->user_id = Auth::user()->id;
                $his->save();

                return redirect()
                    ->back()
                    ->with('success', 'Enregistrement éffectuée.');

            } else {

                return redirect()
                        ->back()
                        ->with('error', 'Enregistrement a échoué.');
            }

        } else {

            return redirect()
                ->back()
                ->with('error', 'Reclamation non enregistrer.');
        }

    }

}
