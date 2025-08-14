<!-- Hero Section -->
<section id="hero" class="relative min-h-screen bg-gray-900 text-white flex items-center justify-center -mt-16 pt-16">
  <!-- Background Image -->
  <div class="absolute inset-0">
    <img src="{{ asset('assets/img/home.jpeg') }}" alt="MWC NU Ciseeng" class="w-full h-full object-cover brightness-50" />
  </div>

  <!-- Overlay Content -->
  <div class="relative z-10 px-6 text-center max-w-3xl">
    <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-4">
      Sistem Informasi <br>
      <span class="text-green-500">MWC NU Ciseeng</span>
    </h1>
    <p class="text-base md:text-lg text-gray-200 mb-6">
      Situs Resmi MWCNU Ciseeng - Pusat Informasi Kegiatan Sosial, <br>
      Keagamaan, dan Kemasyarakatan Warga Kecamatan Ciseeng.
    </p>

    <div class="flex flex-col sm:flex-row justify-center gap-4">
      <a href="{{ route('Index.Post') }}"
         class="bg-green-500 hover:bg-green-400 text-white px-6 py-3 rounded-lg font-semibold transition shadow">
        TEMUKAN INFORMASI TERBARU
      </a>
    </div>
  </div>
</section>
