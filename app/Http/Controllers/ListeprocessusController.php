<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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
use App\Models\Historique;
use App\Models\Pdf_file;
use App\Events\NotificationEvent;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ListeprocessusController extends Controller
{
    public function index_listeprocessus()
    {
        if (Auth::check() === false ) {
            return redirect()->route('login');
        }

        $processus = Processuse::all();

        $objectifData = [];

        foreach ($processus as $processu) {

            $pdf = Pdf_file::where('processus_id', $processu->id)->first();
            if ($pdf) {
                $processu->pdf_nom = $pdf->pdf_nom;
            } else {
                // Gérer le cas où aucun enregistrement n'est trouvé
                $processu->pdf_nom = null; // Ou définissez-le comme vous le souhaitez
            }

            $processu->nbre = Objectif::where('processus_id', $processu->id)->count();
            $objectifs = Objectif::where('processus_id', $processu->id)->get();

            $objectifData[$processu->id] = [];
            foreach($objectifs as $objectif)
            {
                $objectifData[$processu->id][] = [
                    'objectif' => $objectif->nom,
                ];
            }
        }

        return view('liste.processus', ['processus' => $processus, 'objectifData' => $objectifData]);
    }


}
