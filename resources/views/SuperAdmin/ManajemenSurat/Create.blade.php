{{-- Tombol Tambah --}}
<div class="flex justify-between items-center mb-4">
  <h2 class="text-lg font-semibold text-green-700">Daftar Surat</h2>
  <button data-modal-target="modalTambahSurat" data-modal-toggle="modalTambahSurat"
    class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition-all duration-200">
    <i class="fas fa-plus-circle"></i> Tambah Surat
  </button>
</div>

{{-- Modal Tambah Surat --}}
<div id="modalTambahSurat" class="hidden fixed inset-0 z-50 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen px-4">
    <div class="relative bg-white rounded-lg shadow-md w-full max-w-md">
      <div class="flex justify-between items-center px-4 py-3 border-b">
        <h3 class="text-lg font-semibold text-green-800">Tambah Surat</h3>
        <button class="text-gray-400 hover:text-red-600" data-modal-hide="modalTambahSurat">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <form action="{{ route('Store.ManajemenSurat.SA') }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-4">
        @csrf

        {{-- Tipe Surat --}}
        <select name="type" required class="w-full border border-green-200 rounded px-3 py-2 text-sm text-gray-700">
          <option value="" disabled selected>Pilih Tipe Surat</option>
          <option value="masuk">Surat Masuk</option>
          <option value="keluar">Surat Keluar</option>
        </select>

        {{-- Nomor Surat --}}
        <input type="text" name="number" placeholder="Nomor Surat" class="w-full border border-green-200 rounded px-3 py-2" required />

        {{-- Keterangan --}}
        <textarea name="description" placeholder="Keterangan" rows="3" class="w-full border border-green-200 rounded px-3 py-2" required></textarea>

        {{-- File PDF --}}
        <input type="file" name="file" accept="application/pdf" required class="w-full text-sm text-gray-700" />

        {{-- Tombol Submit --}}
        <div class="flex justify-end pt-2">
          <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Script Modal Toggle --}}
<script>
  document.querySelectorAll('[data-modal-toggle]').forEach(btn => {
    btn.addEventListener('click', () => {
      const target = btn.getAttribute('data-modal-target');
      document.getElementById(target)?.classList.remove('hidden');
    });
  });

  document.querySelectorAll('[data-modal-hide]').forEach(btn => {
    btn.addEventListener('click', () => {
      const target = btn.getAttribute('data-modal-hide');
      document.getElementById(target)?.classList.add('hidden');
    });
  });
</script>
