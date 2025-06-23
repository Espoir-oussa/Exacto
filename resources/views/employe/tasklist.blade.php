@extends("layouts.master")

@section("content")
<div class="container mt-5">
    <div class="card shadow rounded p-4">
        <h4 class="text-primary fw-bold text-center mb-4">Historique de vos tâches</h4>

        @if($taches->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>
                Aucune tâche enregistrée pour le moment.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Libellé</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($taches as $index => $tache)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $tache->libelle_tache }}</td>
                            <td>{{ $tache->description }}</td>
                            <td>{{ $tache->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
