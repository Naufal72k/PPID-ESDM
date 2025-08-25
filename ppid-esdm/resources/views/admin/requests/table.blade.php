<!-- FileName: MultipleFiles/table.blade.php -->
<div class="overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">No. Tiket</th>
                <th class="py-3 px-6 text-left">Nama Pemohon</th>
                <th class="py-3 px-6 text-left">Jenis Identitas</th>
                <th class="py-3 px-6 text-left">Status</th>
                <th class="py-3 px-6 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse ($informationRequests as $request)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <span class="font-medium">{{ $request->ticket_number }}</span>
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{ $request->full_name }}
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{ $request->identity_type }}
                    </td>
                    <td class="py-3 px-6 text-left">
                        <span
                            class="px-3 py-1 rounded-full text-xs font-semibold
                            status-{{ strtolower($request->status) }}">
                            {{ ucfirst($request->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <a href="{{ route('admin.requests.show', $request->id) }}"
                                class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                <i class="fas fa-eye"></i>
                            </a>
                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                    <button @click="open = !open" type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-2 py-1 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        id="options-menu" aria-haspopup="true" aria-expanded="true">
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
                                            aria-labelledby="options-menu">
                                            <form action="{{ route('admin.requests.update_status', $request->id) }}"
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
                            <form action="{{ route('admin.requests.destroy', $request->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus permohonan ini?');">
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
                    <td colspan="5" class="py-3 px-6 text-center">Tidak ada permohonan informasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Tambahkan Alpine.js untuk dropdown status --}}
@push('scripts')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
