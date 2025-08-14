<!-- MODAL HAPUS -->
<form id="deleteForm" method="POST">
  @csrf
  @method('DELETE')
  <div id="modalHapus" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-30 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4">
      <div class="relative bg-white rounded-lg shadow-md w-full max-w-md">
        <div class="flex justify-between items-center px-4 py-3 border-b">
          <h3 class="text-lg font-semibold text-red-600">Konfirmasi Hapus</h3>
          <button type="button" onclick="closeModal('modalHapus')" class="text-gray-400 hover:text-red-600">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="p-4">
          <p class="text-sm text-gray-700 mb-4">Yakin ingin menghapus Admin ini?</p>
          <div class="flex justify-end gap-2">
            <button type="button"
              class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded"
              onclick="closeModal('modalHapus')">Batal</button>
            <button type="submit"
              class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Hapus</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>