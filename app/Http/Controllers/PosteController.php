<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Poste;
use App\Models\Historique_action;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosteController extends Controller
{
    public function index_liste_poste()
    {
        $postes = Poste::all();

        return view('add.poste',['postes' => $postes]);
    }

    public function index_add_poste_traitement(Request $request)
    {
        $nom = $request->input('nom');

        foreach ($nom as $nom) {
            $poste = new Poste();
            $poste->nom = $nom;
            $poste->occupe = 'non';
            $poste->save();
        }
        
        if ($poste) {

            $his = new Historique_action();
            $his->nom_formulaire = 'Nouveau Poste';
            $his->nom_action = 'Ajouter';
            $his->user_id = Auth::user()->id;
            $his->save();

            return back()
                ->with('success', 'Enregistrement éffectuée.');
        }
    }

    public function index_modif_poste_traitement(Request $request)
    {
        $rech = Poste::where('id', $request->poste_id)->first();
        
        if ($rech) {

            $rech->nom = $request->nom;
            $rech->update();

            $his = new Historique_action();
            $his->nom_formulaire = 'Liste des Postes';
            $his->nom_action = 'Mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()
                ->back()
                ->with('success', 'Mise à jour éffectuée.');
        }
    }
}
