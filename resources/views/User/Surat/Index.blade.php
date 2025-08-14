<x-user.main>
<div class="max-w-7xl mx-auto px-4 py-10">

  <!-- Judul Halaman -->
  <div class="mb-8 text-center">
    <h1 class="text-3xl font-bold text-green-800">Daftar Surat</h1>

    <!-- Search Centered -->
    <div class="flex justify-center mt-4">
      <div class="w-full md:w-2/3 lg:w-1/2 relative">
        <input type="text"
          class="w-full border border-gray-300 rounded-md px-4 py-2 pr-10 shadow-sm focus:ring-2 focus:ring-green-500 focus:outline-none"
          placeholder="Cari surat berdasarkan nomor atau keterangan..." />
        <span class="absolute right-3 top-2.5 text-gray-400"><i class="fas fa-search"></i></span>
      </div>
    </div>
  </div>

  <!-- Tabel Surat -->
  <div class="overflow-x-auto bg-white rounded-lg shadow ring-1 ring-gray-200">
    <table class="min-w-full text-sm text-left text-gray-700">
      <thead class="bg-green-700 text-white uppercase text-xs">
        <tr>
          <th class="px-6 py-4 font-semibold tracking-wider">No</th>
          <th class="px-6 py-4 font-semibold tracking-wider">Nomor Surat</th>
          <th class="px-6 py-4 font-semibold tracking-wider">Keterangan</th>
          <th class="px-6 py-4 font-semibold tracking-wider text-center">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse($surat as $i => $data)
        <tr class="hover:bg-gray-50 transition">
          <td class="px-6 py-4">{{ $loop->iteration }}</td>
          <td class="px-6 py-4">{{ $data->letter_number }}</td>
          <td class="px-6 py-4">{{ $data->description }}</td>
          <td class="px-6 py-4 text-center">
            <a href="{{ asset('storage/letters/' . $data->file) }}" target="_blank"
              class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-md shadow transition">
              <i class="fas fa-eye"></i> Lihat
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center text-gray-500 py-6 italic">Belum ada surat tersedia.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>
</x-user.main>
