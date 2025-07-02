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


    public function consulterhistorique(Request $request)
    {
        $query = User::where('created_by', Auth::id());

        // Si une recherche est saisie, on filtre
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $comptesCrees = $query->get();

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

    public function showEmployeHistorique(Request $request, User $user)
    {
        // Tâches paginées (exemple sans filtre ici)
        $taches = $user->taches()->latest()->paginate(10);

        // Pointages avec filtre par date ou mois
        $pointagesQuery = $user->pointages();

        if ($request->filled('date')) {
            // Filtre sur une date précise
            $pointagesQuery->whereDate('date_pointage', $request->input('date'));
        } elseif ($request->filled('month')) {
            // Filtre par mois (format attendu : YYYY-MM, ex: 2025-07)
            $month = $request->input('month');
            $pointagesQuery->whereYear('date_pointage', substr($month, 0, 4))
                ->whereMonth('date_pointage', substr($month, 5, 2));
        }

        $pointages = $pointagesQuery->latest()->paginate(10);

        return view('admin.employe_historique', compact('user', 'taches', 'pointages'));
    }
}
