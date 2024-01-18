<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\Processuse;
use App\Models\Objectif;
use App\Models\Risque;
use App\Models\Cause;
use App\Models\Rejet;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Pdf_file;
use App\Models\User;
use App\Models\Historique_action;
use App\Models\Poste;
use App\Models\Amelioration;
use App\Models\Reclamation;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class StatistiqueController extends Controller
{
    public function index_stat()
    {

        $proces = Processuse::all();
        $proces_nbre = count($proces);

        //------------------------------------------------

        $ams = Amelioration::all();
        $ams_nbre = count($ams);

        //------------------------------------------------

        $reclas = Reclamation::all();
        $reclas_tri = Reclamation::inRandomOrder()->take(3)->get();
        $reclas_nbre = count($reclas);

        //------------------------------------------------

        $causes = Cause::all();

        foreach ($causes as $cause) {
            $cause->nbre_suivi = Suivi_action::where('cause_id', $cause->id)->count();
        }

        // Trier les causes par le nombre de suivis (du plus grand au plus petit)
        $causes = $causes->sortByDesc('nbre_suivi');

        $dataLabels = [];
        $dataCounts = [];

        foreach ($causes as $key => $cause) {
            // Ajout des informations pour le graphique
            $dataLabels[] = $cause->nom; // Utilisez le champ approprié pour les labels, j'ai utilisé 'nom' comme exemple
            $dataCounts[] = $cause->nbre_suivi;
        }
        $causes_tri = Cause::inRandomOrder()->take(3)->get();
        $causes_nbre = count($causes);

        //------------------------------------------------

        $users = User::all();
        $users_tri = User::join('postes', 'users.poste_id', '=', 'postes.id')
                        ->select('users.*', 'postes.nom as poste')
                        ->inRandomOrder()
                        ->take(3)
                        ->get();
        $users_nbre = count($users);


        return view('statistique.index', [
            'proces' => $proces, 'proces_nbre' => $proces_nbre, 
            'reclas' => $reclas, 'reclas_nbre' => $reclas_nbre, 'reclas_tri' => $reclas_tri,
            'causes' => $causes, 'causes_nbre' => $causes_nbre, 'causes_tri' => $causes_tri, 'dataLabels' => $dataLabels, 'dataCounts' => $dataCounts,

            'users' => $users, 'users_nbre' => $users_nbre, 'users_tri' => $users_tri,
            'ams' => $ams, 'ams_nbre' => $ams_nbre
        ]);

    }

    public function get_date(Request $request)
    {
        $date1 = Carbon::parse($request->input('date1'))->startOfDay();
        $date2 = Carbon::parse($request->input('date2'))->endOfDay();

        $causes = Cause::join('suivi_actions', 'causes.id', '=', 'suivi_actions.cause_id')
                        ->join('ameliorations', 'suivi_actions.amelioration_id', '=', 'ameliorations.id')
                        ->whereBetween('ameliorations.date_fiche', [$date1, $date2])
                        ->select('causes.nom', DB::raw('COUNT(suivi_actions.id) as nbre_suivi'))
                        ->groupBy('causes.id')
                        ->orderByDesc('nbre_suivi')
                        ->get();

        $dataLs = $causes->pluck('nom');
        $dataCs = $causes->pluck('nbre_suivi');

        return response()->json([
            'dataLs' => $dataLs,
            'dataCs' => $dataCs,
        ]);
    }
}
