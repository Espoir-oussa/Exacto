@extends('layouts.master')

@section('title', "Historique de l'employé {$user->name}")
@section('page-title', "Historique de {$user->name}")

@section('content')

<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-xl md:text-xl font-bold text-gray-800 mb-8">
        Détails de l'employé : <span class="text-dark">{{ $user->name ?? '' }} {{ $user->first_name ?? '' }}</span>
    </h1>

    {{-- TÂCHES --}}
    <section class="mb-12 md:text-sm">
    <h2 class="text-base md:text-xl font-semibold text-gray-800 mb-6 border-b-2 border-dark pb-2 text-capitalize">Tâches exécutées</h2>

    @if ($taches->isEmpty())
        <p class="text-gray-500 italic">Aucune tâche enregistrée.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden text-sm md:text-base">
    <thead class="bg-indigo-100">
        <tr>
            <th class="py-3 px-4 border-b text-left">Description</th>
            <th class="py-3 px-4 border-b text-left">Date</th>
            <th class="py-3 px-4 border-b text-left">Heure</th>
            <th class="py-3 px-4 border-b text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($taches as $tache)
            <tr class="hover:bg-indigo-50">
                <td class="px-4 py-2 border-b">{{ $tache->description }}</td>
                <td class="px-4 py-2 border-b">{{ $tache->created_at->format('d/m/Y') }}</td>
                <td class="px-4 py-2 border-b">{{ $tache->created_at->format('H:i') }}</td>
                <td class="px-4 py-2 border-b text-center">
                    <form action="{{ route('taches.destroy', $tache->id) }}" method="POST" onsubmit="return confirm('Supprimer cette tâche ?');">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:text-red-800 font-semibold text-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

        </div>

        <div class="mt-4">{{ $taches->links() }}</div>
    @endif
</section>


    {{-- POINTAGES --}}
    <section>
    <h2 class="text-base md:text-xl font-semibold text-gray-800 mb-6 border-b-2 border-indigo-600 pb-2">Pointages</h2>

    @if ($pointages->isEmpty())
        <p class="text-gray-500 italic">Aucun pointage enregistré.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden text-sm md:text-base">
                <thead class="bg-indigo-100">
                    <tr>
                        <th class="py-3 px-4 border-b">Date</th>
                        <th class="py-3 px-4 border-b">Arrivée</th>
                        <th class="py-3 px-4 border-b">Départ</th>
                        <th class="py-3 px-4 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pointages as $pointage)
                        <tr class="hover:bg-indigo-50">
                            <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($pointage->date)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 border-b text-green-600 font-semibold">{{ $pointage->heure_arrivee }}</td>
                            <td class="px-4 py-2 border-b text-red-600 font-semibold">{{ $pointage->heure_depart }}</td>
                            <td class="px-4 py-2 border-b text-center">
                                <form action="{{ route('pointages.destroy', $pointage->id) }}" method="POST" onsubmit="return confirm('Supprimer ce pointage ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 font-semibold text-sm">Supprimer</button>
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
