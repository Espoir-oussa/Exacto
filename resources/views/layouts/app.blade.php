<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exacto - Gestion des employés</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/css/ruang-admin.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-5 w-auto">
                </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-[#f40000] text-white rounded-3xl hover:bg-[#000000] transition">Connexion</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->

    <main class="flex-grow bg-logo bg-cover bg-center bg-screen">
        @yield('content')
    </main>


    <!-- Pied de page -->
    <footer class="bg-[#000000] text-white  py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p>&copy; {{ date('Y') }} eXacto. Tous droits réservés.</p>
                </div>
                <div class="text-center md:text-right">
                    <p>Développé par <span class="font-semibold">eXacto</span></p>
                    <p>Contact : eXacto@gmail.com</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
