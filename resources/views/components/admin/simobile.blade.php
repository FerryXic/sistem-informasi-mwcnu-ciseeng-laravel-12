<!-- Sidebar Mobile -->
<aside id="sidebarMobile" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white shadow-md md:hidden flex flex-col justify-between" tabindex="-1" aria-labelledby="drawer-label">
  <div>
    <!-- Header -->
    <div class="px-6 py-6 border-b border-green-100 flex justify-between items-center">
      <h2 class="text-xl font-bold text-green-800">MWC NU</h2>
      <button type="button" data-drawer-hide="sidebarMobile" aria-controls="sidebarMobile" class="text-green-800">
        <i class="fas fa-times text-xl"></i>
      </button>
    </div>

    <!-- Navigation -->
    <nav class="mt-4 px-4 py-2 space-y-1 text-sm text-green-900 font-medium">

      <!-- Dashboard -->
      <a href="{{ route('Index.Dashboard.A') }}"
         class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700 transition
         {{ request()->routeIs('Index.Dashboard.A') ? 'bg-green-100 text-green-800 font-semibold' : '' }}">
        <i class="fas fa-home text-green-600 w-5"></i> Dashboard
      </a>

      <!-- Manajemen Post -->
      <a href="{{ route('Index.ManajemenPost.A') }}"
         class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700 transition
         {{ request()->routeIs('Index.ManajemenPost.SA') ? 'bg-green-100 text-green-800 font-semibold' : '' }}">
        <i class="fas fa-thumbtack text-green-500 w-5"></i> Manajemen Post
      </a>

      <!-- Manajemen Tupoksi (Accordion) -->
      <div class="border-t border-green-100 pt-2">
        <button type="button" class="w-full flex items-center justify-between px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700 transition tupoksi-mobile-toggle">
          <span class="flex items-center gap-3">
            <i class="fas fa-briefcase text-green-500 w-5"></i> Manajemen Tupoksi
          </span>
          <i class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
        </button>

        <div class="tupoksi-mobile-submenu hidden ml-6 mt-2 space-y-1 text-sm text-green-700">
          <a href="{{ route('Index.SK.A') }}"
             class="block px-3 py-1 rounded hover:bg-green-50 transition
             {{ request()->routeIs('Index.SK.SA') ? 'text-green-800 font-semibold' : '' }}">
            <i class="fas fa-file-signature mr-2"></i> SK
          </a>
          <a href="{{ route('Index.StrukturOrganisasi.A') }}"
             class="block px-3 py-1 rounded hover:bg-green-50 transition
             {{ request()->routeIs('Index.StrukturOrganisasi.SA') ? 'text-green-800 font-semibold' : '' }}">
            <i class="fas fa-sitemap mr-2"></i> Struktur Organisasi
          </a>
          <a href="{{ route('Index.AdArt.A') }}"
             class="block px-3 py-1 rounded hover:bg-green-50 transition
             {{ request()->routeIs('Index.AdArt.A') ? 'text-green-800 font-semibold' : '' }}">
            <i class="fas fa-file-alt mr-2"></i> AD & ART
          </a>
        </div>
      </div>

      <!-- Manajemen Surat -->
      <a href="{{ route('Index.ManajemenSurat.A') }}"
         class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700 transition
         {{ request()->routeIs('Index.ManajemenSurat.SA') ? 'bg-green-100 text-green-800 font-semibold' : '' }}">
        <i class="fas fa-envelope-open-text text-green-500 w-5"></i> Manajemen Surat
      </a>

      <!-- Pengaturan -->
      <a href="{{ route('Index.Profile.A') }}"
         class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-green-50 hover:text-green-700 transition
         {{ request()->routeIs('Index.Profile.SA') ? 'bg-green-100 text-green-800 font-semibold' : '' }}">
        <i class="fas fa-tools text-green-500 w-5"></i> Pengaturan
      </a>
    </nav>
  </div>

</aside>

<!-- Script for Accordion Dropdown -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.querySelector('.tupoksi-mobile-toggle');
    const submenu = document.querySelector('.tupoksi-mobile-submenu');
    const icon = toggle.querySelector('i.fas.fa-chevron-down');

    toggle.addEventListener('click', () => {
      submenu.classList.toggle('hidden');
      icon.classList.toggle('rotate-180');
    });

    @if(request()->routeIs('Index.SK.SA') || request()->routeIs('Index.StrukturOrganisasi.SA') || request()->routeIs('Index.AdArt.SA'))
      submenu.classList.remove('hidden');
      icon.classList.add('rotate-180');
    @endif
  });
</script>

<style>
  .rotate-180 {
    transform: rotate(180deg);
  }
</style>
