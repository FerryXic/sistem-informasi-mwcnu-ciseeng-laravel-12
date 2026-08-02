<!-- Tombol Tambah -->
<button type="button" onclick="openModalTambah()"
  class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition-all duration-200">
  <i class="fas fa-plus"></i> Post Baru
</button>

<!-- Modal Buat Post -->
<div id="modalTambah" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
  <!-- Backdrop -->
  <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeModal('modalTambah')"></div>
  
  <!-- Modal Content -->
  <div class="relative w-full max-w-5xl bg-white rounded-2xl shadow-2xl border border-gray-100 flex flex-col max-h-[95vh] overflow-hidden transform transition-all z-10">

      <!-- Header -->
      <div class="flex justify-between items-center px-8 py-5 border-b bg-gradient-to-r from-green-600 to-green-500">
        <h3 class="text-xl font-bold text-white flex items-center gap-2"><i class="fas fa-pen-nib"></i> Buat Post Baru</h3>
        <button type="button" onclick="closeModal('modalTambah')" class="text-white hover:text-red-200 transition-colors">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>

      <!-- Form -->
      <form action="{{ route('Store.ManajemenPost.SA') }}" method="POST" enctype="multipart/form-data" class="flex flex-col overflow-hidden h-full">
        @csrf
        
        <!-- Scrollable Body -->
        <div class="px-8 py-6 space-y-6 overflow-y-auto flex-1 custom-scrollbar">

        <div class="grid md:grid-cols-2 gap-6">
          <!-- Kategori -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
            <select name="category" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-shadow outline-none" required>
              <option value="" disabled selected>Pilih Kategori...</option>
              <option value="article">Artikel</option>
              <option value="news">Berita</option>
              <option value="proker">Program Kerja</option>
            </select>
          </div>

          <!-- Judul -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Post</label>
            <input type="text" name="title" placeholder="Masukkan judul..."
              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-shadow outline-none" required />
          </div>
        </div>

        <!-- Upload Gambar -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Cover</label>
          <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-4 hover:border-green-500 transition-colors bg-gray-50 flex items-center gap-4">
            <div class="p-3 bg-green-100 rounded-full text-green-600">
              <i class="fas fa-image text-xl"></i>
            </div>
            <input type="file" name="image" accept="image/*"
              class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer" />
          </div>
        </div>

        <!-- Editor Konten -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Konten</label>
          <div class="border border-gray-200 rounded-xl overflow-hidden">
            <textarea name="content" id="editorContent" rows="10" placeholder="Tulis isi artikel atau berita di sini..."></textarea>
          </div>
        </div>

        <!-- Tombol (Fixed Footer) -->
        <div class="flex justify-end gap-3 px-8 py-4 border-t bg-gray-50 rounded-b-2xl">
          <button type="button" onclick="closeModal('modalTambah')"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium px-6 py-2.5 rounded-lg transition-colors">Batal</button>
          <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2.5 rounded-lg shadow-lg shadow-green-500/30 transition-all hover:-translate-y-0.5">
            <i class="fas fa-save mr-1"></i> Simpan Post
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  const modalTambah = document.getElementById('modalTambah');

  // Fungsi untuk membuka modal tambah dan inisialisasi TinyMCE
  function openModalTambah() {
    document.getElementById('modalTambah').classList.remove('hidden');
    setTimeout(() => {
      if (tinymce.get('editorContent')) {
        tinymce.get('editorContent').remove(); // destroy instance dulu
      }
      tinymce.init({
        selector: '#editorContent',
        height: 450,
        menubar: false,
        plugins: ['lists', 'wordcount', 'link', 'image', 'table'],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image | removeformat',
        branding: false,
        contextmenu: false,
        paste_as_text: true, 
        paste_data_images: false,
        automatic_uploads: false,
        file_picker_callback: () => false,
        images_upload_handler: () => false
      });
    }, 300); // beri delay agar modal muncul dulu
  }
</script>
