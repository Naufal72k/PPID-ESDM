@extends('layouts.app')

@section('title', 'Detail Pengajuan Keberatan')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Detail Pengajuan Keberatan</h2>

        <div class="mb-4">
            <strong>Nomor Tiket:</strong> {{ $objectionRequest->ticket_number }}
        </div>

        <div class="mb-4">
            <strong>Nama Lengkap:</strong> {{ $objectionRequest->full_name }}
        </div>

        <div class="mb-4">
            <strong>Jenis Identitas:</strong> {{ $objectionRequest->identity_type }}
        </div>

        <div class="mb-4">
            <strong>Nomor Identitas:</strong> {{ $objectionRequest->identity_number }}
        </div>

        <div class="mb-4">
            <strong>Scan Identitas:</strong><br>
            @if ($objectionRequest->identity_scan_path)
                <img src="{{ asset('uploads/identity_scans/' . $objectionRequest->identity_scan_path) }}" alt="Scan Identitas"
                    class="max-w-xs border rounded">
            @else
                <span>Tidak ada scan identitas.</span>
            @endif
        </div>

        <div class="mb-4">
            <strong>Nomor Telepon:</strong> {{ $objectionRequest->phone }}
        </div>

        <div class="mb-4">
            <strong>Alasan Keberatan:</strong><br>
            <p>{{ $objectionRequest->reason }}</p>
        </div>

        <div class="mb-4">
            <strong>Informasi Tambahan:</strong><br>
            <p>{{ $objectionRequest->additional_info ?? '-' }}</p>
        </div>

        <div class="mb-4">
            <strong>Status:</strong>
            @if ($objectionRequest->status === 'completed')
                <span class="text-green-600 font-semibold">Selesai</span>
            @elseif($objectionRequest->status === 'rejected')
                <span class="text-red-600 font-semibold">Ditolak</span>
            @else
                <span class="text-yellow-600 font-semibold">{{ ucfirst($objectionRequest->status) }}</span>
            @endif
        </div>

        <div class="mb-4">
            <strong>Catatan Admin:</strong><br>
            <p>{{ $objectionRequest->admin_notes ?? '-' }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('user.status.print-objection-proof', $objectionRequest->unique_search_id) }}" target="_blank"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Cetak Bukti Keberatan
            </a>
        </div>
    </div>
@endsection
