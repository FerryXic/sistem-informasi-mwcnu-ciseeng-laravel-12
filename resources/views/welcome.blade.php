<x-user.welcome>
  <!-- Artikel & Berita -->
  <section id="artikel-dan-berita" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
      <h3 class="text-3xl font-extrabold text-center text-green-800 mb-12">
        Artikel & Berita
      </h3>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-3">
        @forelse($posts as $post)
        <a href="{{ route('Show.Post', $post->title) }}">
          <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 group">
            <!-- Image -->
            <div class="w-full h-48 overflow-hidden">
              <img 
                src="{{ $post->image ? asset('storage/posts/' . $post->image) : 'https://via.placeholder.com/600x300?text=No+Image' }}" 
                alt="{{ $post->title }}" 
                class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300"
              >
            </div>

            <!-- Content -->
            <div class="p-5 space-y-3">
              <h4 class="text-lg font-semibold text-gray-900 leading-snug hover:text-green-600 transition">
                {{ Str::limit($post->title, 90) }}
              </h4>

              {{-- Optional ringkasan isi artikel --}}
              <p class="text-sm text-gray-600 leading-relaxed">
                {{ Str::limit(strip_tags($post->content), 80) }}
              </p>

              <div class="flex items-center justify-between text-xs text-gray-500 mt-3">
                <div class="flex items-center gap-2">
                  <span>{{ $post->user->name ?? 'Unknown' }}</span>
                </div>
                <span><i class="far fa-clock mr-1"></i>{{ $post->created_at->format('d M Y') }}</span>
              </div>
            </div>
          </div>
        </a>
        @empty
          <p class="text-center col-span-3 text-gray-500">Tidak ada artikel atau berita tersedia.</p>
        @endforelse
      </div>

      <!-- Tombol Lihat Lainnya -->
      <div class="mt-10 text-center">
        <a href="{{ route('Index.Post') }}" 
           class="inline-block px-6 py-3 bg-green-600 text-white text-sm rounded-full shadow hover:bg-green-700 transition">
          Lihat Selengkapnya
        </a>
      </div>
    </div>
  </section>
</x-user.welcome>
