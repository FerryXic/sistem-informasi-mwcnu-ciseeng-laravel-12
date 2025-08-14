<!-- TABEL (Desktop) -->
<div class="hidden md:block">
  <div class="overflow-x-auto bg-white shadow-md rounded-xl border border-green-100">
    <table class="min-w-full text-sm text-green-900">
      <thead class="bg-green-50 text-left text-green-700 text-xs uppercase tracking-wide">
        <tr>
          <th class="px-6 py-4">No</th>
          <th class="px-6 py-4">Tanggal</th>
          <th class="px-6 py-4">Kategori</th>
          <th class="px-6 py-4">Judul</th>
          <th class="px-6 py-4">Author</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-green-100">
        @forelse ($posts as $index => $post)
        <tr onclick='openEditModal(@json($post))' class="hover:bg-green-50 cursor-pointer transition">
          <td class="px-6 py-4">{{ $index + 1 }}</td>
          <td class="px-6 py-4">{{ $post->created_at->format('d M Y') }}</td>
          <td class="px-6 py-4">{{ $post->category }}</td>
          <td class="px-6 py-4 font-semibold">{{ $post->title }}</td>
          <td class="px-6 py-4">{{ $post->user->name ?? 'Unknown' }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- CARD (Mobile) -->
<div class="md:hidden space-y-4">
  @forelse ($posts as $post)
  <div onclick='openEditModal(@json($post))'
       class="bg-white shadow-md rounded-xl border border-green-100 p-4 cursor-pointer transition hover:bg-green-50">
    <div class="mb-2">
      <h3 class="text-base font-semibold text-green-800">{{ $post->title }}</h3>
      <p class="text-sm text-gray-600">
        <i class="fas fa-tags mr-2 text-green-600"></i>{{ $post->category }}
      </p>
    </div>
    <div class="text-sm text-gray-800 prose max-w-none mb-2">{!! Str::limit($post->content, 150, '...') !!}</div>
    <div class="text-sm text-gray-500">
      <i class="fas fa-user mr-1 text-green-600"></i>{{ $post->user->name ?? 'Unknown' }}
    </div>
  </div>
  @empty
  <p class="text-center text-gray-500">Belum ada data.</p>
  @endforelse
</div>

<!-- Modal Update & Delete -->
@include('SuperAdmin.ManajemenPost.Update')
@include('SuperAdmin.ManajemenPost.Delete')

<!-- TinyMCE CDN -->
<script src="https://cdn.tiny.cloud/1/e8yv2o3qz1yzmdtjw23z23hwxwjr03ex3y2758tviq7jw3ua/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<!-- SCRIPT -->
<script>
  // Init TinyMCE for edit
  tinymce.init({
          selector: '#editContent',
          height: 450,
          menubar: false,
          plugins: ['lists', 'wordcount', 'autocorrect', 'typography'],
          toolbar: 'undo redo | fontfamily fontsize | bold italic underline | alignleft aligncenter alignright | bullist numlist | removeformat',
          branding: false,
          contextmenu: false,
          paste_as_text: true, 
          paste_data_images: false,
          automatic_uploads: false,
          file_picker_callback: () => false,
          images_upload_handler: () => false,
        });

  function openEditModal(post) {
  document.getElementById('editTitle').value = post.title;
  document.getElementById('editCategory').value = post.category;
  tinymce.get('editContent').setContent(post.content || '');

  // Set TinyMCE content
  if (tinymce.get('editContent')) {
    tinymce.get('editContent').setContent(post.content || '');
  }

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
}


function openDeleteModal() {
  closeModal('modalEdit'); // tutup modal edit dulu
  document.getElementById('modalHapus').classList.remove('hidden');
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
