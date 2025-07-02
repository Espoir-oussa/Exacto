@extends('layouts.master')
@section('title', 'Pointages')
@section('page-title', 'Pointages')

@section('content')
@if (session('success') || session('error'))
    <div class="fixed bottom-4 right-4 z-[1055]">
        <div id="liveToast"
            class="toast flex items-center text-white rounded shadow-lg p-4
                {{ session('success') ? 'bg-green-600' : 'bg-red-600' }}"
            role="alert" aria-live="assertive" aria-atomic="true">
            <div class="flex-grow font-semibold">
                {{ session('success') ?? session('error') }}
            </div>
            <button type="button" class="ml-4 text-white hover:text-gray-200 focus:outline-none" aria-label="Close" id="toastCloseBtn">
                ✕
            </button>
        </div>
    </div>
@endif

<div class="container mx-auto py-12 px-4">
    <div class="max-w-3xl mx-auto bg-dark/90 rounded-xl shadow-lg overflow-hidden border border-primary/30">
        <div class="p-8">
            <h4 class="text-xl font-extrabold text-primary mb-6 text-center">📍 Pointage du personnel</h4>
            <p class="text-primary/80 mb-8 text-sm">Veuillez choisir l’action à effectuer ci-dessous.</p>

            <form id="pointageForm" method="POST" action="{{ route('pointage.store') }}" novalidate>
                @csrf
                <input type="hidden" name="type" id="inputType" value="" />
                <input type="hidden" name="retard" id="inputRetard" value="0" />

                <div class="flex flex-wrap gap-6 mb-8">
                    <button
                        type="button"
                        id="btnArrivee"
                        class="flex items-center gap-2 px-8 py-3 rounded-lg shadow-lg bg-primary text-dark font-semibold
                               hover:bg-white transition disabled:opacity-50 disabled:cursor-not-allowed"
                        aria-label="Pointer l’arrivée"
                    >
                        <i class="mdi mdi-login text-xl"></i> Pointer l’arrivée
                    </button>

                    <button
                        type="button"
                        id="btnDepart"
                        class="flex items-center gap-2 px-8 py-3 rounded-lg shadow-lg border-2 border-red-500 text-red-400
                               hover:bg-red-600 hover:text-white transition disabled:opacity-50 disabled:cursor-not-allowed"
                        aria-label="Pointer le départ"
                        disabled
                    >
                        <i class="mdi mdi-logout text-xl"></i> Pointer le départ
                    </button>
                </div>

                <div id="motifRetardContainer" class="hidden bg-yellow-50 border-l-4 border-yellow-400 p-5 rounded-lg mb-6 shadow-inner">
                    <label for="motif_retard" class="block font-semibold mb-3 text-yellow-800">⏰ Vous êtes en retard. Merci d’indiquer le motif :</label>
                    <textarea
                        id="motif_retard"
                        name="motif_retard"
                        rows="3"
                        placeholder="Ex : embouteillage, souci familial..."
                        required
                        class="w-full rounded-md border border-yellow-300 p-3 text-yellow-900 placeholder-yellow-500
                               focus:outline-none focus:ring-2 focus:ring-yellow-400 transition"
                    ></textarea>
                    <button
                        type="submit"
                        id="submitBtnWithMotif"
                        class="mt-5 w-full bg-primary text-dark font-semibold py-3 rounded-lg shadow-lg hover:bg-white transition disabled:opacity-50"
                        disabled
                    >
                        Envoyer
                    </button>
                </div>

                <div id="submitBtnContainer">
                    <button
                        type="submit"
                        id="submitBtn"
                        class="w-full bg-primary text-dark font-semibold py-3 rounded-lg shadow-lg hover:bg-white transition disabled:opacity-50"
                        disabled
                    >
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hasArrivee = {{ json_encode($hasArrivee) }};
        const hasDepart = {{ json_encode($hasDepart) }};

        const btnArrivee = document.getElementById('btnArrivee');
        const btnDepart = document.getElementById('btnDepart');
        const form = document.getElementById('pointageForm');
        const inputType = document.getElementById('inputType');
        const inputRetard = document.getElementById('inputRetard');
        const motifContainer = document.getElementById('motifRetardContainer');
        const motifTextarea = document.getElementById('motif_retard');
        const submitBtnWithMotif = document.getElementById('submitBtnWithMotif');
        const submitBtn = document.getElementById('submitBtn');
        const submitBtnContainer = document.getElementById('submitBtnContainer');

        btnArrivee.disabled = hasArrivee;
        btnDepart.disabled = hasDepart || !hasArrivee;

        let currentType = '';
        let retard = 0;

        function updateSubmitBtnState() {
            submitBtn.disabled = currentType === '';
        }

        function updateSubmitBtnMotifState() {
            submitBtnWithMotif.disabled = motifTextarea.value.trim() === '';
        }

        btnArrivee.addEventListener('click', function () {
            currentType = 'arrivee';
            inputType.value = currentType;

            if (confirm("Êtes-vous en retard ?")) {
                retard = 1;
                inputRetard.value = retard;

                motifContainer.classList.remove('hidden');
                submitBtnContainer.classList.add('hidden');
                submitBtnWithMotif.disabled = true;
                motifTextarea.value = '';
                motifTextarea.focus();
            } else {
                retard = 0;
                inputRetard.value = retard;
                motifContainer.classList.add('hidden');
                submitBtnContainer.classList.remove('hidden');
                updateSubmitBtnState();
                submitBtn.focus();
            }
        });

        btnDepart.addEventListener('click', function () {
            currentType = 'depart';
            inputType.value = currentType;
            retard = 0;
            inputRetard.value = retard;

            motifContainer.classList.add('hidden');
            submitBtnContainer.classList.remove('hidden');
            updateSubmitBtnState();
            submitBtn.focus();
        });

        form.addEventListener('submit', function (e) {
            if (currentType === '') {
                e.preventDefault();
                alert("Veuillez sélectionner une action (arrivée ou départ).");
                return;
            }
            if (currentType === 'arrivee' && retard === 1 && motifTextarea.value.trim() === '') {
                e.preventDefault();
                alert("Le motif de retard est obligatoire.");
                motifTextarea.focus();
                return;
            }
        });

        motifTextarea.addEventListener('input', updateSubmitBtnMotifState);

        updateSubmitBtnState();

        const toastCloseBtn = document.getElementById('toastCloseBtn');
        if (toastCloseBtn) {
            toastCloseBtn.addEventListener('click', function () {
                this.closest('#liveToast').remove();
            });
        }
    });
</script>
@endsection
