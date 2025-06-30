<nav id="sidebar" class="fixed top-0 left-0 z-50 h-screen bg-gray-800 text-white transition-all duration-300 transform"
    :class="{
        'w-64': appState.sidebarOpen && !isMobile,
        'w-20': !appState.sidebarOpen && !isMobile,
        'translate-x-0 w-64': appState.sidebarOpen && isMobile,
        '-translate-x-full': !appState.sidebarOpen && isMobile
    }" x-data="{}" x-init="document.addEventListener('sidebar-toggled', (e) => {
        appState.sidebarOpen = e.detail;
    })">
    <!-- Logo -->
    <div class="p-4 flex items-center justify-center bg-dark">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center">
            <div :class="{
                'w-20 h-10': appState.sidebarOpen,
                'w-10 h-10': !appState.sidebarOpen
            }" class="transition-all duration-300">
                <img src="{{ asset('images/Logo IMUXT (Blanc).png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
        </a>
    </div>

    <!-- Dashboard -->
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->role === 'admin';
        $isEmploye = $user && $user->role === 'employe';
    @endphp

    <div class="p-3 space-y-1 flex-1 overflow-y-auto pt-7">
        <a href="{{ $isAdmin ? route('admin.dashboard') : ($isEmploye ? route('employe.dashboard') : '#') }}"
            class="flex items-center p-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') || request()->routeIs('employe.dashboard') ? 'bg-gray-700' : '' }}">
            <i class="fas fa-fw fa-tachometer-alt w-5 mr-3 text-center"></i>
            <span class="sidebar-label" x-show="appState.sidebarOpen">Tableau de Bord</span>
        </a>
    </div>

    <hr class="border-gray-700 mx-3">

    <!-- Section ADMIN -->
    @if (auth()->user()->role === 'admin')
        <div class="px-4 py-2 text-xs uppercase tracking-wider text-gray-400 sidebar-label" x-show="appState.sidebarOpen">
            Admin
        </div>

        <div class="p-3 space-y-1">
            <a href="{{ route('admin.register') }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700">
                <i class="far fa-fw fa-window-maximize w-5 mr-3 text-center"></i>
                <span class="sidebar-label" x-show="appState.sidebarOpen">Créer Comptes</span>
            </a>
            <a href="{{ route('consulterhistorique') }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700">
                <i class="far fa-fw fa-window-maximize w-5 mr-3 text-center"></i>
                <span class="sidebar-label" x-show="appState.sidebarOpen">Liste des Employés</span>
            </a>
        </div>

        <div x-data="{ open: false }" class="rounded-lg hover:bg-gray-700 p-3 mx-3">
            <button @click="open = !open" class="flex items-center justify-between w-full">
                <div class="flex items-center">
                    <i class="fas fa-fw fa-history w-5 mr-3 text-center"></i>
                    <span class="sidebar-label" x-show="appState.sidebarOpen">Historiques</span>
                </div>
                <i x-show="appState.sidebarOpen" class="fas fa-chevron-down text-xs transform transition-transform"
                    :class="open ? 'rotate-180' : ''"></i>
            </button>
            <div x-show="open && appState.sidebarOpen" class="pl-5 py-1 space-y-1">
                <div class="text-xs text-gray-400 px-2 py-1 sidebar-label">Pointages & Tâches</div>
                <a href="{{ route('consulterhistorique') }}" class="block p-2 text-sm rounded hover:bg-gray-600">Pointages</a>
                <a href="{{ route('consulterhistorique') }}"
                    class="block p-2 text-sm rounded hover:bg-gray-600 {{ request()->routeIs('tasks.lists') ? 'bg-gray-600' : '' }}">Tâches</a>
            </div>
        </div>
    @endif

    <!-- Section EMPLOYE -->
    @if (auth()->user()->role === 'employe')
        <div class="px-4 py-2 text-xs uppercase tracking-wider text-gray-400 sidebar-label" x-show="appState.sidebarOpen">
            Employés
        </div>

        <div class="p-3 space-y-1">
            <div x-data="{ open: false }" class="rounded-lg hover:bg-gray-700">
                <button @click="open = !open" class="flex items-center justify-between w-full p-2">
                    <div class="flex items-center">
                        <i class="far fa-fw fa-clock w-5 mr-3 text-center"></i>
                        <span class="sidebar-label" x-show="appState.sidebarOpen">Pointages</span>
                    </div>
                    <i x-show="appState.sidebarOpen" class="fas fa-chevron-down text-xs transform transition-transform"
                        :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open && appState.sidebarOpen" class="pl-8 py-1 space-y-1">
                    <a href="#" class="block p-2 text-sm rounded hover:bg-gray-600">Arrivée</a>
                    <a href="#" class="block p-2 text-sm rounded hover:bg-gray-600">Départ</a>
                </div>
            </div>

            <a href="{{ route('taches.index') }}"
                class="flex items-center p-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('taches.index') ? 'bg-gray-700' : '' }}">
                <i class="fas fa-fw fa-tasks w-5 mr-3 text-center"></i>
                <span class="sidebar-label" x-show="appState.sidebarOpen">Tâches</span>
            </a>

            <div x-data="{ open: false }" class="rounded-lg hover:bg-gray-700">
                <button @click="open = !open" class="flex items-center justify-between w-full p-2">
                    <div class="flex items-center">
                        <i class="fas fa-fw fa-history w-5 mr-3 text-center"></i>
                        <span class="sidebar-label" x-show="appState.sidebarOpen">Historiques</span>
                    </div>
                    <i x-show="appState.sidebarOpen" class="fas fa-chevron-down text-xs transform transition-transform"
                        :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open && appState.sidebarOpen" class="pl-8 py-1 space-y-1">
                    <div class="text-xs text-gray-400 px-2 py-1 sidebar-label">Pointages & Tâches</div>
                    <a href="#" class="block p-2 text-sm rounded hover:bg-gray-600">Pointages</a>
                    <a href="{{ route('tasks.lists') }}"
                        class="block p-2 text-sm rounded hover:bg-gray-600 {{ request()->routeIs('tasks.lists') ? 'bg-gray-600' : '' }}">Tâches</a>
                </div>
            </div>
        </div>
    @endif

    <!-- Bouton de réduction -->
    <div class="p-4 border-t border-gray-700">
        <button @click="appState.toggleSidebar()"
            class="w-full flex items-center justify-center text-gray-400 hover:text-white">
            <i class="fas fa-chevron-left transition-transform" :class="appState.sidebarOpen ? '' : 'rotate-180'"></i>
            <span class="ml-2 sidebar-label" x-show="appState.sidebarOpen">
                <span x-text="isMobile ? 'Fermer' : 'Réduire'"></span>
            </span>
        </button>
    </div>
</nav>
