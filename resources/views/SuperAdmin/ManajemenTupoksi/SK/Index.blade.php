<x-super-admin.main>

  {{-- Header --}}
  <div class="mb-6">
    <h1 class="text-2xl font-bold text-green-800">Manajemen SK</h1>
    <p class="text-sm text-gray-500">Unggah dan kelola file SK dalam bentuk PDF dan gambar.</p>
  </div>

  {{-- Form Upload --}}
  <div class="bg-white shadow-md rounded-xl p-8 mb-10 border border-green-100">
    <div class="mb-6">
      <h2 class="text-2xl font-bold text-green-800">Upload SK</h2>
      <p class="text-sm text-gray-500">Silakan unggah gambar dan file PDF SK terbaru.</p>
    </div>

    <form action="{{ route('Store.SK.SA') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      {{-- Periode SK --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Tahun Mulai -->
        <div>
          <label for="start_year" class="block text-sm font-medium text-gray-700 mb-2">
            Tahun Mulai <span class="text-red-500">*</span>
          </label>
          <select name="start_year" id="start_year" required
            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 px-4 py-2 text-sm">
            <option value="">-- Pilih Tahun --</option>
            @for ($year = now()->year; $year >= 2000; $year--)
              <option value="{{ $year }}" {{ old('start_year') == $year ? 'selected' : '' }}>
                {{ $year }}
              </option>
            @endfor
          </select>
        </div>

        <!-- Tahun Selesai -->
        <div>
          <label for="end_year" class="block text-sm font-medium text-gray-700 mb-2">
            Tahun Selesai <span class="text-red-500">*</span>
          </label>
          <select name="end_year" id="end_year" required
            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 px-4 py-2 text-sm">
            <option value="">-- Pilih Tahun --</option>
            @for ($year = now()->year + 5; $year >= 2000; $year--)
              <option value="{{ $year }}" {{ old('end_year') == $year ? 'selected' : '' }}>
                {{ $year }}
              </option>
            @endfor
          </select>
        </div>
      </div>

      <!-- Gambar -->
      <div>
        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar Preview <span class="text-red-500">*</span></label>
        <div class="flex items-center gap-4">
          <input type="file" name="gambar" accept="image/*" required
            class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-green-500 focus:border-green-500
            file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
        </div>
      </div>

      <!-- PDF -->
      <div>
        <label for="pdf" class="block text-sm font-medium text-gray-700 mb-2">File PDF SK <span class="text-red-500">*</span></label>
        <input type="file" name="pdf" accept="application/pdf" required
          class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-green-500 focus:border-green-500
          file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
      </div>

      <!-- Tombol Upload -->
      <div class="pt-2">
        <button type="submit"
          class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2.5 rounded-md shadow transition">
          <i class="fas fa-upload"></i> Unggah SK
        </button>
      </div>
    </form>
  </div>

  {{-- Tabel Data SK --}}
  <div class="bg-white shadow rounded-lg p-6 border border-gray-100">
    <h2 class="text-lg font-semibold text-green-700 mb-4">Data SK</h2>

    <div class="overflow-x-auto">
      <table class="min-w-full table-auto text-sm border border-gray-200">
        <thead class="bg-green-50 text-green-800 text-left">
          <tr>
            <th class="px-4 py-2 border-b">Gambar</th>
            <th class="px-4 py-2 border-b">File PDF</th>
            <th class="px-4 py-2 border-b">Periode</th>
            <th class="px-4 py-2 border-b">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($skItems as $item)
            <tr class="border-b hover:bg-green-50">
              <td class="px-4 py-2">
                @if($item->gambar)
                  <img src="{{ asset('storage/sk/' . $item->gambar) }}" alt="Preview"
                      class="w-16 h-16 rounded shadow object-cover">
                @else
                  <span class="text-gray-400 italic">Tidak ada</span>
                @endif
              </td>

              <td class="px-4 py-2">
                @if($item->pdf)
                  <a href="{{ asset('storage/sk/' . $item->pdf) }}" target="_blank"
                    class="text-blue-600 hover:underline flex items-center gap-1">
                    <i class="fas fa-file-pdf"></i> Lihat PDF
                  </a>
                @else
                  <span class="text-gray-400 italic">Tidak ada file PDF</span>
                @endif
              </td>

              <td class="px-4 py-2">
                @if($item->start_year && $item->end_year)
                  <span class="font-medium text-green-700">
                    {{ \Carbon\Carbon::parse($item->start_year)->year }} - {{ \Carbon\Carbon::parse($item->end_year)->year }}
                  </span>
                @else
                  <span class="text-gray-400 italic">Tidak tersedia</span>
                @endif
              </td>

              <td class="px-4 py-2 space-x-2">
                <form action="{{ route('Delete.SK.SA', $item->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus SK ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center text-gray-500 py-6 italic">Belum ada data SK</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Style tombol SweetAlert --}}
  <style>
    .btn-confirm {
      background-color: #d83d37; 
      color: white;
      padding: 0.5rem 1.25rem;
      font-weight: 600;
      border-radius: 0.375rem;
      font-size: 0.875rem;
      border: none;
      cursor: pointer;
    }

    .btn-cancel {
      background-color: #6b7280;
      color: white;
      padding: 0.5rem 1.25rem;
      font-weight: 600;
      border-radius: 0.375rem;
      font-size: 0.875rem;
      border: none;
      margin-left: 0.5rem;
      cursor: pointer;
    }

    .btn-confirm:hover {
      background-color: #cf6451; 
    }

    .btn-cancel:hover {
      background-color: #4b5563; 
    }
  </style>

  {{-- Script konfirmasi delete --}}
  <script>
    function confirmDelete() {
      Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Data SK akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        customClass: {
          confirmButton: 'btn-confirm',
          cancelButton: 'btn-cancel'
        },
        buttonsStyling: false
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('deleteForm').submit();
        }
      });
    }
  </script>

</x-super-admin.main>
