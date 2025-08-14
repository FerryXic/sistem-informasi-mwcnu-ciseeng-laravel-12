{{-- Tombol Tambah --}}
<div class="flex justify-between items-center mb-4">
  <h2 class="text-lg font-semibold text-green-700">Daftar Struktur Organisasi</h2>
  <button
    data-modal-target="modalTambahStruktur"
    data-modal-toggle="modalTambahStruktur"
    class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition-all duration-200"
  >
    <i class="fas fa-plus-circle"></i> Tambah Struktur Organisasi
  </button>
</div>

{{-- Modal Tambah Struktur Organisasi --}}
<div id="modalTambahStruktur" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/40 backdrop-blur-sm">
  <div class="relative bg-white rounded-xl shadow-lg w-full max-w-lg mx-auto p-6 animate-slide-in space-y-4">

    {{-- Form --}}
    <form action="{{ route('Store.StrukturOrganisasi.SA') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf

      {{-- Nama --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
        <input
          type="text"
          name="full_name"
          placeholder="Nama Lengkap"
          class="w-full border border-green-200 rounded px-3 py-2 focus:ring-2 focus:ring-green-400 outline-none"
          required
        />
      </div>

      {{-- Kategori --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
        <select name="category_os_id" id="kategoriSelect" required class="w-full border border-green-200 rounded px-3 py-2 text-sm">
          <option value="" disabled selected>Pilih Kategori</option>
          @foreach($categories as $kategori)
            <option value="{{ $kategori->id }}" data-nama="{{ strtolower($kategori->name) }}">
              {{ $kategori->name }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Jabatan --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
        <select name="jabatan" id="jabatanSelect" class="w-full border border-green-200 rounded px-3 py-2 text-sm">
          <option value="" disabled selected>Pilih Kategori terlebih dahulu</option>
        </select>
      </div>

      {{-- Periode --}}
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">
            Tahun Mulai <span class="text-red-500">*</span>
          </label>
          <select name="start_year" id="start_year" required
            class="w-full border border-green-200 rounded px-3 py-2 text-sm">
            <option value="" disabled selected>Pilih Tahun</option>
            @for($year = now()->year; $year >= now()->year - 10; $year--)
              <option value="{{ $year }}">{{ $year }}</option>
            @endfor
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">
            Tahun Selesai <span class="text-red-500">*</span>
          </label>
          <select name="end_year" id="end_year" required
            class="w-full border border-green-200 rounded px-3 py-2 text-sm">
            <option value="" disabled selected>Pilih Tahun</option>
          </select>
        </div>
      </div>

      {{-- Foto --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Foto (Opsional)</label>
        <input type="file" name="foto" accept="image/*"
          class="w-full border border-green-200 rounded px-3 py-2 text-sm file:py-1 file:px-3 file:rounded file:border-0 file:bg-green-100 file:text-green-800 file:mr-2">
      </div>

      {{-- Tombol Simpan --}}
      <div class="flex justify-end pt-2">
        <button type="submit"
          class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded shadow-md transition">
          <i class="fas fa-save mr-1"></i> Simpan
        </button>
      </div>
    </form>

  </div>
</div>

{{-- Script --}}
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const kategoriSelect = document.getElementById('kategoriSelect');
    const jabatanSelect = document.getElementById('jabatanSelect');

    const jabatanOptions = {
      tanfiziyah: ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Wakil Sekretaris', 'Bendahara', 'Wakil Bendahara'],
      syuriah: ['Rois Syuriah', 'Wakil Rois', 'Katib Syuriah', 'Wakil Katib'],
      mustasyar: ['Mustasyar Utama', 'Anggota Mustasyar'],
      awan: ['Anggota']
    };

    kategoriSelect.addEventListener('change', function () {
      const selectedOption = this.options[this.selectedIndex];
      const kategoriNama = selectedOption.getAttribute('data-nama').toLowerCase();

      jabatanSelect.innerHTML = '<option value="" disabled selected>Pilih Jabatan</option>';

      if (jabatanOptions[kategoriNama]) {
        jabatanOptions[kategoriNama].forEach(jabatan => {
          const option = document.createElement('option');
          option.value = jabatan;
          option.textContent = jabatan;
          jabatanSelect.appendChild(option);
        });
      } else {
        const option = document.createElement('option');
        option.value = '';
        option.textContent = 'Tidak ada jabatan untuk kategori ini';
        jabatanSelect.appendChild(option);
      }
    });

    // End Year dinamis
    const startYearSelect = document.getElementById("start_year");
    const endYearSelect = document.getElementById("end_year");

    startYearSelect.addEventListener("change", function () {
      const selectedStart = parseInt(this.value);
      const range = 10;

      endYearSelect.innerHTML = '<option value="" disabled selected>Pilih Tahun</option>';
      for (let i = 1; i <= range; i++) {
        const year = selectedStart + i;
        const option = document.createElement("option");
        option.value = year;
        option.textContent = year;
        endYearSelect.appendChild(option);
      }
    });
  });
</script>

<style>
  @keyframes slide-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .animate-slide-in {
    animation: slide-in 0.25s ease-out;
  }
</style>
