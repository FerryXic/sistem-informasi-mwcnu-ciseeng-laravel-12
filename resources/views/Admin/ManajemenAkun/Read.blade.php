<!-- TABEL (Desktop) -->
<div class="hidden md:block">
  <div class="overflow-x-auto bg-white shadow-md rounded-xl border border-green-100">
    <table class="min-w-full text-sm text-green-900">
      <thead class="bg-green-50 text-left text-green-700 text-xs uppercase tracking-wide">
        <tr>
          <th class="px-6 py-4">No</th>
          <th class="px-6 py-4">Nama</th>
          <th class="px-6 py-4">Email</th>
          <th class="px-6 py-4">Level</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-green-100">
        @forelse ($users as $index => $user)
        <tr onclick='openEditModal(@json($user))' class="hover:bg-green-50 cursor-pointer transition">
          <td class="px-6 py-4">{{ $index + 1 }}</td>
          <td class="px-6 py-4">{{ $user->name }}</td>
          <td class="px-6 py-4">{{ $user->email }}</td>
          <td class="px-6 py-4">
            <span class="inline-block px-2 py-1 text-xs rounded-full
              {{ $user->level == 1 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
              {{ $user->level == 1 ? 'Admin' : 'Superadmin' }}
            </span>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- CARD (Mobile) -->
<div class="md:hidden space-y-4">
  @forelse ($users as $user)
  <div onclick='openEditModal(@json($user))'
       class="bg-white shadow-md rounded-xl border border-green-100 p-4 cursor-pointer transition hover:bg-green-50">
    <div class="flex justify-between items-center mb-2">
      <div>
        <h3 class="text-base font-semibold text-green-800">{{ $user->name }}</h3>
        <p class="text-sm text-gray-700">
          <i class="fas fa-envelope mr-2 text-green-600"></i>{{ $user->email }}
        </p>
      </div>
      <span class="text-xs px-2 py-1 rounded-full
        {{ $user->level == 1 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
        {{ $user->level == 1 ? 'Admin' : 'Superadmin' }}
      </span>
    </div>
  </div>
  @empty
  <p class="text-center text-gray-500">Belum ada data.</p>
  @endforelse
</div>

@include('SuperAdmin.ManajemenAkun.Update')

@include('SuperAdmin.ManajemenAkun.Delete')

<!-- SCRIPT -->
<script>
  function openEditModal(user) {
    document.getElementById('editName').value = user.name;
    document.getElementById('editEmail').value = user.email;
    document.getElementById('editPassword').value = '';
    document.getElementById('editForm').action = `/super-admin/manajemen-akun/update/${user.id}`;
    document.getElementById('deleteForm').action = `/super-admin/manajemen-akun/destroy/${user.id}`;
    document.getElementById('modalEdit').classList.remove('hidden');
  }

  function openDeleteModal() {
    closeModal('modalEdit');
    document.getElementById('modalHapus').classList.remove('hidden');
  }

  function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
  }
</script>