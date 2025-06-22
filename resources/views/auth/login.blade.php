@extends('layouts.app')

@section('content')
<style>
  .glass {
    background: rgba(0, 0, 0, 0.75);
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
        <img src="{{ asset('images/logo.png') }}" alt="Logo exacto" class="h-10 w-auto">
      </a>
    </div>

    <!-- Titre -->
    <h2 class="text-3xl font-bold text-center mb-6 tracking-wide text-white">Connexion</h2>

    @if (session('status'))
      <div class="mb-4 text-sm text-green-400">
        {{ session('status') }}
      </div>
    @endif

    <!-- Formulaire -->
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
      @csrf
      @if ($errors->has('email'))
        <div class="alert alert-danger">
            {{ $errors->first('email') }}
        </div>
        @endif

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-white">Adresse email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
          class="mt-1 w-full px-4 py-2 rounded-lg bg-black bg-opacity-40 border border-gray-600 text-white placeholder-white focus:outline-none focus:ring-2 ">

      </div>

      <!-- Mot de passe -->
      <div>
        <label for="password" class="block text-sm font-medium text-white">Mot de passe</label>
        <input id="password" type="password" name="password" required
          class="mt-1 w-full px-4 py-2 rounded-lg bg-black bg-opacity-40 border border-gray-600 text-white placeholder-white focus:outline-none focus:ring-2 ">
        @error('password')
          <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Mot de passe oublié -->
      <div class="flex justify-end">
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="text-sm text-white-400 hover:underline">
            Mot de passe oublié ?
          </a>
        @endif
      </div>

      <!-- Bouton -->
      <div>
        <button type="submit"
          class="w-full bg-red-600 hover:bg-red-500 text-white font-semibold py-2 rounded-lg transition duration-300 shadow-md">
          Connexion
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
