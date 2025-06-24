@extends('layouts.master')

@section('title', 'Créer comptes')

@section('page-title', 'Créer comptes')

@section('content')
<style>
  .glass {
    background: rgba(22,79, 99, 0.90);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.1);
  }

  .animate-fade-in {
    animation: fade-in 0.8s ease-out forwards;
    opacity: 0;
  }

  @keyframes fade-in {
    to {
      opacity: 1;
    }
  }
</style>

<div class="min-h-screen flex items-center justify-center bg-white-500 px-4">
  <div class="glass w-full max-w-md p-8 rounded-2xl shadow-2xl text-white animate-fade-in">

    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <a href="/">
        <img src="{{ asset('images/Logo IMUXT (Blanc).png') }}" alt="Logo IMUXT" class="h-10 w-auto">
      </a>
    </div>

    <!-- Titre -->
    <h2 class="text-3xl font-bold text-center mb-6 tracking-wide text-white">Créer un compte employé</h2>

    @if (session('status'))
      <div class="mb-4 text-sm text-green-400">
        {{ session('status') }}
      </div>
    @endif

    <!-- Formulaire -->
    <form method="POST" action="{{ route('admin.register.store') }}" class="space-y-6">
      @csrf

      <!-- Prénom -->
      <div>
        <label for="first_name" class="block text-sm font-medium text-white">Prénom</label>
        <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required
          class="mt-1 w-full px-4 py-2 rounded-lg bg-black bg-opacity-40 border border-gray-600 text-white placeholder-white focus:outline-none focus:ring-2 ">
      </div>

      <!-- Nom -->
      <div>
        <label for="name" class="block text-sm font-medium text-white">Nom</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required
          class="mt-1 w-full px-4 py-2 rounded-lg bg-black bg-opacity-40 border border-gray-600 text-white placeholder-white focus:outline-none focus:ring-2 ">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-white">Adresse email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required
          class="mt-1 w-full px-4 py-2 rounded-lg bg-black bg-opacity-40 border border-gray-600 text-white placeholder-white focus:outline-none focus:ring-2 ">
      </div>

      <!-- Mot de passe -->
      <div>
        <label for="password" class="block text-sm font-medium text-white">Mot de passe</label>
        <input id="password" type="password" name="password" required
          class="mt-1 w-full px-4 py-2 rounded-lg bg-black bg-opacity-40 border border-gray-600 text-white placeholder-white focus:outline-none focus:ring-2 ">
      </div>

      <!-- Confirmation -->
      <div>
        <label for="password_confirmation" class="block text-sm font-medium text-white">Confirmer le mot de passe</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required
          class="mt-1 w-full px-4 py-2 rounded-lg bg-black bg-opacity-40 border border-gray-600 text-white placeholder-white focus:outline-none focus:ring-2 ">
      </div>

      <!-- Bouton -->
      <div>
        <button type="submit"
          class="w-full bg-white text-dark hover:text-dark font-semibold py-2 rounded-lg transition duration-300 shadow-md">
          Créer le compte
        </button>
      </div>
    </form>
  </div>
</div>
@endsection




{{-- @section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Créer un nouveau compte employé</h2>

    <form method="POST" action="{{ route('admin.register.store') }}">
        @csrf

        <!-- Nom -->
        <div class="mb-4">
            <label class="block text-gray-700">Nom</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" required
                class="w-full px-4 py-2 border rounded">
            @error('last_name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Prénom -->
        <div class="mb-4">
            <label class="block text-gray-700">Prénom</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}" required
                class="w-full px-4 py-2 border rounded">
            @error('first_name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full px-4 py-2 border rounded">
            @error('email')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div class="mb-4">
            <label class="block text-gray-700">Mot de passe</label>
            <input type="password" name="password" required class="w-full px-4 py-2 border rounded">
            @error('password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmation -->
        <div class="mb-4">
            <label class="block text-gray-700">Confirmer mot de passe</label>
            <input type="password" name="password_confirmation" required
                class="w-full px-4 py-2 border rounded">
        </div>

        <!-- Bouton -->
        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">
                Créer le compte
            </button>
        </div>
    </form>
</div>
@endsection --}}
