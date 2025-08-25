@extends('layouts.app')

@section('title', 'Detail Pengajuan Keberatan')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Status & ID Keberatan -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
            <div class="p-6 bg-gradient-to-r from-purple-700 to-purple-600 text-white">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h2 class="text-2xl font-bold">Pengajuan Keberatan</h2>
                        <p class="opacity-90">ID Keberatan: <span class="font-bold">{{ $objectionRequest->id }}</span></p>
                    </div>
                    <span
                        class="mt-2 md:mt-0 px-4 py-2 rounded-full text-sm font-semibold
                    {{ $objectionRequest->status === 'pending'
                        ? 'bg-yellow-100 text-yellow-800'
                        : ($objectionRequest->status === 'processed'
                            ? 'bg-green-100 text-green-800'
                            : 'bg-red-100 text-red-800') }}">
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
                                class="w-32 h-auto rounded-lg shadow-md border border-gray-200">
                        </div>
                        <a href="{{ $filePath }}" target="_blank"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 mt-2">
                            <i class="fas fa-eye mr-2"></i> Lihat Gambar Ukuran Penuh
                        </a>
                    @elseif ($fileExtension == 'pdf')
                        <div class="mt-2 flex items-center">
                            <i class="fas fa-file-pdf text-red-500 text-3xl mr-2"></i>
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
                    <p class="text-gray-800 whitespace-pre-line">{{ $objectionRequest->reason }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Keterangan Tambahan</p>
                    <p class="text-gray-800 whitespace-pre-line">{{ $objectionRequest->additional_info ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali dan Cetak -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 pt-6">
            <a href="{{ route('information-requests.create') }}"
                class="inline-flex items-center px-6 py-3 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Formulir
            </a>
            <a href="{{ route('information-requests.objection.print_proof', $objectionRequest->id) }}" target="_blank"
                class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow transition">
                <i class="fas fa-print mr-2"></i> Cetak Bukti Pengajuan Keberatan
            </a>
        </div>
    </div>
@endsection
