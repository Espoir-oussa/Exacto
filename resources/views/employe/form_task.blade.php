@extends('layouts.master')

@section('content')
<div class="max-w-2xl mx-auto p-4 sm:p-6 md:p-8">
    @php
        use Carbon\Carbon;
        $now = Carbon::now();
        $debut = Carbon::createFromTime(16, 30, 0); // 16h30
        $fin = Carbon::createFromTime(20, 0, 0);    // 20h00
    @endphp

    @if ($now->between($debut, $fin))
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
                <button type="button" class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Saisir une tâche</h2>

            <form action="{{ route('taches.post') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="description" class="block text-gray-700 font-medium mb-2">
                        Description de la tâche
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"
                        placeholder="Décrivez la tâche effectuée..."
                        required
                    ></textarea>
                </div>

                <div class="text-center mt-8">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition flex items-center justify-center mx-auto">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Enregistrer la tâche
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center">
            <div class="mx-auto w-16 h-16 flex items-center justify-center bg-yellow-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-yellow-800 mb-2">Formulaire indisponible</h3>

            <p class="text-gray-600 mb-3">
                Vous ne pouvez saisir vos tâches qu'entre
                <span class="font-semibold text-yellow-700">16h30</span> et
                <span class="font-semibold text-yellow-700">20h</span>.
            </p>

            <div class="bg-white inline-block rounded-full px-4 py-2 text-sm font-medium text-gray-800">
                Heure actuelle : <span class="font-mono">{{ $now->format('H:i') }}</span>
            </div>
        </div>
    @endif
</div>
@endsection
