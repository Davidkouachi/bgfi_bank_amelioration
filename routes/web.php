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


Route::get('/Login', [AuthController::class, 'view_login'])->name('login');
Route::post('/auth_user', [AuthController::class, 'auth_user']);

Route::get('/Registre', [AuthController::class, 'view_registre'])->name('registre');


Route::middleware(['auth'])->group(function () {
    Route::get('/', [Controller::class, 'index_accueil'])->name('index_accueil');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/Nouveau Processus', [ProcessusController::class, 'index_add_processus'])->name('index_add_processus');

    Route::get('/Nouveau Poste', [Controller::class, 'index_add_poste'])->name('index_add_poste');
    Route::post('/Nouveau Poste', [Controller::class, 'index_add_poste_traitement'])->name('index_add_poste_traitement');

    Route::post('/traitement_processus', [ProcessusController::class, 'add_processus'])->name('add_processus');

    Route::get('/Nouveau Processus Eva', [ProcessusController::class, 'index_add_processuseva'])->name('index_add_processuseva');
    Route::get('/recherche/{processusId}', [ProcessusController::class, 'recherche_processuseva'])->name('recherche_processuseva');
    Route::post('/traitement_prc', [ProcessusController::class, 'add_prc'])->name('add_prc');

    Route::get('/Validation', [ProcessusController::class, 'index_validation_processus'])->name('index_validation_processus');
    Route::get('/cause_valider/{id}', [ProcessusController::class, 'cause_valider'])->name('cause_valider');
    Route::get('/rejet/{id}', [ProcessusController::class, 'cause_rejet'])->name('cause_rejet');

    Route::get('/Liste processus', [ListeprocessusController::class, 'index_listeprocessus'])->name('index_listeprocessus');
    Route::get('/suppr_processus/{id}', [ListeprocessusController::class, 'suppr_processus'])->name('suppr_processus');


    Route::post('/traitement_resva', [ResvaController::class, 'add_resva'])->name('add_resva');
    Route::post('/add_user', [AuthController::class, 'add_user'])->name('add_user');

    Route::get('/Suivi_action', [SuiviactionController::class, 'index_suiviaction'])->name('index_suiviaction');
    Route::get('/Suivi_actionc', [SuiviactionController::class, 'index_suiviactionc'])->name('index_suiviactionc');
    Route::post('/Suivi_action/{id}', [SuiviactionController::class, 'add_suivi_action'])->name('add_suivi_action');
    Route::get('/check_actions', [SuiviactionController::class, 'check_actions'])->name('check_actions');
    Route::get('/update_action_type', [SuiviactionController::class, 'update_action_type'])->name('update_action_type');

    Route::get('/Eva_proces', [EvaluationController::class, 'index'])->name('index_evaluation');

    Route::get('/fiche_amelioration', [AmeliorationController::class, 'index'])->name('index_amelioration');
    Route::get('/get-cause-info/{id}', [AmeliorationController::class, 'get_cause_info']);
    Route::get('/get-risque-info/{id}', [AmeliorationController::class, 'get_risque_info']);
    Route::post('/add_amelioration', [AmeliorationController::class, 'index_add'])->name('index_add');

    Route::get('/Profil', [ProfilController::class, 'index_profil'])->name('index_profil');

    Route::post('/verifi_session', [AuthController::class, 'verifi_session']);

    Route::get('/Historique', [SuiviactionController::class, 'index_historique'])->name('index_historique');
    Route::get('/Historique Profil', [SuiviactionController::class, 'index_historique_profil'])->name('index_historique_profil');

    Route::get('/Statistique', [StatistiqueController::class, 'index_stat'])->name('index_stat');
    Route::get('/get_processus/{id}', [StatistiqueController::class, 'get_processus'])->name('get_processus');
    Route::get('/get_date', [StatistiqueController::class, 'get_date'])->name('get_date');
});

Route::get('/Res-va', [ResvaController::class, 'index_add_resva'])->name('index_add_resva');
Route::post('/traitement_resva', [ResvaController::class, 'add_resva'])->name('add_resva');
Route::post('/add_user', [AuthController::class, 'add_user'])->name('add_user');

Route::get('/Nouveau Poste', [Controller::class, 'index_add_poste'])->name('index_add_poste');
Route::post('/Nouveau Poste', [Controller::class, 'index_add_poste_traitement'])->name('index_add_poste_traitement');


/*--------------------------------------------------------------------------------------------------------------*/



