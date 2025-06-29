<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeDashboardController extends Controller
{
    public function index()
    {
        return view('employe.dash_employe');
    }

    public function ShowTaskForm()
    {
        return view("employe.form_task");
    }

    public function HandleTask(Request $request)
    {
        $request->validate([
            'description' => 'required|string|min:10',
        ],
        [
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 10 caractères.',
        ]);

        Tache::create([
            'description' => $request->description,
            'user_id' => Auth::id(),
            'libelle_tache' => 'Tâche du ' . now()->format('d/m/Y'), // Ajout d'un libellé automatique
        ]);

        return redirect()->back()->with("success", "Tâche enregistrée avec succès");
    }

    public function ShowAllTask()
    {
        // Récupère seulement les tâches de l'utilisateur connecté
        $taches = Tache::where('user_id', Auth::id())
                        ->latest()
                        ->paginate(10); // Pagination

        return view("employe.tasklist", compact("taches"));
    }

    public function ShowPointage()
    {
        // À implémenter
    }

    // Nouvelle méthode pour supprimer une tâche
    public function destroyTask(Tache $tache)
    {
        // Vérifie que l'utilisateur peut seulement supprimer ses propres tâches
        if ($tache->user_id !== Auth::id()) {
            abort(403, 'Action non autorisée');
        }

        $tache->delete();

        return back()->with('success', 'Tâche supprimée avec succès');
    }
}
