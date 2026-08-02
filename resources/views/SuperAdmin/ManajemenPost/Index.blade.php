<x-super-admin.main>

  <!-- Header & Tombol Tambah -->
  <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
      <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Post</h2>
      <p class="text-sm text-slate-500 mt-1">Kelola artikel, berita, dan program kerja di sini.</p>
    </div>

    <div class="flex flex-col sm:flex-row items-center gap-3">
      <!-- Elemen Search Otomatis -->
      <div class="relative w-full sm:w-64">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <i class="fas fa-search text-slate-400"></i>
        </div>
        <input
          type="text"
          id="searchInput"
          placeholder="Cari Post..."
          value="{{ request('q') }}"
          class="bg-white border border-slate-200 text-slate-700 text-sm rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5 shadow-sm transition-all"
        />
      </div>

      @include('SuperAdmin.ManajemenPost.Create')
    </div>
  </div>

  <!-- Tempat Render Data -->
  <div id="dataContainer">
    @include('SuperAdmin.ManajemenPost.Read')
  </div>

  <!-- Script AJAX Search -->
  <script>
    const searchInput = document.getElementById('searchInput');
    const dataContainer = document.getElementById('dataContainer');
    let timer;

    searchInput.addEventListener('input', function () {
      clearTimeout(timer);
      timer = setTimeout(() => {
        const keyword = this.value;

        fetch(`{{ route('Index.ManajemenPost.SA') }}?q=${encodeURIComponent(keyword)}`, {
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
          .then(response => response.text())
          .then(html => {
            dataContainer.innerHTML = html;
          });
      }, 300);
    });
  </script>

</x-super-admin.main>
