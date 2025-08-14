<!-- MODAL EDIT POST -->
<div id="modalEdit" class="hidden fixed inset-0 z-50 bg-black bg-opacity-40 backdrop-blur-sm overflow-y-auto">
  <div class="flex items-start justify-center min-h-screen px-4 pt-20 pb-10">
    <div class="relative w-full max-w-5xl bg-white rounded-lg shadow-xl border border-green-100">

      <!-- Header -->
      <div class="flex justify-between items-center px-6 py-4 border-b bg-green-50 rounded-t-lg">
        <h3 class="text-xl font-bold text-green-800">✏️ Edit Post</h3>
        <button type="button" onclick="closeModal('modalEdit')" class="text-gray-500 hover:text-red-500">
          <i class="fas fa-times text-lg"></i>
        </button>
      </div>

      <!-- Edit Form -->
      <form id="editForm" method="POST" enctype="multipart/form-data" class="px-6 py-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-4">
          <!-- Kategori -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
            <select id="editCategory" name="category"
              class="w-full border border-green-300 rounded px-3 py-2 focus:ring-green-500 focus:outline-none" required>
              <option value="article">Article</option>
              <option value="news">News</option>
              <option value="proker">Program Kerja</option>
            </select>
          </div>

          <!-- Judul -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Post</label>
            <input id="editTitle" type="text" name="title" placeholder="Judul Post"
              class="w-full border border-green-300 rounded px-3 py-2 focus:ring-green-500 focus:outline-none" required />
          </div>
        </div>

        <!-- Gambar Preview -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar Saat Ini</label>
          <img id="editImagePreview" src="#" alt="Preview" class="h-32 rounded border border-green-200 hidden mb-3">
        </div>

        <!-- Gambar Baru -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar Baru (Opsional)</label>
          <input type="file" name="image" accept="image/*"
            class="w-full border border-green-300 rounded px-3 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-green-100 file:text-green-700 hover:file:bg-green-200" />
        </div>

        <!-- Konten -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Isi Konten</label>
          <textarea id="editContent" name="content" rows="10" placeholder="Tulis isi artikel atau berita di sini..."></textarea>
        </div>

        <!-- Tombol -->
        <div class="flex justify-between gap-2 border-t pt-4">
          <button type="button" onclick="openDeleteModal()"
            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded transition">Hapus Post</button>
          <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded transition">Update</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- TinyMCE Init -->
<script>
  tinymce.init({
    selector: '#editContent',
    height: 450,
    menubar: false,
    plugins: [
      'lists', 'wordcount', 'autocorrect', 'typography'
    ],
    toolbar: 'undo redo | fontfamily fontsize | bold italic underline | alignleft aligncenter alignright | bullist numlist | removeformat',
    branding: false,
    contextmenu: false,
    paste_data_images: false,
    automatic_uploads: false,
    file_picker_callback: () => false,
    images_upload_handler: () => false
  });

  function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
  }
</script>
