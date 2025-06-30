@extends('layouts.master')

@section('title', 'Profil')
@section('page-title', 'Mon Profil')

@section('content')
    <div class="max-w-3xl mx-auto py-8 px-4">
        @if (session('status') === 'profile-updated')
            <div class="mb-4 text-green-600 font-semibold">Profil mis à jour avec succès.</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Nom -->
            <div>
                <label for="name" class="block font-medium text-gray-700">Nom</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Prénom -->
            <div>
                <label for="first_name" class="block font-medium text-gray-700">Prénom</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                @error('first_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block font-medium text-gray-700">Nouveau mot de passe <span
                        class="text-gray-500">(laisser vide pour ne pas changer)</span></label>
                <input type="password" id="password" name="password"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmation du mot de passe -->
            <div>
                <label for="password_confirmation" class="block font-medium text-gray-700">Confirmer le mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Photo de profil -->
            <div>
                <label for="profile_photo" class="block font-medium text-gray-700">Photo de profil</label>
                <input type="file" name="profile_photo" id="profile_photo" class="mt-1">
                @if ($user->profile_photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Photo actuelle"
                            class="h-16 w-16 rounded-full object-cover">
                    </div>
                @endif
                @error('profile_photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bouton -->
            <div>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Enregistrer</button>
            </div>
        </form>
    </div>
@endsection
