<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    // Supprimer une tâche
    public function destroy(Tache $tache)
    {
        $tache->delete();
        return redirect()->back()->with('success', 'Tâche supprimée avec succès.');
    }
}
