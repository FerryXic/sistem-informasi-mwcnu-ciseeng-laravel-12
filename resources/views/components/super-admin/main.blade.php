<x-super-admin.header />

<body class="bg-gray-100">
  <x-super-admin.message />

  <!-- Header (Mobile) -->
  <header class="bg-white shadow-md px-4 py-4 flex justify-between items-center border-b border-green-200 md:hidden">
    <!-- Sidebar Toggle -->
    <button data-drawer-target="sidebarMobile" data-drawer-show="sidebarMobile" aria-controls="sidebarMobile"
      class="text-green-800 focus:outline-none">
      <i class="fas fa-bars text-xl"></i>
    </button>

    <!-- Dropdown Profile Icon -->
    <div class="relative">
      <button onclick="toggleMobileMenu()" class="focus:outline-none text-green-800">
        <i class="fas fa-user-circle text-2xl"></i>
      </button>

      <!-- Dropdown Menu -->
      <div id="mobileDropdown" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg border border-green-100 z-50">
        <a href="{{ route('Index.Profile.SA') }}" class="block px-4 py-2 text-sm text-green-800 hover:bg-green-50">
          <i class="fas fa-cog mr-2"></i> Profile
        </a>
        <form action="{{ route('logout.SA') }}" method="POST">
          @csrf
          <button type="submit"
            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </button>
        </form>
      </div>
    </div>
  </header>

  <x-super-admin.simobile></x-super-admin.simobile>

  <!-- Layout -->
  <div class="flex min-h-screen">
    <x-super-admin.sidesktop></x-super-admin.sidesktop>

    <!-- Main Slot Content -->
    <main class="flex-1 px-4 md:px-6 py-8">
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
