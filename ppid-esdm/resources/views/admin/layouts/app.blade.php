<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - Admin InfoPublik</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        .sidebar {
            transition: all 0.3s ease;
        }

        .sidebar-collapsed {
            width: 70px;
        }

        .sidebar-collapsed .sidebar-text {
            display: none;
        }

        .sidebar-collapsed .logo-text {
            display: none;
        }

        .sidebar-collapsed .menu-item {
            justify-content: center;
        }

        .content-area {
            transition: all 0.3s ease;
        }

        .content-expanded {
            margin-left: 70px;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
        }

        .chart-container {
            position: relative;
            height: 100%;
            width: 100%;
        }


        .status-pending {
            background-color: #fef3c7;
            color: #b45309;

        }

        .status-processed {

            background-color: #dcfce7;
            color: #16a34a;
        }

        .status-completed {

            background-color: #bfdbfe;
            color: #1d4ed8;
        }

        .status-rejected {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                z-index: 100;
                left: -260px;
            }

            .sidebar.active {
                left: 0;
            }

            .content-area {
                margin-left: 0 !important;
            }

            .mobile-menu-btn {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-white text-gray-800 w-64 flex-shrink-0 shadow-md">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-landmark text-2xl"></i>
                    <span class="logo-text text-xl font-bold">InfoPublik</span>
                </div>
                <button id="toggleSidebar" class="text-gray-600 focus:outline-none lg:hidden">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4">
                <div class="mb-6">
                    <div class="flex items-center space-x-3 p-2 rounded-lg bg-gray-100">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="sidebar-text">
                            <p class="font-medium">Admin</p>
                            <p class="text-xs text-gray-500">Super Admin</p>
                        </div>
                    </div>
                </div>
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="menu-item flex items-center space-x-3 p-3 rounded-lg {{ Request::routeIs('admin.dashboard') ? 'bg-gray-100 text-blue-600' : 'hover:bg-gray-100 text-gray-700' }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span class="sidebar-text">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.requests.index') }}"
                                class="menu-item flex items-center space-x-3 p-3 rounded-lg {{ Request::routeIs('admin.requests.index') || Request::routeIs('admin.requests.show') ? 'bg-gray-100 text-blue-600' : 'hover:bg-gray-100 text-gray-700' }}">
                                <i class="fas fa-file-alt"></i>
                                <span class="sidebar-text">Permohonan Informasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.objections.index') }}"
                                class="menu-item flex items-center space-x-3 p-3 rounded-lg {{ Request::routeIs('admin.objections.index') || Request::routeIs('admin.objections.show') ? 'bg-gray-100 text-blue-600' : 'hover:bg-gray-100 text-gray-700' }}">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span class="sidebar-text">Pengajuan Keberatan</span>
                            </a>
                        </li>

                        <li>
                            <a href="#"
                                class="menu-item flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700">
                                <i class="fas fa-cog"></i>
                                <span class="sidebar-text">Pengaturan</span>
                            </a>
                        </li>
                        <li>
                            {{-- Tombol Logout Admin --}}
                            <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="menu-item flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700 w-full text-left">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span class="sidebar-text">Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content-area flex-1 flex flex-col overflow-hidden content-expanded">
            <!-- Header -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <button id="mobileMenuBtn"
                            class="text-gray-500 focus:outline-none mr-4 lg:hidden mobile-menu-btn">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-800">@yield('title')</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Cari..."
                                class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-bell text-xl"></i>
                                <span
                                    class="notification-badge bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                            </button>
                        </div>
                        <div class="dropdown relative">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="hidden md:inline">Admin</span>
                                <i class="fas fa-chevron-down text-xs hidden md:inline"></i>
                            </button>
                            <div
                                class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 hidden">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                                {{-- Tombol Logout di Dropdown --}}
                                <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')

    <script>
        document.getElementById("mobileMenuBtn").addEventListener("click", function() {
            document.querySelector(".sidebar").classList.toggle("active");
        });


        document.getElementById("toggleSidebar").addEventListener("click", function() {
            document.querySelector(".sidebar").classList.toggle("sidebar-collapsed");
            document.querySelector(".content-area").classList.toggle("content-expanded");
        });


        const dropdownButton = document.querySelector('.dropdown > button');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        if (dropdownButton && dropdownMenu) {
            dropdownButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });


            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }
    </script>
</body>

</html>
