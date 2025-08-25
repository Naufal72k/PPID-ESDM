<!-- New File: MultipleFiles/admin/objections/index.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Daftar Pengajuan Keberatan')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Daftar Pengajuan Keberatan</h2>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="p-4 border-b flex flex-col md:flex-row md:items-center md:justify-between">
            <h3 class="text-lg font-semibold">Daftar Keberatan</h3>
            <form action="{{ route('admin.objections.index') }}" method="GET"
                class="mt-2 md:mt-0 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 w-full md:w-auto">
                <div class="relative w-full sm:w-auto">
                    <select name="status"
                        class="block appearance-none bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        onchange="this.form.submit()">
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
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Nama Pemohon</th>
                        <th class="py-3 px-6 text-left">Jenis Identitas</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($objectionRequests as $objection)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <span class="font-medium">{{ $objection->full_name }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $objection->identity_type }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold
                                    status-{{ strtolower($objection->status) }}">
                                    {{ ucfirst($objection->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('admin.objections.show', $objection->id) }}"
                                        class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <div x-data="{ open: false }" class="relative inline-block text-left">
                                            <button @click="open = !open" type="button"
                                                class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-2 py-1 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                id="options-menu-{{ $objection->id }}" aria-haspopup="true"
                                                aria-expanded="true">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <div x-show="open" @click.away="open = false"
                                                x-transition:enter="transition ease-out duration-100"
                                                x-transition:enter-start="transform opacity-0 scale-95"
                                                x-transition:enter-end="transform opacity-100 scale-100"
                                                x-transition:leave="transition ease-in duration-75"
                                                x-transition:leave-start="transform opacity-100 scale-100"
                                                x-transition:leave-end="transform opacity-0 scale-95"
                                                class="origin-top-right absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                                <div class="py-1" role="menu" aria-orientation="vertical"
                                                    aria-labelledby="options-menu-{{ $objection->id }}">
                                                    <form
                                                        action="{{ route('admin.objections.update_status', $objection->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" name="status" value="pending"
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left"
                                                            role="menuitem">Pending</button>
                                                        <button type="submit" name="status" value="processed"
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left"
                                                            role="menuitem">Diproses</button>
                                                        <button type="submit" name="status" value="completed"
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left"
                                                            role="menuitem">Selesai</button>
                                                        <button type="submit" name="status" value="rejected"
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left"
                                                            role="menuitem">Ditolak</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('admin.objections.destroy', $objection->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan keberatan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-4 transform hover:text-red-500 hover:scale-110">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-3 px-6 text-center">Tidak ada pengajuan keberatan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $objectionRequests->appends(request()->query())->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
