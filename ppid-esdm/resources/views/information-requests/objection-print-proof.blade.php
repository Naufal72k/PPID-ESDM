<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bukti Pengajuan Keberatan - {{ $objectionRequest->unique_search_id }}</title> {{-- Ubah title --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            color: #333;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body class="p-6 bg-gray-50">
    {{-- Kolom Pencarian (tidak dicetak) --}}
    <div class="no-print max-w-md mx-auto mb-6">
        <form action="{{ route('user.status.search') }}" method="POST" class="flex gap-2">
            @csrf
            <input type="text" name="unique_search_id" placeholder="Masukkan kode unik Anda" {{-- Ubah placeholder --}}
                class="flex-grow border border-gray-300 rounded px-3 py-2" required />
            <button type="submit"
                class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">Cari</button>
        </form>
    </div>

    @php
        // Fungsi ini tidak lagi relevan untuk tampilan unique_search_id, tetapi tetap ada jika ticket_number masih ingin diformat
        function formatTicketNumber($ticketNumber)
        {
            if (str_starts_with($ticketNumber, 'OBJECTION-')) {
                return 'Keberatan-' . substr($ticketNumber, strlen('OBJECTION-'));
            } elseif (str_starts_with($ticketNumber, 'PPID-')) {
                return 'Informasi-' . substr($ticketNumber, strlen('PPID-'));
            }
            return $ticketNumber;
        }
    @endphp

    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-4 text-center">BUKTI PENGAJUAN KEBERATAN INFORMASI PUBLIK</h1>

        {{-- <p class="mb-2 font-semibold">Nomor Tiket Keberatan: <span
                class="text-purple-600">{{ formatTicketNumber($objectionRequest->ticket_number) }}</span></p> --}}
        {{-- Tampilkan Kode Unik untuk Pencarian --}}
        <p class="mb-2 font-semibold">Kode Unik Pencarian: <span
                class="text-purple-600 break-all">{{ $objectionRequest->unique_search_id }}</span></p>
        <p class="mb-6 text-gray-600">Tanggal Pengajuan: {{ $objectionRequest->created_at->format('d M Y H:i') }}</p>

        <h2 class="text-xl font-semibold mb-3">Data Pemohon</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm">
            <div>
                <p class="font-medium">Nama Lengkap</p>
                <p>{{ $objectionRequest->full_name }}</p>
            </div>
            <div>
                <p class="font-medium">Jenis Identitas</p>
                <p>{{ $objectionRequest->identity_type }}</p>
            </div>
            <div>
                <p class="font-medium">Nomor Identitas</p>
                <p>{{ $objectionRequest->identity_number }}</p>
            </div>
            <div>
                <p class="font-medium">Telepon/HP</p>
                <p>{{ $objectionRequest->phone }}</p>
            </div>
            @if ($objectionRequest->identity_scan_path)
                <div class="md:col-span-2">
                    <p class="font-medium">Scan Identitas</p>
                    @php
                        $filePath = asset($objectionRequest->identity_scan_path);
                        $fileExtension = pathinfo($objectionRequest->identity_scan_path, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                        <img src="{{ $filePath }}" alt="Scan Identitas" class="w-48 rounded shadow" />
                    @elseif ($fileExtension == 'pdf')
                        <p>Dokumen PDF (silakan unduh untuk melihatnya)</p>
                        <a href="{{ $filePath }}" target="_blank" class="text-purple-600 underline">Unduh PDF</a>
                    @else
                        <p>Tipe file tidak didukung untuk pratinjau.</p>
                    @endif
                </div>
            @endif
        </div>

        <h2 class="text-xl font-semibold mb-3">Detail Keberatan</h2>
        <p class="mb-4 whitespace-pre-line">{{ $objectionRequest->reason }}</p>

        <p class="mb-6 whitespace-pre-line">{{ $objectionRequest->additional_info ?? '-' }}</p>

        {{-- Contoh moded canvas kosong --}}
        <div class="mb-6">
            <canvas id="modedCanvas" width="600" height="200" style="border:1px solid #ccc; width: 100%;"></canvas>
        </div>

        <p class="text-center text-gray-600 text-sm">Terima kasih atas pengajuan keberatan Anda.</p>

        <div class="text-center no-print mt-6">
            <button onclick="window.print()"
                class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">
                <i class="fas fa-print mr-2"></i> Cetak Bukti
            </button>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('modedCanvas');
        const ctx = canvas.getContext('2d');
        ctx.fillStyle = '#f9f5ff';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = '#6b21a8';
        ctx.font = '20px Poppins, sans-serif';
        ctx.fillText('Moded Canvas Placeholder', 20, 100);
    </script>
</body>

</html>
