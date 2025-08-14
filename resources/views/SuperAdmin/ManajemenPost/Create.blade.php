<!-- Tombol Tambah -->
<button data-modal-target="modalTambah" data-modal-toggle="modalTambah"
  class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition-all duration-200">
  <i class="fas fa-plus"></i> Post Baru
</button>

<!-- Modal Buat Post -->
<div id="modalTambah" tabindex="-1" class="hidden fixed inset-0 z-50 bg-black bg-opacity-40 backdrop-blur-sm overflow-y-auto">
  <div class="flex items-start justify-center min-h-screen px-4 pt-20 pb-10">
    <div class="relative w-full max-w-5xl bg-white rounded-lg shadow-xl border border-green-100">

      <!-- Header -->
      <div class="flex justify-between items-center px-6 py-4 border-b bg-green-50 rounded-t-lg">
        <h3 class="text-xl font-bold text-green-800">✏️ Buat Post Baru</h3>
        <button type="button" onclick="closeModal('modalTambah')" class="text-gray-500 hover:text-red-500">
          <i class="fas fa-times text-lg"></i>
        </button>
      </div>

      <!-- Form -->
      <form action="{{ route('Store.ManajemenPost.SA') }}" method="POST" enctype="multipart/form-data" class="px-6 py-6 space-y-6">
        @csrf

        <div class="grid md:grid-cols-2 gap-4">
          <!-- Kategori -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
            <select name="category" class="w-full border border-green-300 rounded px-3 py-2 focus:ring-green-500 focus:outline-none" required>
              <option value="" disabled selected>Pilih Kategori</option>
              <option value="article">Article</option>
              <option value="news">News</option>
              <option value="proker">Program Kerja</option>
            </select>
          </div>

          <!-- Judul -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Post</label>
            <input type="text" name="title" placeholder="Judul Post"
              class="w-full border border-green-300 rounded px-3 py-2 focus:ring-green-500 focus:outline-none" required />
          </div>
        </div>

        <!-- Upload Gambar -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar</label>
          <input type="file" name="image" accept="image/*"
            class="w-full border border-green-300 rounded px-3 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-green-100 file:text-green-700 hover:file:bg-green-200" />
        </div>

        <!-- Editor Konten -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Isi Konten</label>
          <textarea name="content" id="editorContent" rows="10" placeholder="Tulis isi artikel atau berita di sini..."></textarea>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end gap-2 border-t pt-4">
          <a href="{{ route('Index.ManajemenPost.SA') }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded transition">Batal</a>
          <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded transition">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  const modalTambah = document.getElementById('modalTambah');

  // Saat modal toggle aktif, inisialisasi TinyMCE
  document.querySelectorAll('[data-modal-toggle="modalTambah"]').forEach(button => {
    button.addEventListener('click', () => {
      setTimeout(() => {
        if (tinymce.get('editorContent')) {
          tinymce.get('editorContent').remove(); // destroy instance dulu
        }
        tinymce.init({
          selector: '#editorContent',
          height: 450,
          menubar: false,
          plugins: ['lists', 'wordcount', 'autocorrect', 'typography'],
          toolbar: 'undo redo | fontfamily fontsize | bold italic underline | alignleft aligncenter alignright | bullist numlist | removeformat',
          branding: false,
          contextmenu: false,
          paste_as_text: true, 
          paste_data_images: false,
          paste_data_images: false,
          automatic_uploads: false,
          file_picker_callback: () => false,
          images_upload_handler: () => false
        });
      }, 300); // beri delay agar modal muncul dulu
    });
  });
</script>
