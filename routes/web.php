<?php
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeDashboardController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\PointageController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route dashboard générique actuelle (peut être remplacée ou modifiée)
// Route::get('/dashboard', function () {
//     return view('master');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    $auth=Auth::user();
    if (!$auth) {
        return redirect()->route('login');
    }

    if ($auth->role==="admin") {
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
    Route::get('/admin/accueil-admin', [AdminDashboardController::class, 'accueiladmin'])->name('accueiladmin');
    Route::get('/admin/consulter-historique', [AdminDashboardController::class, 'consulterhistorique'])->name('consulterhistorique');
    Route::get('/admin/register', [RegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('/admin/register', [RegisteredUserController::class, 'store'])->name('admin.register.store');



    // Route::get('/admin/creer-compte', function () {
    //     return view('admin.creercompte');
    // })->name('creercompte');
    // Ajouter ici d'autres routes admin
});

Route::middleware(['auth', CheckRole::class.':employe'])->prefix("employe")->group(function () {
    Route::get('/dashboard', [EmployeDashboardController::class, 'index'])->name('employe.dashboard');
    Route::get("/taches_form",[EmployeDashboardController::class,"ShowTaskForm"])->name("taches.index");
    Route::post("/post_taches",[EmployeDashboardController::class,"HandleTask"])->name("taches.post");
    Route::get("/list_tasks",[EmployeDashboardController::class,"ShowAllTask"])->name("tasks.lists");
    Route::get("/pointages_page",[EmployeDashboardController::class,"ShowPointage"])->name("pointages.index");
    //taches.index

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
