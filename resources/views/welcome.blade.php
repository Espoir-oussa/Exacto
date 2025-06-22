@extends('layouts.app')
@section('content')

        <div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8 font-bold ">
            <div class="text-center justify-center md:justify-center ">
                <h1 class="text-4xl font-bold text-[#f40000] mb-6 pt-10">Optimisez la gestion de votre équipe</h1>
                <p class="text-xl text-[#000000]-800 max-w-3xl mx-auto mb-8">
                    Exacto simplifie le suivi des présences et l'attribution des tâches pour une gestion d'équipe plus efficace.
                </p>

                 <div class="justify-center md:mt-20">
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-[#f40000] text-white rounded-3xl hover:bg-[#000000] transition">Démarrer maintenant</a>
                </div>


            </div>
        </div>

@endsection
