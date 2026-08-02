<!-- Hero Section -->
<section id="hero" class="relative min-h-screen bg-gray-900 text-white flex items-center justify-center pt-[76px] overflow-hidden">
  <!-- Background Image -->
  <div class="absolute inset-0">
    <img src="{{ asset('assets/img/home.jpeg') }}" alt="MWC NU Ciseeng" class="w-full h-full object-cover" />
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/70 to-transparent"></div>
    <div class="absolute inset-0 bg-green-900/20 mix-blend-multiply"></div>
  </div>

  <!-- Overlay Content -->
  <div class="relative z-10 px-6 text-center max-w-4xl mx-auto flex flex-col items-center animate-fade-in-up">
    <div class="inline-block mb-4 px-4 py-1.5 rounded-full bg-green-500/20 border border-green-500/30 backdrop-blur-md">
      <span class="text-white font-medium text-sm tracking-wide uppercase">Selamat Datang di Portal Resmi</span>
    </div>
    
    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6 tracking-tight">
      Sistem Informasi <br>
      <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-300">MWC NU Ciseeng</span>
    </h1>
    
    <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-2xl font-light">
      Pusat informasi dan layanan digital untuk seluruh kegiatan sosial, 
      keagamaan, serta kemasyarakatan warga Kecamatan Ciseeng.
    </p>

    <div class="flex flex-col sm:flex-row justify-center gap-4 w-full sm:w-auto">
      <a href="{{ route('Index.Post') }}"
         class="group relative px-8 py-4 bg-gradient-to-r from-green-600 to-green-500 hover:from-green-500 hover:to-green-400 text-white rounded-full font-semibold transition-all duration-300 shadow-[0_0_20px_rgba(34,197,94,0.4)] hover:shadow-[0_0_30px_rgba(34,197,94,0.6)] hover:-translate-y-1">
        <span class="flex items-center justify-center gap-2">
          TEMUKAN INFORMASI TERBARU
          <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
        </span>
      </a>
    </div>
  </div>
</section>

<style>
  @keyframes fade-in-up {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  .animate-fade-in-up {
    animation: fade-in-up 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
  }
</style>
