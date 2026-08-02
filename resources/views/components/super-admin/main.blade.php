<x-super-admin.header />

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-green-100 selection:text-green-900">
  <x-super-admin.message />

  <!-- Header (Mobile) -->
  <header class="bg-white/80 backdrop-blur-md shadow-sm px-4 py-4 flex justify-between items-center border-b border-slate-200 md:hidden sticky top-0 z-40">
    <!-- Sidebar Toggle -->
    <button data-drawer-target="sidebarMobile" data-drawer-show="sidebarMobile" aria-controls="sidebarMobile"
      class="text-slate-600 hover:text-green-600 focus:outline-none transition-colors">
      <i class="fas fa-bars text-xl"></i>
    </button>

    <!-- Dropdown Profile Icon -->
    <div class="relative">
      <button onclick="toggleMobileMenu()" class="focus:outline-none text-slate-600 hover:text-green-600 transition-colors">
        <i class="fas fa-user-circle text-2xl drop-shadow-sm"></i>
      </button>

      <!-- Dropdown Menu -->
      <div id="mobileDropdown" class="hidden absolute right-0 mt-3 w-48 bg-white/90 backdrop-blur-lg rounded-xl shadow-xl border border-slate-100 z-50 overflow-hidden transform transition-all origin-top-right">
        <a href="{{ route('Index.Profile.SA') }}" class="block px-4 py-3 text-sm text-slate-700 hover:bg-green-50 hover:text-green-700 transition-colors">
          <i class="fas fa-cog mr-2 w-4"></i> Pengaturan Profile
        </a>
        <div class="border-t border-slate-100"></div>
        <form action="{{ route('logout.SA') }}" method="POST">
          @csrf
          <button type="submit"
            class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
            <i class="fas fa-sign-out-alt mr-2 w-4"></i> Keluar
          </button>
        </form>
      </div>
    </div>
  </header>

  <x-super-admin.simobile></x-super-admin.simobile>

  <!-- Layout -->
  <div class="flex min-h-screen bg-slate-50">
    <x-super-admin.sidesktop></x-super-admin.sidesktop>

    <!-- Main Slot Content -->
    <main class="flex-1 px-4 md:px-8 py-8 w-full max-w-[100vw] md:max-w-[calc(100vw-16rem)] overflow-x-hidden">
      {{ $slot }}
    </main>
  </div>

  <x-super-admin.footer />

  <!-- Script for Dropdown Toggle -->
  <script>
    function toggleMobileMenu() {
      const dropdown = document.getElementById('mobileDropdown');
      dropdown.classList.toggle('hidden');
    }

    // Optional: close dropdown if clicking outside
    document.addEventListener('click', function(event) {
      const dropdown = document.getElementById('mobileDropdown');
      const button = event.target.closest('button[onclick="toggleMobileMenu()"]');
      if (!dropdown.contains(event.target) && !button) {
        dropdown.classList.add('hidden');
      }
    });
  </script>
</body>
