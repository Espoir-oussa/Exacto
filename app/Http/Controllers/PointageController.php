<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PointageController extends Controller
{
    public function create()
    {
        return view('employe.saisir-pointage');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_pointage' => 'required|date',
            'heure_arrivee' => 'required',
            'heure_depart' => 'required',
            'justificatif_retard' => 'nullable|string',
        ]);

        Pointage::create([
            'user_id' => auth()->id(),
            'date_pointage' => $request->date_pointage,
            'heure_arrivee' => $request->heure_arrivee,
            'heure_depart' => $request->heure_depart,
            'justificatif_retard' => $request->justificatif_retard,
            'statut' => true,
        ]);

        return redirect()->back()->with('success', 'Pointage enregistré.');
    }

    public function mesPointages()
    {
        $mesPointages = auth()->user()->pointages()->latest()->get();
        return view('employe.mes-pointages', compact('mesPointages'));
    }

    public function index()
    {
        $pointages = Pointage::with('user')->latest()->get();
        return view('admin.pointages.index', compact('pointages'));
    }
}
