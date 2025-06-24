<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        return view('admin.consulterhistorique');
    }
}
