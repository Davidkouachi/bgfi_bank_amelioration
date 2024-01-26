<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProcessusController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResvaController;
use App\Http\Controllers\SuiviactionController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\AmeliorationController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\ListeprocessusController;
use App\Http\Controllers\ListeactionController;
use App\Http\Controllers\ListereclamationController;
use App\Http\Controllers\ListeuserController;
use App\Http\Controllers\SuivireclaController;


Route::get('/Login', [AuthController::class, 'view_login'])->name('login');
Route::post('/auth_user', [AuthController::class, 'auth_user']);

Route::get('/Registre', [AuthController::class, 'view_registre'])->name('registre');


Route::middleware(['auth'])->group(function () {

    Route::get('/Internet indisponible', [Controller::class, 'internet_indisponible'])->name('internet_indisponible');

    Route::get('/suiviactiveoui', [ProfilController::class, 'suivi_oui']);
    Route::get('/suiviactivenon', [ProfilController::class, 'suivi_non']);
    Route::get('/mdp_update', [ProfilController::class, 'mdp_update']);
    Route::get('/info_update', [ProfilController::class, 'info_update']);
    
    Route::get('/', [Controller::class, 'index_accueil'])->name('index_accueil');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/Nouveau Processus', [ProcessusController::class, 'index_add_processus'])->name('index_add_processus');

    Route::get('/Liste Poste', [Controller::class, 'index_liste_poste'])->name('index_liste_poste');
    Route::post('/Nouveau Poste', [Controller::class, 'index_add_poste_traitement'])->name('index_add_poste_traitement');
    Route::post('/Mise a jour Poste', [Controller::class, 'index_modif_poste_traitement'])->name('index_modif_poste_traitement');

    Route::post('/traitement_processus', [ProcessusController::class, 'add_processus'])->name('add_processus');

    Route::get('/Nouveau Processus Eva', [ProcessusController::class, 'index_add_processuseva'])->name('index_add_processuseva');
    Route::get('/recherche/{processusId}', [ProcessusController::class, 'recherche_processuseva'])->name('recherche_processuseva');
    Route::post('/traitement_prc', [ProcessusController::class, 'add_prc'])->name('add_prc');

    Route::get('/Vérification des réclamations', [ListereclamationController::class, 'index_validation'])->name('index_validation_recla');
    Route::get('/Liste des reclamations non acceptées', [ListereclamationController::class, 'index_non_accepte'])->name('index_non_accepte');
    Route::post('/Réclamations non acceptées', [ListereclamationController::class, 'index_non_accepte2'])->name('index_non_accepte2');
    Route::post('/Réclamations traitement', [ListereclamationController::class, 'index_non_accepte_traitement'])->name('index_non_accepte_traitement');
    
    Route::get('/rejet/{id}', [ProcessusController::class, 'cause_rejet'])->name('cause_rejet');

    Route::get('/Liste des processus', [ListeprocessusController::class, 'index_listeprocessus'])->name('index_listeprocessus');
    Route::get('/suppr_processus/{id}', [ListeprocessusController::class, 'suppr_processus'])->name('suppr_processus');


    Route::post('/traitement_resva', [ResvaController::class, 'add_resva'])->name('add_resva');
    Route::post('/add_user', [AuthController::class, 'add_user'])->name('add_user');

    Route::get('/Liste de contrôle des actions', [SuiviactionController::class, 'index_suiviaction'])->name('index_suiviaction');
    Route::get('/valider/{id}', [SuiviactionController::class, 'valider_recla'])->name('valider_recla');
    Route::post('/Rejet', [SuiviactionController::class, 'rejet_recla'])->name('rejet_recla');

    Route::get('/Liste des actions', [ListeactionController::class, 'index'])->name('index_listeaction');
    Route::get('/Liste des actions effectuées', [ListeactionController::class, 'index_effectuer'])->name('index_listeactioneffectuer');

    Route::get('/Eva_proces', [EvaluationController::class, 'index'])->name('index_evaluation');

    Route::get('/fiche_amelioration', [AmeliorationController::class, 'index'])->name('index_amelioration');
    Route::get('/get_cause/{id}', [AmeliorationController::class, 'get_cause']);
    Route::get('/get_cause_new/{id}', [AmeliorationController::class, 'get_cause_new']);
    Route::get('/get_action/{id}', [AmeliorationController::class, 'get_action']);
    Route::post('/add_amelioration', [AmeliorationController::class, 'index_add'])->name('index_add');

    Route::get('/Suivis des reclamations', [ListereclamationController::class, 'index_suivi'])->name('index_listereclamation');
    Route::post('/traitement_date', [SuivireclaController::class, 'date_recla'])->name('date_recla');
    Route::post('/traitement_eff', [SuivireclaController::class, 'eff_recla'])->name('eff_recla');

    Route::get('/liste des causes', [ListereclamationController::class, 'index_list_cause'])->name('index_listecause');
    Route::get('/liste du resume des reclamations', [ListereclamationController::class, 'index_list_recla'])->name('index_listerecla');
    Route::post('/Modification Cause', [ListereclamationController::class, 'index_modif_cause'])->name('index_modif_cause');
    Route::post('/Modification Reclamation', [ListereclamationController::class, 'index_modif_recla'])->name('index_modif_recla');

    Route::get('/Profil', [ProfilController::class, 'index_profil'])->name('index_profil');

    Route::post('/verifi_session', [AuthController::class, 'verifi_session']);

    Route::get('/Historique', [ProfilController::class, 'index_historique'])->name('index_historique');
    Route::get('/Historique Profil', [ProfilController::class, 'index_historique_profil'])->name('index_historique_profil');

    Route::get('/Statistique', [StatistiqueController::class, 'index_stat'])->name('index_stat');
    Route::get('/get_processus/{id}', [StatistiqueController::class, 'get_processus'])->name('get_processus');
    Route::get('/get_date', [StatistiqueController::class, 'get_date'])->name('get_date');

    Route::post('/Suivi_action/{id}', [SuiviactionController::class, 'add_suivi_action'])->name('add_suivi_action');

    Route::get('/Res-va', [ResvaController::class, 'index_add_resva'])->name('index_add_resva');
    Route::post('/traitement_resva', [ResvaController::class, 'add_resva'])->name('add_resva');
    Route::post('/add_user', [AuthController::class, 'add_user'])->name('add_user');

    Route::get('/Liste des utilisateurs', [ListeuserController::class, 'index'])->name('index_liste_resva');

    Route::post('/Modif', [ListeuserController::class, 'index_modif'])->name('index_modif_auto');

    Route::get('/Nouveau Poste', [Controller::class, 'index_add_poste'])->name('index_add_poste');
    Route::post('/Nouveau Poste', [Controller::class, 'index_add_poste_traitement'])->name('index_add_poste_traitement');


    
        
});



/*--------------------------------------------------------------------------------------------------------------*/



