<x-super-admin.main>

  {{-- Header --}}
  <div class="mb-6">
    <h1 class="text-2xl font-bold text-green-800">Manajemen Surat</h1>
    <p class="text-sm text-gray-500">Kelola surat masuk/keluar yang tercatat dalam sistem.</p>
  </div>

  {{-- Card --}}
  <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">

    @include('SuperAdmin.ManajemenSurat.Create')

    {{-- Tabel --}}
    <div class="overflow-x-auto">
      <table class="min-w-full table-auto text-sm border border-gray-200">
        <thead class="bg-green-50 text-green-800">
          <tr>
            <th class="px-4 py-2 border-b text-left">No</th>
            <th class="px-4 py-2 border-b text-left">Nomor Surat</th>
            <th class="px-4 py-2 border-b text-left">Tipe Surat</th>
            <th class="px-4 py-2 border-b text-left">Keterangan</th>
            <th class="px-4 py-2 border-b text-left">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($letters as $index => $letter)
            <tr class="border-b hover:bg-green-50">
              <td class="px-4 py-2">{{ $index + 1 }}</td>
              <td class="px-4 py-2">{{ $letter->letter_number }}</td>
              <td class="px-4 py-2">{{ $letter->type }}</td>
              <td class="px-4 py-2">{{ $letter->description }}</td>
              <td class="px-4 py-2 space-x-2">
                <a href="{{ asset('storage/letters/' . $letter->file) }}" target="_blank" class="text-blue-600 hover:text-blue-800" title="Lihat File">
                  <i class="fas fa-file-alt"></i>
                </a>
                @include('SuperAdmin.ManajemenSurat.Update')
                @include('SuperAdmin.ManajemenSurat.Delete')
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center text-gray-500 py-6 italic">Belum ada data surat.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</x-super-admin.main>
