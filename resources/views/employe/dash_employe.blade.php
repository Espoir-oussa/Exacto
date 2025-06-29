@extends('layouts.master')

@section("content")
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Carte Pointage -->
        <a href="{{ route('pointages.index')}}" class="block">
            <div class="bg-blue-600 text-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl h-full">
                <div class="flex flex-col justify-center items-center text-center p-8 md:p-10 h-full">
                    <div class="mb-6">
                        <div class="bg-blue-500 rounded-full p-4 inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Pointage</h3>
                    <p class="text-lg">Enregistrez vos heures d'arrivée et de départ chaque jour.</p>
                </div>
            </div>
        </a>

        <!-- Carte Tâches -->
        <a href="{{ route('taches.index')}}" class="block">
            <div class="bg-green-600 text-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl h-full">
                <div class="flex flex-col justify-center items-center text-center p-8 md:p-10 h-full">
                    <div class="mb-6">
                        <div class="bg-green-500 rounded-full p-4 inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Tâches</h3>
                    <p class="text-lg">Saisissez et suivez les tâches que vous effectuez au quotidien.</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
