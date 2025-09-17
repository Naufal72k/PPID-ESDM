@extends('layouts.app')

@section('title', 'Detail Permohonan')

@section('content')
    <div class="max-w-3xl mx-auto p-8 bg-white rounded-2xl shadow-md border border-gray-100">
        <!-- Judul -->
        <h2 class="text-3xl font-bold text-blue-700 mb-8 text-center">
            Detail Permohonan Informasi
        </h2>

        <!-- Informasi Utama -->
        <div class="space-y-5">
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-medium text-gray-600">Nomor Tiket:</span>
                <span class="text-gray-900 font-semibold">{{ $informationRequest->ticket_number }}</span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-medium text-gray-600">Nama Lengkap:</span>
                <span class="text-gray-900">{{ $informationRequest->full_name }}</span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-medium text-gray-600">Pekerjaan:</span>
                <span class="text-gray-900">{{ $informationRequest->occupation }}</span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <span class="font-medium text-gray-600">Status:</span>
                <span
                    class="px-3 py-1 rounded-full text-sm font-semibold
                        @if (strtolower($informationRequest->status) == 'selesai') bg-green-100 text-green-700
                        @elseif(strtolower($informationRequest->status) == 'pending') bg-yellow-100 text-yellow-700
                        @elseif(strtolower($informationRequest->status) == 'ditolak') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-700 @endif">
                    {{ ucfirst($informationRequest->status) }}
                </span>
            </div>
        </div>

        <!-- Detail Tambahan -->
        <div class="mt-10 space-y-6">
            <div>
                <h3 class="font-semibold text-gray-700 mb-1">Rincian Informasi yang Dibutuhkan:</h3>
                <p class="text-gray-900 whitespace-pre-line bg-gray-50 p-3 rounded-md">
                    {{ $informationRequest->information_details }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700 mb-1">Tujuan Penggunaan Informasi:</h3>
                <p class="text-gray-900 whitespace-pre-line bg-gray-50 p-3 rounded-md">
                    {{ $informationRequest->purpose }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700 mb-1">Cara Mendapatkan Salinan:</h3>
                <p class="text-gray-900 bg-gray-50 p-3 rounded-md">
                    {{ $informationRequest->copy_method ?? '-' }}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700 mb-1">Keterangan Admin:</h3>
                <p class="text-gray-900 bg-gray-50 p-3 rounded-md">
                    {{ $informationRequest->admin_notes ?? '-' }}
                </p>
            </div>
        </div>

        <!-- Tombol -->
        <div class="mt-10 flex justify-center">
            <a href="{{ route('user.status.index') }}"
                class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
@endsection
