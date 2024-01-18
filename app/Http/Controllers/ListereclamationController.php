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

        $ams = Amelioration::all();

        $actionsData = [];

        foreach ($ams as $am) {

            $am->nbre_action = Suivi_action::where('amelioration_id', '=', $am->id)->count();
            $am->nbre_action_eff = Suivi_action::where('amelioration_id', '=', $am->id)
                                                ->where('statut', 'realiser')
                                                ->count();
            $am->nbre_action_non = Suivi_action::where('amelioration_id', '=', $am->id)
                                                ->where('statut', 'non-realiser')
                                                ->count();

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

        return view('traitement.reclamation', ['ams' => $ams, 'actionsData' => $actionsData ]);
    }

    public function index_list_cause()
    {
        $causes = Cause::join('reclamations', 'causes.reclamation_id', 'reclamations.id')
                    ->join('processuses', 'reclamations.processus_id', 'processuses.id')
                    ->select('causes.*','processuses.nom as processus', 'reclamations.nom as reclamation')
                    ->get();

        $nbre_total = Suivi_action::all()->count();

        $actionsData = [];

        foreach ($causes as $key => $cause) {

            $cause->nbre = Suivi_action::where('cause_id', $cause->id)->count();

            $cause->progess = ($cause->nbre / $nbre_total) * 100;
            $cause->progess = number_format($cause->progess, 2);

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

    public function index_list_recla()
    {
        $reclas = Reclamation::join('processuses', 'reclamations.processus_id', 'processuses.id')
                    ->select('reclamations.*','processuses.nom as processus')
                    ->get();

        $nbre_total = Suivi_action::all()->count();

        $causeData = [];

        foreach ($reclas as $key => $recla) {

            $recla->nbre = Suivi_action::where('reclamation_id', $recla->id)->count();

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

        return view('liste.recla', ['reclas' => $reclas, 'causeData' => $causeData ]);
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

    public function index_validation()
    {
        $ams = Amelioration::where('statut', '=', 'update')
                            ->orWhere('statut', '=', 'non-valider')
                            ->orWhere('statut', '=', 'soumis')
                            ->get();

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

        return view('tableau.validerecla', ['ams' => $ams, 'actionsData' => $actionsData ]);
    }

    public function index_non_accepte()
    {

        $ams = Amelioration::where('statut', '=', 'non-valider')->get();

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

        return view('traitement.reclaup', ['ams' => $ams, 'actionsData' => $actionsData ]);
    }

    public function index_non_accepte2(Request $request)
    {
        $am = Amelioration::where('id', '=', $request->id)->first();

        $actionsDatam = [];

        if ($am) {

            $suivi = Suivi_action::where('amelioration_id', '=', $am->id)->get();

            $actionsDatam[$am->id] = [];

            foreach ($suivi as $suivis) {

                    $action= null;

                    $action = Action::join('postes', 'actions.poste_id', 'postes.id')
                                    ->join('causes', 'actions.cause_id', 'causes.id')
                                    ->join('reclamations', 'causes.reclamation_id', 'reclamations.id')
                                    ->join('processuses', 'reclamations.processus_id', 'processuses.id')
                                    ->where('actions.id', '=', $suivis->action_id)
                                    ->select('actions.nom as action', 'actions.id as action_id', 'postes.id as poste_id', 'processuses.id as processus_id', 'reclamations.id as reclamation_id', 'reclamations.nom as reclamation', 'causes.nom as cause' , 'causes.id as cause_id')
                                    ->first();

                if ($action) {
                    $actionsDatam[$am->id][] = [
                        'action_id' => $action->action_id,
                        'action' => $action->action,
                        'poste_id' => $action->poste_id,
                        'delai' => $suivis->delai,
                        'nature' => $suivis->nature,
                        'date_action' => $suivis->date_action,
                        'processus_id' => $action->processus_id,
                        'reclamation_id' => $action->reclamation_id,
                        'reclamation' => $action->reclamation,
                        'cause' => $action->cause,
                        'cause_id' => $action->cause_id,
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

        $postes = Poste::join('users', 'users.poste_id', 'postes.id')
                        ->select('postes.*') // Sélectionne les colonnes de la table 'postes'
                        ->distinct() // Rend les résultats uniques
                        ->get();
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

        $choix_recla = $request->input('choix_recla');

        $choix_select = $request->input('choix_select');

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
            $am->lieu =$lieu;
            $am->detecteur = $detecteur;
            $am->reclamations = $reclamations;
            $am->consequences = $consequences;
            $am->causes = $causes;
            $am->statut = 'update';
            $am->nbre_traitement = $nbre_jour;
            $am->update();

            if ($am) {

                $id_suppr = $request->input('id_suppr');
                $suppr = $request->input('suppr');

                if ($id_suppr) {

                    foreach ($id_suppr as $index => $valeur) {
                        if (isset($suppr[$index]) && $suppr[$index] === 'oui') {
                            $delete_action = Suivi_action::where('action_id', $valeur)->delete();
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
                            $actio->poste_id = $poste_id[$index];
                            $actio->cause_id = $caus->id;
                            $actio->save();

                            $suivi = new Suivi_action();
                            $suivi->action_id = $actio->id;
                            $suivi->reclamation_id = $recla->id;
                            $suivi->cause_id = $caus->id;
                            $suivi->amelioration_id = $am->id;
                            $suivi->processus_id = $processus_id[$index];
                            $suivi->delai = $date_limite;
                            $suivi->commentaire_am = $commentaires[$index];
                            $suivi->nature = $nature[$index];
                            $suivi->statut = 'non-realiser';
                            $suivi->save();

                        } else if ($nature[$index] === 'trouve') {

                            $suivi = new Suivi_action();
                            $suivi->action_id = $action_id[$index];
                            $suivi->reclamation_id = $reclamation_id[$index];
                            $suivi->cause_id = $cause_id[$index];
                            $suivi->amelioration_id = $am->id;
                            $suivi->processus_id = $processus_id[$index];
                            $suivi->delai = $date_limite;
                            $suivi->commentaire_am = $commentaires[$index];
                            $suivi->nature = $nature[$index];
                            $suivi->statut = 'non-realiser';
                            $suivi->save();

                            if ($suivi) {

                                $reclat = new Reclamationtrouver();
                                $reclat->reclamation_id = $reclamation_id[$index];
                                $reclat->amelioration_id = $am->id;
                                $reclat->save();

                                $causet = new Causetrouver();
                                $causet->cause_id = $cause_id[$index];
                                $causet->amelioration_id = $am->id;
                                $causet->save();
                            }

                        } else if ($nature[$index] === 'new_cause') {

                            $caus = new Cause();
                            $caus->nom = $cause[$index];
                            $caus->reclamation_id = $reclamation_id[$index];
                            $caus->save();

                            $actio = new Action();
                            $actio->nom = $action[$index];
                            $actio->actions = $actions[$index];
                            $actio->poste_id = $poste_id[$index];
                            $actio->cause_id = $caus->id;
                            $actio->save();

                            $suivi = new Suivi_action();
                            $suivi->action_id = $actio->id;
                            $suivi->reclamation_id = $reclamation_id[$index];
                            $suivi->cause_id = $caus->id;
                            $suivi->amelioration_id = $am->id;
                            $suivi->processus_id = $processus_id[$index];
                            $suivi->delai = $date_limite;
                            $suivi->statut = 'non-realiser';
                            $suivi->commentaire_am = $commentaires[$index];
                            $suivi->nature = $nature[$index];
                            $suivi->save();

                            if ($suivi) {

                                $reclat = new Reclamationtrouver();
                                $reclat->reclamation_id = $reclamation_id[$index];
                                $reclat->amelioration_id = $am->id;
                                $reclat->save();
                            }

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
