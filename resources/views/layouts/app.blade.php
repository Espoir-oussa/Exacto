<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMUXT - Plateforme de Gestion des Employés et des Tâches</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/Logo IMUXT.png') }}" type="image/png" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-[#164f63] shadow-md py-1 px-2  md:px-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/Logo IMUXT (Blanc).png') }}" alt="Logo" class="h-5 w-auto">
                </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-[#ffffff] text-[#164f63] font-bold rounded-3xl hover:border-[#164f63] hover:border-2 hover:no-underline hover:text-[#164f63] text-decoration-none transition">Connexion</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->

    <main class="flex-grow bg-logo bg-cover bg-center bg-screen">
        @yield('content')
    </main>


    <!-- Pied de page -->
    <footer class="bg-[#164f63] text-white  py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0 text-center ">
                    <p>&copy; {{ date('Y') }} IMUXT Sarl. Tous droits reservés.</p>
                </div>
                {{-- <div class="text-center md:text-right">
                    <p>Développé par <span class="font-semibold">OUSSA Chadrac</span></p>
                </div> --}}
            </div>
        </div>
    </footer>
</body>
</html>
