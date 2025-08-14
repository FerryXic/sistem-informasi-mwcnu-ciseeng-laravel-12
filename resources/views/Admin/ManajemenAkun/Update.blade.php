<!-- MODAL EDIT -->
<div id="modalEdit" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-30 backdrop-blur-sm">
  <div class="flex items-center justify-center min-h-screen px-4">
    <div class="relative bg-white rounded-lg shadow-md w-full max-w-md">
      <div class="flex justify-between items-center px-4 py-3 border-b">
        <h3 class="text-lg font-semibold text-green-800">Edit Admin</h3>
        <button type="button" onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-red-600">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <div class="p-4 space-y-4">
          <input id="editName" name="name" type="text" placeholder="Nama Lengkap"
            class="w-full border border-green-200 rounded px-3 py-2" />

          <input id="editEmail" name="email" type="email" placeholder="Email"
            class="w-full border border-green-200 rounded px-3 py-2" />

          <input id="editPassword" name="password" type="password" placeholder="Password Baru (opsional)"
            class="w-full border border-green-200 rounded px-3 py-2" />

          <button type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Update Admin
          </button>

          <button type="button" onclick="openDeleteModal()"
            class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded mt-2">
            Hapus Admin
          </button>
        </div>
      </form>
    </div>
  </div>
</div>