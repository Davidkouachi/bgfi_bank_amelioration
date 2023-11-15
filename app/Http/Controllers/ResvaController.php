<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Processuse;
use App\Models\Objectif;
use App\Models\Resva;
use App\Models\Poste;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ResvaController extends Controller
{
    public function index_add_resva()
    {
        $postes = Poste::all();
        return view('add.res-va', ['postes' => $postes]);
    }

    public function add_resva(Request $request)
    {
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $email = $request->input('email');
        $tel = $request->input('tel');
        $poste = $request->input('poste');
        $fonction = $request->input('fonction');

        foreach ($nom as $index => $valeur) {
            $nouvelleDonnee = new Resva(); // Remplacez VotreModele par le nom de votre modèle Eloquent
            $nouvelleDonnee->nom = $nom[$index];
            $nouvelleDonnee->prenom = $prenom[$index];
            $nouvelleDonnee->email = $email[$index];
            $nouvelleDonnee->tel = $tel[$index];
            $nouvelleDonnee->poste = $poste[$index];
            $nouvelleDonnee->fonction = $fonction[$index];
            $nouvelleDonnee->save();
        }

        return redirect()
            ->route('index_add_resva')
            ->with('ajouter', 'Enregistrement éffectuée.');
    }
}
