<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Logo -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->role === 'admin';
        $isEmploye = $user && $user->role === 'employe';
    @endphp

    <li
        class="nav-item {{ request()->routeIs('admin.dashboard') || request()->routeIs('employe.dashboard') ? 'active' : '' }}">
        <a class="nav-link"
            href="{{ $isAdmin ? route('admin.dashboard') : ($isEmploye ? route('employe.dashboard') : '#') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">


    {{-- Section ADMIN --}}
    @if (auth()->user()->role === 'admin')
        <div class="sidebar-heading">Administrateur</div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdminComptes"
                aria-expanded="false" aria-controls="collapseAdminComptes">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Comptes</span>
            </a>
            <div id="collapseAdminComptes" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Créer Comptes</h6>
                    <a class="collapse-item" href="#">Importer listes</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdminHistorique"
                aria-expanded="false" aria-controls="collapseAdminHistorique">
                <i class="fas fa-fw fa-table"></i>
                <span>Historiques</span>
            </a>
            <div id="collapseAdminHistorique" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pointages & Tâches</h6>
                    <a class="collapse-item" href="#">Pointages</a>
                    <a class="collapse-item" href="#">Tâches</a>
                </div>
            </div>
        </li>
    @endif

    {{-- Section EMPLOYE --}}
    @if (auth()->user()->role === 'employe')
        <div class="sidebar-heading">Employés</div>

        <li class="nav-item {{ request()->routeIs('pointages.index') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ route('pointages.index') }}" data-toggle="collapse"
                data-target="#collapseEmployePointages" aria-expanded="false" aria-controls="collapseEmployePointages">
                <i class="far fa-fw fa-clock"></i>
                <span>Pointages</span>
            </a>
            <div id="collapseEmployePointages" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="#">Arrivée</a>
                    <a class="collapse-item" href="#">Départ</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ request()->routeIs('taches.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('taches.index') }}">
                <i class="fas fa-fw fa-tasks"></i>
                <span>Tâches</span>
            </a>
        </li>

        <li class="nav-item ">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployeHistorique"
                aria-expanded="false" aria-controls="collapseEmployeHistorique">
                <i class="fas fa-fw fa-history"></i>
                <span>Historiques</span>
            </a>
            <div id="collapseEmployeHistorique" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Pointages & Tâches</h6>
                    <a class="collapse-item" href="#">Pointages</a>
                    <a class="collapse-item {{ request()->routeIs('tasks.lists') ? 'active' : '' }}" href="{{route("tasks.lists")}}">Tâches</a>
                </div>
            </div>
        </li>
    @endif

</ul>
