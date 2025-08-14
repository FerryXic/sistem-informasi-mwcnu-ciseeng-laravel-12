<!-- Sidebar Desktop -->
<aside class="w-64 bg-white shadow-md border-r border-green-100 hidden md:flex flex-col">
  <!-- Header -->
  <div class="px-6 py-6 border-b border-green-100">
    <h2 class="text-xl font-bold text-green-800">MWC NU</h2>
    <p class="text-sm text-gray-500">Superadmin</p>
  </div>

  <!-- Navigation -->
  <nav class="flex-1 mt-4 px-4 py-2 space-y-1 text-sm text-green-900 font-medium">
    
    <!-- Dashboard -->
    <a href="{{ route('Index.Dashboard.SA') }}"
       class="flex items-center gap-3 px-4 py-2 rounded-lg transition hover:bg-green-50 hover:text-green-700
       {{ request()->routeIs('Index.Dashboard.SA') ? 'bg-green-100 text-green-800 font-semibold' : '' }}">
      <i class="fas fa-home text-green-600 w-5"></i> Dashboard
    </a>

    <!-- Manajemen Akun -->
    <a href="{{ route('Index.ManajemenAkun.SA') }}"
       class="flex items-center gap-3 px-4 py-2 rounded-lg transition hover:bg-green-50 hover:text-green-700
       {{ request()->routeIs('Index.ManajemenAkun.SA') ? 'bg-green-100 text-green-800 font-semibold' : '' }}">
      <i class="fas fa-user-cog text-green-500 w-5"></i> Manajemen Akun
    </a>

    <!-- Manajemen Post -->
    <a href="{{ route('Index.ManajemenPost.SA') }}"
       class="flex items-center gap-3 px-4 py-2 rounded-lg transition hover:bg-green-50 hover:text-green-700
       {{ request()->routeIs('Index.ManajemenPost.SA') ? 'bg-green-100 text-green-800 font-semibold' : '' }}">
      <i class="fas fa-thumbtack text-green-500 w-5"></i> Manajemen Post
    </a>

    <!-- Manajemen Tupoksi (With Dropdown) -->
    <div class="tupoksi-wrapper">
      <button type="button"
        class="tupoksi-toggle w-full flex items-center justify-between px-4 py-2 rounded-lg transition hover:bg-green-50 hover:text-green-700 focus:outline-none
        {{ request()->routeIs('Index.SK.SA') || request()->routeIs('Index.StrukturOrganisasi.SA') || request()->routeIs('Index.AdArt.SA') || request()->routeIs('Index.ProgramKerja.SA') ? 'bg-green-100 text-green-800 font-semibold' : '' }}">
        <span class="flex items-center gap-3">
          <i class="fas fa-briefcase text-green-500 w-5"></i> Manajemen Tupoksi
        </span>
        <i class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
      </button>

      <div class="tupoksi-submenu hidden ml-6 mt-2 space-y-1 text-sm text-green-700">
        <a href="{{ route('Index.SK.SA') }}"
           class="block px-3 py-1 rounded hover:bg-green-50 transition
           {{ request()->routeIs('Index.SK.SA') ? 'text-green-800 font-semibold' : '' }}">
          <i class="fas fa-file-signature mr-2"></i> SK
        </a>
        <a href="{{ route('Index.StrukturOrganisasi.SA') }}"
           class="block px-3 py-1 rounded hover:bg-green-50 transition
           {{ request()->routeIs('Index.StrukturOrganisasi.SA') ? 'text-green-800 font-semibold' : '' }}">
          <i class="fas fa-sitemap mr-2"></i> Struktur Organisasi
        </a>
        <a href="{{ route('Index.AdArt.SA') }}"
           class="block px-3 py-1 rounded hover:bg-green-50 transition
           {{ request()->routeIs('Index.AdArt.SA') ? 'text-green-800 font-semibold' : '' }}">
          <i class="fas fa-file-alt mr-2"></i> AD & ART
        </a>
      </div>
    </div>

    <!-- Manajemen Surat -->
    <a href="{{ route('Index.ManajemenSurat.SA') }}"
       class="flex items-center gap-3 px-4 py-2 rounded-lg transition hover:bg-green-50 hover:text-green-700
       {{ request()->routeIs('Index.ManajemenSurat.SA') ? 'bg-green-100 text-green-800 font-semibold' : '' }}">
      <i class="fas fa-envelope-open-text text-green-500 w-5"></i> Manajemen Surat
    </a>

    <!-- Pengaturan -->
    <a href="{{ route('Index.Profile.SA') }}"
       class="flex items-center gap-3 px-4 py-2 rounded-lg transition hover:bg-green-50 hover:text-green-700
       {{ request()->routeIs('Index.Profile.SA') ? 'bg-green-100 text-green-800 font-semibold' : '' }}">
      <i class="fas fa-tools text-green-500 w-5"></i> Pengaturan
    </a>
  </nav>

  <!-- Logout -->
  <form method="POST" action="{{ route('logout.SA') }}" class="px-6 py-4 border-t border-green-100">
    @csrf
    <button type="submit"
      class="w-full flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
      <i class="fas fa-sign-out-alt"></i> Logout
    </button>
  </form>
</aside>

<!-- Dropdown Toggle Script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.querySelector('.tupoksi-toggle');
    const submenu = document.querySelector('.tupoksi-submenu');
    const icon = toggleBtn.querySelector('i.fas.fa-chevron-down');

    toggleBtn.addEventListener('click', function () {
      submenu.classList.toggle('hidden');
      icon.classList.toggle('rotate-180');
    });

    @if(request()->routeIs('Index.SK.SA') || request()->routeIs('Index.StrukturOrganisasi.A') || request()->routeIs('Index.AdArt.A') || request()->routeIs('Index.ProgramKerja.A'))
      submenu.classList.remove('hidden');
      icon.classList.add('rotate-180');
    @endif
  });
</script>

<!-- Dropdown Animation -->
<style>
  .rotate-180 {
    transform: rotate(180deg);
  }
</style>
