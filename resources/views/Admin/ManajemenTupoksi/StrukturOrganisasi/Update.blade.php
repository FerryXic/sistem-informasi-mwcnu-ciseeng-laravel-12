<!-- Tombol Edit -->
<button
  data-modal-target="modalUpdateStruktur-{{ $data['id'] }}"
  data-modal-toggle="modalUpdateStruktur-{{ $data['id'] }}"
  class="text-yellow-500 hover:text-yellow-700"
  title="Edit"
>
  <i class="fas fa-edit"></i>
</button>

<!-- Modal Update Struktur Organisasi -->
<div id="modalUpdateStruktur-{{ $data['id'] }}"
     class="modal-wrapper hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm items-center justify-center">
  <div class="relative bg-white rounded-lg shadow-md w-full max-w-lg animate-slide-in p-6 space-y-4">

    <!-- Header -->
    <div class="flex justify-between items-center border-b pb-2">
      <h3 class="text-lg font-semibold text-yellow-700">Update Struktur Organisasi</h3>
      <button class="text-gray-400 hover:text-red-600" data-modal-hide="modalUpdateStruktur-{{ $data['id'] }}">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <!-- Form -->
    <form action="{{ route('Update.StrukturOrganisasi.A', $data['id']) }}"
          method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf
      @method('PUT')

      <!-- Nama -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
        <input type="text" name="full_name" value="{{ $data['full_name'] }}" required
               class="w-full border border-yellow-200 rounded px-3 py-2 focus:ring-2 focus:ring-yellow-400 outline-none" />
      </div>

      <!-- Kategori -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
        <select name="category_id" class="w-full border border-yellow-200 rounded px-3 py-2 text-sm" id="kategoriSelect-{{ $data['id'] }}" required>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
              data-nama="{{ strtolower($cat->name) }}"
              {{ $cat->id == $data['category_id'] ? 'selected' : '' }}>
              {{ $cat->name }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Jabatan -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
        <select name="position" id="jabatanSelect-{{ $data['id'] }}" class="w-full border border-yellow-200 rounded px-3 py-2 text-sm">
          {{-- Akan diisi via JS --}}
        </select>
      </div>

      <!-- Periode -->
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm text-gray-700 mb-1">Tahun Mulai</label>
          <input type="number" name="start_year" value="{{ $data['start_year'] }}"
                 class="w-full border border-yellow-200 rounded px-3 py-2" required>
        </div>
        <div>
          <label class="block text-sm text-gray-700 mb-1">Tahun Selesai</label>
          <input type="number" name="end_year" value="{{ $data['end_year'] }}"
                 class="w-full border border-yellow-200 rounded px-3 py-2" required>
        </div>
      </div>

      <!-- Foto -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Foto (Opsional)</label>
        <input type="file" name="foto" accept="image/*"
               class="w-full border border-yellow-200 rounded px-3 py-2 file:py-1 file:px-3 file:rounded file:border-0 file:bg-yellow-100 file:text-yellow-800 file:mr-2">
      </div>

      <!-- Tombol Simpan -->
      <div class="flex justify-end pt-2">
        <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded shadow-md transition">
          <i class="fas fa-save mr-1"></i> Update
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Script Modal & Jabatan Dinamis -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const kategoriSelect = document.getElementById('kategoriSelect-{{ $data['id'] }}');
    const jabatanSelect = document.getElementById('jabatanSelect-{{ $data['id'] }}');

    const jabatanOptions = {
      1: ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Wakil Sekretaris', 'Bendahara', 'Wakil Bendahara'],
      2: ['Rois Syuriah', 'Wakil Rois', 'Katib Syuriah', 'Wakil Katib'],
      3: ['Mustasyar Utama', 'Anggota Mustasyar'],
      4: ['Anggota'],
    };

    function updateJabatanDropdown() {
      const selectedCategoryId = parseInt(kategoriSelect.value);
      jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';

      if (jabatanOptions[selectedCategoryId]) {
        jabatanOptions[selectedCategoryId].forEach(jabatan => {
          const option = document.createElement('option');
          option.value = jabatan;
          option.textContent = jabatan;
          // Tandai sebagai selected jika sama dengan yang tersimpan
          if ("{{ $data['position'] }}" === jabatan) {
            option.selected = true;
          }
          jabatanSelect.appendChild(option);
        });
      } else {
        const opt = document.createElement('option');
        opt.value = '-';
        opt.textContent = 'Tidak ada jabatan untuk kategori ini';
        opt.selected = true;
        jabatanSelect.appendChild(opt);
      }
    }

    kategoriSelect.addEventListener('change', updateJabatanDropdown);
    updateJabatanDropdown(); // init saat pertama
  });
</script>

<!-- Style -->
<style>
  @keyframes slide-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .animate-slide-in {
    animation: slide-in 0.25s ease-out;
  }

  .modal-wrapper {
    display: none;
  }

  .modal-wrapper.flex {
    display: flex !important;
  }
</style>
