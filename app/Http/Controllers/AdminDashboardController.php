<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.accueiladmin');
    }

    public function creerCompte()
    {
        return view('admin.creercompte');
    }

    public function consulterhistorique()
    {
        $comptesCrees = User::where('created_by', Auth::id())->get();
        return view('admin.consulterhistorique', compact('comptesCrees'));
    }

    // Ajouter : activer/désactiver compte
    public function toggleStatus(User $user)
    {
        $user->active = !$user->active;
        $user->save();

        return redirect()->back()->with('success', 'Statut modifié avec succès.');
    }

    // Ajouter : supprimer compte
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Compte supprimé avec succès.');
    }

    public function showEmployeHistorique($userId)
    {
        $user = User::findOrFail($userId);

        // On récupère les tâches de cet employé
        $taches = $user->taches()->latest()->paginate(10);

        // Pour les pointages, il faudra aussi faire une relation dans User si tu as ce modèle
        // $pointages = $user->pointages()->latest()->paginate(10);
        // Pour l'instant, on laisse vide ou à adapter selon ta table pointages
        $pointages = collect();

        return view('admin.employe_historique', compact('user', 'taches', 'pointages'));
    }

    public function voirDetailsUser($id)
    {
        $user = User::findOrFail($id);
        $taches = $user->taches;       // Toutes ses tâches
        $pointages = $user->pointages; // Tous ses pointages

        return view('admin.details_user', compact('user', 'taches', 'pointages'));
    }
}
