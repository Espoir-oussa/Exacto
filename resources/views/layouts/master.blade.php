<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'IMUXT')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">


    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
    <div class="flex-1 flex flex-col min-h-0"
        :style="!isMobile ? {
            marginLeft: appState.sidebarOpen ? '16rem' : '5rem',
            transition: 'margin-left 0.1s'
        } : {}">

        <!-- Header -->
        @include('partials.header')

        <!-- Contenu -->
        <main class="flex-1 overflow-y-auto bg-gray-50">
            <div class="max-w-7xl mx-auto ">

                <!-- HEADER STICKY -->
                <div class="sticky top-0 z-30 bg-gray-50 pt-4 pb-4 shadow-sm px-8">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center px-4">
                        <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-2 md:mb-0">
                            @yield('page-title', 'Dashboard')
                        </h1>
                        <nav class="flex text-sm">
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}"
                                    class="text-dark hover:text-dark hover:font-black">Home</a>
                            @else
                                <a href="{{ route('employe.dashboard') }}"
                                    class="text-dark hover:text-dark hover:font-black">Home</a>
                            @endif
                            <span class="mx-2 text-gray-500">/</span>
                            <span class="text-gray-600">Dashboard</span>
                        </nav>
                    </div>
                </div>

                <!-- CONTENU DÉCALÉ EN DESSOUS DU HEADER FIXE -->
                <div class="px-8 pt-6">
                    @yield('content')
                </div>

            </div>
        </main>



        <!-- Footer -->
        {{-- <footer class="bg-[#164f63] text-white py-4 h-22 flex-shrink-0">
            <div class="max-w-7xl mx-auto px-4">
                <p class="text-center py-2">&copy; <span id="current-year"></span> IMUXT. Tous droits réservés.</p>
            </div>
        </footer> --}}
    </div>

    <script>
        // Mettre à jour l'année dans le footer
        document.getElementById('current-year').textContent = new Date().getFullYear();
    </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
     @stack('scripts')
</body>

</html>
