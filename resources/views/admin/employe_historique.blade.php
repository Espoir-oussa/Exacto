@extends('layouts.master')

@section('title', "Historique de l'employé {$user->name} {$user->first_name}")
@section('page-title', "Historique de {$user->name} {$user->first_name}")

@section('content')

    {{-- <form method="GET" action="{{ route('employe.historique', $user->id) }}"
        class="mb-8 flex flex-col md:flex-row gap-6 items-start md:items-end">
        <div class="w-full md:w-auto">
            <label for="date" class="block text-sm font-medium text-[#164f63] mb-1">Filtrer par date</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}"
                class="border border-[#164f63] rounded-md px-3 py-2 w-full md:w-48 focus:outline-none focus:ring-2 focus:ring-[#164f63] focus:ring-opacity-50" />
        </div>

        <div class="w-full md:w-auto">
            <label for="month" class="block text-sm font-medium text-[#164f63] mb-1">Filtrer par mois</label>
            <input type="month" name="month" id="month" value="{{ request('month') }}"
                class="border border-[#164f63] rounded-md px-3 py-2 w-full md:w-48 focus:outline-none focus:ring-2 focus:ring-[#164f63] focus:ring-opacity-50" />
        </div>

        <div class="w-full md:w-auto">
            <button type="submit"
                class="w-full md:w-auto bg-[#164f63] text-white font-semibold px-6 py-2 rounded-md hover:bg-opacity-90 transition">
                Filtrer
            </button>
        </div>
    </form> --}}

    <div class="max-w-6xl mx-auto px-4 py-8">

        <h1 class="text-xl font-bold text-[#164f63] mb-10">
            Détails sur l'employé : <span class="text-[#164f63] font-semibold capitalize">{{ $user->name ?? '' }} {{ $user->first_name ?? '' }}</span>
        </h1>

        {{-- TÂCHES --}}
        <section class="mb-16">
            <h2 class="text-xl font-semibold text-[#164f63] border-b-4 border-[#164f63] pb-3 mb-8 capitalize">
                Tâches exécutées
            </h2>

            @if ($taches->isEmpty())
                <p class="italic text-gray-500">Aucune tâche enregistrée.</p>
            @else
                <div class="overflow-x-auto rounded-lg border border-[#164f63] shadow-sm">
                    <table class="min-w-full bg-white text-[#164f63]">
                        <thead class="bg-[#164f63] text-white uppercase text-xs sm:text-sm tracking-wide">
                            <tr>
                                <th class="text-left px-4 sm:px-8 py-3 font-semibold">Description</th>
                                <th class="text-left px-4 sm:px-8 py-3 font-semibold">Date</th>
                                <th class="text-left px-4 sm:px-8 py-3 font-semibold">Heure</th>
                                <th class="text-center px-4 sm:px-8 py-3 font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taches as $tache)
                                <tr class="border-b border-[#164f63] hover:bg-[#164f63]/10 transition">
                                    <td class="px-4 sm:px-8 py-2">{{ $tache->description }}</td>
                                    <td class="px-4 sm:px-8 py-2">{{ $tache->created_at->format('d/m/Y') }}</td>
                                    <td class="px-4 sm:px-8 py-2">{{ $tache->created_at->format('H:i') }}</td>
                                    <td class="px-4 sm:px-8 py-2 text-center">
                                        <form action="{{ route('taches.destroy', $tache->id) }}" method="POST" onsubmit="return confirm('Supprimer cette tâche ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="text-red-600 hover:text-red-800 font-semibold text-sm transition"
                                                aria-label="Supprimer la tâche">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $taches->links() }}
                </div>
            @endif
        </section>

        {{-- POINTAGES --}}
        <section>
            <h2 class="text-xl font-semibold text-[#164f63] border-b-4 border-[#164f63] pb-3 mb-8">
                Pointages
            </h2>

            @if ($pointages->isEmpty())
                <p class="italic text-gray-500">Aucun pointage enregistré.</p>
            @else
                <div class="overflow-x-auto rounded-lg border border-[#164f63] shadow-sm">
                    <table class="min-w-full bg-white text-[#164f63]">
                        <thead class="bg-[#164f63] text-white uppercase text-xs sm:text-sm tracking-wide">
                            <tr>
                                <th class="px-4 sm:px-8 py-3 font-semibold text-left">Date</th>
                                <th class="px-4 sm:px-8 py-3 font-semibold text-left">Arrivée</th>
                                <th class="px-4 sm:px-8 py-3 font-semibold text-left">Départ</th>
                                <th class="px-4 sm:px-8 py-3 font-semibold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pointages as $pointage)
                                <tr class="hover:bg-[#164f63]/10 transition">
                                    <td class="px-4 sm:px-8 py-2">{{ \Carbon\Carbon::parse($pointage->date)->format('d/m/Y') }}</td>
                                    <td class="px-4 sm:px-8 py-2 text-green-700 font-semibold">{{ $pointage->heure_arrivee }}</td>
                                    <td class="px-4 sm:px-8 py-2 text-red-700 font-semibold">{{ $pointage->heure_depart }}</td>
                                    <td class="px-4 sm:px-8 py-2 text-center">
                                        <form action="{{ route('pointages.destroy', $pointage->id) }}" method="POST" onsubmit="return confirm('Supprimer ce pointage ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="text-red-600 hover:text-red-800 font-semibold text-sm transition"
                                                aria-label="Supprimer le pointage">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

    </div>

@endsection
