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
        if (Auth::check() === false ) {
            return redirect()->route('login');
        }

        $types = ['processus', 'reclamation', 'cause'];

        $statistics = [];

        foreach ($types as $type) {
            $statistics[$type] = [];

            $statistics[$type]['processus'] = Processuse::all()->count();
            $statistics[$type]['reclamation'] = Reclamation::all()->count();
            $statistics[$type]['cause'] = Cause::all()->count();
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
