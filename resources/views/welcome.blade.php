<x-user.welcome>
  <!-- Artikel & Berita -->
  <section id="artikel-dan-berita" class="py-24 bg-gray-50/50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-extrabold text-green-900 tracking-tight mb-4">
          Artikel & Berita
        </h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Ikuti kabar terbaru dan kegiatan-kegiatan terkini seputar MWC NU Ciseeng.</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
        <a href="{{ route('Show.Post', $post->title) }}">
          <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group border border-gray-100/50">
            <!-- Image -->
            <div class="w-full h-56 overflow-hidden relative bg-slate-100 flex items-center justify-center">
              <div class="absolute inset-0 bg-gray-900/10 group-hover:bg-transparent transition duration-300 z-10"></div>
              @if($post->image)
              <img src="{{ asset('storage/posts/' . $post->image) }}"
                   alt="{{ $post->title }}"
                   class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300"
                   onerror="this.outerHTML='<div class=\'w-full h-full bg-slate-100 flex flex-col items-center justify-center text-slate-400\'><i class=\'fas fa-image text-3xl mb-2\'></i><span class=\'text-xs font-medium\'>Media tidak tersedia</span></div>'">
              @else
              <div class="w-full h-full bg-slate-100 flex flex-col items-center justify-center text-slate-400">
                <i class="fas fa-image text-3xl mb-2"></i>
                <span class="text-xs font-medium">Media tidak tersedia</span>
              </div>
              @endif
            </div>

            <!-- Content -->
            <div class="p-5 space-y-3">
              <h4 class="text-lg font-semibold text-gray-900 leading-snug hover:text-green-600 transition">
                {{ Str::limit($post->title, 90) }}
              </h4>

              {{-- Optional ringkasan isi artikel --}}
              <p class="text-sm text-gray-600 leading-relaxed">
                {{ Str::limit(html_entity_decode(strip_tags($post->content)), 80) }}
              </p>

              <div class="flex items-center justify-between text-xs text-gray-500 mt-3">
                <div class="flex items-center gap-2">
                  <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xs font-bold">
                    <i class="fas fa-user"></i>
                  </div>
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
      <div class="mt-16 text-center">
        <a href="{{ route('Index.Post') }}" 
           class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-green-600 to-green-500 hover:from-green-500 hover:to-green-400 text-white font-medium rounded-full shadow-lg shadow-green-500/30 transition-all duration-300 hover:shadow-green-500/50 hover:-translate-y-0.5">
          Lihat Selengkapnya <i class="fas fa-arrow-right text-sm"></i>
        </a>
      </div>
    </div>
  </section>
</x-user.welcome>
