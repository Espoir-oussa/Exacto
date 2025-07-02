@extends('layouts.master')

@section('title', 'Historique des comptes')

@section('page-title', 'Comptes Créés')

@section('content')

    {{-- <form method="GET" action="{{ route('consulterhistorique') }}"
        class="mb-8 flex flex-wrap gap-3 justify-center md:justify-start">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Rechercher un employé par nom, prénom ou email..."
            class="w-full md:w-96 px-5 py-3 rounded-lg border-2 border-[#164f63] bg-[#164f63] text-white placeholder-[#a0c4d6] focus:outline-none focus:ring-4 focus:ring-[#164f63] transition" />
        <button type="submit"
            class="bg-[#164f63] hover:bg-[#133d4a] text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition">
            <i class="fas fa-fw fa-magnifying-glass w-5"></i>
        </button>
    </form>

    @if(request('search'))
        <p class="text-sm text-[#164f63] mb-4 text-center md:text-left">
            Résultats pour <strong>{{ request('search') }}</strong> : {{ $comptesCrees->count() }} compte(s) trouvé(s).
        </p>
    @endif

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-5 py-3 rounded-lg mb-6 max-w-xl mx-auto md:mx-0 shadow-md">
            {{ session('success') }}
        </div>
    @endif --}}

    <!-- TABLEAU DESKTOP -->
    <div class="hidden md:block overflow-x-auto rounded-lg shadow-lg border border-[#164f63]">
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
                            @if($user->active)
                                <span
                                    class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold tracking-wide">Actif</span>
                            @else
                                <span
                                    class="inline-block px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold tracking-wide">Désactivé</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center space-x-2 md:space-y-3">
                            <a href="{{ route('employe.historique', $user->id) }}"
                                class="inline-block bg-[#164f63] hover:bg-[#0f3a4c] text-white px-4 py-1 rounded-md text-sm font-semibold shadow-md transition">
                                <i class="fas fa-fw fa-eye w-5"></i>
                            </a>

                            <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="inline-block bg-yellow-400 hover:bg-yellow-500 text-[#164f63] font-semibold px-4 py-1 rounded-md text-sm shadow-md transition">
                                    @if($user->active) <i class="fas fa-fw fa-toggle-on w-5 text-black"></i> @else<i
                                    class="fas fa-fw fa-toggle-off w-5 text-gray-400"></i> @endif
                                </button>
                            </form>

                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-block bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded-md text-sm font-semibold shadow-md transition">
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
                    {{ $user->first_name }}</p>
                <p class="text-[#164f63] mb-1"><span class="font-bold">Email :</span> {{ $user->email }}</p>
                <p class="text-[#164f63] mb-1"><span class="font-bold">Date création :</span>
                    {{ $user->created_at->format('d/m/Y H:i') }}</p>
                <p class="mb-3">
                    <span class="font-bold text-[#164f63]">Statut :</span>
                    @if($user->active)
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
                            @if($user->active) Désactiver @else Activer @endif
                        </button>
                    </form>

                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="w-full sm:w-auto"
                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold text-sm shadow-md transition">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

@endsection
