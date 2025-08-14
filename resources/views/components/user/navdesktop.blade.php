@php
  use Illuminate\Support\Facades\DB;

  // Ambil semua periode unik dari organizational_structures
  $periodeGabungan = DB::table('organizational_structures')
    ->select('start_year', 'end_year')
    ->get()
    ->map(function ($item) {
      $item->periode = $item->start_year . '-' . $item->end_year;
      return $item;
    })
    ->unique('periode')
    ->sortByDesc('start_year')
    ->values();

  // Ambil juga data SK jika diperlukan
  $skPeriodes = DB::table('sk_items')
    ->selectRaw('start_year, end_year')
    ->orderByDesc('start_year')
    ->get();

  $isDashboard = request()->routeIs('Index.Dashboard');

  $navLinks = [
    'Profil' => [
      'Visi' => route('Index.Profile', ['section' => 'visi']),
      'Misi' => route('Index.Profile', ['section' => 'misi']),
      'Tujuan' => route('Index.Profile', ['section' => 'tujuan']),
      'Sejarah' => route('Index.Profile', ['section' => 'sejarah']),
    ],
    'Tupoksi & Program Kerja' => [
      'SK' => route('Index.Tupoksi.SK'),
      'Struktur Organisasi' => route('Index.Tupoksi.StrukturOrganisasi'),
      'AD & ART' => route('Index.Tupoksi.AdArt'),
      'Program Kerja' => route('Index.ProgramKerja'),
    ],
    'Surat' => [
      'Surat Masuk' => route('Index.Surat', ['tipe' => 'masuk']),
      'Surat Keluar' => route('Index.Surat', ['tipe' => 'keluar']),
    ],
    'Informasi' => [
      'Tentang' => request()->routeIs('Index.Dashboard') ? '#tentang' : route('Index.Dashboard', ['#tentang']),
      'Kontak' => request()->routeIs('Index.Dashboard') ? '#kontak' : route('Index.Dashboard', ['#kontak']),
    ]
  ];
@endphp



<header id="mainHeader" class="hidden md:flex sticky top-0 z-50 transition-all duration-300
  {{ $isDashboard ? 'bg-transparent backdrop-blur-sm text-white' : 'bg-white shadow-md text-green-900' }}">
  
  <div class="max-w-7xl mx-auto w-full flex items-center justify-between px-6 lg:px-10 py-4">
    
    <!-- Logo -->
    <a href="{{ route('Index.Dashboard') }}">
      <div class="flex items-center gap-4">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo NU"
          class="h-10 w-10 bg-white p-1 border border-green-700 rounded-full" />
        <span class="text-lg font-bold tracking-wide leading-snug">MWC NU Kec. Ciseeng</span>
      </div>
    </a>

    <!-- Desktop Navigation -->
    <nav class="hidden md:flex gap-8 text-sm font-semibold items-center relative z-50">
      @foreach ($navLinks as $menu => $items)
        <div class="relative group dropdown-wrapper">
          <button type="button"
            class="dropdown-btn px-2 py-1 flex items-center gap-1 hover:text-yellow-400 transition">
            {{ $menu }} <i class="fas fa-chevron-down text-xs mt-[1px] transition-transform duration-300"></i>
          </button>
          <div
            class="dropdown-menu hidden absolute bg-white text-green-900 rounded-lg shadow-md ring-1 ring-green-200 py-2 w-56 mt-3 animate-fade-in-down z-40">
            @foreach ($items as $label => $url)
              <a href="{{ $url }}" class="flex justify-between items-center px-4 py-2 hover:bg-yellow-100 transition">
                {{ $label }}
              </a>
            @endforeach
          </div>
        </div>
      @endforeach

      <!-- Artikel & Berita -->
      <a href="{{ request()->routeIs('Index.Dashboard') ? '#artikel-dan-berita' : route('Index.Post') }}"
        class="hover:text-yellow-300 transition">
        Artikel & Berita
      </a>
    </nav>
  </div>
</header>

<!-- Style -->
<style>
  @keyframes fade-in-down {
    from {
      opacity: 0;
      transform: translateY(-0.5rem);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  .animate-fade-in-down {
    animation: fade-in-down 0.3s ease-out forwards;
  }
  .dropdown-wrapper:hover .dropdown-btn i {
    transform: rotate(-180deg);
  }
  #mainHeader {
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  /* Submenu styling */
  .submenu-container {
    position: relative;
  }
  .submenu {
    display: none;
    position: absolute;
    top: 0;
    left: 100%;
    min-width: 180px;
    background: white;
    color: #064e3b;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 50;
  }
  .submenu a {
    display: block;
    padding: 0.5rem 1rem;
    font-size: 14px;
  }
  .submenu a:hover {
    background: #fef3c7;
  }
  .submenu-container:hover .submenu {
    display: block;
  }
</style>

<!-- Script -->
<script>
  const header = document.getElementById('mainHeader');
  const isDashboard = {{ $isDashboard ? 'true' : 'false' }};

  // Scroll background logic
  window.addEventListener('scroll', () => {
    if (!isDashboard) return;
    if (window.scrollY === 0) {
      header.classList.remove('bg-white', 'shadow-md', 'text-green-900');
      header.classList.add('bg-transparent', 'backdrop-blur-sm', 'text-white');
    } else {
      header.classList.remove('bg-transparent', 'backdrop-blur-sm', 'text-white');
      header.classList.add('bg-white', 'shadow-md', 'text-green-900');
    }
  });

  // Dropdown hover + click support
  document.querySelectorAll('.dropdown-wrapper').forEach(wrapper => {
    const btn = wrapper.querySelector('.dropdown-btn');
    const menu = wrapper.querySelector('.dropdown-menu');
    let hideTimer;

    wrapper.addEventListener('mouseenter', () => {
      clearTimeout(hideTimer);
      closeAllDropdownsExcept(menu);
      menu.classList.remove('hidden');
    });

    wrapper.addEventListener('mouseleave', () => {
      hideTimer = setTimeout(() => menu.classList.add('hidden'), 300);
    });

    btn.addEventListener('click', e => {
      e.preventDefault();
      e.stopPropagation();
      const isHidden = menu.classList.contains('hidden');
      closeAllDropdownsExcept(menu);
      if (isHidden) menu.classList.remove('hidden');
      else menu.classList.add('hidden');
    });
  });

  document.addEventListener('click', () => {
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
      menu.classList.add('hidden');
    });
  });

  function closeAllDropdownsExcept(currentMenu) {
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
      if (menu !== currentMenu) menu.classList.add('hidden');
    });
  }

  // === Tambahan Submenu untuk SK dan Struktur Organisasi dengan ICON "›" ===
  document.addEventListener('DOMContentLoaded', () => {
    // SK
    const skMenu = [...document.querySelectorAll('.dropdown-menu a')]
      .find(a => a.textContent.trim() === 'SK');
    if (skMenu) {
      const wrapper = document.createElement('div');
      wrapper.classList.add('submenu-container');
      skMenu.parentNode.insertBefore(wrapper, skMenu);
      skMenu.classList.add('flex', 'justify-between', 'items-center');
      skMenu.innerHTML = `SK <i class="fas fa-chevron-right text-xs"></i>`;
      wrapper.appendChild(skMenu);

      const subMenu = document.createElement('div');
      subMenu.classList.add('submenu');
      subMenu.innerHTML = `
        @foreach ($skPeriodes as $periode)
          <a href="{{ route('Index.Tupoksi.SK', ['periode' => \Carbon\Carbon::parse($periode->start_year)->year . '-' . \Carbon\Carbon::parse($periode->end_year)->year]) }}">
            {{ \Carbon\Carbon::parse($periode->start_year)->year }} - {{ \Carbon\Carbon::parse($periode->end_year)->year }}
          </a>
        @endforeach
      `;
      wrapper.appendChild(subMenu);
    }

    // Struktur Organisasi
    const strukturMenu = [...document.querySelectorAll('.dropdown-menu a')]
      .find(a => a.textContent.trim() === 'Struktur Organisasi');
    if (strukturMenu) {
      const wrapper2 = document.createElement('div');
      wrapper2.classList.add('submenu-container');
      strukturMenu.parentNode.insertBefore(wrapper2, strukturMenu);
      strukturMenu.classList.add('flex', 'justify-between', 'items-center');
      strukturMenu.innerHTML = `Struktur Organisasi <i class="fas fa-chevron-right text-xs"></i>`;
      wrapper2.appendChild(strukturMenu);

      const subMenu2 = document.createElement('div');
      subMenu2.classList.add('submenu');
      subMenu2.innerHTML = `{!! $periodeGabungan->map(function($item) {
          return '<a href="' . route('Index.Tupoksi.StrukturOrganisasi', ['periode' => $item->start_year . '-' . $item->end_year]) . '">' .
              $item->start_year . ' - ' . $item->end_year .
              '</a>';
      })->implode('') !!}`;
      wrapper2.appendChild(subMenu2);
    }
  });
</script>
