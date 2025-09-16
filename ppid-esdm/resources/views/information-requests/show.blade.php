@extends('layouts.app')

@section('title', 'Detail Permohonan')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Status & Nomor Tiket -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
            <div class="p-6 bg-gradient-to-r from-blue-700 to-blue-600 text-white">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h2 class="text-2xl font-bold">Permohonan Informasi</h2>
                        <p class="opacity-90">Nomor Tiket: <span
                                class="font-bold">{{ $informationRequest->ticket_number }}</span></p>
                        {{-- Tampilkan Kode Unik --}}
                        <p class="opacity-90 text-sm mt-1">Kode Unik Pencarian: <span
                                class="font-bold text-yellow-200 break-all">{{ $informationRequest->unique_search_id }}</span>
                        </p>
                    </div>
                    {{-- Status di pojok kanan atas --}}
                    <span
                        class="mt-2 md:mt-0 px-4 py-2 rounded-full text-sm font-semibold
                        status-{{ strtolower($informationRequest->status) }}">
                        {{ ucfirst($informationRequest->status) }}
                    </span>
                </div>
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-200 text-center">
                <p class="text-sm text-gray-600">Tanggal Pengajuan:
                    {{ $informationRequest->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <!-- Data Pemohon -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4">
                <i class="fas fa-user-circle mr-2 text-blue-600"></i> Data Pemohon
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-500 text-sm">Nama Lengkap</p>
                    <p class="text-gray-800 font-medium">{{ $informationRequest->full_name }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Pekerjaan</p>
                    <p class="text-gray-800 font-medium">{{ $informationRequest->occupation }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Identitas</p>
                    <p class="text-gray-800 font-medium">
                        {{ $informationRequest->identity_type }}: {{ $informationRequest->identity_number }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Telepon/HP</p>
                    <p class="text-gray-800 font-medium">{{ $informationRequest->phone }}</p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-gray-500 text-sm">Alamat</p>
                    <p class="text-gray-800 font-medium">{{ $informationRequest->address }}</p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-gray-500 text-sm">Berkas Identitas</p>
                    {{-- Logika untuk menampilkan pratinjau gambar/PDF --}}
                    @php
                        $filePath = asset($informationRequest->identity_scan_path); // Gunakan asset() untuk public_path
                        $fileExtension = pathinfo($informationRequest->identity_scan_path, PATHINFO_EXTENSION);
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

        <!-- Detail Permohonan -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4">
                <i class="fas fa-info-circle mr-2 text-blue-600"></i> Rincian Permohonan
            </h3>

            <div class="space-y-6">
                <div>
                    <p class="text-gray-500 text-sm">Detail Informasi yang Diminta</p>
                    <p class="text-gray-800 whitespace-pre-line">{{ $informationRequest->information_details }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Tujuan Penggunaan Informasi</p>
                    <p class="text-gray-800 whitespace-pre-line">{{ $informationRequest->purpose }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-500 text-sm">Cara mendapatkan salinan</p>
                        <p class="text-gray-800">{{ $informationRequest->copy_method ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Cara pengambilan</p>
                        <p class="text-gray-800">{{ $informationRequest->retrieval_method ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Keterangan Admin -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4">
                <i class="fas fa-comment-alt mr-2 text-blue-600"></i> Keterangan Admin
            </h3>
            <p class="text-gray-800 whitespace-pre-line">
                {{ $informationRequest->admin_notes ?? 'Belum ada keterangan dari admin.' }}</p>
        </div>

        <!-- Tombol Kembali dan Cetak -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 pt-6 border-t border-gray-200">
            <a href="{{ route('information-requests.create') }}"
                class="inline-flex items-center px-6 py-3 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Formulir
            </a>
            <a href="{{ route('information-requests.print_proof') }}" target="_blank"
                class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition">
                <i class="fas fa-print mr-2"></i> Cetak Bukti Permohonan
            </a>
        </div>
    </div>
@endsection
