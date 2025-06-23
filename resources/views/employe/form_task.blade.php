@extends('layouts.master')

@section('content')
    <div class="container mt-5">

        @php
            use Carbon\Carbon;
            $now = Carbon::now(); // par défaut utilise l'heure du serveur
            $limite = Carbon::createFromTime(16, 30, 0);
        @endphp

        @if ($now->greaterThanOrEqualTo($limite))
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif
            <div class="card shadow-lg rounded p-4">
                <h4 class="mb-4 text-center text-primary fw-bold">Saisir une tâche</h4>

                <form action="{{ route('taches.post') }}" method="POST">
                    @csrf

                    <!-- Libellé -->
                    <div class="mb-3">
                        <label for="libelle" class="form-label fw-semibold">Libellé de la tâche</label>
                        <input type="text" class="form-control form-control-lg" id="libelle" name="libelle" required
                            placeholder="Entrez le libellé de la tâche">
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description de la tâche</label>
                        <textarea class="form-control" id="description" name="description" rows="5"
                            placeholder="Décrivez brièvement la tâche..." required></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i> Enregistrer la tâche
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="alert alert-warning text-center">
                <h5 class="mb-2">⏳ Formulaire indisponible</h5>
                <p>Vous ne pouvez saisir vos tâches qu'à partir de <strong>16h30</strong>.</p>
                <p>Heure actuelle : <strong>{{ $now->format('H:i') }}</strong></p>
            </div>
        @endif
    </div>
@endsection
