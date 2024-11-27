<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\YearController;
use Illuminate\Support\Facades\Route;




Route::get('/login', [UtilisateurController::class, 'showLoginForm'])->name('login');
Route::get('/', [UtilisateurController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UtilisateurController::class, 'login']);
Route::post('/logout', [UtilisateurController::class, 'logout'])->name('logout');
Route::get('/login', [UtilisateurController::class, 'showLoginForm'])->name('login');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');




Route::get('/dashboard/inscrits', [DashboardController::class, 'compterInscrits']);


// La dashboard
Route::get('/dashboard/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard.dashboard');

Route::get('/inscrit', [DashboardController::class, 'inscrit'])->middleware('auth')->name('dashboard.inscrit');

Route::post('/profile/update-photo', [RegisterController::class, 'updatePhoto'])->middleware('auth')->name('profile.updatePhoto');

Route::get('/showinscrit/{id}', [DashboardController::class, 'show'])->name('dashboard.showinscrit');

Route::get('/delete-user/{id}', [DashboardController::class, 'destroy'])->name('user.destroy');

Route::get('/change-role/{id}/{role}', [DashboardController::class, 'changeRole'])->name('user.changeRole');

Route::get('/change-role-user/{id}', [DashboardController::class, 'changeRoleToUser'])->name('user.changeRoleToUser');

Route::post('/change-role/{id}/{role}', [DashboardController::class, 'changeRoleToAdmin'])->name('changeRoleToAdmin');


// Route pour afficher le formulaire de modification de mot de passe
Route::get('/user/{id}/edit-password', [DashboardController::class, 'editPassword'])->middleware('auth')->name('user.edit-password');

// Route pour soumettre le nouveau mot de passe
Route::post('/user/{id}/update-password', [DashboardController::class, 'updatePassword'])->middleware('auth')->name('user.update-password');

// Route pour afficher le formulaire de modification des informations
Route::get('/user/{id}/edit-info', [DashboardController::class, 'editInfo'])->middleware('auth')->name('user.edit-info');

// Route pour soumettre les nouvelles informations
Route::post('/user/{id}/update-info', [DashboardController::class, 'updateInfo'])->middleware('auth')->name('user.update-info');


// Groupe de routes pour les années
Route::prefix('years')->name('years.')->group(function () {
    Route::get('/', [YearController::class, 'index'])->middleware('auth')->name('index'); // Affiche toutes les années
    Route::get('/create', [YearController::class, 'create'])->middleware('auth')->name('create'); // Formulaire pour ajouter une année->middleware('auth')
    Route::post('/', [YearController::class, 'store'])->middleware('auth')->name('store'); // Enregistre une nouvelle année
    Route::get('/{year}/edit', [YearController::class, 'edit'])->middleware('auth')->name('edit'); // Formulaire de modification
    Route::put('/{year}', [YearController::class, 'update'])->middleware('auth')->name('update'); // Met à jour une année
    Route::delete('/{year}', [YearController::class, 'destroy'])->middleware('auth')->name('destroy'); // Supprime une année
});

Route::get('/dashboard/inscrits', [DashboardController::class, 'compterInscrits'])->middleware('auth');

Route::prefix('dashboard')->group(function () {


});



Route::prefix('ecoles')->group(function() {
    // Route pour afficher la liste des écoles
    Route::get('/', [DashboardController::class, 'viewEcoles'])->middleware('auth')->name('ecoles.view');

    // Route pour afficher le formulaire d'ajout
    Route::get('/create', [DashboardController::class, 'createEcole'])->middleware('auth')->name('ecoles.create');

    // Route pour ajouter une nouvelle école
    Route::post('/store', [DashboardController::class, 'storeEcole'])->middleware('auth')->name('ecoles.store');

    // Routes pour l'édition, la mise à jour et la suppression d'une école
    Route::get('/{id}/edit', [DashboardController::class, 'editEcole'])->middleware('auth')->name('ecoles.edit');
    Route::put('/{id}', [DashboardController::class, 'updateEcole'])->middleware('auth')->name('ecoles.update'); // Utiliser PUT pour la mise à jour
    Route::get('/{id}/edit', [DashboardController::class, 'editEcole'])->middleware('auth')->name('ecoles.edit');
    Route::put('/{id}', [DashboardController::class, 'updateEcole'])->middleware('auth')->name('ecoles.update'); // Utiliser PUT pour la mise à jour

    // Utiliser une méthode PUT ou PATCH pour la mise à jour
    Route::put('/{id}/update', [DashboardController::class, 'updateEcole'])->middleware('auth')->name('ecoles.update');

    Route::delete('/{ecole}', [DashboardController::class, 'destroyEcole'])->middleware('auth')->name('ecoles.destroy');
});


Route::prefix('dioceses')->group(function(){
    Route::get('/', [DashboardController::class, 'viewDioceses'])->middleware('auth')->name('dioceses.view');
    Route::get('/create', [DashboardController::class, 'create'])->middleware('auth')->name('dioceses.create'); // Route pour afficher le formulaire de création
    Route::post('/store', [DashboardController::class, 'store'])->middleware('auth')->name('dioceses.store'); // Route pour enregistrer le diocèse
    Route::get('/{id}/edit', [DashboardController::class, 'edit'])->middleware('auth')->name('dioceses.edit');
    Route::post('/{id}/update', [DashboardController::class, 'update'])->middleware('auth')->name('dioceses.update');
    Route::delete('/{id}', [DashboardController::class, 'destroyDiceses'])->middleware('auth')->name('dioceses.destroy');
});


Route::prefix('utilisateurs')->group(function() {
    Route::get('/', [UtilisateurController::class, 'index'])->middleware('auth')->name('utilisateurs');

});

Route::prefix('acceuil')->group(function() {
    Route::get('/', [UtilisateurController::class, 'acceuil'])->middleware('auth')->name('acceuil');

});

Route::prefix('acceuils')->group(function() {
    Route::get('/', [UtilisateurController::class, 'acceuils'])->middleware('auth')->name('acceuils');

});


Route::prefix('personnels')->group(function() {
    // Affiche la liste de tous les personnels
    Route::get('/', [UtilisateurController::class, 'viewPersonnels'])->middleware('auth')->name('personnels.index');

    // Affiche le formulaire de création d'un nouveau personnel
    Route::get('/create', [UtilisateurController::class, 'createPersonnels'])->middleware('auth')->name('personnels.create');

    // Enregistre un nouveau personnel en base de données
    Route::post('/', [UtilisateurController::class, 'store'])->name('personnels.store');

    // Affiche les détails d'un personnel spécifique
    Route::get('/{personnel}', [UtilisateurController::class, 'showPersonnels'])->middleware('auth')->name('personnels.show');

    // Affiche le formulaire de modification d'un personnel existant
    Route::get('/{personnel}/edit', [UtilisateurController::class, 'editPersonnels'])->middleware('auth')->name('personnels.edit');
    Route::get('/{personnel}/edit', [UtilisateurController::class, 'editPersonnels'])->middleware('auth')->name('personnels.edit');

    // Met à jour un personnel existant
    Route::put('/{personnel}', [UtilisateurController::class, 'updatePersonnels'])->middleware('auth')->name('personnels.update');

    // Supprime un personnel
    Route::delete('/{personnel}', [UtilisateurController::class, 'destroy'])->middleware('auth')->name('personnels.destroy');

});


// Groupes de routes pour les performances
Route::prefix('performances')->group(function () {
    Route::get('/', [PerformanceController::class, 'index'])->middleware('auth')->name('performances.index'); // Liste des performances
    Route::get('/create', [PerformanceController::class, 'create'])->middleware('auth')->name('performances.create'); // Formulaire d'ajout
    Route::post('/', [PerformanceController::class, 'store'])->name('performances.store'); // Stocker une nouvelle performance
    Route::get('/{performance}/edit', [PerformanceController::class, 'edit'])->middleware('auth')->name('performances.edit'); // Formulaire d'édition
    Route::put('/{performance}', [PerformanceController::class, 'update'])->middleware('auth')->name('performances.update'); // Mettre à jour une performance
    Route::delete('/{performance}', [PerformanceController::class, 'destroy'])->middleware('auth')->name('performances.destroy'); // Supprimer une performance
});


Route::prefix('examens')->group(function(){
    // Liste tous les examens
    Route::get('/', [ExamenController::class, 'index'])->middleware('auth')->name('examens.index');

    // Affiche le formulaire de création d'un nouvel examen
    Route::get('/create', [ExamenController::class, 'create'])->middleware('auth')->name('examens.create');

    // Enregistre un nouvel examen
    Route::post('/', [ExamenController::class, 'store'])->middleware('auth')->name('examens.store');

    // Affiche un examen spécifique
    // Route::get('/{examen}', [ExamenController::class, 'show'])->middleware('auth')->name('examens.show');
    Route::get('/{id}/edit', [ExamenController::class, 'edit'])->name('examens.edit');

    // Affiche le formulaire de modification d'un examen
    Route::get('/{examen}/edit', [ExamenController::class, 'edit'])->middleware('auth')->name('examens.edit');

    // Met à jour un examen spécifique
    Route::put('/{examen}', [ExamenController::class, 'update'])->middleware('auth')->name('examens.update');

    // Supprime un examen spécifique
    Route::delete('/{examen}', [ExamenController::class, 'destroy'])->middleware('auth')->name('examens.destroy');

});

