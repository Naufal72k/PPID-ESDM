<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cek Status Permohonan & Keberatan - PPID ESDM NTB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <style>
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .status-completed {
            background-color: #bfdbfe;
            color: #1d4ed8;
        }

        .status-rejected {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .table-container {
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 1rem;
        }

        .table-custom {
            width: 100%;
            border-collapse: collapse;
        }

        .table-custom th,
        .table-custom td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-custom th {
            background-color: #f3f4f6;
            font-weight: 600;
            color: #4b5563;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .table-custom tbody tr:hover {
            background-color: #f9fafb;
        }

        /* Pagination styling */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            color: #374151;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .pagination .active {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .pagination a:hover {
            background-color: #e0e7ff;
            border-color: #3b82f6;
            color: #1e40af;
        }
    </style>
</head>

<body class="font-poppins bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-800 to-blue-600 text-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center mb-6 md:mb-0">
                    <img src="/images/logo-esdm.png" alt=""
                        class="h-20 w-20 mr-5 rounded-full shadow-lg object-cover object-left objec" />
                    <div>
                        <h1 class="text-3xl font-extrabold leading-tight">Dinas Energi dan Sumber Daya Mineral</h1>
                        <p class="text-xl font-semibold opacity-90">Provinsi Nusa Tenggara Barat</p>
                    </div>
                </div>
                <div class="bg-white text-blue-900 px-6 py-3 rounded-xl shadow-lg text-center">
                    <h2 class="text-2xl font-bold">Cek Status Permohonan & Keberatan</h2>
                    <p class="text-base text-gray-700">PPID Dinas ESDM NTB</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8 max-w-md mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Cari Status Permohonan/Keberatan Anda</h2>

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('user.status.search') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="unique_search_id" class="block text-sm font-medium text-gray-700">Masukkan Kode Unik
                        Anda:</label>
                    <input type="text" name="unique_search_id" id="unique_search_id"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Contoh: aRtyu268029Ghhjy" value="{{ old('unique_search_id') }}" required />
                    @error('unique_search_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cari Status
                </button>
            </form>
        </div>

        {{-- Tabel Permohonan Informasi --}}
        <div class="table-container bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Permohonan Informasi </h3>
            @if ($completedRejectedInformationRequests->isEmpty())
                <p class="text-gray-600 text-center">Tidak ada permohonan informasi.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pemohon</th>
                                <th>Alamat</th>
                                <th>Keterangan Admin</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($completedRejectedInformationRequests as $index => $request)
                                <tr>
                                    <td>{{ $completedRejectedInformationRequests->firstItem() + $index }}</td>
                                    <td>{{ $request->full_name }}</td>
                                    <td>{{ $request->address }}</td>
                                    <td>{{ $request->admin_notes ?? '-' }}</td>
                                    <td>
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-semibold status-{{ strtolower($request->status) }}">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="pagination">
                    {{ $completedRejectedInformationRequests->appends(request()->except('info_page'))->links() }}
                </div>
            @endif
        </div>

        {{-- Tabel Pengajuan Keberatan --}}
        <div class="table-container bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Pengajuan Keberatan </h3>
            @if ($completedRejectedObjectionRequests->isEmpty())
                <p class="text-gray-600 text-center">Tidak ada pengajuan keberatan.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pemohon</th>
                                <th>Alasan Keberatan</th>
                                <th>Keterangan Admin</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($completedRejectedObjectionRequests as $index => $objection)
                                <tr>
                                    <td>{{ $completedRejectedObjectionRequests->firstItem() + $index }}</td>
                                    <td>{{ $objection->full_name }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($objection->reason, 50) }}</td>
                                    <td>{{ $objection->admin_notes ?? '-' }}</td>
                                    <td>
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-semibold status-{{ strtolower($objection->status) }}">
                                            {{ ucfirst($objection->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="pagination">
                    {{ $completedRejectedObjectionRequests->appends(request()->except('objection_page'))->links() }}
                </div>
            @endif
        </div>
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
</body>

</html>
