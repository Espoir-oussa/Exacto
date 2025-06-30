<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeDashboardController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\PointageController; // <-- ajouté ici
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route dashboard avec redirection basée sur le rôle
Route::get('/dashboard', function () {
    $auth = Auth::user();
    if (!$auth) {
        return redirect()->route('login');
    }

    return $auth->role === "admin"
        ? redirect()->route('admin.dashboard')
        : redirect()->route('employe.dashboard');
})->name('dashboard')->middleware(['auth', 'verified']);

// Routes Admin
Route::middleware(['auth', 'active', CheckRole::class . ':admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/accueil-admin', [AdminDashboardController::class, 'accueiladmin'])->name('accueiladmin');
        Route::get('/consulter-historique', [AdminDashboardController::class, 'consulterhistorique'])->name('consulterhistorique');


        Route::get('/register', [RegisteredUserController::class, 'create'])->name('admin.register');
        Route::post('/register', [RegisteredUserController::class, 'store'])->name('admin.register.store');

        // Nouvelle route pour la liste des employés
        Route::get('/liste-employes', [AdminDashboardController::class, 'listeEmployes'])->name('admin.liste-employes');

        // Route pour voir l'historique d'un employé
        Route::get('/employe/{user}/historique', [AdminDashboardController::class, 'showEmployeHistorique'])->name('employe.historique');

        // Suppression et activation/désactivation des utilisateurs
        Route::post('/user/{user}/toggle', [AdminDashboardController::class, 'toggleStatus'])->name('admin.user.toggle');
        Route::delete('/user/{user}', [AdminDashboardController::class, 'destroyUser'])->name('admin.user.destroy');

        // Routes pour supprimer tâches et pointages
        Route::delete('/taches/{tache}', [TacheController::class, 'destroy'])->name('taches.destroy');
        Route::delete('/pointages/{pointage}', [PointageController::class, 'destroy'])->name('pointages.destroy');
    });
});

// Routes Employé
Route::middleware(['auth', 'active', CheckRole::class . ':employe'])->prefix("employe")->group(function () {
    Route::get('/dashboard', [EmployeDashboardController::class, 'index'])->name('employe.dashboard');
    Route::get("/taches_form", [EmployeDashboardController::class, "ShowTaskForm"])->name("taches.index");
    Route::post("/post_taches", [EmployeDashboardController::class, "HandleTask"])->name("taches.post");
    Route::get("/list_tasks", [EmployeDashboardController::class, "ShowAllTask"])->name("tasks.lists");
    Route::get("/pointages_page", [EmployeDashboardController::class, "ShowPointage"])->name("pointages.index");

    // Nouvelle route pour la suppression des tâches par employé
    Route::delete('/taches/{tache}', [EmployeDashboardController::class, 'destroyTask'])->name('taches.delete');
});

// Routes Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

require __DIR__ . '/auth.php';
