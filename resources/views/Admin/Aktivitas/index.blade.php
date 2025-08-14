<x-admin.main>

  <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
    <i class="fas fa-list text-green-600"></i> Semua Aktivitas
  </h3>

  <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
    @forelse ($activities as $activity)

      @php
        $borderColor = match ($activity->method) {
            'store' => 'border-green-500',
            'update' => 'border-yellow-500',
            'delete' => 'border-red-500',
            default => 'border-gray-300',
        };

        $icon = match ($activity->method) {
            'store' => ['fas fa-plus-circle', 'text-green-500'],
            'update' => ['fas fa-edit', 'text-yellow-500'],
            'delete' => ['fas fa-trash-alt', 'text-red-500'],
            default => ['fas fa-info-circle', 'text-gray-500'],
        };
      @endphp

      <div class="bg-white shadow rounded-lg border-l-4 {{ $borderColor }} p-4 flex items-start gap-3">

        <!-- Icon -->
        <div>
          <i class="{{ $icon[0] }} {{ $icon[1] }} text-xl mt-1"></i>
        </div>

        <!-- Content -->
        <div>
          <p class="text-sm text-gray-700 italic mb-1">{{ $activity->value }}</p>
          <small class="text-gray-500 text-xs">{{ $activity->created_at->format('d M Y, H:i') }}</small>
        </div>

      </div>

    @empty
      <p class="text-gray-500 text-sm">Belum ada aktivitas yang tercatat.</p>
    @endforelse
  </div>

</x-admin.main>
