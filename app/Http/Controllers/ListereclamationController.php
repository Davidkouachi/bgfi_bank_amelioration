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

class ListereclamationController extends Controller
{
    public function index_suivi()
    {

        $ams = Amelioration::where('statut', '!=', 'soumis')
                            ->where('statut', '!=', 'non-valider')
                            ->where('statut', '!=', 'update')
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

        return view('traitement.reclamation', ['ams' => $ams, 'actionsData' => $actionsData ]);
    }

    public function index_validation()
    {
        $ams = Amelioration::where('statut', '=', 'update')
                            ->orWhere('statut', '=', 'non-valider')
                            ->orWhere('statut', '=', 'soumis')
                            ->get();

        $actionsData = [];

        foreach ($ams as $am) {
            $am->nbre_action = Suivi_action::where('amelioration_id', '=', $am->id)->count();

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
                        'delai' => $am->date_limite,
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

        return view('tableau.validerecla', ['ams' => $ams, 'actionsData' => $actionsData ]);
    }

    public function index_non_accepte()
    {

        $ams = Amelioration::join('rejets', 'rejets.amelioration_id', 'ameliorations.id')
                            ->where('ameliorations.statut', '=', 'non-valider')
                            ->select('ameliorations.*', 'rejets.motif as motif')
                            ->get();

        foreach ($ams as $am) {
            $am->nbre_action = Suivi_action::where('amelioration_id', '=', $am->id)->count();
        }

        return view('traitement.reclaup', ['ams' => $ams]);
    }

    public function index_non_accepte2(Request $request)
    {
        $am = Amelioration::where('id', '=', $request->id)->first();

        $actionsDatam = [];

        if ($am) {

            $rejet = rejet::where('amelioration_id', $am->id)->first();
            if ($rejet) {
                $am->rejet = $rejet->motif;
            }

            $suivi = Suivi_action::join('postes', 'suivi_actions.poste_id', 'postes.id')
                                    ->where('amelioration_id', '=', $am->id)
                                    ->select('suivi_actions.*', 'postes.id as poste_id')
                                    ->get();

            $actionsDatam[$am->id] = [];

            foreach ($suivi as $suivis) {

                    $action= null;

                    $action = Action::join('causes', 'actions.cause_id', 'causes.id')
                                    ->join('reclamations', 'causes.reclamation_id', 'reclamations.id')
                                    ->join('processuses', 'reclamations.processus_id', 'processuses.id')
                                    ->where('actions.id', '=', $suivis->action_id)
                                    ->select('actions.nom as action', 'actions.id as action_id', 'processuses.nom as processus', 'reclamations.id as reclamation_id', 'reclamations.nom as reclamation', 'causes.nom as cause' , 'causes.id as cause_id')
                                    ->first();

                if ($action) {
                    $actionsDatam[$am->id][] = [
                        'suivi_id' => $suivis->id,
                        'action' => $action->action,
                        'poste_id' => $suivis->poste_id,
                        'nature' => $suivis->nature,
                        'processus' => $action->processus,
                        'reclamation' => $action->reclamation,
                        'cause' => $action->cause,
                        'commentaire_am' => $suivis->commentaire_am,
                    ];
                }

            }
        } else {

            return back()->with('error', 'Réclamation non trouvée');
        }

        //--------------------------------------------------------------------------------------------
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

        return view('traitement.reclaup2',
            ['reclas' => $reclas, 'causesData' => $causesData, 'actionsData' => $actionsData,
            'postes' => $postes, 'processuss' => $processuss, 'actionsDatam' => $actionsDatam, 'am' => $am]);
    }

    public function index_non_accepte_traitement(Request $request)
    {

        $amelioration_id = $request->input('amelioration_id');

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



        $am = Amelioration::where('id', $amelioration_id)->first();

        if ($am) {

            $am->date_fiche = $date_fiche;
            $am->date_limite = $date_limite;
            $am->lieu =$lieu;
            $am->detecteur = $detecteur;
            $am->reclamations = $reclamations;
            $am->consequences = $consequences;
            $am->causes = $causes;
            $am->statut = 'update';
            $am->nbre_traitement = $nbre_jour;
            $am->update();

            if ($am) {

                $suivi_id = $request->input('suivi_id');
                $suivi_poste_id = $request->input('suivi_poste_id');
                $suivi_commentaire_am = $request->input('suivi_commentaire_am');

                foreach ($suivi_id as $index => $value) {

                    $modif = Suivi_action::where('id', $value)->first();

                    if($modif){
                        $modif->poste_id = $suivi_poste_id[$index];
                        $modif->commentaire_am =  $suivi_commentaire_am[$index];
                        $modif->update();
                    }
                }

                
                $id_suppr = $request->input('id_suppr');
                $suppr = $request->input('suppr');

                if ($suppr && is_array($suppr)) {
                    foreach ($suppr as $index => $valeur) {
                        if ($valeur === 'oui' && isset($id_suppr[$index])) {
                            $delete = Suivi_action::where('id', $id_suppr[$index])->delete();
                        }
                    }
                }

                //---------------------------------------------------------------------------------------------

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
                }

                //--------------------------------------------------------------------------------------------

                event(new NotificationUpdateRecla());

                $his = new Historique_action();
                $his->nom_formulaire = 'Réclamations non acceptées';
                $his->nom_action = 'mise à jour';
                $his->user_id = Auth::user()->id;
                $his->save();

                return redirect()->route('index_non_accepte')->with('success', 'Mise à jour éffectuée.');
            }
        }

        return redirect()->route('index_non_accepte')->with('error', 'Échec de la mise à jour.');
    }

}
