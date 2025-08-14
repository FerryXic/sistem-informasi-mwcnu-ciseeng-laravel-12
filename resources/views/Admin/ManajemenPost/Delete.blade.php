<!-- MODAL DELETE CONFIRM -->
<div id="modalHapus" class="hidden fixed inset-0 z-50 bg-black bg-opacity-40 backdrop-blur-sm">
  <div class="flex items-center justify-center min-h-screen px-4">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md border border-red-200">
      <div class="px-6 py-4 border-b">
        <h3 class="text-lg font-bold text-red-600">Yakin ingin menghapus post ini?</h3>
        <p class="text-sm text-gray-600 mt-1">Tindakan ini tidak dapat dibatalkan.</p>
      </div>
      <form id="deleteForm" method="POST" class="px-6 py-4 space-y-3">
        @csrf
        @method('DELETE')
        <div class="flex justify-end gap-3">
          <button type="button" onclick="closeModal('modalHapus')"
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</button>
          <button type="submit"
            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>
