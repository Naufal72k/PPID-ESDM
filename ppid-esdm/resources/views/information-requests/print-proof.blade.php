<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bukti Permohonan Informasi - {{ $informationRequest->unique_search_id }}</title> {{-- Ubah title --}}
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
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Cari</button>
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
        <h1 class="text-2xl font-bold mb-4 text-center">BUKTI PERMOHONAN INFORMASI PUBLIK</h1>

        {{-- <p class="mb-2 font-semibold">Nomor Tiket: <span
                class="text-blue-600">{{ formatTicketNumber($informationRequest->ticket_number) }}</span></p> --}}
        {{-- Tampilkan Kode Unik untuk Pencarian --}}
        <p class="mb-2 font-semibold">Kode Unik Pencarian: <span
                class="text-blue-600 break-all">{{ $informationRequest->unique_search_id }}</span></p>
        <p class="mb-6 text-gray-600">Tanggal Pengajuan: {{ $informationRequest->created_at->format('d M Y H:i') }}</p>

        <h2 class="text-xl font-semibold mb-3">Data Pemohon</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm">
            <div>
                <p class="font-medium">Nama Lengkap</p>
                <p>{{ $informationRequest->full_name }}</p>
            </div>
            <div>
                <p class="font-medium">Pekerjaan</p>
                <p>{{ $informationRequest->occupation }}</p>
            </div>
            <div>
                <p class="font-medium">Identitas</p>
                <p>{{ $informationRequest->identity_type }} - {{ $informationRequest->identity_number }}</p>
            </div>
            <div>
                <p class="font-medium">Telepon/HP</p>
                <p>{{ $informationRequest->phone }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="font-medium">Alamat</p>
                <p>{{ $informationRequest->address }}</p>
            </div>
            @if ($informationRequest->identity_scan_path)
                <div class="md:col-span-2">
                    <p class="font-medium">Scan Identitas</p>
                    @php
                        $filePath = asset($informationRequest->identity_scan_path);
                        $fileExtension = pathinfo($informationRequest->identity_scan_path, PATHINFO_EXTENSION);
                    @endphp
                    @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                        <img src="{{ $filePath }}" alt="Scan Identitas" class="w-48 rounded shadow" />
                    @elseif ($fileExtension == 'pdf')
                        <p>Dokumen PDF (silakan unduh untuk melihatnya)</p>
                        <a href="{{ $filePath }}" target="_blank" class="text-blue-600 underline">Unduh PDF</a>
                    @else
                        <p>Tipe file tidak didukung untuk pratinjau.</p>
                    @endif
                </div>
            @endif
        </div>

        <h2 class="text-xl font-semibold mb-3">Detail Permohonan</h2>
        <p class="mb-4 whitespace-pre-line">{{ $informationRequest->information_details }}</p>

        <p class="mb-2"><strong>Tujuan Penggunaan:</strong></p>
        <p class="mb-6 whitespace-pre-line">{{ $informationRequest->purpose }}</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <p><strong>Cara Mendapatkan Salinan:</strong></p>
                <p>{{ $informationRequest->copy_method ?? '-' }}</p>
            </div>
            <div>
                <p><strong>Cara Pengambilan:</strong></p>
                <p>{{ $informationRequest->retrieval_method ?? '-' }}</p>
            </div>
        </div>

        {{-- Contoh moded canvas kosong --}}
        <div class="mb-6">
            <canvas id="modedCanvas" width="600" height="200" style="border:1px solid #ccc; width: 100%;"></canvas>
        </div>

        <p class="text-center text-gray-600 text-sm">Terima kasih atas permohonan Anda.</p>

        <div class="text-center no-print mt-6">
            <button onclick="window.print()"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                <i class="fas fa-print mr-2"></i> Cetak Bukti
            </button>
        </div>
    </div>

    <script>
        // Contoh script untuk moded canvas (kosong, bisa Anda modifikasi)
        const canvas = document.getElementById('modedCanvas');
        const ctx = canvas.getContext('2d');
        ctx.fillStyle = '#f0f0f0';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = '#333';
        ctx.font = '20px Poppins, sans-serif';
        ctx.fillText('Moded Canvas Placeholder', 20, 100);
    </script>
</body>

</html>
