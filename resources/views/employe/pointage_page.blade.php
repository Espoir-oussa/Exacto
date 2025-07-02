@extends('layouts.master')
@section('content')
@if(session('success') || session('error'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
    <div id="liveToast" class="toast align-items-center text-white {{ session('success') ? 'bg-success' : 'bg-danger' }} border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') ?? session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0 rounded-4">
                <div class="row g-0">
                    <!-- Section droite : Formulaire -->
                    <div class="col-md-8">
                        <div class="card-body py-4 px-5">
                            <h4 class="fw-bold text-primary mb-3">📍 Pointage du personnel</h4>
                            <p class="text-muted mb-4">Veuillez choisir l’action à effectuer ci-dessous.</p>
                                {{$hasDepart||!$hasArrivee}}
                            <form method="POST" action="{{route('pointage.store')}}">
                                @csrf
                                <input type="hidden" name="type" id="type" value="">
                                <input type="hidden" name="retard" id="retard" value="0">

                                <div class="d-flex justify-content-start gap-3 flex-wrap mb-4">
                                    <button type="submit" class="btn btn-lg btn-primary px-4 py-2 rounded-3 shadow-sm" id="btn-arrivee"  {{ $hasArrivee ?'disabled':''}}>
                                        <i class="mdi mdi-login me-1"></i> Pointer l’arrivée
                                    </button>

                                    <button type="submit" class="btn btn-lg btn-outline-dark px-4 py-2 rounded-3 shadow-sm btn-danger" id="btn-depart"  {{ $hasDepart || !$hasArrivee ? 'disabled' : '' }}>
                                        <i class="mdi mdi-logout me-1"></i> Pointer le départ
                                    </button>
                                </div>

                                <div id="champ-retard" class="alert alert-warning d-none shadow-sm">
                                    <label for="motif_retard" class="form-label fw-semibold mb-1">
                                        ⏰ Vous êtes en retard. Merci d’indiquer le motif :
                                    </label>
                                    <textarea name="motif_retard" class="form-control border-0 shadow-sm" placeholder="Ex : embouteillage, souci familial..." ></textarea>
                                    <button type="submit" class="btn btn-primary mt-3" id="btn-m">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end card -->
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const btnArrivee = document.getElementById("btn-arrivee");
        const btnDepart = document.getElementById("btn-depart");
        const typeInput = document.getElementById("type");
        const champRetard = document.getElementById("champ-retard");
        const btn = document.getElementById("btn-m");
        btnArrivee.addEventListener("click", function () {
            typeInput.value = "arrivee";
            const now = new Date();
            const heure = now.getHours();
            const minute = now.getMinutes();

            const enRetard = (heure > 8) || (heure === 8 && minute > 0);
            if(enRetard){
                btnArrivee.disabled=true
            } else{
                btnArrivee.disabled=false
            }
            champRetard.classList.toggle("d-none", !enRetard);
        });

        btnDepart.addEventListener("click", function () {
            typeInput.value = "depart";
        });

    });  
</script>
@if(session('success') || session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.getElementById('liveToast');
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    });
</script>
@endif
@endpush
