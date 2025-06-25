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
       $tache=new Tache();
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
