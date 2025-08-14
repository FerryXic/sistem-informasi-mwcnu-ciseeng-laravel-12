<!-- Edit -->
<button data-modal-target="modalUpdate-{{ $letter->id }}" data-modal-toggle="modalUpdate-{{ $letter->id }}"
  class="text-yellow-500 hover:text-yellow-700" title="Edit">
  <i class="fas fa-edit"></i>
</button>

<!-- Modal Update Surat -->
<div id="modalUpdate-{{ $letter->id }}" tabindex="-1" class="hidden fixed inset-0 z-50 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen px-4">
    <div class="relative bg-white rounded-lg shadow-md w-full max-w-md">
      <div class="flex justify-between items-center px-4 py-3 border-b">
        <h3 class="text-lg font-semibold text-yellow-700">Update Surat</h3>
        <button class="text-gray-400 hover:text-red-600" data-modal-hide="modalUpdate-{{ $letter->id }}">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <form action="{{ route('Update.ManajemenSurat.A', $letter->id) }}" method="POST" enctype="multipart/form-data" class="p-4 space-y-4">
        @csrf
        @method('PUT')

        {{-- Tipe Surat --}}
        <select name="type" required class="w-full border border-green-200 rounded px-3 py-2 text-sm text-gray-700">
          <option value="" disabled selected>Pilih Tipe Surat</option>
          <option value="masuk">Surat Masuk</option>
          <option value="keluar">Surat Keluar</option>
        </select>

        <!-- Nomor Surat -->
        <input type="text" name="letter_number" value="{{ $letter->letter_number }}" placeholder="Nomor Surat"
          class="w-full border border-yellow-200 rounded px-3 py-2" required />

        <!-- Keterangan -->
        <textarea name="description" rows="3" placeholder="Keterangan"
          class="w-full border border-yellow-200 rounded px-3 py-2" required>{{ $letter->description }}</textarea>

        <!-- File Baru -->
        <div>
          <label class="block text-sm text-gray-600">Ganti File (opsional)</label>
          <input type="file" name="file" accept="application/pdf" class="w-full text-sm text-gray-700" />
        </div>

        <!-- Tombol Simpan -->
        <div class="flex justify-end pt-2">
          <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
