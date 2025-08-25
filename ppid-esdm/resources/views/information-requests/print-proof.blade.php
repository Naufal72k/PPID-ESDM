<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Permohonan Informasi - {{ $informationRequest->ticket_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            /* Pastikan background putih untuk cetak */
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Sembunyikan elemen yang tidak perlu saat dicetak */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            /* Pastikan gambar tidak tersembunyi */
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
            <h1 class="text-2xl font-bold text-gray-800">BUKTI PERMOHONAN INFORMASI PUBLIK</h1>
            <h2 class="text-xl font-semibold text-gray-700">Dinas Energi dan Sumber Daya Mineral Provinsi Nusa Tenggara
                Barat</h2>
            <p class="text-sm text-gray-600">PPID Dinas ESDM NTB</p>
        </div>

        <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-200">
                <p class="text-lg font-semibold">Nomor Tiket: <span
                        class="text-blue-600">{{ $informationRequest->ticket_number }}</span></p>
                <p class="text-sm text-gray-600">Tanggal Pengajuan:
                    {{ $informationRequest->created_at->format('d M Y H:i') }}</p>
            </div>

            <h3 class="text-lg font-semibold text-gray-800 mb-3">Data Pemohon</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-6">
                <div>
                    <p class="text-gray-500">Nama Lengkap:</p>
                    <p class="font-medium">{{ $informationRequest->full_name }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Pekerjaan:</p>
                    <p class="font-medium">{{ $informationRequest->occupation }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Identitas:</p>
                    <p class="font-medium">{{ $informationRequest->identity_type }} -
                        {{ $informationRequest->identity_number }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Telepon/HP:</p>
                    <p class="font-medium">{{ $informationRequest->phone }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-gray-500">Alamat:</p>
                    <p class="font-medium">{{ $informationRequest->address }}</p>
                </div>

                {{-- BAGIAN BARU UNTUK MENAMPILKAN GAMBAR SCAN IDENTITAS --}}
                @if ($informationRequest->identity_scan_path)
                    <div class="md:col-span-2">
                        <p class="text-gray-500">Scan Identitas:</p>
                        @php
                            $filePath = asset($informationRequest->identity_scan_path);
                            $fileExtension = pathinfo($informationRequest->identity_scan_path, PATHINFO_EXTENSION);
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
                {{-- AKHIR BAGIAN BARU --}}

            </div>

            <h3 class="text-lg font-semibold text-gray-800 mb-3">Detail Permohonan</h3>
            <div class="space-y-4 text-sm mb-6">
                <div>
                    <p class="text-gray-500">Rincian Informasi Yang Dibutuhkan:</p>
                    <p class="font-medium whitespace-pre-line">{{ $informationRequest->information_details }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Tujuan Penggunaan Informasi:</p>
                    <p class="font-medium whitespace-pre-line">{{ $informationRequest->purpose }}</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500">Cara Mendapatkan Salinan:</p>
                        <p class="font-medium">{{ $informationRequest->copy_method ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Cara Pengambilan:</p>
                        <p class="font-medium">{{ $informationRequest->retrieval_method ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8 text-gray-700">
                <p class="text-sm">Terima kasih atas permohonan Anda. Silakan simpan bukti ini sebagai referensi.</p>
                <p class="text-xs mt-2">Status permohonan Anda saat ini: <span
                        class="font-bold">{{ ucfirst($informationRequest->status) }}</span></p>
            </div>
        </div>

        <div class="text-center mt-6 no-print">
            <button onclick="window.print()"
                class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition">
                <i class="fas fa-print mr-2"></i> Cetak Ulang
            </button>
            <a href="{{ route('information-requests.show', $informationRequest->id) }}"
                class="inline-flex items-center px-6 py-3 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow transition ml-4">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
</body>

</html>
