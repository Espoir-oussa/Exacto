@extends('layouts.master')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-8">
    <!-- TEST HEADER -->
    <h1 class="text-4xl font-extrabold mb-8 text-gray-900">
        Détails de l'utilisateur : <span class="text-indigo-600">{{ $user->name }}</span>
    </h1>

    {{-- Section Tâches --}}
    <section class="mb-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b-2 border-indigo-600 pb-2">Tâches assignées</h2>

        @if ($taches->isEmpty())
            <p class="text-gray-500 italic">Aucune tâche assignée.</p>
        @else
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-indigo-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">Titre</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($taches as $tache)
                    <tr class="hover:bg-indigo-50">
                        <td class="border border-gray-300 px-4 py-2">{{ $tache->titre }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $tache->description }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <form action="{{ route('taches.destroy', $tache->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette tâche ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>

    {{-- Section Pointages --}}
    <section>
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b-2 border-indigo-600 pb-2">Pointages</h2>

        @if ($pointages->isEmpty())
            <p class="text-gray-500 italic">Aucun pointage enregistré.</p>
        @else
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-indigo-100">
                        <th class="border border-gray-300 px-4 py-2">Date</th>
                        <th class="border border-gray-300 px-4 py-2">Arrivée</th>
                        <th class="border border-gray-300 px-4 py-2">Départ</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pointages as $pointage)
                    <tr class="hover:bg-indigo-50">
                        <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($pointage->date)->format('d/m/Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-green-600 font-semibold">{{ $pointage->heure_arrivee }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-red-600 font-semibold">{{ $pointage->heure_depart }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <form action="{{ route('pointages.destroy', $pointage->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce pointage ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
</div>
@endsection
