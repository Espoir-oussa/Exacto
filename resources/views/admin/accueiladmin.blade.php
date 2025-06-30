@extends('layouts.master')

{{-- @section('title', 'Créer un compte')

@section('page-title', 'Créer un compte') --}}

@section('content')
    {{-- <div class="flex justify-center items-center flex-col md:flex-row md:space-x-32 space-y-4 md:space-y-0 p-6 ">

        <!-- Card 1 : Créer compte -->
        <div class="flex items-center justify-center bg-gray-100">
            <a href="{{ route('admin.register') }}"
                class="flex flex-col items-center justify-center space-y-4 w-full md:w-[350px] md:h-[400px] p-6 bg-white rounded-lg shadow hover:shadow-lg transition cursor-pointer hover:no-underline">
                <!-- Icône Créer compte -->
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-blue-500 animate-pulse" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v6m3-3h-6m-3 6a4 4 0 100-8 4 4 0 000 8zM6 21v-2a4 4 0 014-4h4a4 4 0 014 4v2" />
                    </svg>
                </div>

                <div class="text-center">
                    <h3 class="text-lg font-semibold">Créer des comptes</h3>
                    <p class="text-gray-600 pt-2">Ajoutez de nouveaux utilisateurs rapidement.</p>
                </div>
            </a>
        </div>

        <div class="flex items-center justify-center bg-gray-100">
            <a href="{{ route('consulterhistorique') }}"
                class="flex flex-col items-center justify-center space-y-4 w-full md:w-[350px] md:h-[400px] p-6 bg-white rounded-lg shadow hover:shadow-lg transition cursor-pointer hover:no-underline">
                <!-- Icône Créer compte -->
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-green-500 animate-pulse" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div class="text-center">
                    <h3 class="text-lg font-semibold">Consulter historiques</h3>
                    <p class="text-gray-600 pt-2">Voir toutes les historiques des tâches et des pointages enregistrés.</p>
                </div>
            </a>
        </div>
    </div> --}}
@endsection
