<x-super-admin.main>

        <!-- Ringkasan Kartu -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-xl border border-green-100 shadow-sm hover:shadow-lg transition group">
        <div class="flex items-center justify-between">
            <div>
            <h2 class="text-sm text-gray-500 group-hover:text-green-700 transition">Total Pengguna</h2>
            <p class="text-3xl font-bold text-green-700 mt-1">{{ number_format($users,0, ',', '.') }}</p>
            </div>
            <div class="bg-green-100 text-green-700 p-3 rounded-full">
            <i class="fas fa-users"></i>
            </div>
        </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-yellow-100 shadow-sm hover:shadow-lg transition group">
        <div class="flex items-center justify-between">
            <div>
            <h2 class="text-sm text-gray-500 group-hover:text-yellow-700 transition">Jumlah Artikel </h2>
            <p class="text-3xl font-bold text-yellow-600 mt-1">{{ number_format($artikel,0, ',', '.') ?? 0 }}</p>
            </div>
            <div class="bg-yellow-100 text-yellow-700 p-3 rounded-full">
            <i class="fas fa-file-alt"></i>
            </div>
        </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-blue-100 shadow-sm hover:shadow-lg transition group">
        <div class="flex items-center justify-between">
            <div>
            <h2 class="text-sm text-gray-500 group-hover:text-blue-700 transition">Jumlah Berita</h2>
            <p class="text-3xl font-bold text-blue-600 mt-1">{{ number_format($berita,0, ',', '.') ?? 0 }}</p>
            </div>
            <div class="bg-blue-100 text-blue-700 p-3 rounded-full">
            <i class="fas fa-check-circle"></i>
            </div>
        </div>
        </div>
    </div>

<!-- Aktivitas Terbaru -->
<section>
  <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
    <i class="fas fa-bullhorn text-green-600"></i> Aktivitas Terbaru
  </h3>

  <ul class="space-y-3">

    <!-- CREATE -->
    @if ($store)
    <li class="bg-white px-4 py-3 rounded-lg shadow text-gray-700 border-l-4 border-green-500 flex items-start gap-3">
      <i class="fas fa-plus-circle text-green-500 text-lg mt-1"></i>
      <div>
        <span class="italic block">{{ $store->value }}</span>
        <small class="text-gray-500 text-xs block mt-1">
          {{ $store->created_at->format('d M Y, H:i') }}
        </small>
      </div>
    </li>
    @endif

    <!-- UPDATE -->
    @if ($update)
    <li class="bg-white px-4 py-3 rounded-lg shadow text-gray-700 border-l-4 border-yellow-500 flex items-start gap-3">
      <i class="fas fa-edit text-yellow-500 text-lg mt-1"></i>
      <div>
        <span class="italic block">{{ $update->value }}</span>
        <small class="text-gray-500 text-xs block mt-1">
          {{ $update->created_at->format('d M Y, H:i') }}
        </small>
      </div>
    </li>
    @endif

    <!-- DELETE -->
    @if ($delete)
    <li class="bg-white px-4 py-3 rounded-lg shadow text-gray-700 border-l-4 border-red-500 flex items-start gap-3">
      <i class="fas fa-trash-alt text-red-500 text-lg mt-1"></i>
      <div>
        <span class="italic block">{{ $delete->value }}</span>
        <small class="text-gray-500 text-xs block mt-1">
          {{ $delete->created_at->format('d M Y, H:i') }}
        </small>
      </div>
    </li>
    @endif

  </ul>

  <!-- Tombol Lihat Semua -->
  <div class="mt-4 text-right">
    <a href="{{ route('Index.Aktivitas.SA') }}"
       class="inline-flex items-center text-sm text-green-600 hover:underline hover:text-green-700 transition">
      Lihat Semua Aktivitas
      <i class="fas fa-arrow-right ml-1"></i>
    </a>
  </div>
</section>



</x-super-admin.main>