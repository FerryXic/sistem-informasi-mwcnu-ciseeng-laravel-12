@php
  $activeTab = request()->segment(2) ?? 'visi';
@endphp

<x-user.main>
<div class="max-w-7xl mt-10 mx-auto px-4 py-10">
  <div class="flex flex-col md:flex-row gap-8 items-start">
    
    <!-- Logo -->
    <div class="md:w-1/3 flex justify-center md:justify-start md:ml-10">
      <div class="bg-white rounded-xl shadow-md p-4 border border-gray-200">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo NU"
            class="w-80 h-80 object-contain mx-auto rounded-md" />
      </div>
    </div>

    <!-- Tabs dan Konten -->
    <div class="md:w-2/3 w-full">
      <!-- Tabs -->
      <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-4">
        <div class="flex flex-wrap divide-x divide-gray-200 text-sm font-semibold text-gray-600 text-center">
          @php
            $tabs = [
              'visi' => ['icon' => 'fas fa-bookmark', 'label' => 'Visi'],
              'misi' => ['icon' => 'fas fa-bullseye', 'label' => 'Misi'],
              'tujuan' => ['icon' => 'fas fa-star', 'label' => 'Tujuan'],
              'sejarah' => ['icon' => 'fas fa-user-clock', 'label' => 'Sejarah'],
            ];
          @endphp

          @foreach($tabs as $key => $tab)
            <a href="{{ route('Index.Profile', $key) }}"
              class="flex-1 px-4 py-3 transition-all duration-200 {{ $activeTab === $key 
                  ? 'bg-green-700 text-white shadow-inner' 
                  : 'hover:bg-green-50 text-gray-700' }}">
              <i class="{{ $tab['icon'] }} mr-2"></i>{{ $tab['label'] }}
            </a>
          @endforeach
        </div>
      </div>

      <!-- Tab Content -->
      <div class="bg-white border border-gray-200 rounded-lg shadow px-6 py-6">
        @if($activeTab === 'visi')
          <h2 class="text-xl font-bold text-green-800 mb-2">Visi</h2>
          <p class="text-gray-700 mb-4 leading-relaxed">Menjadi organisasi Islam Ahlussunnah Wal Jamaah An-Nahdliyah yang unggul dan berperan dalam penguatan umat.</p>
        
        @elseif($activeTab === 'misi')
          <h2 class="text-xl font-bold text-green-800 mb-2">Misi</h2>
          <ul class="list-disc list-inside text-gray-700 space-y-2">
            <li>Menyelenggarakan pendidikan yang bermutu, inovatif, responsif, dan berkarakter Aswaja.</li>
            <li>Menghasilkan kader NU yang berperan serta sebagai lokomotif peradaban.</li>
            <li>Mengembangkan penelitian dan teknologi berbasis keunggulan lokal dan nilai keislaman.</li>
            <li>Melaksanakan pengabdian kepada masyarakat untuk meningkatkan taraf hidup dan keimanan.</li>
          </ul>

        @elseif($activeTab === 'tujuan')
          <h2 class="text-xl font-bold text-green-800 mb-2">Tujuan</h2>
          <p class="text-gray-700 leading-relaxed">
            Mewujudkan cita-cita organisasi Nahdlatul Ulama melalui kaderisasi, pemberdayaan umat, dan pemantapan ajaran Ahlussunnah wal Jamaah.
          </p>

        @elseif($activeTab === 'sejarah')
          <h2 class="text-xl font-bold text-green-800 mb-2">Sejarah</h2>
          <p class="text-gray-700 leading-relaxed">
            Sejarah singkat MWC NU Kec. Ciseeng akan ditampilkan di sini. Silakan lengkapi konten sejarah sesuai narasi organisasi Anda.
          </p>
        @endif
      </div>

    </div>
  </div>
</div>
</x-user.main>
