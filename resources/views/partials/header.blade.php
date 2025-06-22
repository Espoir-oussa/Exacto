<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
  <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <ul class="navbar-nav ml-auto">
    <!-- Recherches -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown">
        <i class="fas fa-search fa-fw"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in">
        <form class="navbar-search">
          <div class="input-group">
            <input type="text" class="form-control bg-light border-1 small" placeholder="Que recherchez-vous ?"
              aria-label="Recherche">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    <!-- Notifications admin (pointages & tâches) -->
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-toggle="dropdown">
        <i class="fas fa-bell fa-fw"></i>
        <span class="badge badge-danger badge-counter">3</span> {{-- exemple dynamique possible --}}
      </a>
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
        <h6 class="dropdown-header">Notifications</h6>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="mr-3">
            <div class="icon-circle bg-primary">
              <i class="fas fa-user-check text-white"></i>
            </div>
          </div>
          <div>
            <span class="font-weight-bold">Nouveau pointage enregistré</span>
            <div class="small text-gray-500">Aujourd'hui à 10:24</div>
          </div>
        </a>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="mr-3">
            <div class="icon-circle bg-success">
              <i class="fas fa-tasks text-white"></i>
            </div>
          </div>
          <div>
            <span class="font-weight-bold">Nouvelle tâche soumise</span>
            <div class="small text-gray-500">Aujourd'hui à 09:15</div>
          </div>
        </a>
        <a class="dropdown-item text-center small text-gray-500" href="#">Voir toutes les notifications</a>
      </div>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Utilisateur -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
        <img class="img-profile rounded-circle" src="{{ asset('img/boy.png') }}" style="max-width: 60px">
        <span class="ml-2 d-none d-lg-inline text-white small">
          {{ Auth::check() ? Auth::user()->name : 'Utilisateur' }}
        </span>
      </a>
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
        <a class="dropdown-item" href="#">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Mon profil
        </a>
        <a class="dropdown-item" href="#">
          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
          Paramètres
        </a>
        <div class="dropdown-divider"></div>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="dropdown-item">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Se déconnecter
          </button>
        </form>
      </div>
    </li>
  </ul>
</nav>
