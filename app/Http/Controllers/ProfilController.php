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

class ProfilController extends Controller
{
    public function index_profil() 
    {
        return view('user.profil');
    }

    public function suivi_oui()
    {
        $user = User::find(Auth::user()->id);
        $user->suivi_active = 'oui';
        $user->update();

        if ($user && Auth::check()) {
            Auth::user()->suivi_active = 'oui';
            Auth::user()->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

    public function suivi_non()
    {
        $user = User::find(Auth::user()->id);
        $user->suivi_active = 'non';
        $user->update();

        if ($user && Auth::check()) {
            Auth::user()->suivi_active = 'non';
            Auth::user()->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

    public function mdp_update(Request $request)
    {
        $mdp2 = $request->input('mdp2');

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($mdp2);
        $user->mdp_date = now()->format('Y-m-d\TH:i:s');
        $user->update();

        if ($user) {
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

    public function info_update(Request $request)
    {
        $name = $request->input('name');
        $tel = $request->input('tel');
        $email = $request->input('email');

        $user = User::find(Auth::user()->id);
        $user->name = $name;
        $user->tel = $tel;
        $user->email = $email;
        $user->update();

        if ($user) {
            
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

    public function index_historique()
    {
        if (Auth::check() === false ) {
            return redirect()->route('login');
        }

        $historiques = Historique_action::join('users', 'historique_actions.user_id', '=', 'users.id')
                ->join('postes', 'users.poste_id', '=', 'postes.id')
                ->orderBy('historique_actions.created_at', 'desc')
                ->select('historique_actions.*', 'postes.nom as poste', 'users.name as nom', 'users.matricule as matricule')
                ->get();

       return view('historique.historique', ['historiques' => $historiques]);
    }

    public function index_historique_profil()
    {
        if (Auth::check() === false ) {
            return redirect()->route('login');
        }
        
        $historiques = Historique_action::join('users', 'historique_actions.user_id', '=', 'users.id')
                ->join('poste', 'users.poste_id', '=', 'postes.id')
                ->orderBy('historique_actions.created_at', 'desc')
                ->where('historique_actions.user_id', Auth::user()->id)
                ->select('historique_actions.*', 'postes.nom as poste', 'users.name as nom', 'users.matricule as matricule')
                ->get();

       return view('historique.historique_profil', ['historiques' => $historiques]);
    }

}
