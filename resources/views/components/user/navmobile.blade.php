@php
  use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Str;

  $isDashboard = request()->routeIs('Index.Dashboard');

  $skPeriodes = DB::table('sk_items')
      ->select('start_year', 'end_year')
      ->orderByDesc('start_year')
      ->get();

  $strukturPeriodes = DB::table('organizational_structures')
      ->select('start_year', 'end_year')
      ->get()
      ->map(fn($item) => (object)[
          'start_year' => $item->start_year,
          'end_year' => $item->end_year,
          'periode' => $item->start_year . '-' . $item->end_year,
      ])
      ->unique('periode')
      ->sortByDesc('start_year')
      ->values();

  $dropdowns = [
    'Profil' => [
      ['label' => 'Visi', 'url' => route('Index.Profile', ['section' => 'visi'])],
      ['label' => 'Misi', 'url' => route('Index.Profile', ['section' => 'misi'])],
      ['label' => 'Tujuan', 'url' => route('Index.Profile', ['section' => 'tujuan'])],
      ['label' => 'Sejarah', 'url' => route('Index.Profile', ['section' => 'sejarah'])],
    ],
    'Tupoksi & Program Kerja' => [
      ['label' => 'SK', 'sub' =>
        $skPeriodes->map(fn($p) => [
          'label' => \Carbon\Carbon::parse($p->start_year)->year . ' - ' . \Carbon\Carbon::parse($p->end_year)->year,
          'url' => route('Index.Tupoksi.SK', ['periode' => \Carbon\Carbon::parse($p->start_year)->year . '-' . \Carbon\Carbon::parse($p->end_year)->year])
        ])->toArray()
      ],
      ['label' => 'Struktur Organisasi', 'sub' =>
        $strukturPeriodes->map(fn($p) => [
          'label' => $p->periode,
          'url' => route('Index.Tupoksi.StrukturOrganisasi', ['periode' => $p->periode])
        ])->toArray()
      ],
      ['label' => 'AD & ART', 'url' => route('Index.Tupoksi.AdArt')],
      ['label' => 'Program Kerja', 'url' => route('Index.ProgramKerja')],
    ],
    'Surat' => [
      ['label' => 'Surat Masuk', 'url' => route('Index.Surat', ['tipe' => 'masuk'])],
      ['label' => 'Surat Keluar', 'url' => route('Index.Surat', ['tipe' => 'keluar'])],
    ],
    'Informasi' => [
      ['label' => 'Tentang', 'url' => $isDashboard ? '#tentang' : route('Index.Dashboard', ['#tentang'])],
      ['label' => 'Kontak', 'url' => $isDashboard ? '#kontak' : route('Index.Dashboard', ['#kontak'])],
    ],
  ];
@endphp

<header id="mainHeaderMobile"
  class="md:hidden sticky top-0 z-50 transition-all duration-300
  {{ $isDashboard ? 'bg-transparent backdrop-blur-sm text-white' : 'bg-white shadow-md text-green-900' }}">

  <div class="flex justify-between items-center px-4 py-3">
    <a href="{{ route('Index.Dashboard') }}" class="flex items-center gap-3">
      <img src="{{ asset('assets/img/logo.png') }}" alt="Logo NU"
        class="h-10 w-10 bg-white p-1 border border-green-700 rounded-full" />
      <span id="mobileTitle" class="text-lg font-bold {{ $isDashboard ? 'text-white' : 'text-green-800' }}">
        MWC NU Kec. Ciseeng
      </span>
    </a>

    <button id="toggleNav" class="focus:outline-none" aria-label="Toggle navigation">
      <i id="hamburgerIcon" class="fas fa-bars text-2xl transition-colors duration-300 {{ $isDashboard ? 'text-white' : 'text-green-800' }}"></i>
    </button>
  </div>

  <div id="mobileNav" class="max-h-0 overflow-hidden bg-white text-green-800 ring-1 ring-green-300 transition-all duration-500 ease-in-out">
    <div class="px-4 py-5 space-y-2 text-sm font-medium">
      @foreach ($dropdowns as $title => $items)
        @php $slug = Str::slug($title); @endphp
        <div class="mobile-dropdown">
          <button type="button" class="w-full flex justify-between items-center bg-white px-4 py-3 rounded shadow hover:bg-yellow-100 transition font-semibold" data-mobile-toggle="{{ $slug }}">
            {{ $title }} <i class="fas fa-chevron-down ml-2 transition-transform duration-300"></i>
          </button>
          <div id="mobile-menu-{{ $slug }}" class="hidden flex-col space-y-2 mt-2 pl-2">
            @foreach ($items as $item)
              @if (isset($item['sub']))
                <div class="mobile-submenu">
                  <button type="button" class="w-full flex justify-between items-center bg-white px-4 py-2 rounded shadow hover:bg-yellow-100 font-medium text-left" data-sub-toggle="{{ Str::slug($item['label']) }}">
                    {{ $item['label'] }} <i class="fas fa-chevron-down ml-2 text-xs"></i>
                  </button>
                  <div id="sub-menu-{{ Str::slug($item['label']) }}" class="hidden flex-col space-y-1 mt-1 pl-3">
                    @foreach ($item['sub'] as $sub)
                      <a href="{{ $sub['url'] }}" class="block bg-white px-4 py-2 rounded shadow hover:bg-yellow-100 text-sm">{{ $sub['label'] }}</a>
                    @endforeach
                  </div>
                </div>
              @else
                <a href="{{ $item['url'] }}" class="block bg-white px-4 py-2 rounded shadow hover:bg-yellow-100 transition">{{ $item['label'] }}</a>
              @endif
            @endforeach
          </div>
        </div>
      @endforeach

      <a href="{{ request()->routeIs('Index.Dashboard') ? '#artikel-dan-berita' : route('Index.Post') }}"
        class="block bg-white px-4 py-3 rounded shadow hover:bg-yellow-100 font-semibold transition">
        Artikel & Berita
      </a>
    </div>
  </div>
</header>

<script>
  const toggleBtn = document.getElementById('toggleNav');
  const mobileNav = document.getElementById('mobileNav');
  const headerMobile = document.getElementById('mainHeaderMobile');
  const hamburgerIcon = document.getElementById('hamburgerIcon');
  const mobileTitle = document.getElementById('mobileTitle');
  let isOpen = false;

  toggleBtn?.addEventListener('click', () => {
    isOpen = !isOpen;
    mobileNav.classList.toggle('max-h-0', !isOpen);
    mobileNav.classList.toggle('max-h-[1000px]', isOpen);
    updateHeaderMobile();
  });

  document.querySelectorAll('[data-mobile-toggle]').forEach(button => {
    button.addEventListener('click', function () {
      const targetId = this.dataset.mobileToggle;
      const targetMenu = document.getElementById('mobile-menu-' + targetId);
      document.querySelectorAll('#mobileNav .mobile-dropdown > div').forEach(div => {
        if (div !== targetMenu) div.classList.add('hidden');
      });
      targetMenu.classList.toggle('hidden');
      this.querySelector('i').classList.toggle('rotate-180');
    });
  });

  // Nested submenu toggle
  document.querySelectorAll('[data-sub-toggle]').forEach(btn => {
    btn.addEventListener('click', function () {
      const subTarget = this.dataset.subToggle;
      const subMenu = document.getElementById('sub-menu-' + subTarget);
      subMenu.classList.toggle('hidden');
      this.querySelector('i').classList.toggle('rotate-180');
    });
  });

  function updateHeaderMobile() {
    const isDashboard = {{ $isDashboard ? 'true' : 'false' }};
    const isAtTop = window.scrollY === 0;
    if (isAtTop && !isOpen && isDashboard) {
      headerMobile.classList.remove('bg-white', 'shadow-md', 'text-green-900');
      headerMobile.classList.add('bg-transparent', 'backdrop-blur-sm', 'text-white');
      hamburgerIcon.classList.replace('text-green-800', 'text-white');
      mobileTitle.classList.replace('text-green-800', 'text-white');
    } else {
      headerMobile.classList.remove('bg-transparent', 'backdrop-blur-sm', 'text-white');
      headerMobile.classList.add('bg-white', 'shadow-md', 'text-green-900');
      hamburgerIcon.classList.replace('text-white', 'text-green-800');
      mobileTitle.classList.replace('text-white', 'text-green-800');
    }
  }

  window.addEventListener('scroll', updateHeaderMobile);
  window.addEventListener('DOMContentLoaded', updateHeaderMobile);
</script>

<style>
  .rotate-180 {
    transform: rotate(180deg);
  }

  #mobileNav {
    transition: max-height 0.5s ease-in-out;
  }

  #mainHeaderMobile {
    transition: background-color 0.3s ease, color 0.3s ease;
  }
</style>
