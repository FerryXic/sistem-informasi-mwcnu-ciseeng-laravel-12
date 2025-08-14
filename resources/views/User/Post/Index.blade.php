<x-user.main>
  {{-- SECTION: Artikel & Berita --}}
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">

      <!-- Heading -->
      <div class="mb-12 text-center">
        <h2 class="text-3xl font-extrabold text-green-800 mb-2">Artikel & Berita</h2>
        <p class="text-gray-600 text-sm">Temukan informasi terbaru seputar kegiatan, dakwah, dan kabar menarik lainnya.</p>
      </div>

      <!-- Search Bar -->
      <form method="GET" action="{{ route('Index.Post') }}" class="mb-10 max-w-2xl mx-auto">
        <div class="relative">
          <input type="text" name="q" value="{{ request('q') }}"
            class="w-full border border-green-300 rounded-full py-3 px-5 pr-12 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none"
            placeholder="Cari artikel & berita berdasarkan judul, kategori, atau penulis...">
          <button type="submit"
            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-green-600 hover:text-green-800">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>

      <!-- Katalog Artikel -->
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($posts as $post)
        <a href="{{ route('Show.Post', $post->title) }}">
          <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition-all duration-300 group">
            <!-- Gambar -->
            <div class="h-48 overflow-hidden">
              <img src="{{ $post->image 
    ? asset('storage/posts/' . $post->image) 
    : 'https://via.placeholder.com/600x300?text=No+Image' }}"
    alt="{{ $post->title }}"
    class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300">

            </div>

            <!-- Konten -->
            <div class="p-5 space-y-3">
              <h4 class="text-lg font-semibold text-gray-900 leading-snug hover:text-green-600 transition">
                {{ Str::limit($post->title, 90) }}
              </h4>
              <p class="text-sm text-gray-600 leading-relaxed">
                {{ Str::limit(strip_tags($post->content), 80) }}
              </p>

              <!-- Meta Info -->
              <div class="flex items-center justify-between text-xs text-gray-500 mt-3">
                <div class="flex items-center gap-2">
                  <img src="https://unusia.ac.id/assets/frontend/images/user.png" alt="Author"
                    class="w-5 h-5 rounded-full">
                  <span>{{ $post->user->name ?? 'Unknown' }}</span>
                </div>
                <span><i class="far fa-clock mr-1"></i>{{ $post->created_at->format('d M Y') }}</span>
              </div>
            </div>
          </div>
        </a>
        @empty
        <p class="text-center col-span-3 text-gray-500">Tidak ada artikel atau berita ditemukan.</p>
        @endforelse
      </div>

      <!-- Tombol Lihat Lainnya (Pagination) -->
      @if ($posts->hasPages())
      <div class="mt-12 text-center">
        {{ $posts->links('vendor.pagination.tailwind') }}
      </div>
      @endif

    </div>
  </section>
</x-user.main>
