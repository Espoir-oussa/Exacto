<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TacheController extends Controller
{
     public function create()
    {
        return view('employe.saisir-taches');
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle_tache' => 'required|string|max:255',
            'date_tache' => 'required|date',
        ]);

        Tache::create([
            'user_id' => auth()->id(),
            'date_tache' => $request->date_tache,
            'libelle_tache' => $request->libelle_tache,
        ]);

        return redirect()->back()->with('success', 'Tâche enregistrée.');
    }

    public function index()
    {
        $taches = Tache::with('user')->latest()->get();
        return view('admin.taches.index', compact('taches'));
    }
}
