<!-- Delete -->
<button data-modal-target="modalDelete-{{ $letter->id }}" data-modal-toggle="modalDelete-{{ $letter->id }}"
  class="text-red-500 hover:text-red-700" title="Hapus">
  <i class="fas fa-trash-alt"></i>
</button>

<!-- Modal Delete Surat -->
<div id="modalDelete-{{ $letter->id }}" tabindex="-1" class="hidden fixed inset-0 z-50 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen px-4">
    <div class="bg-white rounded-lg shadow-md w-full max-w-md p-6 text-center">
      <h3 class="text-lg font-semibold text-red-600 mb-4">Konfirmasi Hapus</h3>
      <p class="text-gray-700 mb-6">Apakah Anda yakin ingin menghapus surat <strong>{{ $letter->letter_number }}</strong>?</p>
      <form action="{{ route('Delete.ManajemenSurat.SA', $letter->id) }}" method="POST" class="flex justify-center gap-3">
        @csrf
        @method('DELETE')
        <button type="button" data-modal-hide="modalDelete-{{ $letter->id }}" class="px-4 py-2 border border-gray-400 text-gray-600 hover:bg-gray-200 rounded">Batal</button>
        <button type="submit" class="px-5 py-2 bg-red-600 text-white hover:bg-red-700 rounded">Hapus</button>
      </form>
    </div>
  </div>
</div>
