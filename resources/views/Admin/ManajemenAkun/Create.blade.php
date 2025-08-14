<!-- Tombol Tambah -->
<button data-modal-target="modalTambah" data-modal-toggle="modalTambah"
  class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition-all duration-200">
  <i class="fas fa-user-plus"></i> Tambah Admin
</button>

<!-- Modal Tambah Admin -->
<div id="modalTambah" tabindex="-1" class="hidden fixed inset-0 z-50 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen px-4">
    <div class="relative bg-white rounded-lg shadow-md w-full max-w-md">
      <div class="flex justify-between items-center px-4 py-3 border-b">
        <h3 class="text-lg font-semibold text-green-800">Tambah Admin</h3>
        <button class="text-gray-400 hover:text-red-600" data-modal-hide="modalTambah">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <form action="{{ route('Store.ManajemenAkun.SA') }}" method="POST" class="p-4 space-y-4">
        @csrf
        <!-- Nama -->
        <input type="text" name="name" placeholder="Nama Lengkap" class="w-full border border-green-200 rounded px-3 py-2" required />

        <!-- Email -->
        <input type="email" name="email" placeholder="Email" class="w-full border border-green-200 rounded px-3 py-2" required />

        <!-- Password + Toggle -->
        <div class="relative">
          <input type="password" name="password" placeholder="Password" id="passwordInput" class="w-full border border-green-200 rounded px-3 py-2 pr-10" required />
          <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
            <i id="toggleIcon" class="fas fa-eye"></i>
          </button>
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end pt-2">
          <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Script Toggle Password -->
<script>
  function togglePassword() {
    const input = document.getElementById('passwordInput');
    const icon = document.getElementById('toggleIcon');
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  }
</script>
