<?php

namespace App\Http\Controllers;

use App\Models\Pointage;
use Illuminate\Http\Request;

class PointageController extends Controller
{
    // Supprimer un pointage
    public function destroy(Pointage $pointage)
    {
        $pointage->delete();
        return redirect()->back()->with('success', 'Pointage supprimé avec succès.');
    }
}
