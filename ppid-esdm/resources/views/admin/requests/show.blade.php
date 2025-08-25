<!-- FileName: MultipleFiles/show.blade.php -->
@extends('admin.layouts.app') {{-- Pastikan ini mengarah ke layout baru --}}

@section('title', 'Detail Permohonan Admin')

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
                    </div>
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

        <!-- Detail Permohonan -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h3 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4">
                <i class="fas fa-info-circle mr-2 text-blue-600"></i> Detail Permohonan
            </h3>

            <div class="space-y-6">
                <div>
                    <p class="text-gray-500 text-sm">Rincian Informasi</p>
                    <p class="text-gray-800 whitespace-pre-line">{{ $informationRequest->information_details }}</p>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">Tujuan Penggunaan</p>
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

        <!-- Riwayat Status (from esdm.php, simplified) -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h4 class="font-medium text-gray-900 mb-2">Riwayat Status</h4>
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flow-root">
                    <ul class="-mb-8">
                        <li>
                            <div class="relative pb-8">
                                {{-- Garis vertikal untuk item pertama --}}
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                    aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span
                                            class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                            <i class="fas fa-file-alt text-white text-xs"></i>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">
                                                Permohonan diajukan
                                            </p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time
                                                datetime="{{ $informationRequest->created_at->format('Y-m-d') }}">{{ $informationRequest->created_at->format('d M Y') }}</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{-- Anda bisa menambahkan logika riwayat status yang lebih kompleks di sini jika ada tabel log status --}}
                        <li>
                            <div class="relative pb-8">
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span
                                            class="h-8 w-8 rounded-full
                                        @if ($informationRequest->status == 'pending') bg-yellow-500
                                        @elseif($informationRequest->status == 'processed') bg-green-500
                                        @elseif($informationRequest->status == 'completed') bg-blue-500
                                        @else bg-red-500 @endif
                                        flex items-center justify-center ring-8 ring-white">
                                            <i
                                                class="fas fa-{{ $informationRequest->status == 'pending'
                                                    ? 'clock'
                                                    : ($informationRequest->status == 'processed'
                                                        ? 'cogs'
                                                        : ($informationRequest->status == 'completed'
                                                            ? 'check'
                                                            : 'times')) }} text-white text-xs"></i>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Status saat ini:
                                                {{ ucfirst($informationRequest->status) }}</p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time
                                                datetime="{{ $informationRequest->updated_at->format('Y-m-d') }}">{{ $informationRequest->updated_at->format('d M Y') }}</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <!-- Tombol Kembali -->
        <div class="text-center">
            <a href="{{ route('admin.requests.index') }}"
                class="inline-flex items-center px-6 py-3 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Permohonan
            </a>
        </div>
    </div>
@endsection
