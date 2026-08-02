<!-- MODAL EDIT POST -->
<div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
  <!-- Backdrop -->
  <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="closeModal('modalEdit')"></div>
  
  <!-- Modal Content -->
  <div class="relative w-full max-w-5xl bg-white rounded-2xl shadow-2xl border border-gray-100 flex flex-col max-h-[95vh] overflow-hidden transform transition-all z-10">

      <!-- Header -->
      <div class="flex justify-between items-center px-8 py-5 border-b bg-gradient-to-r from-green-600 to-green-500">
        <h3 class="text-xl font-bold text-white flex items-center gap-2"><i class="fas fa-edit"></i> Edit Post</h3>
        <button type="button" onclick="closeModal('modalEdit')" class="text-white hover:text-red-200 transition-colors">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>

      <!-- Edit Form -->
      <form id="editForm" method="POST" enctype="multipart/form-data" class="flex flex-col overflow-hidden h-full">
        @csrf
        @method('PUT')
        
        <!-- Scrollable Body -->
        <div class="px-8 py-6 space-y-6 overflow-y-auto flex-1 custom-scrollbar">

        <div class="grid md:grid-cols-2 gap-6">
          <!-- Kategori -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
            <select id="editCategory" name="category"
              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-shadow outline-none" required>
              <option value="article">Artikel</option>
              <option value="news">Berita</option>
              <option value="proker">Program Kerja</option>
            </select>
          </div>

          <!-- Judul -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Post</label>
            <input id="editTitle" type="text" name="title" placeholder="Masukkan judul..."
              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-shadow outline-none" required />
          </div>
        </div>

        <!-- Gambar Preview -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Saat Ini</label>
          <img id="editImagePreview" src="#" alt="Preview" class="h-32 rounded-lg border border-gray-200 hidden mb-3 shadow-sm">
        </div>

        <!-- Gambar Baru -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Baru (Opsional)</label>
          <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-4 hover:border-green-500 transition-colors bg-gray-50 flex items-center gap-4">
            <div class="p-3 bg-green-100 rounded-full text-green-600">
              <i class="fas fa-image text-xl"></i>
            </div>
            <input type="file" name="image" accept="image/*"
              class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer" />
          </div>
        </div>

        <!-- Konten -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Konten</label>
          <div class="border border-gray-200 rounded-xl overflow-hidden">
            <textarea id="editContent" name="content" rows="10" placeholder="Tulis isi artikel atau berita di sini..."></textarea>
          </div>
        </div>

        </div> <!-- End Scrollable Body -->

        <!-- Tombol (Fixed Footer) -->
        <div class="flex justify-between items-center px-8 py-4 border-t bg-gray-50 rounded-b-2xl">
          <button type="button" onclick="openDeleteModal()"
            class="bg-red-100 hover:bg-red-200 text-red-600 font-medium px-4 py-2.5 rounded-lg transition-colors flex items-center gap-2">
            <i class="fas fa-trash-alt"></i> Hapus
          </button>
          <div class="flex gap-3">
            <button type="button" onclick="closeModal('modalEdit')"
              class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium px-6 py-2.5 rounded-lg transition-colors">Batal</button>
            <button type="submit"
              class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2.5 rounded-lg shadow-lg shadow-green-500/30 transition-all hover:-translate-y-0.5">
              <i class="fas fa-save mr-1"></i> Update Post
            </button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>


