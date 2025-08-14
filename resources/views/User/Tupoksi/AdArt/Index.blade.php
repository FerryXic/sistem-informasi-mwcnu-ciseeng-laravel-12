<x-user.main>

<div class="max-w-5xl mx-auto px-4 py-10">

  <div class="text-center mb-8">
    <h1 class="text-3xl font-bold text-green-800">Ad-Art</h1>
    <p class="text-gray-600 mt-2">Berikut adalah dokumen resmi Ad-Art MWC NU Kecamatan Ciseeng.</p>
  </div>

  @if($AdArt)
    <div class="text-center mb-6">
      <a href="{{ asset('storage/AdArt/' . $AdArt->pdf) }}" target="_blank"
        class="inline-flex items-center gap-2 px-6 py-3 bg-green-700 hover:bg-green-800 text-white rounded-md shadow transition">
        <i class="fas fa-file-download"></i> Unduh PDF Ad-Art
      </a>
    </div>

    <div class="flex justify-center">
      <img src="{{ asset('storage/AdArt/' . $AdArt->gambar) }}"
        alt="Gambar SK"
        class="rounded-lg shadow-md border border-gray-300 w-full max-w-3xl object-contain" />
    </div>
  @else
    <div class="text-center text-gray-500 italic mt-10">
      Data SK belum tersedia.
    </div>
  @endif

</div>

</x-user.main>
