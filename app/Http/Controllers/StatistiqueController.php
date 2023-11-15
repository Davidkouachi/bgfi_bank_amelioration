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

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class StatistiqueController extends Controller
{
    /*public function index_stat()
    {
        $nbre_nci = Amelioration::where('type', 'non-conformite-interne')->count();
        $nbre_nci_c = Amelioration::where('type', 'non-conformite-interne')
                ->where('choix_select', 'cause')
                ->count();
        $nbre_nci_r = Amelioration::where('type', 'non-conformite-interne')
                ->where('choix_select', 'risque')
                ->count();
        $nbre_nci_n = Amelioration::where('type', 'non-conformite-interne')
                ->where('choix_select', 'cause_risque_nt')
                ->count();

        $nbre_r = Amelioration::where('type', 'reclamation')->count();
        $nbre_r_c = Amelioration::where('type', 'reclamation')
                ->where('choix_select', 'cause')
                ->count();
        $nbre_r_r = Amelioration::where('type', 'reclamation')
                ->where('choix_select', 'risque')
                ->count();
        $nbre_r_n = Amelioration::where('type', 'reclamation')
                ->where('choix_select', 'cause_risque_nt')
                ->count();

        $nbre_c = Amelioration::where('type', 'contentieux')->count();
        $nbre_c_c = Amelioration::where('type', 'contentieux')
                ->where('choix_select', 'cause')
                ->count();
        $nbre_c_r = Amelioration::where('type', 'contentieux')
                ->where('choix_select', 'risque')
                ->count();
        $nbre_c_n = Amelioration::where('type', 'contentieux')
                ->where('choix_select', 'cause_risque_nt')
                ->count();

        return view('statistique.index', ['nbre_nci' => $nbre_nci, 'nbre_r' => $nbre_r, 'nbre_c' => $nbre_c, 'nbre_nci_c' => $nbre_nci_c,'nbre_nci_r' => $nbre_nci_r,'nbre_nci_n' => $nbre_nci_n, 'nbre_r_c' => $nbre_r_c,'nbre_r_r' => $nbre_r_r,'nbre_r_n' => $nbre_r_n, 'nbre_c_c' => $nbre_c_c,'nbre_c_r' => $nbre_c_r,'nbre_c_n' => $nbre_c_n]);
    }*/

    public function index_stat()
    {
        $types = ['non_conformite_interne', 'reclamation', 'contentieux'];

        $statistics = [];

        foreach ($types as $type) {
            $statistics[$type] = [];

            $statistics[$type]['total'] = Amelioration::where('type', $type)->count();
            $statistics[$type]['causes'] = Amelioration::where('type', $type)
                ->where('choix_select', 'cause')->count();
            $statistics[$type]['risques'] = Amelioration::where('type', $type)
                ->where('choix_select', 'risque')->count();
            $statistics[$type]['causes_risques_nt'] = Amelioration::where('type', $type)
                ->where('choix_select', 'cause_risque_nt')->count();
        }


        $processus = Processuse::all();

        return view('statistique.index', ['statistics' => $statistics, 'processus' => $processus]);
    }

    public function get_processus($id)
    {
        $processus = Processuse::find($id);

        $types = ['non_conformite_interne', 'reclamation', 'contentieux'];
        $nbres = [];

        foreach ($types as $type) {
            $nbres[$type] = Amelioration::where('type', $type)
                ->where('processus_id', $id)->count();
        }

        return response()->json([
            'data' => array_values($nbres),
        ]);
    }

    public function get_date(Request $request)
    {
        $date1 = Carbon::parse($request->input('date1'))->format('Y-m-d');
        $date2 = Carbon::parse($request->input('date2'))->format('Y-m-d');

        $types = ['non_conformite_interne', 'reclamation', 'contentieux'];
        $nbres = [];

        foreach ($types as $type) {
            $nbres[$type] = Amelioration::where('date_fiche', '>=', $date1)
                ->where('date_fiche', '<=', $date2)
                ->where('type', $type)->count();
        }

        return response()->json([
            'data' => array_values($nbres),
        ]);
    }


}
