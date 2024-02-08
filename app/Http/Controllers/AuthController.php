<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Historique_action;
use App\Models\Poste;
use App\Models\Autorisation;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AuthController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {

            return view('add.processus');

        } else {

            return redirect()->route('login');

        }
    }

    public function index_accueil_escaladeur()
    {
        if (Auth::check()) {

            return view('escaladeur.index');

        } else {

            return redirect()->route('login');

        }
    }
    
    public function view_login()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('info', 'Vous avez été déconnecté avec succès.');

    }

    public function add_user(Request $request)
    {
        $user_vrf = User::where('email', $request->email)
                        ->orWhere('tel', $request->tel)
                        ->first();
        if ($user_vrf) {
            if ($user_vrf->email === $request->email) {
                return back()->with('error', 'Email existe déjà.');
            } else {
                return back()->with('error', 'Contact existe déjà.');
            }
        } else {

            $user = User::create([
                'name' => $request->np,
                'email' => $request->email,
                'password' => bcrypt($request->mdp),
                'matricule' => $request->matricule,
                'tel' => $request->tel,
                'poste_id' => $request->poste_id,
                'suivi_active' => 'non',
                'fa' => 'non',
            ]);

            if ($user) {

                $auto = new Autorisation();
                $auto->new_user = $request->nouveau_user;
                $auto->list_user = $request->liste_user;
                $auto->new_poste = $request->nouveau_poste;
                $auto->list_poste = $request->liste_poste;
                $auto->historiq = $request->historique;
                $auto->stat = $request->statistique;
                $auto->new_proces = $request->nouveau_proces;
                $auto->list_proces = $request->liste_proces;
                $auto->new_recla = $request->nouvelle_recla;
                $auto->list_recla = $request->liste_recla;
                $auto->list_cause = $request->liste_cause;
                $auto->suivi_act = $request->suivi;
                $auto->act_eff = $request->action_e;
                $auto->list_act = $request->liste_action;
                $auto->user_id = $user->id;
                $auto->save();

                $rech = Poste::find($request->poste_id);
                if ($rech) {
                    
                    $rech->occupe = 'oui';
                    $rech->save();
                }

                if ($auto) {

                    $his = new Historique_action();
                    $his->nom_formulaire = 'Nouveau Utilisateur';
                    $his->nom_action = 'Ajouter';
                    $his->user_id = Auth::user()->id;
                    $his->save();

                    $mail = new PHPMailer(true);
                    $mail->isHTML(true);
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'bgfibankmail01@gmail.com';
                    $mail->Password = 'uxqu rotm ibpc yvxa';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    // Destinataire, sujet et contenu de l'email
                    $mail->setFrom('bgfibankmail01@gmail.com', 'BGFIBank');
                    $mail->addAddress($user->email);
                    $mail->Subject = 'Coordonnées utilisateur';
                    $mail->Body = 'Bienvenue à BGFIBank ! <br><br>'.'<br>'
                            . 'Voici vos informations pour vous connecter :<br>'
                            . 'Matricule : ' . $request->matricule.'<br>'
                            . 'Email : ' . $user->email . '<br>'
                            . 'Mot de passe : ' . $request->mdp.'<br>'
                            . 'NB : Vous pouvez modifier le mot de passe selon votre choix.';
                    // Envoi de l'email
                    $mail->send();

                    return back()->with('success', 'Enregistrement éffectuée.');
                } 
            }

            return back()->with('error', 'Echec de l\'enregistrement.');
        }
    }

    public function auth_user(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            //Auth::logoutOtherDevices($request->password);
            
            $poste_id = Auth::user()->poste_id;
            $user_id = Auth::user()->id;

            $auto = Autorisation::where('user_id', $user_id)->first();
            if ($auto) {
                session(['user_auto' => $auto]);
            }

            $poste = Poste::find($poste_id);
            if ($poste) {
                session(['user_poste' => $poste]);

                if (session('user_poste')->nom === 'ESCALADEUR') {
                    return redirect()->intended(route('index_accueil_escaladeur'))->with('success', 'Connexion réussi.');
                }
            }

            return redirect()->intended(route('index_accueil'))->with('success', 'Connexion réussi.');
        }

        return redirect()->back()->withInput(['email' => $request->input('email'), 'password' => $request->input('password')])->with([
            'error' => 'L\'authentification a échoué. Veuillez vérifier vos informations d\'identification et réessayer.',
        ]);
    }

}
