<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
     public function index()
    {
        // $nbEmployes = User ::where('is_admin', false)->count();
        // $pointagesDuJour = Pointage::whereDate('date_pointage', today())->get();
        // $tachesDuJour = Tache::whereDate('date_tache', today())->get();

        return view('layouts.master');
    }
}
