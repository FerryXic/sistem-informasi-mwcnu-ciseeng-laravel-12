<x-user.main>
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 lg:px-6">
      <div class="grid md:grid-cols-12 gap-8">

        <!-- Konten Utama -->
        <div class="md:col-span-8">

          <!-- Breadcrumb -->
          <nav class="text-sm text-gray-500 mb-6 space-x-1">
            <a href="{{ url('/') }}" class="hover:underline">Beranda</a> /
            <a href="{{ route('Index.Post') }}" class="hover:underline">Artikel & Berita</a> /
            <span class="text-gray-700">{{ Str::limit($post->title, 50) }}</span>
          </nav>

          <!-- Judul -->
          <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-snug mb-6">
            {{ $post->title }}
          </h1>

          <!-- Meta Info -->
          <div class="flex flex-wrap items-center justify-between text-sm text-gray-500 mb-8">
            <div class="flex items-center gap-2">
                <span>
                    Author : {{ $post->user->name ?? 'Penulis Tidak Diketahui' }}
                </span>
            </div>
            <span><i class="far fa-clock mr-1"></i>{{ $post->created_at->format('d M Y, H:i') }}</span>
          </div>

          <!-- Gambar -->
          @if($post->image)
          <div class="mb-8 rounded-lg overflow-hidden shadow-lg">
            <img src="{{ asset('storage/posts/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover">
          </div>
          @endif

          <!-- Konten -->
          <div class="prose prose-green max-w-none text-gray-800 leading-relaxed mb-12">
            {!! $post->content !!}
          </div>

          <!-- Bagikan -->
          <div class="border-t pt-6 mt-8">
            <h4 class="text-base font-semibold mb-3 text-gray-700">Bagikan Artikel:</h4>
            <div class="flex gap-3">
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                 target="_blank"
                 class="text-blue-600 hover:text-blue-800 transition"><i class="fab fa-facebook"></i> Facebook</a>

              <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}&text={{ urlencode($post->title) }}"
                 target="_blank"
                 class="text-sky-500 hover:text-sky-700 transition"><i class="fab fa-twitter"></i> Twitter</a>

              <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . Request::fullUrl()) }}"
                 target="_blank"
                 class="text-green-500 hover:text-green-700 transition"><i class="fab fa-whatsapp"></i> WhatsApp</a>
            </div>
          </div>

        </div>

        <!-- Sidebar -->
        <div class="md:col-span-4 hidden md:block">
          <div class="bg-gray-50 border rounded-lg p-5 shadow sticky top-24">
            <h3 class="text-lg font-bold text-green-700 mb-4 flex items-center gap-2">
              <i class="fas fa-bookmark text-green-500"></i> Topik Serupa
            </h3>

            @forelse($relatedPosts as $related)
            <a href="{{ route('Index.Post', ['title' => $related->title]) }}" class="block mb-4">
              <div class="flex items-center gap-3 hover:bg-green-50 p-2 rounded transition">
                <img src="{{ $related->image ? asset('assets/img/posts/' . $related->image) : 'https://via.placeholder.com/80' }}"
                     alt="{{ $related->title }}" class="w-14 h-14 object-cover rounded border">
                <div class="text-sm text-gray-700">
                  <p class="font-medium leading-snug">{{ Str::limit($related->title, 50) }}</p>
                  <small class="text-gray-500"><i class="far fa-clock mr-1"></i>{{ $related->created_at->format('d M Y') }}</small>
                </div>
              </div>
            </a>
            @empty
              <p class="text-sm text-gray-500 italic">Tidak ada topik serupa.</p>
            @endforelse
          </div>
        </div>

      </div>
    </div>
  </section>
</x-user.main>
