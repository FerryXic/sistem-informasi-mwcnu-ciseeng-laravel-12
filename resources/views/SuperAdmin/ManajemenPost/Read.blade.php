<!-- TABEL (Desktop) -->
<div class="hidden md:block">
  <div class="overflow-x-auto bg-white shadow-sm border border-slate-200 rounded-2xl">
    <table class="min-w-full text-sm text-left">
      <thead class="bg-slate-50/50 text-slate-500 uppercase text-[11px] font-bold tracking-wider border-b border-slate-200">
        <tr>
          <th class="px-6 py-4 rounded-tl-2xl">No</th>
          <th class="px-6 py-4">Tanggal</th>
          <th class="px-6 py-4">Kategori</th>
          <th class="px-6 py-4">Judul</th>
          <th class="px-6 py-4">Author</th>
          <th class="px-6 py-4 rounded-tr-2xl text-center">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100 text-slate-700">
        @forelse ($posts as $index => $post)
        <tr onclick="openEditModal({{ $post->id }})" class="hover:bg-slate-50 cursor-pointer transition-colors group">
          <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ $post->created_at->format('d M Y') }}</td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
              {{ ucfirst($post->category) }}
            </span>
          </td>
          <td class="px-6 py-4 font-semibold text-slate-800 group-hover:text-green-600 transition-colors">{{ $post->title }}</td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center gap-2">
              <div class="w-6 h-6 rounded-full bg-green-200 flex items-center justify-center text-green-700 text-xs font-bold">
                {{ strtoupper(substr($post->user->name ?? 'U', 0, 1)) }}
              </div>
              {{ $post->user->name ?? 'Unknown' }}
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-center">
            <div class="flex items-center justify-center gap-2">
              <button type="button" onclick="event.stopPropagation(); openEditModal({{ $post->id }})" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition-colors tooltip-btn" title="Edit">
                <i class="fas fa-edit"></i>
              </button>
              <button type="button" onclick="event.stopPropagation(); setDeleteData({{ $post->id }}); openDeleteModal()" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors tooltip-btn" title="Hapus">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="px-6 py-12 text-center text-slate-500">
            <div class="flex flex-col items-center justify-center gap-2">
              <i class="fas fa-inbox text-3xl text-slate-300"></i>
              <p>Belum ada data post.</p>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- CARD (Mobile) -->
<div class="md:hidden space-y-4">
  @forelse ($posts as $post)
  <div onclick="openEditModal({{ $post->id }})"
       class="bg-white shadow-sm rounded-xl border border-slate-200 p-5 cursor-pointer transition-all hover:border-green-300 hover:shadow-md group">
    <div class="flex justify-between items-start mb-3">
      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
        {{ ucfirst($post->category) }}
      </span>
      <span class="text-xs text-slate-400 font-medium">{{ $post->created_at->format('d M Y') }}</span>
    </div>
    <h3 class="text-base font-bold text-slate-800 group-hover:text-green-600 transition-colors mb-2 leading-tight">{{ $post->title }}</h3>
    <div class="text-sm text-slate-600 line-clamp-2 mb-4 leading-relaxed">{!! strip_tags($post->content) !!}</div>
    <div class="flex items-center justify-between pt-3 border-t border-slate-100">
      <div class="flex items-center gap-2">
        <div class="w-6 h-6 rounded-full bg-green-200 flex items-center justify-center text-green-700 text-xs font-bold">
          {{ strtoupper(substr($post->user->name ?? 'U', 0, 1)) }}
        </div>
        <span class="text-xs font-medium text-slate-600">{{ $post->user->name ?? 'Unknown' }}</span>
      </div>
      <div class="flex items-center gap-2">
        <button type="button" onclick="event.stopPropagation(); openEditModal({{ $post->id }})" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition-colors">
          <i class="fas fa-edit"></i>
        </button>
        <button type="button" onclick="event.stopPropagation(); setDeleteData({{ $post->id }}); openDeleteModal()" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors">
          <i class="fas fa-trash"></i>
        </button>
      </div>
    </div>
  </div>
  @empty
  <div class="bg-white border border-slate-200 rounded-xl p-8 text-center text-slate-500">
    <i class="fas fa-inbox text-3xl text-slate-300 mb-2"></i>
    <p>Belum ada data post.</p>
  </div>
  @endforelse
</div>

<!-- Modal Update & Delete -->
@include('SuperAdmin.ManajemenPost.Update')
@include('SuperAdmin.ManajemenPost.Delete')

<!-- TinyMCE CDN -->
<script src="https://cdn.tiny.cloud/1/e8yv2o3qz1yzmdtjw23z23hwxwjr03ex3y2758tviq7jw3ua/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<!-- SCRIPT -->
<script>
  const postsData = @json($posts->keyBy('id'));

  function openEditModal(postId) {
  const post = postsData[postId];
  
  document.getElementById('editTitle').value = post.title;
  document.getElementById('editCategory').value = post.category;
  document.getElementById('editContent').value = post.content || '';

  // Gambar preview
  if (post.image) {
    document.getElementById('editImagePreview').src = `/storage/posts/${post.image}`;
    document.getElementById('editImagePreview').classList.remove('hidden');
  } else {
    document.getElementById('editImagePreview').classList.add('hidden');
  }

  // Set action form
  document.getElementById('editForm').action = `/super-admin/manajemen-post/update/${post.id}`;
  document.getElementById('deleteForm').action = `/super-admin/manajemen-post/destroy/${post.id}`;
  document.getElementById('modalEdit').classList.remove('hidden');

  // Inisialisasi TinyMCE setelah modal terbuka
  setTimeout(() => {
    if (tinymce.get('editContent')) {
      tinymce.get('editContent').remove();
    }
    tinymce.init({
      selector: '#editContent',
      height: 450,
      menubar: false,
      plugins: ['lists', 'wordcount', 'link', 'image', 'table'],
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image | removeformat',
      branding: false,
      contextmenu: false,
      paste_data_images: false,
      automatic_uploads: false,
      file_picker_callback: () => false,
      images_upload_handler: () => false,
      setup: function (editor) {
        editor.on('init', function () {
          editor.setContent(post.content || '');
        });
      }
    });
  }, 300);
}


function openDeleteModal() {
  closeModal('modalEdit'); // tutup modal edit dulu
  document.getElementById('modalHapus').classList.remove('hidden');
}

function setDeleteData(id) {
  document.getElementById('deleteForm').action = `/super-admin/manajemen-post/destroy/${id}`;
}

function closeModal(id) {
  document.getElementById(id).classList.add('hidden');
}


  function previewImage(event, previewId) {
    const reader = new FileReader();
    reader.onload = function () {
      const output = document.getElementById(previewId);
      output.src = reader.result;
      output.classList.remove('hidden');
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>
