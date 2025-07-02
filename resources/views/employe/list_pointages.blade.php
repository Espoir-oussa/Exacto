@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-primary mb-4">🗓️ Mes pointages</h4>

                    @if($pointages->isEmpty())
                        <div class="alert alert-info text-center">Aucun pointage effectué pour l’instant.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle shadow-sm">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Heure d’arrivée</th>
                                        <th>Heure de départ</th>
                                        <th>Retard</th>
                                        <th>Motif</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($pointages as $index => $pointage)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pointage->date_pointage)->format('d/m/Y') }}</td>
                                            <td>{{ $pointage->heure_arrivee ?? '—' }}</td>
                                            <td>{{ $pointage->heure_depart ?? '—' }}</td>
                                            <td>
                                                @if($pointage->justificatif_retard)
                                                    <span class="badge bg-warning text-dark">Oui</span>
                                                @else
                                                    <span class="badge bg-success">Non</span>
                                                @endif
                                            </td>
                                            <td>{{ $pointage->justificatif_retard ?? '—' }}</td>
                                            <td>
                                                @if($pointage->statut)
                                                    <span class="badge bg-success">Validé</span>
                                                @else
                                                    <span class="badge bg-secondary">En attente</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination (si besoin) --}}
                        <div class="mt-3">
                            {{ $pointages->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
