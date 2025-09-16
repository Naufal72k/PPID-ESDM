<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hasil Pencarian: {{ $searchName }} - PPID ESDM NTB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        .font-poppins {
            font-family: 'Poppins', sans-serif;
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

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
            gap: 0.25rem;
            flex-wrap: wrap;
            font-size: 0.75rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.3rem 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;
            color: #374151;
            text-decoration: none;
            font-size: 0.75rem;
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
    <header class="bg-gradient-to-r from-blue-800 to-blue-600 text-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center mb-6 md:mb-0">
                    <img src="/images/logo-esdm.png" alt=""
                        class="h-20 w-20 mr-5 rounded-full shadow-lg object-cover object-left" />
                    <div>
                        <h1 class="text-3xl font-extrabold leading-tight">Dinas Energi dan Sumber Daya Mineral</h1>
                        <p class="text-xl font-semibold opacity-90">Provinsi Nusa Tenggara Barat</p>
                    </div>
                </div>
                <div class="bg-white text-blue-900 px-6 py-3 rounded-xl shadow-lg text-center">
                    <h2 class="text-2xl font-bold">Cek Status Permohonan</h2>
                    <p class="text-base text-gray-700">PPID Dinas ESDM NTB</p>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="max-w-4xl mx-auto mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Hasil Pencarian untuk: <span
                    class="text-blue-600">{{ $searchName }}</span></h2>

            {{-- Permohonan Informasi --}}
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Permohonan Informasi</h3>

                @if ($informationRequests->isEmpty())
                    <p class="text-gray-600">Tidak ada permohonan informasi ditemukan.</p>
                @else
                    <table class="table-custom w-full">
                        <thead>
                            <tr>
                                <th>Nama Pengaju</th>
                                <th>Rincian Informasi Yang Dibutuhkan</th>
                                <th>Tujuan Penggunaan Informasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($informationRequests as $request)
                                <tr>
                                    <td>{{ $request->full_name }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($request->information_details, 100) }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($request->purpose, 100) }}</td>
                                    <td>
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-semibold status-{{ strtolower($request->status) }}">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.status.show-request', $request) }}"
                                            class="text-blue-600 hover:underline">Lihat Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="pagination mt-4">
                        {{ $informationRequests->appends(request()->except('info_page'))->links() }}
                    </div>
                @endif
            </div>

            {{-- Pengajuan Keberatan --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Pengajuan Keberatan</h3>

                @if ($objectionRequests->isEmpty())
                    <p class="text-gray-600">Tidak ada pengajuan keberatan ditemukan.</p>
                @else
                    <table class="table-custom w-full">
                        <thead>
                            <tr>
                                <th>Nama Pengaju</th>
                                <th>Alasan Pengajuan Keberatan</th>
                                <th>Keterangan Tambahan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($objectionRequests as $objection)
                                <tr>
                                    <td>{{ $objection->full_name }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($objection->reason, 100) }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($objection->additional_info ?? '-', 100) }}
                                    </td>
                                    <td>
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-semibold status-{{ strtolower($objection->status) }}">
                                            {{ ucfirst($objection->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.status.show-objection', $objection) }}"
                                            class="text-blue-600 hover:underline">Lihat Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="pagination mt-4">
                        {{ $objectionRequests->appends(request()->except('objection_page'))->links() }}
                    </div>
                @endif
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('user.status.index') }}"
                    class="inline-block px-6 py-3 bg-gray-700 text-white rounded hover:bg-gray-800 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Halaman Pencarian
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-white py-8 mt-auto">
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
