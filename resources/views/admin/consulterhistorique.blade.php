@extends('layouts.master')

@section('title', 'Historique des comptes')

@section('page-title', 'Comptes Créés')

@section('content')


    <!-- TABLEAU DESKTOP -->
    <div class="hidden md:block overflow-x-auto rounded-lg shadow-lg border border-[#164f63] mb-8">
        <table class="min-w-full border-collapse text-[#164f63] font-sans">
            <thead class="bg-[#164f63] text-white uppercase text-sm tracking-wide">
                <tr>
                    <th class="py-4 px-6 text-left">Nom complet</th>
                    <th class="py-4 px-6 text-left">Email</th>
                    <th class="py-4 px-6 text-left">Date création</th>
                    <th class="py-4 px-6 text-left">Statut</th>
                    <th class="py-4 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-[#f9fafb]">
                @foreach ($comptesCrees as $user)
                    <tr class="border-b border-[#164f63]/20 hover:bg-[#e0f2ff] transition">
                        <td class="py-3 px-6 font-medium">{{ $user->name }} {{ $user->first_name }}</td>
                        <td class="py-3 px-6 break-words max-w-xs">{{ $user->email }}</td>
                        <td class="py-3 px-6 whitespace-nowrap">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-3 px-6">
                            @if ($user->active)
                                <span
                                    class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold tracking-wide">Actif</span>
                            @else
                                <span
                                    class="inline-block px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold tracking-wide">Désactivé</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center space-x-2 md:space-y-3">
                            <a href="{{ route('employe.historique', $user->id) }}"
                                class="inline-block text-dark px-4 py-1 font-semibold">
                                <i class="fas fa-fw fa-eye w-5"></i>
                            </a>

                            <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="inline-block  text-[#164f63] font-semibold px-4 py-1">
                                    @if ($user->active)
                                    <i class="fas fa-fw fa-toggle-on w-5 text-black"></i> @else<i
                                        class="fas fa-fw fa-toggle-off w-5 text-gray-400"></i>
                                    @endif
                                </button>
                            </form>

                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="openDeleteModal({{ $user->id }})"
                                    class="inline-block text-red-600 px-4 py-1 font-semibold">
                                    <i class="fas fa-fw fa-trash w-5 text-white-600"></i>
                                </button>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- AFFICHAGE MOBILE -->
    <div class="md:hidden space-y-6">
        @foreach ($comptesCrees as $user)
            <div class="bg-[#164f63] bg-opacity-10 rounded-xl p-5 shadow-lg border border-[#164f63]/30">
                <p class="text-[#164f63] font-semibold mb-1"><span class="font-bold">Nom :</span> {{ $user->name }}
                    {{ $user->first_name }}
                </p>
                <p class="text-[#164f63] mb-1"><span class="font-bold">Email :</span> {{ $user->email }}</p>
                <p class="text-[#164f63] mb-1"><span class="font-bold">Date création :</span>
                    {{ $user->created_at->format('d/m/Y H:i') }}</p>
                <p class="mb-3">
                    <span class="font-bold text-[#164f63]">Statut :</span>
                    @if ($user->active)
                        <span
                            class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold tracking-wide">Actif</span>
                    @else
                        <span
                            class="inline-block px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold tracking-wide">Désactivé</span>
                    @endif
                </p>
                <div class="flex flex-wrap gap-3 justify-center">
                    <a href="{{ route('employe.historique', $user->id) }}"
                        class="bg-[#164f63] hover:bg-[#0f3a4c] text-white px-4 py-2 rounded-lg font-semibold text-sm shadow-md transition w-full sm:w-auto text-center">
                        Voir détails
                    </a>

                    <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit"
                            class="w-full bg-yellow-400 hover:bg-yellow-500 text-[#164f63] font-semibold px-4 py-2 rounded-lg text-sm shadow-md transition">
                            @if ($user->active)
                                Désactiver
                            @else
                                Activer
                            @endif
                        </button>
                    </form>

                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="w-full sm:w-auto"
                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="openDeleteModal({{ $user->id }})"
                            class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold text-sm shadow-md transition">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- MODALE DE CONFIRMATION -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white p-6 rounded shadow-lg text-center w-[90%] max-w-md">
            <p class="mb-4 text-gray-800">Êtes-vous sûr de vouloir supprimer ce compte ?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-center gap-4">
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Confirmer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function openDeleteModal(userId) {
        const form = document.getElementById('deleteForm');
        form.action = "{{ route('admin.user.destroy',  $user->id) }}";
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>



@endsection
