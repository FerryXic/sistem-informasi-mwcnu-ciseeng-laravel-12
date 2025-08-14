<x-user.main>
  <div class="max-w-6xl mx-auto px-4 py-10">

    <!-- Filter Periode -->
    <form method="GET" class="mb-10 text-center">
      <label for="periode" class="mr-2 font-medium text-gray-700">Pilih Periode:</label>
      <select name="periode" id="periode" class="border border-gray-300 px-3 py-2 rounded" onchange="this.form.submit()">
        <option disabled {{ request('periode') ? '' : 'selected' }}>Pilih Periode</option>
        @foreach ($periodes as $periode)
          @php $label = $periode->start_year . ' - ' . $periode->end_year; @endphp
          <option value="{{ $periode->start_year }}-{{ $periode->end_year }}"
            {{ request('periode') == $periode->start_year . '-' . $periode->end_year ? 'selected' : '' }}>
            {{ $label }}
          </option>
        @endforeach
      </select>
    </form>

    <!-- Heading -->
    <div class="text-center mb-10">
      <h1 class="text-2xl sm:text-3xl font-bold text-green-800 leading-tight">
        Pengurus Majelis Wakil Cabang Nahdlatul Ulama (MWC NU)<br>
        Kecamatan Ciseeng – Kabupaten Bogor Masa Khidmat {{ request('periode') ?? '....' }}
      </h1>
    </div>

    @if ($data->isEmpty())
  <div class="text-center text-gray-500 italic mt-6">Belum ada data struktur organisasi untuk periode ini.</div>
@else
  @php
    function getPerson($data, $kategori, $jabatan) {
      return $data->first(fn($item) =>
        strtolower($item['kategori']) === strtolower($kategori) &&
        strtolower($item['position']) === strtolower($jabatan)
      );
    }

    $ketua       = getPerson($data, 'TANFIZIYAH', 'Ketua');
    $wakilKetua  = getPerson($data, 'TANFIZIYAH', 'Wakil Ketua');
    $sekretaris  = getPerson($data, 'TANFIZIYAH', 'Sekretaris');
    $roisSyuriah = getPerson($data, 'SYURIAH', 'Rois Syuriah');
    $katib       = getPerson($data, 'SYURIAH', 'Katib Syuriah');

    function renderCard($person, $jabatan, $isKetua = false) {
      $image = !empty($person['image']) ? asset('storage/' . $person['image']) : 'https://via.placeholder.com/800x800?text=Foto';
      $cardClass = $isKetua
        ? 'border-4 border-yellow-500 shadow-lg w-[200px] md:w-[200px]'
        : 'shadow-md w-[180px] md:w-[180px]';

      return <<<HTML
        <div class="bg-white rounded-xl p-2 text-center {$cardClass}">
          <div class="rounded-md overflow-hidden aspect-square mb-3 bg-gray-100 flex items-center justify-center">
            <img src="{$image}" alt="Foto {$person['full_name']}" class="object-cover w-full h-full" loading="lazy">
          </div>
          <div class="bg-green-800 text-white text-center py-2 rounded-md">
            <p class="font-semibold text-sm leading-tight tracking-tight">{$person['full_name']}</p>
            <p class="text-xs font-light -mt-0.5">{$jabatan}</p>
          </div>
        </div>
      HTML;
    }
  @endphp

  <!-- Responsive Card Layout -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 justify-center items-start">
    <!-- Ketua (tengah) -->
    <div class="flex justify-center md:col-span-3">
      @if ($ketua)
        {!! renderCard($ketua, 'Ketua Tanfidziyah', true) !!}
      @endif
    </div>

    <!-- Sekretaris (kiri), Kosong Tengah, Wakil Ketua (kanan) -->
    <div class="flex justify-center">
      @if ($sekretaris)
        {!! renderCard($sekretaris, 'Sekretaris Tanfidziyah') !!}
      @endif
    </div>
    <div class="hidden md:block"></div>
    <div class="flex justify-center">
      @if ($wakilKetua)
        {!! renderCard($wakilKetua, 'Wakil Ketua Tanfidziyah') !!}
      @endif
    </div>

    <!-- Rois Syuriah (kiri), Kosong Tengah, Katib Syuriah (kanan) -->
    <div class="flex justify-center">
      @if ($roisSyuriah)
        {!! renderCard($roisSyuriah, 'Rois Syuriah') !!}
      @endif
    </div>
    <div class="hidden md:block"></div>
    <div class="flex justify-center">
      @if ($katib)
        {!! renderCard($katib, 'Katib Syuriah') !!}
      @endif
    </div>
  </div>
  @endif


  </div>

  <div class="max-w-6xl mx-auto px-4 py-10">
    <!-- Heading -->
    <div class="text-center mb-10">
      <h1 class="text-2xl sm:text-3xl font-bold text-green-800 leading-tight">
        Adapun Struktur Majelis Wakil Cabang Nahdlatul Ulama <br>
        Kecamatan Ciseeng – Kabupaten Bogor Masa Khidmat {{ request('periode') ?? '....' }}
      </h1>
    </div>

    @php
      $tanfiziyah = $data->filter(fn($item) => $item['kategori'] === 'TANFIZIYAH');
      $syuriah    = $data->filter(fn($item) => $item['kategori'] === 'SYURIAH');
      $mustasyar  = $data->filter(fn($item) => $item['kategori'] === 'MUSTASYAR');
      $awan       = $data->filter(fn($item) => $item['kategori'] === 'AWAN');

      function renderGroup($title, $items) {
        if ($items->isEmpty()) return '';

        $grouped = $items->groupBy('position');

        $html = "<div class='mb-12 border border-green-600 rounded-md shadow-sm bg-white'>";
        $html .= "<div class='bg-green-700 text-white font-bold text-center text-lg py-2 rounded-t-md tracking-wide uppercase'>{$title}</div>";
        $html .= "<div class='px-6 py-4'>";

        foreach ($grouped as $position => $members) {
          $html .= "<div class='mb-6 text-center'>";
          $html .= "<h3 class='text-green-800 font-semibold text-base mb-2 border-b border-dashed border-gray-400 pb-1'>{$position}</h3>";
          foreach ($members as $person) {
            $html .= "<p class='text-gray-800 text-sm leading-tight'>{$person['full_name']}</p>";
          }
          $html .= "</div>";
        }

        $html .= "</div></div>";
        return $html;
      }
    @endphp

    <div class="space-y-8">
      {!! renderGroup('Tanfiziyah', $tanfiziyah) !!}
      {!! renderGroup('Syuriah', $syuriah) !!}
      {!! renderGroup('Mustasyar', $mustasyar) !!}
      {!! renderGroup("A'wan", $awan) !!}
    </div>
  </div>
</x-user.main>
