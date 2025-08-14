@php
  use Illuminate\Support\Facades\DB;

  // Ambil semua periode dari tabel sk_items, urut dari terbaru ke terlama
  $periodeList = DB::table('sk_items')
    ->select('start_year', 'end_year')
    ->orderByDesc('start_year')
    ->get();
@endphp

<!-- Footer dengan Map Lebih Besar -->
<footer class="bg-gradient-to-br from-green-900 via-green-800 to-green-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!-- ===== HEADER ===== -->
        <div class="mb-10 text-center md:text-left">
            <h3 class="text-3xl md:text-4xl font-extrabold leading-tight tracking-tight">
                Majelis Wakil Cabang Nahdlatul Ulama
            </h3>
            <h3 class="text-xl md:text-2xl font-medium">
                Kecamatan Ciseeng, Kabupaten Bogor
            </h3>
        </div>

        <!-- ===== BODY ===== -->
        <div class="flex flex-col md:flex-row md:justify-between gap-10">

            <!-- Kolom Kiri (Alamat + Map) -->
            <div class="flex flex-col md:flex-row md:space-x-6 w-full md:w-3/5">

                <!-- Alamat & Kontak -->
                <div class="w-full md:w-2/5 space-y-4 pr-2">
                    <h4 class="text-lg font-semibold border-b border-white/30 pb-1">Alamat</h4>
                    <p class="text-sm text-white/80 leading-relaxed">
                        Sekretariat MWC NU Ciseeng<br>
                        Perumahan Panorama Bali Blok C,<br>
                        Desa Putat Nutug, Kecamatan Ciseeng,<br>
                        Kabupaten Bogor, Provinsi Jawa Barat,<br>
                        Kode Pos 16120
                    </p>

                    <h4 class="text-lg font-semibold border-b border-white/30 pb-1">Kontak</h4>
                    <ul class="text-sm text-white/80 space-y-1">
                        <li>
                            <i class="fas fa-phone mr-2 text-yellow-300"></i>
                            <a href="tel:08179001883" class="hover:text-yellow-400 transition">0817-9001-883</a>
                        </li>
                        <li>
                            <i class="fas fa-envelope mr-2 text-yellow-300"></i>
                            <a href="mailto:mwcnu.ciseeng@gmail.com" class="hover:text-yellow-400 transition">mwcnu.ciseeng@gmail.com</a>
                        </li>
                    </ul>
                </div>

                <!-- Map lebih besar -->
                <div class="w-full md:w-3/5 flex items-start">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d1765.979543612538!2d106.66952606712411!3d-6.459441206138284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMjcnMzEuOCJTIDEwNsKwNDAnMTQuNSJF!5e0!3m2!1sid!2sid!4v1754180492331!5m2!1sid!2sid"
                        width="100%"
                        height="320"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        class="rounded-xl shadow-2xl"
                        title="Lokasi MWC NU Ciseeng"
                        aria-label="Lokasi MWC NU Ciseeng pada peta">
                    </iframe>
                </div>
            </div>

            <!-- Kolom Kanan (Grid 2x2) -->
            <div class="grid grid-cols-2 gap-x-8 gap-y-5 w-full md:w-2/5 pl-1">

                <!-- Profil -->
                <div>
                    <h4 class="text-white font-semibold mb-2 border-b border-white/30 pb-1">Profil</h4>
                    <ul class="text-sm space-y-1 text-white/80">
                    <li><a href="{{ route('Index.Profile', ['section' => 'visi']) }}" class="hover:text-yellow-300 transition">Visi</a></li>
                    <li><a href="{{ route('Index.Profile', ['section' => 'misi']) }}" class="hover:text-yellow-300 transition">Misi</a></li>
                    <li><a href="{{ route('Index.Profile', ['section' => 'tujuan']) }}" class="hover:text-yellow-300 transition">Tujuan</a></li>
                    <li><a href="{{ route('Index.Profile', ['section' => 'sejarah']) }}" class="hover:text-yellow-300 transition">Sejarah</a></li>
                    </ul>
                </div>

                <!-- SK Kepengurusan -->
                <div>
                    <h4 class="text-white font-semibold mb-2 border-b border-white/30 pb-1">SK Kepengurusan</h4>
                    <ul class="text-sm space-y-1 text-white/80">
                    @forelse($periodeList as $periode)
                        <li>
                        <a href="{{ route('Index.Tupoksi.SK', ['periode' => \Carbon\Carbon::parse($periode->start_year)->year . '-' . \Carbon\Carbon::parse($periode->end_year)->year]) }}"
                            class="hover:text-yellow-300 transition">
                            {{ \Carbon\Carbon::parse($periode->start_year)->year }} - {{ \Carbon\Carbon::parse($periode->end_year)->year }}
                        </a>
                        </li>
                    @empty
                        <li class="italic text-gray-300">Belum ada data SK</li>
                    @endforelse
                    </ul>
                </div>

                <!-- Surat -->
                <div>
                    <h4 class="text-white font-semibold mb-2 border-b border-white/30 pb-1">Surat</h4>
                    <ul class="text-sm space-y-1 text-white/80">
                    <li><a href="{{ route('Index.Surat', ['tipe' => 'keluar']) }}" class="hover:text-yellow-300 transition">Surat Keluar</a></li>
                    <li><a href="{{ route('Index.Surat', ['tipe' => 'masuk']) }}" class="hover:text-yellow-300 transition">Surat Masuk</a></li>
                    </ul>

                    <!-- Sosmed -->
                    <div class="flex space-x-4 mt-4">
                    <a href="#" aria-label="Facebook" title="Facebook"><i class="fab fa-facebook text-lg hover:text-yellow-300 transition"></i></a>
                    <a href="#" aria-label="Instagram" title="Instagram"><i class="fab fa-instagram text-lg hover:text-yellow-300 transition"></i></a>
                    <a href="#" aria-label="YouTube" title="YouTube"><i class="fab fa-youtube text-lg hover:text-yellow-300 transition"></i></a>
                    <a href="#" aria-label="TikTok" title="TikTok"><i class="fab fa-tiktok text-lg hover:text-yellow-300 transition"></i></a>
                    </div>
                </div>

                <!-- Tupoksi -->
                <div>
                    <h4 class="text-white font-semibold mb-2 border-b border-white/30 pb-1">Tupoksi</h4>
                    <ul class="text-sm space-y-1 text-white/80">
                    <li><a href="{{ route('Index.Tupoksi.SK') }}" class="hover:text-yellow-300 transition">SK Kepengurusan</a></li>
                    <li><a href="{{ route('Index.Tupoksi.AdArt') }}" class="hover:text-yellow-300 transition">AD & ART</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-white/20 mt-10 pt-3 text-center text-sm text-white/70">
            &copy; {{ now()->year }} MWC NU Kec. Ciseeng. Seluruh Hak Cipta Dilindungi.
        </div>
    </div>
</footer>
