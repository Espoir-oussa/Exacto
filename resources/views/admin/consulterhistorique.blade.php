@extends('layouts.master')

@section('title', 'Historique des comptes')

@section('page-title', 'Historique des comptes créés')

@section('content')

<h2 class="text-2xl font-bold mb-6">Comptes créés par vous</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

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
                <td class="py-2 px-4 border-b border-gray-300">{{ $user->name }}</td>
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

                    <!-- Voir tâches & pointages -->
                    <a href="{{ route('employe.historique', $user->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                        Voir détails
                    </a>

                    <!-- Bouton activer/désactiver -->
                    <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                            @if($user->active) Désactiver @else Activer @endif
                        </button>
                    </form>

                    <!-- Bouton supprimer -->
                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
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

@endsection
