<x-user.main>
<div class="max-w-5xl mx-auto px-4 py-10">

  <div class="text-center mb-8">
    <h1 class="text-3xl font-bold text-green-800">Surat Keputusan (SK)</h1>
    <p class="text-gray-600 mt-2">Berikut adalah dokumen resmi Surat Keputusan MWC NU Kecamatan Ciseeng.</p>
  </div>

  {{-- Filter Periode --}}
  <form method="GET" action="{{ route('Index.Tupoksi.SK') }}" class="max-w-xs mx-auto mb-10">
    <label for="periode" class="block text-sm font-medium text-gray-700 mb-2">Pilih Periode</label>
    <select name="periode" id="periode" required
      class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 px-4 py-2 text-sm">
      <option value="" disabled selected>-- Pilih Periode --</option>
      @foreach($skItems->sortByDesc('start_year')->unique('start_year') as $item)
        @php
          $start = \Carbon\Carbon::parse($item->start_year)->year;
          $end = \Carbon\Carbon::parse($item->end_year)->year;
          $periodeValue = $start . '-' . $end;
        @endphp
        <option value="{{ $periodeValue }}" {{ request('periode') == $periodeValue ? 'selected' : '' }}>
          {{ $periodeValue }}
        </option>
      @endforeach
    </select>

    <div class="mt-4 text-center">
      <button type="submit"
        class="inline-block bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded shadow text-sm font-semibold">
        Tampilkan SK
      </button>
    </div>
  </form>

  {{-- Tampilkan Data Jika Periode Dipilih --}}
  @php
    $selectedSK = null;
    if(request('periode')) {
      [$start, $end] = explode('-', request('periode'));
      $selectedSK = $skItems->first(function($item) use ($start, $end) {
        return \Carbon\Carbon::parse($item->start_year)->year == $start
            && \Carbon\Carbon::parse($item->end_year)->year == $end;
      });
    }
  @endphp

  @if($selectedSK)
    <div class="text-center mb-6">
      <a href="{{ asset('storage/sk/' . $selectedSK->pdf) }}" target="_blank"
        class="inline-flex items-center gap-2 px-6 py-3 bg-green-700 hover:bg-green-800 text-white rounded-md shadow transition">
        <i class="fas fa-file-download"></i> Unduh PDF SK
      </a>
    </div>

    <div class="flex justify-center">
      <img src="{{ asset('storage/sk/' . $selectedSK->gambar) }}"
        alt="Gambar SK"
        class="rounded-lg shadow-md border border-gray-300 w-full max-w-3xl object-contain" />
    </div>
  @elseif(request('periode'))
    <div class="text-center text-red-500 italic mt-10">
      Data SK untuk periode tersebut tidak ditemukan.
    </div>
  @endif

</div>
</x-user.main>
