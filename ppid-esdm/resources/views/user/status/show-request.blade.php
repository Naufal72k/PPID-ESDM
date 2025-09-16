@extends('layouts.app')

@section('title', 'Detail Permohonan')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Detail Permohonan Informasi</h2>

        <p><strong>Nama Pengaju:</strong> {{ $informationRequest->full_name }}</p>
        <p><strong>Rincian Informasi Yang Dibutuhkan:</strong></p>
        <p class="whitespace-pre-line mb-4">{{ $informationRequest->information_details }}</p>

        <p><strong>Tujuan Penggunaan Informasi:</strong></p>
        <p class="whitespace-pre-line mb-4">{{ $informationRequest->purpose }}</p>

        <p><strong>Status:</strong> <span
                class="status-{{ strtolower($informationRequest->status) }}">{{ ucfirst($informationRequest->status) }}</span>
        </p>

        <a href="{{ route('user.status.index') }}"
            class="inline-block mt-6 px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800">Kembali</a>
    </div>
@endsection
