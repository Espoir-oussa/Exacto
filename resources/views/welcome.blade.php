@extends('layouts.app')
@section('content')

        <div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8 ">
            <div class="text-center justify-center md:justify-center py-2">
                <h1 class="text-3xl md:text-4xl text-[#164f63] font-black mb-6 pt-10">Optimisez la gestion de votre équipe</h1>
                <p class="text-[18px] md:text-lg text-[#164f63] max-w-3xl mx-auto mb-8 font-medium">
                    Exacto simplifie le suivi des présences et l'attribution des tâches pour une gestion d'équipe plus efficace.
                </p>

                 <div class="justify-center md:mt-16 font-bold">
                    <a href="{{ route('login') }}" class="px-5 py-3 bg-[#164f63] text-[#ffffff] rounded-3xl hover:border-[#164f63] hover:bg-[#ffffff] hover:text-[#164f63] hover:border-2 hover:no-underline  text-decoration-none]  transition p-6">Démarrer maintenant</a>
                </div>


            </div>
        </div>

@endsection
