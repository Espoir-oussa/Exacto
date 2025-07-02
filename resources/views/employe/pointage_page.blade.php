@extends('layouts.master')
@section('title', 'Pointages')
@section('page-title', 'Pointages')

@section('content')
@if (session('success') || session('error'))
    <div class="fixed bottom-4 right-4 z-[1055]">
        <div id="liveToast"
            class="toast flex items-center text-white {{ session('success') ? 'bg-green-600' : 'bg-red-600' }} rounded shadow-lg p-4"
            role="alert" aria-live="assertive" aria-atomic="true">
            <div class="flex-grow">
                {{ session('success') ?? session('error') }}
            </div>
            <button type="button" class="ml-4 text-white hover:text-gray-200 focus:outline-none" aria-label="Close" id="toastCloseBtn">
                ✕
            </button>
        </div>
    </div>
@endif

<div class="container mx-auto py-12">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <div class="md:flex">
            <!-- Formulaire -->
            <div class="p-8 flex-1">
                <h4 class="text-2xl font-bold text-blue-600 mb-4">📍 Pointage du personnel</h4>
                <p class="text-gray-600 mb-6">Veuillez choisir l’action à effectuer ci-dessous.</p>

                <form id="pointageForm" method="POST" action="{{ route('pointage.store') }}" novalidate>
                    @csrf
                    <input type="hidden" name="type" id="inputType" value="" />
                    <input type="hidden" name="retard" id="inputRetard" value="0" />

                    <div class="flex flex-wrap gap-4 mb-6">
                        <button
                            type="button"
                            id="btnArrivee"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
                            aria-label="Pointer l’arrivée"
                        >
                            <i class="mdi mdi-login"></i> Pointer l’arrivée
                        </button>

                        <button
                            type="button"
                            id="btnDepart"
                            class="border border-red-600 text-red-600 px-6 py-3 rounded-lg shadow hover:bg-red-600 hover:text-white disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
                            aria-label="Pointer le départ"
                            disabled
                        >
                            <i class="mdi mdi-logout"></i> Pointer le départ
                        </button>
                    </div>

                    <div id="motifRetardContainer" class="hidden bg-yellow-100 border-l-4 border-yellow-400 p-4 rounded mb-4">
                        <label for="motif_retard" class="block font-semibold mb-2">⏰ Vous êtes en retard. Merci d’indiquer le motif :</label>
                        <textarea
                            id="motif_retard"
                            name="motif_retard"
                            class="w-full p-3 rounded border border-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                            placeholder="Ex : embouteillage, souci familial..."
                            required
                        ></textarea>
                        <button
                            type="submit"
                            id="submitBtnWithMotif"
                            class="mt-4 bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700 disabled:opacity-50"
                            disabled
                        >
                            Envoyer
                        </button>
                    </div>

                    <div id="submitBtnContainer">
                        <button
                            type="submit"
                            id="submitBtn"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 disabled:opacity-50"
                            disabled
                        >
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Variables
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

        // Initial button states selon variables PHP
        btnArrivee.disabled = hasArrivee;
        btnDepart.disabled = hasDepart || !hasArrivee;

        let currentType = '';
        let retard = 0;

        // Fonction mise à jour bouton Envoyer normal
        function updateSubmitBtnState() {
            submitBtn.disabled = currentType === '';
        }

        // Fonction mise à jour bouton Envoyer avec motif
        function updateSubmitBtnMotifState() {
            submitBtnWithMotif.disabled = motifTextarea.value.trim() === '';
        }

        // Clic Pointer arrivée
        btnArrivee.addEventListener('click', function () {
            currentType = 'arrivee';
            inputType.value = currentType;

            // Confirmation retard
            if (confirm("Êtes-vous en retard ?")) {
                retard = 1;
                inputRetard.value = retard;

                // Afficher textarea motif retard
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

        // Clic Pointer départ
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

        // Validation formulaire
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

        // Écoute sur textarea motif retard pour activer bouton Envoyer
        motifTextarea.addEventListener('input', updateSubmitBtnMotifState);

        // Initial disable submit button normal
        updateSubmitBtnState();

        // Toast close button
        const toastCloseBtn = document.getElementById('toastCloseBtn');
        if (toastCloseBtn) {
            toastCloseBtn.addEventListener('click', function () {
                this.closest('#liveToast').remove();
            });
        }
    });
</script>
@endsection
