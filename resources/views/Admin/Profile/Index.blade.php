<x-admin.main>

  <!-- Card Profile -->
  <div class="w-full max-w-xl mx-auto bg-white shadow-md rounded-xl border border-green-100 p-6 space-y-4 mb-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-4 sm:space-y-0">
      <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center self-center sm:self-auto">
        <i class="fas fa-user text-green-600 text-2xl"></i>
      </div>
      <div class="text-center sm:text-left">
        <h2 class="text-lg font-semibold text-green-800 break-words">{{ $user->name }}</h2>
        <p class="text-sm text-gray-600 break-all">{{ $user->email }}</p>
      </div>
    </div>

    <!-- Informasi Tambahan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <h3 class="text-xs text-gray-500 uppercase mb-1">Level</h3>
        <span class="inline-block px-2 py-1 text-xs rounded-full
          {{ $user->level == 1 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
          {{ $user->level == 1 ? 'Admin' : 'Superadmin' }}
        </span>
      </div>

      <div>
        <h3 class="text-xs text-gray-500 uppercase mb-1">Tanggal Bergabung</h3>
        <p class="text-sm text-gray-700">
          {{ $user->created_at->translatedFormat('d F Y') }}
        </p>
      </div>
    </div>
  </div>

  <!-- Card Form Update -->
  <div class="w-full max-w-xl mx-auto bg-white shadow-md rounded-xl border border-green-100 p-6 space-y-4">
    <h3 class="text-lg font-semibold text-green-800 mb-2 text-center sm:text-left">Update Data Akun</h3>

    <form action="{{ route('Update.Profile.A') }}" method="POST" class="space-y-4">
      @csrf
      @method('PUT')

      <div>
        <label class="block text-sm text-gray-700 mb-1">Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}"
          class="w-full border border-green-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>

      <div>
        <label class="block text-sm text-gray-700 mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}"
          class="w-full border border-green-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>

      <div>
        <label class="block text-sm text-gray-700 mb-1">Password Baru <span class="text-xs text-gray-400">(Opsional)</span></label>
        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah"
          class="w-full border border-green-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" />
      </div>

      <div class="pt-2 text-center sm:text-right">
        <button type="submit"
          class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded transition w-full sm:w-auto">Update Akun</button>
      </div>
    </form>
  </div>

</x-admin.main>
