<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $mesTaches = $user->taches()->latest()->take(5)->get();
        $mesPointages = $user->pointages()->latest()->take(5)->get();

        return view('employe.dashboard', compact('mesTaches', 'mesPointages'));
    }
}
