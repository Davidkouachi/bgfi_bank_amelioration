<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Events\NotificationAcorrective;

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

use Carbon\Carbon;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SuivireclaController extends Controller
{
    public function date_recla(Request $request)
    {
        $amelioration_id = $request->input('amelioration_id');
        $date1 = $request->input('date1');
        $date22 = $request->input('date2');
        $dateObj2 = \DateTime::createFromFormat('d/m/Y', $date22);
        $date2 = $dateObj2->format('Y-m-d');

        $am = Amelioration::find($amelioration_id);
        $am->date1 = $date1;
        $am->date2 = $date2;
        $am->statut = 'date_efficacite';
        $am->update();

        if ($am) {

            return back()->with('success', 'Enregistrement éffectuée');
        }

        return back()->with('error', 'Echec');

    }

    public function efficacite_recla(Request $request)
    {
        $amelioration_id = $request->input('amelioration_id');
        $efficacite = $request->input('efficacite');
        $date_efficacite = $request->input('date_efficacite');
        $commentaire = $request->input('commentaire');

        $am = Amelioration::find($amelioration_id);
        $am->efficacite = $efficacite;
        $am->date_efficacite = $date_efficacite;
        $am->commentaire = $commentaire;
        $am->statut = 'cloturer';
        $am->update();

        if ($am) {

            return back()->with('success', 'Enregistrement éffectuée');
        }

        return back()->with('error', 'Echec');
    }
}
