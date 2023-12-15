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

use App\Events\NotificationEvent;
use App\Events\NotificationA;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AmeliorationController extends Controller
{
    public function index()
    {

        if (Auth::check() === false ) {
            return redirect()->route('login');
        }

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
        $processus = Processuse::where('id',$reclamations->processus_id);

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

        $actions = Action::join('postes', 'actions.poste_id', '=', 'postes.id')
                    ->join('causes', 'actions.cause_id', '=', 'causes.id')
                    ->where('actions.cause_id', '=', $id)
                    ->select('actions.*', 'postes.nom as responsable','postes.id as responsable_id','causes.nom as cause','causes.reclamation_id as reclamation_id','causes.id as cause_id')
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

        $choix_alert_alert = $request->input('choix_alert_alert');
        $choix_alert_email = $request->input('choix_alert_email');
        $choix_alert_sms = $request->input('choix_alert_sms');

        $am = new Amelioration();
        $am->date_fiche = $date_fiche;
        $am->lieu =$lieu;
        $am->detecteur = $detecteur;
        $am->reclamations = $reclamations;
        $am->consequences = $consequences;
        $am->causes = $causes;
        $am->choix_select = 'neant';
        $am->statut = 'soumis';
        $am->save();

        if ($am) {

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

                if ($choix_alert_email === 'email') {

                    $post = User::join('postes', 'users.poste_id', 'postes.id')
                                ->where('postes.id', '=', $poste_id[$index])
                                ->first();
                    if ($post) {
                        $his = new Historique_action();
                        $his->nom_formulaire = 'Nouveau Utilisateur';
                        $his->nom_action = 'Ajouter';
                        $his->user_id = Auth::user()->id;
                        $his->save();

                        $mail = new PHPMailer(true);
                        $mail->isHTML(true);
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'bgfibankmail01@gmail.com';
                        $mail->Password = 'uxqu rotm ibpc yvxa';
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;
                        // Destinataire, sujet et contenu de l'email
                        $mail->setFrom('bgfibankmail01@gmail.com', 'BGFIBank');
                        $mail->addAddress($post->email);
                        $mail->Subject = 'Alert';
                        $mail->Body = 'Nouvelle(s) Action(s)';
                        // Envoi de l'email
                        $mail->send();
                    } else {
                        return redirect()
                                ->back()
                                ->with('error', 'Email non envoyé.');
                    }
                }


            }

        } else {

            return redirect()
                ->back()
                ->with('error', 'Reclamation non enregistrer.');
        }

        event(new NotificationA());

        $his = new Historique_action();
        $his->nom_formulaire = 'Fiche de réclamation';
        $his->nom_action = 'Ajouter';
        $his->user_id = Auth::user()->id;
        $his->save();

        return redirect()
            ->back()
            ->with('ajouter', 'Enregistrement éffectuée.');

    }

}
