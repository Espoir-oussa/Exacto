<?php

namespace App\Http\Controllers;

use App\Models\Pointage;
use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $request->validate(
            [
                'description' => 'required|string|min:10',
            ],
            [
                'description.required' => 'La description est obligatoire.',
                'description.min' => 'La description doit contenir au moins 10 caractères.',
            ]
        );

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
            ->orderBy('created_at', 'asc')
            ->paginate(10); // Pagination

        return view("employe.tasklist", compact("taches"));
    }

    public function ShowPointage()
    {
        // À implémenter*
        //id
        // user_id
        // date_pointage
        // heure_arrivee
        // heure_depart
        // justificatif_retard
        // statut
        // created_at
        // updated_a
        $userId = Auth::id();
        $today = now()->toDateString();

        $pointage = Pointage::where('user_id', $userId)
            ->whereDate('date_pointage', $today)
            ->first();

        // Flags pour les boutons
        $hasArrivee = $pointage && $pointage->heure_arrivee !== null;
        $hasDepart = $pointage && $pointage->heure_depart !== null;

        return view("employe.pointage_page", [
            'hasArrivee' => $hasArrivee,
            'hasDepart' => $hasDepart,
        ]);
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
    public function HandlePointage(Request $request)
    {
        $today = now()->toDateString();
        $userId = Auth::id();

        // Vérifie si un pointage existe déjà pour aujourd’hui
        $pointage = Pointage::where('user_id', $userId)
            ->whereDate('date_pointage', $today)
            ->first();

        if (!$pointage) {
            // Création d’un nouveau pointage
            $pointage = new Pointage();
            $pointage->user_id = $userId;
            $pointage->date_pointage = $today;
        }

        if ($request->type === "arrivee" && !$pointage->heure_arrivee) {
            $pointage->heure_arrivee = Carbon::now()->format('H:i');

            // Gestion du retard
            if ($request->has('retard') && $request->retard == 1) {
                $request->validate([
                    'motif_retard' => 'required|string|min:3',
                ], [
                    'motif_retard.required' => 'Le motif est requis.',
                ]);

                $pointage->justificatif_retard = $request->motif_retard;
            }
        }

        if ($request->type === "depart" && !$pointage->heure_depart) {
            $pointage->heure_depart = Carbon::now()->format('H:i');
        }

        $pointage->statut = true;
        $pointage->save();

        return redirect()->back()->with("success", "Pointage effectué avec succès.");
    }
    public function ShowPointages()
    {
        $userId = Auth::id();
        $pointages = Pointage::where('user_id', $userId)
            ->orderByDesc('date_pointage')
            ->paginate(10);

        return view('employe.list_pointages', compact('pointages'));
    }
}
