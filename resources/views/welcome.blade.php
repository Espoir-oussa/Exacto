<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exacto - Gestion des employés</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    <main class="flex-grow">
        <div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8 ">
            <div class="text-center justify-center md:justify-center bg-logo bg-cover bg-center bg-screen">
                <h1 class="text-4xl font-bold text-[#f40000] mb-6 pt-10">Optimisez la gestion de votre équipe</h1>
                <p class="text-xl text-[#000000]-800 max-w-3xl mx-auto mb-8">
                    Exacto simplifie le suivi des présences et l'attribution des tâches pour une gestion d'équipe plus efficace.
                </p>

                 <div class="justify-center md:mt-20">
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-[#f40000] text-white rounded-3xl hover:bg-[#000000] transition">Démarrer maintenant</a>
                </div>
                
                <!-- <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-[#f40000] mb-4">
                            <svg class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Suivi des présences</h3>
                        <p class="mt-2 text-gray-600">
                            Enregistrement et visualisation simplifiés des heures de travail
                        </p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-[#f40000] mb-4">
                            <svg class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Gestion des tâches</h3>
                        <p class="mt-2 text-gray-600">
                            Attribution et suivi des missions en temps réel
                        </p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-[#f40000] mb-4">
                            <svg class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Rapports détaillés</h3>
                        <p class="mt-2 text-gray-600">
                            Analyse des performances et export des données
                        </p>
                    </div>
                </div> -->
            </div>
        </div>
    </main>

    <!-- Pied de page -->
    <footer class="bg-[#000000] text-white py-6">
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