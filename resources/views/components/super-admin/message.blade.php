@if (session('success'))
    <script>
        Swal.fire({
            html: `
                <div class="text-green-700 text-3xl mb-2"><i class="fas fa-circle-check"></i></div>
                <h2 class="text-xl font-bold mb-1">Berhasil</h2>
                <p class="text-sm text-gray-600">{{ session('success') }}</p>
            `,
            background: "#f0fdf4",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            customClass: {
                popup: 'rounded-2xl px-8 py-6 shadow-xl border border-green-200',
            },
            didOpen: () => {
                const popup = Swal.getPopup();
                popup.style.fontFamily = `'Merriweather Sans', sans-serif`;
            }
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            html: `
                <div class="text-red-600 text-3xl mb-2"><i class="fas fa-circle-xmark"></i></div>
                <h2 class="text-xl font-semibold mb-1">Ups, Terjadi Kesalahan</h2>
                <p class="text-sm text-gray-600">{{ session('error') }}</p>
            `,
            background: "#fff1f2",
            confirmButtonText: '<i class="fas fa-arrow-left mr-1"></i> OK',
            confirmButtonColor: "#e11d48",
            customClass: {
                popup: 'rounded-2xl px-8 py-6 shadow-xl border border-red-200',
                confirmButton: 'text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg font-medium shadow-sm mt-3'
            },
            didOpen: () => {
                const popup = Swal.getPopup();
                popup.style.fontFamily = `'Merriweather Sans', sans-serif`;
            }
        });
    </script>
@endif