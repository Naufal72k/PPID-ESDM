<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Login Admin - PPID ESDM NTB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter", sans-serif;
        }
    </style>
</head>

<body>
    <div class="min-h-screen flex flex-col" style="background: linear-gradient(to bottom, #a6d0f7 0%, #eaf4fc 100%)">
        <main class="flex-grow flex justify-center items-center px-4">
            <form action="{{ route('admin.login') }}" method="POST"
                class="bg-white bg-opacity-90 backdrop-blur-sm rounded-2xl max-w-sm w-full p-8 flex flex-col items-center space-y-6 shadow-md"
                style="box-shadow: 0 10px 15px -3px rgb(166 208 247 / 0.5), 0 4px 6px -2px rgb(234 244 252 / 0.5);">
                @csrf

                <!-- Logo dan Judul -->
                <div class="bg-white rounded-xl p-3 shadow-md mb-2 flex justify-center items-center"
                    style="box-shadow: 0 4px 6px rgb(0 0 0 / 0.1)">
                    <img src="/images/logo-esdm.png"
                        alt="Logo ESDM NTB - Badge resmi Dinas Energi dan Sumber Daya Mineral Nusa Tenggara Barat"
                        class="w-10 h-10 mr-2 object-cover object-left">
                    <span class="font-semibold text-gray-700">ESDM NTB</span>

                </div>

                <h2 class="font-semibold text-black text-lg">Login Admin PPID</h2>

                <p class="text-center text-gray-500 text-sm max-w-[280px]">
                    Masukkan email dan password untuk mengakses dashboard administrator
                </p>

                <!-- Pesan Error -->
                @if ($errors->any())
                    <div class="w-full bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded-lg" role="alert">
                        <ul class="list-disc list-inside pl-2">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="w-full bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded-lg"
                        role="alert">
                        <p class="text-sm">{{ session('status') }}</p>
                    </div>
                @endif

                <!-- Form Input -->
                <div class="w-full space-y-3">
                    <label class="relative block">
                        <input
                            class="w-full rounded-lg bg-gray-100 text-gray-600 placeholder-gray-400 pl-10 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus />
                        <i aria-hidden="true"
                            class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    </label>

                    <label class="relative block">
                        <input
                            class="w-full rounded-lg bg-gray-100 text-gray-600 placeholder-gray-400 pl-10 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Password" type="password" name="password" required />
                        <i aria-hidden="true"
                            class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <i aria-hidden="true"
                            class="fas fa-eye-slash absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm cursor-pointer toggle-password"></i>
                    </label>
                </div>

                <!-- Remember Me -->
                <div class="w-full flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">Ingat Saya</label>
                </div>

                <!-- Tombol Login -->
                <button
                    class="w-full bg-gradient-to-b from-blue-600 to-blue-700 text-white rounded-lg py-2 text-center text-sm font-medium shadow-md hover:brightness-110 transition"
                    type="submit">
                    Masuk ke Dashboard
                </button>

                <!-- Footer -->
                <div class="w-full flex items-center text-gray-400 text-xs select-none">
                    <div class="flex-grow border-t border-dotted border-gray-300"></div>
                    <span class="px-3">PPID ESDM NTB</span>
                    <div class="flex-grow border-t border-dotted border-gray-300"></div>
                </div>

                <!-- Copyright -->
                <p class="text-center text-gray-500 text-xs">
                    &copy; 2025 Dinas Energi dan Sumber Daya Mineral<br>
                    Provinsi Nusa Tenggara Barat
                </p>
            </form>
        </main>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(item => {
            item.addEventListener('click', function() {
                const passwordInput = this.parentElement.querySelector('input');
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);


                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            });
        });

        // Validasi form sederhana
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = this.querySelector('input[name="email"]').value;
            const password = this.querySelector('input[name="password"]').value;

            if (!email || !password) {
                e.preventDefault();
                alert('Email dan password harus diisi!');
            }
        });
    </script>
</body>

</html>
