<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ config('app.name') }} | Login</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/3f8ab955ad.js" crossorigin="anonymous"></script>

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@400;600&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Merriweather Sans', sans-serif;
    }
    .input-icon {
      position: absolute;
      left: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      color: #4CAF50;
    }
    .toggle-icon {
      position: absolute;
      right: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      cursor: pointer;
    }
    .animate-fade-in {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .animate-fade-in.opacity-100 {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>

<body class="relative bg-cover bg-center bg-no-repeat min-h-screen flex items-center justify-center px-4"
      style="background-image: url('{{ asset('assets/img/home.jpeg') }}');">

  <!-- Overlay -->
  <div class="absolute inset-0 bg-black/60 z-0"></div>

  <!-- Login Card -->
  <div class="relative z-10 w-full max-w-md bg-white/20 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl p-8 animate-fade-in transition-all duration-500">

    <!-- Header -->
    <div class="text-center mb-6">
      <img src="{{ asset('assets/img/logo.png') }}" alt="Logo MWC NU" class="h-24 w-24 mx-auto rounded-full shadow mb-4 border-4 border-white/40">
      <h1 class="text-2xl font-bold text-white drop-shadow">Selamat Datang</h1>
      <p class="text-sm text-white/80 mt-1">Silakan masuk untuk melanjutkan</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
      @csrf

      <!-- Username -->
      <div class="relative">
        <i class="fas fa-user input-icon"></i>
        <input id="name" name="name" type="text" placeholder="Username"
          class="w-full pl-10 pr-4 py-2 bg-white/80 text-green-900 placeholder-green-700 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 shadow-inner transition" required />
      </div>

      <!-- Password -->
      <div class="relative">
        <i class="fas fa-lock input-icon"></i>
        <input id="passwordInput" name="password" type="password" placeholder="Kata Sandi"
          class="w-full pl-10 pr-10 py-2 bg-white/80 text-green-900 placeholder-green-700 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 shadow-inner transition" required />
        <span class="toggle-icon" onclick="togglePassword()">
          <i id="eyeIcon" class="fas fa-eye"></i>
        </span>
      </div>

      <!-- Remember -->
      <div class="flex items-center text-sm text-white/90">
        <label class="flex items-center">
          <input type="checkbox" name="remember" class="mr-2 text-green-600 focus:ring-green-500" />
          Ingat saya
        </label>
      </div>

      <!-- Button -->
      <button type="submit"
        class="w-full py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition-all duration-200 ease-in-out flex items-center justify-center gap-2 shadow-lg hover:shadow-xl">
        <i class="fas fa-sign-in-alt"></i>
        Masuk
      </button>
    </form>

    <!-- Footer -->
    <p class="text-xs text-white/60 mt-6 text-center">&copy; {{ now()->year }} MWC NU Kec. Ciseeng. Seluruh hak cipta dilindungi.</p>
  </div>

  <!-- Password Toggle Script -->
  <script>
    function togglePassword() {
      const password = document.getElementById('passwordInput');
      const icon = document.getElementById('eyeIcon');
      password.type = password.type === 'password' ? 'text' : 'password';
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
    }

    document.addEventListener("DOMContentLoaded", () => {
      document.querySelector('.animate-fade-in').classList.add('opacity-100');
    });
  </script>

  <!-- SweetAlert Session Feedback -->
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
        timer: 2200,
        timerProgressBar: true,
        customClass: {
          popup: 'rounded-2xl px-8 py-6 shadow-xl border border-green-200',
        },
        didClose: () => {
          window.location.href = "{{ session('redirect_to') }}";
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
        showConfirmButton: true,
        confirmButtonText: '<i class="fas fa-arrow-left mr-1"></i> Coba Lagi',
        confirmButtonColor: "#e11d48",
        customClass: {
          popup: 'rounded-2xl px-8 py-6 shadow-xl border border-red-200',
          confirmButton: 'text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg font-medium shadow-sm mt-3'
        }
      });
    </script>
  @endif

</body>
</html>
