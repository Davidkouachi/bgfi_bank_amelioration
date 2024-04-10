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

        $causes_tri = Cause::inRandomOrder()->take(3)->get();

        foreach ($causes_tri as $key => $causes_tr) {
            $causes_tr->nbre = Amelioration::where('cause_id', $causes_tr->id)->count();
        }

        $causes_nbre = count($causes);

        //------------------------------------------------

        $users = User::all();
        $users_tri = User::join('postes', 'users.poste_id', '=', 'postes.id')
                        ->select('users.*', 'postes.nom as poste')
                        ->inRandomOrder()
                        ->take(3)
                        ->get();
        $users_nbre = count($users);

        //------------------------------------------------

        $esc_oui = Amelioration::where('escaladeur', 'oui')->count();
        $esc_non = Amelioration::where('escaladeur', 'non')->count();

        //------------------------------------------------

        $rech_tr_cause = Amelioration::where('choix_select', 'cause')->count();
        $rech_tr_recla = Amelioration::where('choix_select', 'reclamation')->count();
        $rech_tr_n = Amelioration::where('choix_select', 'neant')->count();

        //------------------------------------------------

        $rech_nt = Amelioration::where('statut', 'soumis')->count();
        $rech_en = Amelioration::where('statut', 'non-valider')
                                ->orWhere('statut', 'update')
                                ->orWhere('statut', 'valider')
                                ->orWhere('statut', 'terminer')
                                ->orWhere('statut', 'date_efficacite')
                                ->count();
        $rech_t = Amelioration::where('statut', 'cloturer')->count();


        return view('statistique.index', [
            'proces' => $proces, 'proces_nbre' => $proces_nbre, 
            'reclas' => $reclas, 'reclas_nbre' => $reclas_nbre, 
            'reclas_tri' => $reclas_tri,'causes' => $causes, 
            'causes_nbre' => $causes_nbre, 'causes_tri' => $causes_tri,
            'users' => $users, 'users_nbre' => $users_nbre, 'users_tri' => $users_tri,
            'ams' => $ams, 'ams_nbre' => $ams_nbre,'esc_oui' => $esc_oui, 'esc_non' => $esc_non,
            'rech_tr_cause' => $rech_tr_cause, 'rech_tr_recla' => $rech_tr_recla, 'rech_tr_n' => $rech_tr_n,
            'rech_nt' => $rech_nt, 'rech_en' => $rech_en, 'rech_t' => $rech_t,
        ]);

    }

}
