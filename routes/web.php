<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeDashboardController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\PointageController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('master');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/ma')
});


// Route::middleware(['auth'])->group(function () {

//     // Redirection automatique selon le rôle
//     Route::get('/dashboard', function () {
//         return auth()->user()->is_admin ? redirect('/admin') : redirect('/employe');
//     });

//     // Routes ADMIN
//     Route::middleware('admin')->prefix('admin')->group(function () {
//         Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
//         Route::get('/taches', [TacheController::class, 'index'])->name('admin.taches.index');
//         Route::get('/pointages', [PointageController::class, 'index'])->name('admin.pointages.index');
//         // Tu pourras ajouter ici la gestion des employés plus tard
//     });

//     // Routes EMPLOYÉ
//     Route::prefix('employe')->group(function () {
//         Route::get('/', [EmployeDashboardController::class, 'index'])->name('employe.dashboard');

//         // Pointage
//         Route::get('/saisir-pointage', [PointageController::class, 'create'])->name('employe.pointage.create');
//         Route::post('/saisir-pointage', [PointageController::class, 'store'])->name('employe.pointage.store');
//         Route::get('/mes-pointages', [PointageController::class, 'mesPointages'])->name('employe.pointages');

//         // Tâches
//         Route::get('/saisir-taches', [TacheController::class, 'create'])->name('employe.tache.create');
//         Route::post('/saisir-taches', [TacheController::class, 'store'])->name('employe.tache.store');
//     });
// }); 

require __DIR__.'/auth.php';