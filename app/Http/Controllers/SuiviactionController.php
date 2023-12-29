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

use App\Events\NotificationAe;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class SuiviactionController extends Controller
{
    public function index_suiviaction()
    {

        $actions = Suivi_action::join('actions', 'suivi_actions.action_id', '=', 'actions.id')
                    ->join('postes', 'actions.poste_id', '=', 'postes.id')
                    ->join('ameliorations', 'suivi_actions.amelioration_id', '=', 'ameliorations.id')
                    ->join('causes', 'actions.cause_id', '=', 'causes.id')
                    ->join('reclamations', 'suivi_actions.reclamation_id', '=', 'reclamations.id')
                    ->join('processuses', 'suivi_actions.processus_id', '=', 'processuses.id')
                    ->where('suivi_actions.statut', 'non-realiser')
                    ->where('ameliorations.statut', 'valider')
                    ->select('suivi_actions.*','reclamations.nom as reclamation', 'ameliorations.date_fiche as date_fiche' ,'processuses.nom as processus', 'actions.nom as action', 'causes.nom as cause', 'postes.nom as poste')
                    ->get();

        return view('traitement.suiviaction',  ['actions' => $actions]);
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
        $suivi = Suivi_action::where('action_id', $id)->first();
        
        if ($suivi)
        {
            $suivi->efficacite = $request->input('efficacite');
            $suivi->commentaires = $request->input('commentaire');
            $suivi->date_action = $request->input('date_action');
            $suivi->statut = 'realiser';
            $suivi->date_suivi = now()->format('Y-m-d\TH:i');
            $suivi->update();

            if ($suivi)
            {
                $suivi2 = Suivi_action::where('amelioration_id', $suivi->amelioration_id)->where('statut', 'non-realiser')->count();

                if ($suivi2 === 0 ) {

                    $am = Amelioration::where('id', $suivi->amelioration_id)->first();
                    $am->date_cloture1 = $request->input('date_action');
                    $am->statut = 'terminer';
                    $am->update();
                }

                $his = new Historique_action();
                $his->nom_formulaire = 'Suivi des actions';
                $his->nom_action = 'Suivi effectué';
                $his->user_id = Auth::user()->id;
                $his->save();

                return back()->with('success', 'Suivi éffectué.');
            }

        }

        return back()->with('error', 'Suivi non éffectuée.');
    }


}
