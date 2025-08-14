<x-admin.main>

  {{-- Header --}}
  <div class="mb-6">
    <h1 class="text-2xl font-bold text-green-800">Manajemen Struktur Organisasi</h1>
    <p class="text-sm text-gray-500">Kelola Struktur Organisasi yang tercatat dalam sistem.</p>
  </div>

  {{-- Card --}}
  <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">

    {{-- Form Tambah --}}
    @include('Admin.ManajemenTupoksi.StrukturOrganisasi.Create')

    {{-- Filter Periode --}}
    <form method="GET" class="mt-4 mb-6">
      <div class="flex flex-wrap gap-4 items-center">
        <div>
          <label for="periode" class="block text-sm font-medium text-gray-700 mb-1">Filter Periode</label>
          <select name="periode" id="periode"
                  onchange="this.form.submit()"
                  class="border border-green-200 rounded px-3 py-2 text-sm">
            <option value="">-- Semua Periode --</option>
            @foreach($availablePeriods as $periode)
              <option value="{{ $periode }}" {{ request('periode') == $periode ? 'selected' : '' }}>
                {{ $periode }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </form>

    {{-- Daftar Berdasarkan Periode --}}
    <div class="overflow-x-auto mt-6 space-y-10">
      @forelse($groupedByPeriode as $periode => $items)

        {{-- Jika filter diaktifkan, hanya tampilkan periode yang dipilih --}}
        @if(request('periode') == null || request('periode') == $periode)

          {{-- Judul Periode --}}
          <div class="text-green-800 font-semibold text-base border-l-4 border-green-500 pl-3 bg-green-50 py-2 mb-2">
            Periode: {{ $periode }}
          </div>

          <table class="min-w-full table-auto text-sm border border-gray-200">
            <thead class="bg-green-50 text-green-800 text-left">
              <tr>
                <th class="px-4 py-2 border-b">No</th>
                <th class="px-4 py-2 border-b">Foto</th>
                <th class="px-4 py-2 border-b">Kategori</th>
                <th class="px-4 py-2 border-b">Nama</th>
                <th class="px-4 py-2 border-b">Jabatan</th>
                <th class="px-4 py-2 border-b">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($items as $index => $data)
                <tr class="border-b hover:bg-green-50">
                  <td class="px-4 py-2">{{ $index + 1 }}</td>
                  <td class="px-4 py-2">
                    @if($data->image)
                      <img src="{{ asset('storage/' . $data->image) }}" alt="Foto" class="w-12 h-12 object-cover rounded-full">
                    @else
                      <span class="text-gray-400 italic">Tidak ada foto</span>
                    @endif
                  </td>
                  <td class="px-4 py-2">{{ $data->category->name }}</td>
                  <td class="px-4 py-2">{{ $data->full_name }}</td>
                  <td class="px-4 py-2">{{ $data->position ?? '-' }}</td>
                  <td class="px-4 py-2 space-x-2">
                    @include('Admin.ManajemenTupoksi.StrukturOrganisasi.Update')
                    <span class="text-gray-400 italic">-</span>
                    @include('Admin.ManajemenTupoksi.StrukturOrganisasi.Delete')
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

        @endif

      @empty
        <div class="text-center text-gray-500 py-6 italic">
          Belum ada data struktur organisasi.
        </div>
      @endforelse
    </div>

  </div>

</x-admin.main>
