@extends('layouts.master')

@section("content")
<div class="container py-5">
    <div class="row justify-content-center g-4">

        <!-- Carte Pointage -->
        <div class="col-md-6">
            <a href="{{ route('pointages.index')}}" class="text-decoration-none">
                <div class="card text-white bg-primary shadow-lg border-0 rounded-4 h-100 hover-zoom transition"
                     style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center p-5">
                        <i class="fas fa-clock fa-4x mb-4"></i>
                        <h3 class="card-title fw-bold mb-3">Pointage</h3>
                        <p class="card-text fs-5">Enregistrez vos heures d’arrivée et de départ chaque jour.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Carte Tâches -->
        <div class="col-md-6">
            <a href="{{ route('taches.index')}}" class="text-decoration-none">
                <div class="card text-white bg-success shadow-lg border-0 rounded-4 h-100 hover-zoom transition"
                     style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center p-5">
                        <i class="fas fa-tasks fa-4x mb-4"></i>
                        <h3 class="card-title fw-bold mb-3">Tâches</h3>
                        <p class="card-text fs-5">Saisissez et suivez les tâches que vous effectuez au quotidien.</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>

<!-- Animation personnalisée -->
<style>
    .hover-zoom:hover {
        transform: scale(1.05);
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection
