<!-- New File: MultipleFiles/information-requests/objection-print-proof.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pengajuan Keberatan - ID {{ $objectionRequest->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            img {
                display: block !important;
                visibility: visible !important;
            }
        }
    </style>
</head>

<body onload="window.print()" class="font-poppins">
    <div class="container mx-auto p-6">
        <div class="text-center mb-8">
            <img src="https://via.placeholder.com/90" alt="Logo Dinas ESDM NTB"
                class="h-20 w-20 mx-auto mb-4 rounded-full">
            <h1 class="text-2xl font-bold text-gray-800">BUKTI PENGAJUAN KEBERATAN INFORMASI PUBLIK</h1>
            <h2 class="text-xl font-semibold text-gray-700">Dinas Energi dan Sumber Daya Mineral Provinsi Nusa Tenggara
                Barat</h2>
            <p class="text-sm text-gray-600">PPID Dinas ESDM NTB</p>
        </div>

        <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-200">
                <p class="text-lg font-semibold">ID Keberatan: <span
                        class="text-purple-600">{{ $objectionRequest->id }}</span></p>
                <p class="text-sm text-gray-600">Tanggal Pengajuan:
                    {{ $objectionRequest->created_at->format('d M Y H:i') }}</p>
            </div>

            <h3 class="text-lg font-semibold text-gray-800 mb-3">Data Pemohon</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-6">
                <div>
                    <p class="text-gray-500">Nama Lengkap:</p>
                    <p class="font-medium">{{ $objectionRequest->full_name }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Jenis Identitas:</p>
                    <p class="font-medium">{{ $objectionRequest->identity_type }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Nomor Identitas:</p>
                    <p class="font-medium">{{ $objectionRequest->identity_number }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Telepon/HP:</p>
                    <p class="font-medium">{{ $objectionRequest->phone }}</p>
                </div>

                @if ($objectionRequest->identity_scan_path)
                    <div class="md:col-span-2">
                        <p class="text-gray-500">Scan Identitas:</p>
                        @php
                            $filePath = asset($objectionRequest->identity_scan_path);
                            $fileExtension = pathinfo($objectionRequest->identity_scan_path, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                            <div class="mt-2">
                                <img src="{{ $filePath }}" alt="Scan Identitas"
                                    class="w-48 h-auto rounded-lg shadow-md border border-gray-200">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Gambar identitas</p>
                        @elseif ($fileExtension == 'pdf')
                            <div class="mt-2 flex items-center">
                                <i class="fas fa-file-pdf text-red-500 text-xl mr-2"></i>
                                <span class="text-sm">Dokumen PDF (tidak dapat ditampilkan langsung)</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Silakan unduh PDF untuk melihatnya.</p>
                        @else
                            <p class="text-gray-600 mt-2 text-sm">Tipe file tidak didukung untuk pratinjau.</p>
                        @endif
                    </div>
                @endif
            </div>

            <h3 class="text-lg font-semibold text-gray-800 mb-3">Detail Keberatan</h3>
            <div class="space-y-4 text-sm mb-6">
                <div>
                    <p class="text-gray-500">Alasan Pengajuan Keberatan:</p>
                    <p class="font-medium whitespace-pre-line">{{ $objectionRequest->reason }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Keterangan Tambahan:</p>
                    <p class="font-medium whitespace-pre-line">{{ $objectionRequest->additional_info ?? '-' }}</p>
                </div>
            </div>

            <div class="text-center mt-8 text-gray-700">
                <p class="text-sm">Terima kasih atas pengajuan keberatan Anda. Silakan simpan bukti ini sebagai
                    referensi.</p>
                <p class="text-xs mt-2">Status pengajuan keberatan Anda saat ini: <span
                        class="font-bold">{{ ucfirst($objectionRequest->status) }}</span></p>
            </div>
        </div>

        <div class="text-center mt-6 no-print">
            <button onclick="window.print()"
                class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow transition">
                <i class="fas fa-print mr-2"></i> Cetak Ulang
            </button>
            <a href="{{ route('information-requests.objection.show', $objectionRequest->id) }}"
                class="inline-flex items-center px-6 py-3 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow transition ml-4">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
</body>

</html>
