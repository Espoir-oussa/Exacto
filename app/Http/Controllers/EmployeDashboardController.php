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
            'libelle' => 'required|string|max:255',
            'description' => 'required|string|min:10',
        ], [
            'libelle.required' => 'Le libellé est obligatoire.',
            'libelle.max' => 'Le libellé ne doit pas dépasser 255 caractères.',
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 10 caractères.',
        ]);
       $tache=new Tache();
       $tache->libelle_tache=$request->libelle;
       $tache->description=$request->description;
       $tache->user_id=Auth::id();
       $tache->save();
       return redirect()->back()->with("success","Tache envoyéée avec succès");

    }
    public function ShowAllTask(){
        $taches=Tache::all();
        return view("employe.tasklist",compact("taches"));
    }
    public function ShowPointage() {

    }
}
