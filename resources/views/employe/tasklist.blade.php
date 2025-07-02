@extends("layouts.master")
@section('title', 'Historique des Tâches')
@section('page-title', 'Historique des Tâches')

@section("content")
<div class="px-4 sm:px-6 lg:px-8 py-10">
    <div class="max-w-7xl mx-auto bg-primary rounded-2xl shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-dark px-6 py-4 rounded-t-2xl">
            <h2 class="text-xl sm:text-2xl font-bold text-white text-center">📋 Historique de vos tâches</h2>
        </div>

        <!-- Contenu -->
        <div class="p-4 sm:p-6">
            @if($taches->isEmpty())
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 text-center">
                    <div class="mx-auto w-16 h-16 flex items-center justify-center bg-blue-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-dark mb-2">Aucune tâche enregistrée</h3>
                    <p class="text-gray-600 text-sm sm:text-base">Votre historique de tâches apparaîtra ici</p>
                </div>
            @else
                <div class="overflow-x-auto rounded-lg">
                    <table class="min-w-full text-sm sm:text-base border-separate border-spacing-y-2">
                        <thead class="bg-dark text-primary uppercase text-xs sm:text-sm">
                            <tr>
                                <th class="py-3 px-4 text-left rounded-tl-lg">N°</th>
                                <th class="py-3 px-4 text-left">Libellé</th>
                                <th class="py-3 px-4 text-left">Description</th>
                                <th class="py-3 px-4 text-left">Date</th>
                                <th class="py-3 px-4 text-left rounded-tr-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white text-gray-800">
                            @foreach($taches as $index => $tache)
                            <tr class="hover:bg-dark/5 transition">
                                <td class="py-3 px-4 font-semibold">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 font-medium break-words">{{ $tache->libelle_tache }}</td>
                                <td class="py-3 px-4 max-w-sm break-words text-sm">{{ $tache->description }}</td>
                                <td class="py-3 px-4 text-sm">
                                    {{ $tache->created_at->format('d/m/Y') }}
                                    <div class="text-xs text-gray-400">{{ $tache->created_at->format('H:i') }}</div>
                                </td>
                                <td class="py-3 px-4">
                                    <form action="{{ route('taches.delete', $tache->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $taches->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
