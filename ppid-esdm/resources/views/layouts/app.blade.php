<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PPID ESDM NTB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        .font-poppins {
            font-family: 'Poppins', sans-serif
        }
    </style>
    @stack('styles')
</head>

<body class="font-poppins bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-800 to-blue-600 text-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center mb-6 md:mb-0">
                    <img src="https://via.placeholder.com/90" alt="Logo Dinas ESDM NTB"
                        class="h-20 w-20 mr-5 rounded-full shadow-lg">
                    <div>
                        <h1 class="text-3xl font-extrabold leading-tight">Dinas Energi dan Sumber Daya Mineral</h1>
                        <p class="text-xl font-semibold opacity-90">Provinsi Nusa Tenggara Barat</p>
                    </div>
                </div>
                <div class="bg-white text-blue-900 px-6 py-3 rounded-xl shadow-lg text-center">
                    <h2 class="text-2xl font-bold">Formulir Permohonan Informasi Publik</h2>
                    <p class="text-base text-gray-700">PPID Dinas ESDM NTB</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-xl font-bold">PPID Dinas ESDM NTB</h3>
                    <p class="text-sm opacity-80">Pejabat Pengelola Informasi dan Dokumentasi</p>
                </div>
                <div class="text-sm opacity-80">
                    <p>© {{ date('Y') }} Dinas Energi dan Sumber Daya Mineral Provinsi NTB</p>
                    <p>Email: ppid.esdmntb@example.com | Telp: (0370) 1234567</p>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
