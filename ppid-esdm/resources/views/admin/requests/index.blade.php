<!-- FileName: MultipleFiles/index.blade.php -->
@extends('admin.layouts.app') {{-- Pastikan ini mengarah ke layout baru --}}

@section('title', 'Daftar Permohonan Informasi')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Daftar Permohonan Informasi</h2>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="p-4 border-b flex flex-col md:flex-row md:items-center md:justify-between">
            <h3 class="text-lg font-semibold">Daftar Permohonan</h3>
            <form action="{{ route('admin.requests.index') }}" method="GET"
                class="mt-2 md:mt-0 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 w-full md:w-auto">
                <div class="relative w-full sm:w-auto">
                    <select name="status"
                        class="block appearance-none bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        onchange="this.form.submit()"> {{-- Submit form saat status berubah --}}
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Diproses</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="relative w-full sm:w-auto">
                    <input type="text" name="search" placeholder="Cari nama pemohon..."
                        class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        value="{{ request('search') }}" />
                    <button type="submit"
                        class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 hover:text-blue-500">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        @include('admin.requests.table', ['informationRequests' => $informationRequests])
        <div class="mt-4">
            {{ $informationRequests->appends(request()->query())->links() }} {{-- Untuk pagination dengan mempertahankan filter --}}
        </div>
    </div>
@endsection
