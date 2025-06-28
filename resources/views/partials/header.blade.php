<header class="w-full bg-[#164f63] text-white shadow-md px-4 py-3 flex justify-between items-center">
  <!-- Bouton burger -->
  <button id="sidebarToggle" class="text-white text-xl focus:outline-none">
    <i class="fas fa-bars"></i>
  </button>

  <div class="flex items-center space-x-4">
    <!-- Recherche -->
    <div class="relative group">
      <button class="focus:outline-none">
        <i class="fas fa-search"></i>
      </button>
      <div class="absolute right-0 mt-2 w-64 bg-white text-black rounded shadow-lg p-4 hidden group-hover:block z-10">
        <form>
          <div class="flex">
            <input type="text" placeholder="Que recherchez-vous ?" class="w-full px-3 py-1 border border-gray-300 rounded-l">
            <button type="submit" class="bg-blue-600 text-white px-3 rounded-r">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Notifications -->
    <div class="relative group">
      <button class="relative focus:outline-none">
        <i class="fas fa-bell"></i>
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-1 rounded-full">3</span>
      </button>
      <div class="absolute right-0 mt-2 w-80 bg-white text-black rounded shadow-lg hidden group-hover:block z-10">
        <div class="p-4">
          <h6 class="font-semibold mb-2">Notifications</h6>
          <div class="flex items-start space-x-2 mb-2">
            <div class="bg-blue-600 text-white p-2 rounded-full">
              <i class="fas fa-user-check"></i>
            </div>
            <div>
              <p class="font-semibold">Nouveau pointage enregistré</p>
              <p class="text-sm text-gray-500">Aujourd'hui à 10:24</p>
            </div>
          </div>
          <div class="flex items-start space-x-2">
            <div class="bg-green-600 text-white p-2 rounded-full">
              <i class="fas fa-tasks"></i>
            </div>
            <div>
              <p class="font-semibold">Nouvelle tâche soumise</p>
              <p class="text-sm text-gray-500">Aujourd'hui à 09:15</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Utilisateur -->
    <div class="relative group">
      <button class="flex items-center space-x-2 focus:outline-none">
        <img src="{{ asset('img/boy.png') }}" class="w-10 h-10 rounded-full" alt="Profil">
        <span class="hidden lg:inline">{{ Auth::check() ? Auth::user()->name : 'Utilisateur' }}</span>
      </button>
      <div class="absolute right-0 mt-2 w-48 bg-white text-black rounded shadow-lg hidden group-hover:block z-10">
        <a href="#" class="block px-4 py-2 hover:bg-gray-100"><i class="fas fa-user mr-2"></i>Mon profil</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100"><i class="fas fa-cogs mr-2"></i>Paramètres</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
            <i class="fas fa-sign-out-alt mr-2"></i>Se déconnecter
          </button>
        </form>
      </div>
    </div>
  </div>
</header>
