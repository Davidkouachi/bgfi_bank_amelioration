<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Processuse;
use App\Models\Amelioration;
use App\Models\Rejet;
use App\Models\Cause;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\User;
use App\Models\Historique_action;

use App\Events\NotificationRejetRecla;
use App\Events\NotificationValideRecla;
use App\Events\NotificationSuiviActionRecla;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class SuiviactionController extends Controller
{
    public function index_suiviaction()
    {

        $ams = Action::join('causes', 'actions.cause_id', 'causes.id')
                    ->join('reclamations', 'causes.reclamation_id', 'reclamations.id')
                    ->join('processuses', 'reclamations.processus_id', 'processuses.id')
                    ->select('actions.id as id', 'actions.nom as action', 'processuses.nom as processus', 'reclamations.nom as reclamation', 'causes.nom as cause')
                    ->get();

        $actionsData = [];

        foreach ($ams as $am) {
            $rech = Suivi_action::join('postes', 'suivi_actions.poste_id', 'postes.id')
                            ->join('ameliorations', 'suivi_actions.amelioration_id', '=', 'ameliorations.id')
                            ->join('actions', 'suivi_actions.action_id', '=', 'actions.id')
                            ->where('ameliorations.statut', '=', 'valider')
                            ->where('ameliorations.escaladeur', '=', 'non')
                            ->where('suivi_actions.statut', '=', 'non-realiser')
                            ->where('suivi_actions.action_id', $am->id)
                            ->select('suivi_actions.*','postes.nom as poste', 'ameliorations.detecteur as detecteur', 'ameliorations.date_fiche as date_fiche', 'ameliorations.lieu as lieu', 'ameliorations.reclamations as reclamations', 'ameliorations.consequences as consequences', 'ameliorations.causes as causes', 'ameliorations.date_fiche as date_fiche', 'ameliorations.date_limite as date_limite', 'ameliorations.nbre_traitement as nbre_traitement', 'ameliorations.choix_select as choix_select')
                            ->get();

            $am->nbre_am = count($rech);

            $actionsData[$am->id] = [];

            $maxDateLimite = null;

            foreach($rech as $rec)
            {
                $actionsData[$am->id][] = [
                    'lieu' => $rec->lieu,
                    'date_fiche' => $rec->date_fiche,
                    'date_limite' => $rec->date_limite,
                    'nbre_traitement' => $rec->nbre_traitement,
                    'detecteur' => $rec->detecteur,
                    'reclamations' => $rec->reclamations,
                    'consequences' => $rec->consequences,
                    'causes' => $rec->causes,
                    'choix_select' => $rec->choix_select,
                ];

                // Parcourir les données de chaque AM
                foreach ($actionsData[$am->id] as $detail) {
                    // Convertir la date limite en objet DateTime pour la comparaison
                    $dateLimite = Carbon::createFromFormat('Y-m-d', $detail['date_limite']);
                    
                    // Comparer la date limite actuelle avec la date limite maximale
                    if ($maxDateLimite === null || $dateLimite < $maxDateLimite) {
                        $maxDateLimite = $dateLimite;
                    }
                }               
            }

            $am->delai = $maxDateLimite !== null ? $maxDateLimite->format('d-m-Y') : null;

        }

        return view('traitement.suiviaction',  ['ams' => $ams, 'actionsData' => $actionsData]);
    }

    public function valider_recla($id)
    {

        $am = Amelioration::where('id', $id)->first();
        if ($am)
        {

            $am->statut = 'valider';
            $am->date_validation = now()->format('Y-m-d\TH:i');
            $am->update();

            if($am)
            {
                event(new NotificationValideRecla());

                $his = new Historique_action();
                $his->nom_formulaire = 'Verification des réclamations';
                $his->nom_action = 'Valider';
                $his->user_id = Auth::user()->id;
                $his->save();

                return redirect()
                    ->back()
                    ->with('success', 'Validation éffectué.');

            }

        }

        return redirect()
            ->back()
            ->with('error', 'La validation a échoué.');
    }

    public function rejet_recla(Request $request)
    {
        $rejet = Rejet::where('amelioration_id', $request->input('amelioration_id'))->first();

        if ($rejet)
        {
            $rejet->motif = $request->input('motif');
            $rejet->update();

        } else {

            $rejet = new Rejet();
            $rejet->motif = $request->input('motif');
            $rejet->amelioration_id = $request->input('amelioration_id');
            $rejet->save();

        }

        if ($rejet)
        {
            $valide = Amelioration::where('id', $request->input('amelioration_id'))->first();

            if ($valide)
            {

                $valide->date_validation = now()->format('Y-m-d\TH:i');
                $valide->statut = 'non-valider';
                $valide->update();

                if ($valide) {

                    event(new NotificationRejetRecla());

                    $his = new Historique_action();
                    $his->nom_formulaire = 'Verification des réclamations';
                    $his->nom_action = 'Rejet';
                    $his->user_id = Auth::user()->id;
                    $his->save();

                    /*$users = Suivi_amelioration::join('ameliorations', 'suivi_ameliorations.amelioration_id', 'ameliorations.id')
                                ->join('actions', 'suivi_ameliorations.action_id', 'actions.id')
                                ->join('postes', 'actions.poste_id', 'postes.id')
                                ->join('users', 'users.poste_id', 'postes.id')
                                ->where('ameliorations.id', $id)
                                ->select('users.email as email')
                                ->get();

                    foreach ($users as $user) {

                        $mail = new PHPMailer(true);
                        $mail->isHTML(true);
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'coherencemail01@gmail.com';
                        $mail->Password = 'kiur ejgn ijqt kxam';
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;
                        // Destinataire, sujet et contenu de l'email
                        $mail->setFrom('coherencemail01@gmail.com', 'Coherence');
                        $mail->addAddress($user->email);
                        $mail->Subject = 'ALERT !';
                        $mail->Body = 'Nouvelle Action Préventive';
                        // Envoi de l'email
                        $mail->send();
                    }*/


                    return redirect()
                        ->back()
                        ->with('success', 'Rejet éffectuée.');
                }

            }

        }

        return redirect()
            ->back()
            ->with('error', 'Echec du Rejet.');
    }

    public function add_suivi_action(Request $request, $id)
    {
        $suivis = Suivi_action::where('action_id', $id)->get();
        
        foreach ($suivis as $suivi) {
            
            $suivi->efficacite = $request->input('efficacite');
            $suivi->commentaires = $request->input('commentaire');
            $suivi->date_action = $request->input('date_action');
            $suivi->statut = 'realiser';
            $suivi->date_suivi = now()->format('Y-m-d\TH:i');
            $suivi->update();

            if ($suivi)
            {
                event(new NotificationSuiviActionRecla());
                
                $suivi2 = Suivi_action::where('amelioration_id', $suivi->amelioration_id)->where('statut', 'non-realiser')->count();

                if ($suivi2 === 0 ) {

                    $am = Amelioration::where('id', $suivi->amelioration_id)->first();
                    $am->date_cloture1 = $request->input('date_action');
                    $am->statut = 'terminer';
                    $am->update();
                }

            }

        }

        $his = new Historique_action();
        $his->nom_formulaire = 'Contrôle des actions';
        $his->nom_action = 'Suivi effectué';
        $his->user_id = Auth::user()->id;
        $his->save();

        return back()->with('success', 'Suivi éffectué.');
    } 

}
