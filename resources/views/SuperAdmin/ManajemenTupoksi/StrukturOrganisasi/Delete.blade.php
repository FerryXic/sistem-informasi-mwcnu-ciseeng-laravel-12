<!-- Tombol Delete -->
<button
  data-modal-target="modalDelete-{{ $data['id'] }}"
  data-modal-toggle="modalDelete-{{ $data['id'] }}"
  class="text-red-500 hover:text-red-700"
  title="Hapus"
>
  <i class="fas fa-trash-alt"></i>
</button>

<!-- Modal Konfirmasi Hapus -->
<div id="modalDelete-{{ $data['id'] }}"
     tabindex="-1"
     class="modal-wrapper hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm items-center justify-center">
  <div class="bg-white rounded-lg shadow-md w-full max-w-md p-6 text-center animate-slide-in">
    <h3 class="text-lg font-semibold text-red-600 mb-4">Konfirmasi Hapus</h3>
    <p class="text-gray-700 mb-6">Apakah Anda yakin ingin menghapus <strong>{{ $data['full_name'] }}</strong>?</p>

    <form action="{{ route('Delete.StrukturOrganisasi.SA', $data['id']) }}" method="POST" class="flex justify-center gap-3">
      @csrf
      @method('DELETE')

      <button type="button"
              data-modal-hide="modalDelete-{{ $data['id'] }}"
              class="px-4 py-2 border border-gray-400 text-gray-600 hover:bg-gray-200 rounded">
        Batal
      </button>
      <button type="submit"
              class="px-5 py-2 bg-red-600 text-white hover:bg-red-700 rounded">
        Hapus
      </button>
    </form>
  </div>
</div>

<!-- Style Animasi -->
<style>
  @keyframes slide-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .animate-slide-in {
    animation: slide-in 0.25s ease-out;
  }

  .modal-wrapper {
    display: none;
  }

  .modal-wrapper.flex {
    display: flex !important;
  }
</style>

<!-- Script Toggle Modal -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modalToggles = document.querySelectorAll('[data-modal-toggle]');
    const modalHides = document.querySelectorAll('[data-modal-hide]');

    modalToggles.forEach(btn => {
      btn.addEventListener('click', () => {
        const targetId = btn.getAttribute('data-modal-target');
        const modal = document.getElementById(targetId);
        if (modal) {
          modal.classList.remove('hidden');
          modal.classList.add('flex');
        }
      });
    });

    modalHides.forEach(btn => {
      btn.addEventListener('click', () => {
        const targetId = btn.getAttribute('data-modal-hide');
        const modal = document.getElementById(targetId);
        if (modal) {
          modal.classList.add('hidden');
          modal.classList.remove('flex');
        }
      });
    });
  });
</script>
