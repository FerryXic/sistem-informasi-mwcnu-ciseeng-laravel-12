<x-admin.main>

  <!-- Header & Tombol Tambah -->
  <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
    <h2 class="text-2xl font-semibold text-green-800">Manajemen Post</h2>

    @include('Admin.ManajemenPost.Create')

    <!-- Elemen Search Otomatis -->
    <input
      type="text"
      id="searchInput"
      placeholder="Cari Kategori / Judul"
      value="{{ request('q') }}"
      class="px-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-sm w-full sm:w-64"
    />
  </div>

  <!-- Tempat Render Data -->
  <div id="dataContainer">
    @include('Admin.ManajemenPost.Read')
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

        fetch(`{{ route('Index.ManajemenPost.A') }}?q=${encodeURIComponent(keyword)}`, {
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
          .then(response => response.text())
          .then(html => {
            dataContainer.innerHTML = html;
          });
      }, 300);
    });
  </script>

</x-admin.main>
