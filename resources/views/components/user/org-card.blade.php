@php
  $image = !empty($person['image']) ? asset('storage/' . $person['image']) : asset('assets/img/user-placeholder.png');
@endphp

<div class="bg-gray-100 rounded-lg overflow-hidden shadow text-center">
  <div class="p-6">
    <img src="{{ $image }}" alt="{{ $person['nama'] }}" class="w-24 h-24 mx-auto rounded-full object-cover border mb-3">
    <h3 class="text-green-900 font-semibold text-base">{{ $person['nama'] }}</h3>
  </div>
  <div class="bg-green-800 text-yellow-200 text-sm py-2 font-semibold">
    {{ $person['jabatan'] }}
  </div>
</div>
