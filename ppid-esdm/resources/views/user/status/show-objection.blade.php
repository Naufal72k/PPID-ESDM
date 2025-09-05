    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detail Pengajuan Keberatan - PPID ESDM NTB</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet">
        <style>
            .font-poppins {
                font-family: 'Poppins', sans-serif
            }

            .status-completed {
                background-color: #bfdbfe;
                color: #1d4ed8;
            }

            .status-rejected {
                background-color: #fee2e2;
                color: #dc2626;
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
                            class="h-20 w-20 mr-5 rounded-full shadow-lg object-cover object-left objec">
                        <div>
                            <h1 class="text-3xl font-extrabold leading-tight">Dinas Energi dan Sumber Daya Mineral</h1>
                            <p class="text-xl font-semibold opacity-90">Provinsi Nusa Tenggara Barat</p>
                        </div>
                    </div>
                    <div class="bg-white text-blue-900 px-6 py-3 rounded-xl shadow-lg text-center">
                        <h2 class="text-2xl font-bold">Detail Pengajuan Keberatan</h2>
                        <p class="text-base text-gray-700">PPID Dinas ESDM NTB</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="max-w-4xl mx-auto">
                <!-- Status & ID Keberatan -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                    <div class="p-6 bg-gradient-to-r from-purple-700 to-purple-600 text-white">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                            <div>
                                <h2 class="text-2xl font-bold">Pengajuan Keberatan</h2>
                                {{-- <p class="opacity-90">Nomor Tiket Keberatan: <span
                                        class="font-bold">{{ $objectionRequest->ticket_number }}</span></p> --}}
                                {{-- Tampilkan Kode Unik --}}
                                <p class="opacity-90 text-sm mt-1">Kode Unik Pencarian: <span
                                        class="font-bold text-yellow-200 break-all">{{ $objectionRequest->unique_search_id }}</span>
                                </p>
                            </div>
                            <span
                                class="mt-2 md:mt-0 px-4 py-2 rounded-full text-sm font-semibold
                                status-{{ strtolower($objectionRequest->status) }}">
                                {{ ucfirst($objectionRequest->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 border-t border-gray-200 text-center">
                        <p class="text-sm text-gray-600">Tanggal Pengajuan:
                            {{ $objectionRequest->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                <!-- Data Pemohon -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4">
                        <i class="fas fa-user-circle mr-2 text-purple-600"></i> Data Pemohon
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-gray-500 text-sm">Nama Lengkap</p>
                            <p class="text-gray-800 font-medium">{{ $objectionRequest->full_name }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Jenis Identitas</p>
                            <p class="text-gray-800 font-medium">{{ $objectionRequest->identity_type }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Nomor Identitas</p>
                            <p class="text-gray-800 font-medium">{{ $objectionRequest->identity_number }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Telepon/HP</p>
                            <p class="text-gray-800 font-medium">{{ $objectionRequest->phone }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-gray-500 text-sm">Berkas Identitas</p>
                            @php
                                $filePath = asset($objectionRequest->identity_scan_path);
                                $fileExtension = pathinfo($objectionRequest->identity_scan_path, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                <div class="mt-2">
                                    <img src="{{ $filePath }}" alt="Scan Identitas"
                                        class="w-48 h-auto rounded-lg shadow-md border border-gray-200">
                                </div>
                                <a href="{{ $filePath }}" target="_blank"
                                    class="inline-flex items-center text-blue-600 hover:text-blue-800 mt-2">
                                    <i class="fas fa-eye mr-2"></i> Lihat Gambar Ukuran Penuh
                                </a>
                            @elseif ($fileExtension == 'pdf')
                                <div class="mt-2 flex items-center">
                                    <i class="fas fa-file-pdf text-red-500 text-4xl mr-2"></i>
                                    <span>Dokumen PDF</span>
                                </div>
                                <a href="{{ $filePath }}" target="_blank"
                                    class="inline-flex items-center text-blue-600 hover:text-blue-800 mt-2">
                                    <i class="fas fa-download mr-2"></i> Unduh Dokumen PDF
                                </a>
                            @else
                                <p class="text-gray-600 mt-2">Tipe file tidak didukung untuk pratinjau.</p>
                                <a href="{{ $filePath }}" target="_blank"
                                    class="inline-flex items-center text-blue-600 hover:text-blue-800 mt-2">
                                    <i class="fas fa-external-link-alt mr-2"></i> Buka Dokumen
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Detail Keberatan -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4">
                        <i class="fas fa-exclamation-triangle mr-2 text-purple-600"></i> Rincian Keberatan
                    </h3>

                    <div class="space-y-6">
                        <div>
                            <p class="text-gray-500 text-sm">Alasan Pengajuan Keberatan</p>
                            <p class="text-gray-800 whitespace-pre-line">
                                {{ $objectionRequest->reason }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Keterangan Tambahan</p>
                            <p class="text-gray-800 whitespace-pre-line">
                                {{ $objectionRequest->additional_info ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Keterangan Admin -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4">
                        <i class="fas fa-comment-alt mr-2 text-purple-600"></i> Keterangan Admin
                    </h3>
                    <p class="text-gray-800 whitespace-pre-line">
                        {{ $objectionRequest->admin_notes ?? 'Belum ada keterangan dari admin.' }}</p>
                </div>

                <!-- Tombol Kembali -->
                <div class="text-center">
                    <a href="{{ route('user.status.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow transition">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Pencarian Status
                    </a>
                    <a href="{{ route('user.status.print-objection-proof') }}" target="_blank"
                        class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow transition ml-4">
                        <i class="fas fa-print mr-2"></i> Cetak Bukti Pengajuan Keberatan
                    </a>
                </div>
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
