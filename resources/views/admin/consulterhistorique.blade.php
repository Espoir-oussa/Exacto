@extends('layouts.master')

@section('title', 'Historique des comptes')

@section('page-title', 'Comptes Créés')

@section('content')

    <form method="GET" action="{{ route('consulterhistorique') }}" class="mb-6 flex gap-2 flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Rechercher un employé par nom, prénom ou email..."
            class="px-4 py-2 border border-gray-300 rounded-md w-full md:w-1/3">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Rechercher
        </button>
    </form>

    <script>
        const searchInput = document.querySelector('input[name="search"]');
        const tableBody = document.querySelector('table tbody');
        const mobileList = document.querySelector('.md\\:hidden.space-y-4');

        function renderTable(users) {
            let html = '';
            users.forEach(user => {
                html += `
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b border-gray-300">${user.name} ${user.first_name}</td>
                        <td class="py-2 px-4 border-b border-gray-300">${user.email}</td>
                        <td class="py-2 px-4 border-b border-gray-300">${new Date(user.created_at).toLocaleString('fr-FR')}</td>
                        <td class="py-2 px-4 border-b border-gray-300">
                            ${user.active ? '<span class="text-green-600 font-semibold">Actif</span>' : '<span class="text-red-600 font-semibold">Désactivé</span>'}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-300 text-center space-x-2">
                            <a href="/employe/historique/${user.id}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Voir détails</a>
                            <form action="/admin/user/toggle/${user.id}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                    ${user.active ? 'Désactiver' : 'Activer'}
                                </button>
                            </form>
                            <form action="/admin/user/destroy/${user.id}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                `;
            });
            tableBody.innerHTML = html;
        }

        function renderMobile(users) {
            let html = '';
            users.forEach(user => {
                html += `
                    <div class="border rounded p-4 shadow bg-white">
                        <p><strong>Nom :</strong> ${user.name}</p>
                        <p><strong>Email :</strong> ${user.email}</p>
                        <p><strong>Date création :</strong> ${new Date(user.created_at).toLocaleString('fr-FR')}</p>
                        <p><strong>Statut :</strong> ${user.active ? '<span class="text-green-600 font-semibold">Actif</span>' : '<span class="text-red-600 font-semibold">Désactivé</span>'}</p>
                        <div class="flex flex-wrap gap-2 mt-3">
                            <a href="/employe/historique/${user.id}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Voir détails</a>
                            <form action="/admin/user/toggle/${user.id}" method="POST">
                                @csrf
                                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                    ${user.active ? 'Désactiver' : 'Activer'}
                                </button>
                            </form>
                            <form action="/admin/user/destroy/${user.id}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Supprimer</button>
                            </form>
                        </div>
                    </div>
                `;
            });
            mobileList.innerHTML = html;
        }

        searchInput.addEventListener('input', function () {
            const query = this.value.trim();

            fetch("{{ route('consulterhistorique') }}?search=" + encodeURIComponent(query), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    renderTable(data.comptes);
                    renderMobile(data.comptes);
                })
                .catch(error => {
                    console.error('Erreur AJAX:', error);
                });
        });
    </script>




    @if(request('search'))
        <p class="text-sm text-gray-600 mt-2">
            Résultats pour <strong>{{ request('search') }}</strong> : {{ $comptesCrees->count() }} compte(s) trouvé(s).
        </p>
    @endif


    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <!-- TABLEAU (pour écran md et +) -->
    <div class="w-full overflow-x-auto hidden md:block mt-8">
        <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 border-b border-gray-300 text-left">Nom complet</th>
                    <th class="py-3 px-4 border-b border-gray-300 text-left">Email</th>
                    <th class="py-3 px-4 border-b border-gray-300 text-left">Date création</th>
                    <th class="py-3 px-4 border-b border-gray-300 text-left">Statut</th>
                    <th class="py-3 px-4 border-b border-gray-300 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comptesCrees as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b border-gray-300">{{ $user->name }} {{ $user->first_name }}</td>
                        <td class="py-2 px-4 border-b border-gray-300">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b border-gray-300">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-2 px-4 border-b border-gray-300">
                            @if($user->active)
                                <span class="text-green-600 font-semibold">Actif</span>
                            @else
                                <span class="text-red-600 font-semibold">Désactivé</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b border-gray-300 text-center space-x-2">
                            <a href="{{ route('employe.historique', $user->id) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                Voir détails
                            </a>

                            <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                    @if($user->active) Désactiver @else Activer @endif
                                </button>
                            </form>

                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- AFFICHAGE MOBILE (cartes) -->
    <div class="md:hidden space-y-4">
        @foreach ($comptesCrees as $user)
            <div class="border rounded p-4 shadow bg-white">
                <p><strong>Nom :</strong> {{ $user->name }}</p>
                <p><strong>Email :</strong> {{ $user->email }}</p>
                <p><strong>Date création :</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Statut :</strong>
                    @if($user->active)
                        <span class="text-green-600 font-semibold">Actif</span>
                    @else
                        <span class="text-red-600 font-semibold">Désactivé</span>
                    @endif
                </p>

                <div class="flex flex-wrap gap-2 mt-3">
                    <a href="{{ route('employe.historique', $user->id) }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                        Voir détails
                    </a>

                    <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                            @if($user->active) Désactiver @else Activer @endif
                        </button>
                    </form>

                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

@endsection
