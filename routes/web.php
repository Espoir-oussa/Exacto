<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeDashboardController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\PointageController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route dashboard générique actuelle (peut être remplacée ou modifiée)
// Route::get('/dashboard', function () {
//     return view('master');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role="admin") {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('employe.dashboard');
    }
})  ->name('dashboard')
    ->middleware(['auth', 'verified']);
;


// Groupes de routes sécurisées par rôle
Route::middleware(['auth', CheckRole::class.':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Ajouter ici d'autres routes admin
});

Route::middleware(['auth', 'role:employe'])->group(function () {
    Route::get('/employe/dashboard', [EmployeDashboardController::class, 'index'])->name('employe.dashboard');
    // Ajouter ici d'autres routes employé
});

// Routes pour le profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

require __DIR__.'/auth.php';
