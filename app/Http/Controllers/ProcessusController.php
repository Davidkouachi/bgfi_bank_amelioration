<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Events\MessageNotification;

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

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProcessusController extends Controller
{
    public function index_add_processus()
    {
        if (Auth::check() === false ) {
            return redirect()->route('login');
        }
        
        return view('add.processus');
    }

    public function add_processus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nprocessus' => 'required',
            'objectifs' => 'required',
            'description' => 'required',
            'finalite' => 'required',
        ]);

        $validator->setCustomMessages([
            'nprocessus.required' => 'Saisie obligatoire.',
            'objectifs.required' => 'Saisie obligatoire.',
            'description.required' => 'Saisie obligatoire.',
            'finalite.required' => 'Saisie obligatoire.',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('index_add_processus')
                        ->withErrors($validator)
                        ->withInput();
        }

        $nomProcessus = $request->input('nprocessus');
        $descriptionProcessus = $request->input('description');
        $objectifs = $request->input('objectifs');
        $finalite = $request->input('finalite');

        $processus = new Processuse();
        $processus->nom = $nomProcessus;
        $processus->description = $descriptionProcessus;
        $processus->finalite = $finalite;
        $processus->save();

        if ($request->hasFile('pdfFile') && $request->file('pdfFile')->isValid()) {

            $originalFileName = $request->file('pdfFile')->getClientOriginalName();
            $pdfPathname = $request->file('pdfFile')->storeAs('public/pdf', $originalFileName);

            // Enregistrez le fichier PDF dans la base de données
            $pdfFile = new Pdf_file();
            $pdfFile->pdf_nom = $originalFileName;
            $pdfFile->pdf_chemin = $pdfPathname;
            $pdfFile->processus_id = $processus->id;
            $pdfFile->save();
        }

        foreach ($objectifs as $objectif) {
            $nouvelObjectif = new Objectif();
            $nouvelObjectif->processus_id = $processus->id;
            $nouvelObjectif->nom = $objectif;
            $nouvelObjectif->save();
        }

        if ($processus)
        {
            $his = new Historique_action();
            $his->nom_formulaire = 'Nouveau Processus';
            $his->nom_action = 'Ajouter';
            $his->user_id = Auth::user()->id;
            $his->save();
        }

        event(new MessageNotification());

        return redirect()
            ->route('index_add_processus')
            ->with('ajouter', 'Enregistrement éffectuée.');

    }

}
