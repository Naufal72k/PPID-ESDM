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
                            <a href="{{ route('admin.requests.show', $request) }}"
                                class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                <i class="fas fa-eye"></i>
                            </a>

                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <div x-data="{ open: false, selectedStatus: '{{ $request->status }}', adminNotes: '{{ $request->admin_notes ?? '' }}' }" class="relative inline-block text-left">
                                    <button @click="open = !open" type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-2 py-1 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        id="options-menu-{{ $request->id }}" aria-haspopup="true" aria-expanded="true">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <div x-show="open" @click.away="open = false"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="origin-top-right absolute right-0 mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                        <div class="py-1" role="menu" aria-orientation="vertical"
                                            aria-labelledby="options-menu-{{ $request->id }}">
                                            <form action="{{ route('admin.requests.update_status', $request->id) }}"
                                                method="POST" class="p-4">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label for="status-{{ $request->id }}"
                                                        class="block text-sm font-medium text-gray-700">Ubah
                                                        Status</label>
                                                    <select id="status-{{ $request->id }}" name="status"
                                                        x-model="selectedStatus"
                                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                        <option value="pending">Pending</option>
                                                        <option value="processed">Diproses</option>
                                                        <option value="completed">Selesai</option>
                                                        <option value="rejected">Ditolak</option>
                                                    </select>
                                                </div>
                                                <div class="mb-4"
                                                    x-show="selectedStatus === 'rejected' || selectedStatus === 'completed'">
                                                    <label for="admin_notes-{{ $request->id }}"
                                                        class="block text-sm font-medium text-gray-700">Keterangan Admin
                                                        (Opsional)
                                                    </label>
                                                    <textarea id="admin_notes-{{ $request->id }}" name="admin_notes" x-model="adminNotes" rows="3"
                                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                                </div>
                                                <button type="submit"
                                                    class="w-full bg-blue-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    Simpan
                                                </button>
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
