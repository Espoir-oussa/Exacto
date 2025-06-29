<header class="sticky top-0 z-50 w-full bg-[#164f63] text-white shadow-md px-4 py-4 flex justify-between items-center">
    <!-- Bouton burger pour mobile -->
    <button @click="appState.toggleSidebar()" class="text-white hover:text-blue-200 transition-colors md:hidden">
        <i class="fas fa-bars text-xl"></i>
    </button>

    <!-- Espace vide sur desktop -->
    <div class="hidden md:block"></div>

    <div class="flex items-center space-x-4 md:space-x-6">
        <!-- Barre de recherche -->
        <div class="relative" x-data="{ searchOpen: false }" @click.outside="searchOpen = false">
            <button @click="searchOpen = !searchOpen" class="hover:text-blue-200 transition-colors">
                <i class="fas fa-search text-lg"></i>
            </button>

            <div x-show="searchOpen" x-transition class="absolute right-0 mt-2 w-64 bg-white text-black rounded-md shadow-lg p-4 z-50">
                <form>
                    <div class="flex">
                        <input type="text" placeholder="Que recherchez-vous ?"
                            class="w-full px-3 py-2 border border-gray-300 rounded-l-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 rounded-r-md transition-colors">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Notifications -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" class="hover:text-blue-200 transition-colors relative">
                <i class="fas fa-bell text-lg"></i>
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-full">3</span>
            </button>
            <div x-show="open" x-transition class="absolute right-0 mt-2 w-80 bg-white text-black rounded-md shadow-lg z-50">
                <div class="p-4">
                    <h6 class="font-semibold mb-3 text-gray-800">Notifications</h6>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <div class="bg-blue-600 text-white p-2 rounded-full">
                                <i class="fas fa-user-check text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Nouveau pointage enregistré</p>
                                <p class="text-xs text-gray-500">Aujourd'hui à 10:24</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="bg-green-600 text-white p-2 rounded-full">
                                <i class="fas fa-tasks text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Nouvelle tâche soumise</p>
                                <p class="text-xs text-gray-500">Aujourd'hui à 09:15</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Utilisateur -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" class="flex items-center space-x-2">
                <img src="{{ asset('img/boy.png') }}" class="w-8 h-8 md:w-10 md:h-10 rounded-full" alt="Profil">
                <span class="hidden lg:inline">{{ Auth::check() ? Auth::user()->name : 'Utilisateur' }}</span>
            </button>
            <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white text-black rounded shadow-lg z-50">
                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                    <i class="fas fa-user mr-2 text-sm"></i>Mon profil
                </a>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                    <i class="fas fa-cogs mr-2 text-sm"></i>Paramètres
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full text-left px-4 py-2 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt mr-2 text-sm"></i>Se déconnecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
