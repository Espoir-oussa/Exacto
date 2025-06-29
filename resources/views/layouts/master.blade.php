<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Exacto')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // Gestion du mode mobile
        function initMobileMode() {
            return {
                isMobile: window.innerWidth < 768,
                checkScreenSize() {
                    this.isMobile = window.innerWidth < 768;
                    if (this.isMobile) {
                        this.appState.sidebarOpen = false;
                    }
                }
            }
        }
    </script>
</head>

<body x-data="{
    appState: {
        sidebarOpen: localStorage.getItem('sidebarOpen') !== 'false',
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            localStorage.setItem('sidebarOpen', this.sidebarOpen);
            document.dispatchEvent(new CustomEvent('sidebar-toggled', {
                detail: this.sidebarOpen
            }));
        }
    },
    ...initMobileMode()
}" x-init="// Initialisation
$watch('isMobile', () => checkScreenSize());
window.addEventListener('resize', () => checkScreenSize());
checkScreenSize();

// Émettre l'état initial
document.dispatchEvent(new CustomEvent('sidebar-toggled', {
    detail: appState.sidebarOpen
}));">
    <!-- Overlay mobile -->
    <div x-show="appState.sidebarOpen && isMobile" @click="appState.toggleSidebar()"
        class="fixed inset-0 z-40 bg-black bg-opacity-50 md:hidden" style="display: none;">
    </div>

    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Contenu principal -->
    <div class="flex-1 flex flex-col min-h-0" :style="!isMobile ? {
            marginLeft: appState.sidebarOpen ? '16rem' : '5rem',
            transition: 'margin-left 0.3s'
        } : {}">

        <!-- Header -->
        @include('partials.header')

        <!-- Contenu -->
        <main class="flex-1 overflow-y-auto bg-gray-50 p-4 md:p-6">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 md:mb-6">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 md:mb-0">
                        @yield('page-title', 'Dashboard')
                    </h1>
                    <nav class="flex text-sm">
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">Home</a>
                        @else
                            <a href="{{ route('employe.dashboard') }}" class="text-blue-600 hover:text-blue-800">Home</a>
                        @endif
                        <span class="mx-2 text-gray-500">/</span>
                        <span class="text-gray-600">Dashboard</span>
                    </nav>
                </div>

                <div class="p-4 md:p-6">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 h-22 flex-shrink-0">
        <div class="max-w-7xl mx-auto px-4">

            <div class="mb-3 md:mb-0">
                <p class="text-center py-5">&copy; <span id="current-year"></span> IMUXT. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mettre à jour l'année dans le footer
        document.getElementById('current-year').textContent = new Date().getFullYear();
    </script>

</body>

</html>
