<!-- Sidebar Mobile -->
<aside id="sidebarMobile" class="fixed top-0 left-0 z-50 w-64 h-screen transition-transform -translate-x-full bg-white shadow-2xl md:hidden flex flex-col justify-between" tabindex="-1" aria-labelledby="drawer-label">
  <div class="flex flex-col h-full">
    <!-- Header -->
    <div class="px-6 py-6 border-b border-slate-100 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500 to-green-600 shadow-lg shadow-green-500/30 flex items-center justify-center text-white font-bold text-lg">
          NU
        </div>
        <div>
          <h2 class="text-lg font-bold text-slate-800 leading-tight">MWC NU</h2>
          <p class="text-xs text-slate-500 font-medium">CMS Admin</p>
        </div>
      </div>
      <button type="button" data-drawer-hide="sidebarMobile" aria-controls="sidebarMobile" class="text-slate-400 hover:text-red-500 transition-colors p-2 rounded-lg hover:bg-slate-100">
        <i class="fas fa-times text-xl"></i>
      </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 mt-4 px-4 py-2 space-y-1.5 text-sm font-medium overflow-y-auto custom-scrollbar">

      <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-2">Menu Utama</p>

      <!-- Dashboard -->
      <a href="{{ route('Index.Dashboard.SA') }}"
         class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 relative group overflow-hidden
         {{ request()->routeIs('Index.Dashboard.SA') ? 'bg-green-50 text-green-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-green-600' }}">
         @if(request()->routeIs('Index.Dashboard.SA'))
           <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-green-600 rounded-r-md"></div>
         @endif
        <div class="flex items-center justify-center w-8">
          <i class="fas fa-home text-lg {{ request()->routeIs('Index.Dashboard.SA') ? 'text-green-600' : 'text-slate-400 group-hover:text-green-500' }}"></i>
        </div>
        Dashboard
      </a>

      <!-- Manajemen Akun -->
      <a href="{{ route('Index.ManajemenAkun.SA') }}"
         class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 relative group overflow-hidden
         {{ request()->routeIs('Index.ManajemenAkun.SA') ? 'bg-green-50 text-green-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-green-600' }}">
         @if(request()->routeIs('Index.ManajemenAkun.SA'))
           <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-green-600 rounded-r-md"></div>
         @endif
        <div class="flex items-center justify-center w-8">
          <i class="fas fa-users-cog text-lg {{ request()->routeIs('Index.ManajemenAkun.SA') ? 'text-green-600' : 'text-slate-400 group-hover:text-green-500' }}"></i>
        </div>
        Manajemen Akun
      </a>

      <!-- Manajemen Post -->
      <a href="{{ route('Index.ManajemenPost.SA') }}"
         class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 relative group overflow-hidden
         {{ request()->routeIs('Index.ManajemenPost.SA') ? 'bg-green-50 text-green-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-green-600' }}">
         @if(request()->routeIs('Index.ManajemenPost.SA'))
           <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-green-600 rounded-r-md"></div>
         @endif
        <div class="flex items-center justify-center w-8">
          <i class="fas fa-newspaper text-lg {{ request()->routeIs('Index.ManajemenPost.SA') ? 'text-green-600' : 'text-slate-400 group-hover:text-green-500' }}"></i>
        </div>
        Manajemen Post
      </a>

      <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-6">Administrasi</p>

      <!-- Manajemen Tupoksi (With Dropdown) -->
      <div class="tupoksi-mobile-wrapper">
        <button type="button"
          class="tupoksi-mobile-toggle w-full flex items-center justify-between px-3 py-2.5 rounded-xl transition-all duration-200 relative group overflow-hidden focus:outline-none
          {{ request()->routeIs('Index.SK.SA') || request()->routeIs('Index.StrukturOrganisasi.SA') || request()->routeIs('Index.AdArt.SA') || request()->routeIs('Index.ProgramKerja.SA') ? 'bg-green-50 text-green-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-green-600' }}">
          @if(request()->routeIs('Index.SK.SA') || request()->routeIs('Index.StrukturOrganisasi.SA') || request()->routeIs('Index.AdArt.SA') || request()->routeIs('Index.ProgramKerja.SA'))
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-green-600 rounded-r-md"></div>
          @endif
          <span class="flex items-center gap-3">
            <div class="flex items-center justify-center w-8">
              <i class="fas fa-briefcase text-lg {{ request()->routeIs('Index.SK.SA') || request()->routeIs('Index.StrukturOrganisasi.SA') || request()->routeIs('Index.AdArt.SA') || request()->routeIs('Index.ProgramKerja.SA') ? 'text-green-600' : 'text-slate-400 group-hover:text-green-500' }}"></i>
            </div>
            Tupoksi
          </span>
          <i class="fas fa-chevron-down text-xs transition-transform duration-300 {{ request()->routeIs('Index.SK.SA') || request()->routeIs('Index.StrukturOrganisasi.SA') || request()->routeIs('Index.AdArt.SA') || request()->routeIs('Index.ProgramKerja.SA') ? 'rotate-180' : '' }}"></i>
        </button>

        <div class="tupoksi-mobile-submenu ml-11 mt-1 space-y-1 overflow-hidden transition-all duration-300 {{ request()->routeIs('Index.SK.SA') || request()->routeIs('Index.StrukturOrganisasi.SA') || request()->routeIs('Index.AdArt.SA') || request()->routeIs('Index.ProgramKerja.SA') ? 'max-h-40 opacity-100' : 'max-h-0 opacity-0' }}">
          <a href="{{ route('Index.SK.SA') }}"
             class="flex items-center py-2 text-sm transition-colors
             {{ request()->routeIs('Index.SK.SA') ? 'text-green-700 font-semibold' : 'text-slate-500 hover:text-green-600' }}">
            <div class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('Index.SK.SA') ? 'bg-green-600' : 'bg-slate-300' }}"></div> SK
          </a>
          <a href="{{ route('Index.StrukturOrganisasi.SA') }}"
             class="flex items-center py-2 text-sm transition-colors
             {{ request()->routeIs('Index.StrukturOrganisasi.SA') ? 'text-green-700 font-semibold' : 'text-slate-500 hover:text-green-600' }}">
            <div class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('Index.StrukturOrganisasi.SA') ? 'bg-green-600' : 'bg-slate-300' }}"></div> Struktur Organisasi
          </a>
          <a href="{{ route('Index.AdArt.SA') }}"
             class="flex items-center py-2 text-sm transition-colors
             {{ request()->routeIs('Index.AdArt.SA') ? 'text-green-700 font-semibold' : 'text-slate-500 hover:text-green-600' }}">
            <div class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('Index.AdArt.SA') ? 'bg-green-600' : 'bg-slate-300' }}"></div> AD & ART
          </a>
        </div>
      </div>

      <!-- Manajemen Surat -->
      <a href="{{ route('Index.ManajemenSurat.SA') }}"
         class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 relative group overflow-hidden
         {{ request()->routeIs('Index.ManajemenSurat.SA') ? 'bg-green-50 text-green-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-green-600' }}">
         @if(request()->routeIs('Index.ManajemenSurat.SA'))
           <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-green-600 rounded-r-md"></div>
         @endif
        <div class="flex items-center justify-center w-8">
          <i class="fas fa-envelope-open-text text-lg {{ request()->routeIs('Index.ManajemenSurat.SA') ? 'text-green-600' : 'text-slate-400 group-hover:text-green-500' }}"></i>
        </div>
        Manajemen Surat
      </a>

      <!-- Pengaturan -->
      <a href="{{ route('Index.Profile.SA') }}"
         class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 relative group overflow-hidden
         {{ request()->routeIs('Index.Profile.SA') ? 'bg-green-50 text-green-700 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-green-600' }}">
         @if(request()->routeIs('Index.Profile.SA'))
           <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-green-600 rounded-r-md"></div>
         @endif
        <div class="flex items-center justify-center w-8">
          <i class="fas fa-cog text-lg {{ request()->routeIs('Index.Profile.SA') ? 'text-green-600' : 'text-slate-400 group-hover:text-green-500' }}"></i>
        </div>
        Pengaturan
      </a>
    </nav>
  </div>

  <!-- Logout -->
  <div class="p-4 border-t border-slate-100 bg-slate-50/50">
    <form method="POST" action="{{ route('logout.SA') }}">
      @csrf
      <button type="submit"
        class="w-full flex items-center justify-center gap-2 bg-white border border-slate-200 shadow-sm hover:border-red-300 hover:bg-red-50 hover:text-red-600 text-slate-600 px-4 py-2.5 rounded-xl transition-all duration-200 group">
        <i class="fas fa-sign-out-alt"></i> <span class="font-medium">Keluar</span>
      </button>
    </form>
  </div>
</aside>

<!-- Dropdown Toggle Script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.querySelector('.tupoksi-mobile-toggle');
    const submenu = document.querySelector('.tupoksi-mobile-submenu');
    const icon = toggleBtn.querySelector('i.fas.fa-chevron-down');

    toggleBtn.addEventListener('click', function () {
      if (submenu.classList.contains('max-h-0')) {
        submenu.classList.remove('max-h-0', 'opacity-0');
        submenu.classList.add('max-h-40', 'opacity-100');
        icon.classList.add('rotate-180');
      } else {
        submenu.classList.remove('max-h-40', 'opacity-100');
        submenu.classList.add('max-h-0', 'opacity-0');
        icon.classList.remove('rotate-180');
      }
    });
  });
</script>
