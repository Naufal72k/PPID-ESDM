@extends('admin.layouts.app') {{-- Pastikan ini mengarah ke layout baru --}}

@section('title', 'Dashboard Admin')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Permohonan</p>
                    <h3 class="text-2xl font-bold mt-1">{{ $totalRequests }}</h3>

                    <p class="text-green-500 text-sm mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>Data terbaru
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: 100%;"></div> {{-- Placeholder width --}}
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pending Permohonan</p>
                    <h3 class="text-2xl font-bold mt-1">{{ $pendingRequests }}</h3>
                    <p class="text-yellow-500 text-sm mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>Data terbaru
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-500 h-2 rounded-full"
                        style="width: {{ $totalRequests > 0 ? ($pendingRequests / $totalRequests) * 100 : 0 }}%;"></div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Diproses Permohonan</p>
                    <h3 class="text-2xl font-bold mt-1">{{ $processedRequests }}</h3>
                    <p class="text-green-500 text-sm mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>Data terbaru
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="fas fa-cogs text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full"
                        style="width: {{ $totalRequests > 0 ? ($processedRequests / $totalRequests) * 100 : 0 }}%;"></div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Selesai Permohonan</p>
                    <h3 class="text-2xl font-bold mt-1">{{ $completedRequests }}</h3> {{-- New variable for completed --}}
                    <p class="text-blue-500 text-sm mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>Data terbaru
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-check-circle text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full"
                        style="width: {{ $totalRequests > 0 ? ($completedRequests / $totalRequests) * 100 : 0 }}%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards for Objections -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Keberatan</p>
                    <h3 class="text-2xl font-bold mt-1">{{ $totalObjections }}</h3>
                    <p class="text-green-500 text-sm mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>Data terbaru
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-purple-600 h-2 rounded-full" style="width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pending Keberatan</p>
                    <h3 class="text-2xl font-bold mt-1">{{ $pendingObjections }}</h3>
                    <p class="text-yellow-500 text-sm mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>Data terbaru
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-500 h-2 rounded-full"
                        style="width: {{ $totalObjections > 0 ? ($pendingObjections / $totalObjections) * 100 : 0 }}%;">
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Diproses Keberatan</p>
                    <h3 class="text-2xl font-bold mt-1">{{ $processedObjections }}</h3>
                    <p class="text-green-500 text-sm mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>Data terbaru
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="fas fa-cogs text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full"
                        style="width: {{ $totalObjections > 0 ? ($processedObjections / $totalObjections) * 100 : 0 }}%;">
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Selesai Keberatan</p>
                    <h3 class="text-2xl font-bold mt-1">{{ $completedObjections }}</h3>
                    <p class="text-blue-500 text-sm mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>Data terbaru
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-check-circle text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full"
                        style="width: {{ $totalObjections > 0 ? ($completedObjections / $totalObjections) * 100 : 0 }}%;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Pie Chart Permohonan Informasi -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Distribusi Status Permohonan Informasi</h3>
            <div class="chart-container">
                <canvas id="pieChartRequests"></canvas>
            </div>
        </div>

        <!-- Pie Chart Pengajuan Keberatan -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Distribusi Status Pengajuan Keberatan</h3>
            <div class="chart-container">
                <canvas id="pieChartObjections"></canvas>
            </div>
        </div>
    </div>

    <!-- Bar Chart Permohonan Informasi -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h3 class="text-lg font-semibold mb-4">Tujuan Penggunaan Informasi</h3>
        <div class="chart-container">
            <canvas id="barChartPurpose"></canvas>
        </div>
    </div>

    <!-- Bar Chart Pengajuan Keberatan -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h3 class="text-lg font-semibold mb-4">Alasan Pengajuan Keberatan</h3>
        <div class="chart-container">
            <canvas id="barChartReason"></canvas>
        </div>
    </div>

    <!-- Requests Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
        <div class="p-4 border-b flex flex-col md:flex-row md:items-center md:justify-between">
            <h3 class="text-lg font-semibold">Permohonan Informasi Terbaru</h3>
            <div class="mt-2 md:mt-0">
                <a href="{{ route('admin.requests.index') }}" class="text-blue-600 hover:underline">Lihat Semua
                    Permohonan
                    <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>
        <div class="overflow-x-auto">
            @include('admin.requests.table', ['informationRequests' => $latestRequests])
        </div>
    </div>

    <!-- Objections Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b flex flex-col md:flex-row md:items-center md:justify-between">
            <h3 class="text-lg font-semibold">Pengajuan Keberatan Terbaru</h3>
            <div class="mt-2 md:mt-0">
                <a href="{{ route('admin.objections.index') }}" class="text-blue-600 hover:underline">Lihat Semua
                    Keberatan
                    <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>
        <div class="overflow-x-auto">
            {{-- Re-use the table structure, but pass objection data --}}
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
                    @forelse ($latestObjections as $objection)
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
                                    {{-- Dropdown untuk update status --}}
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <div x-data="{ open: false }" class="relative inline-block text-left">
                                            <button @click="open = !open" type="button"
                                                class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-2 py-1 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                id="options-menu-objection-{{ $objection->id }}" aria-haspopup="true"
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
                                                    aria-labelledby="options-menu-objection-{{ $objection->id }}">
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
                            <td colspan="4" class="py-3 px-6 text-center">Tidak ada pengajuan keberatan terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Data for charts (dynamic from PHP variables)
            const totalRequests = {{ $totalRequests }};
            const pendingRequests = {{ $pendingRequests }};
            const processedRequests = {{ $processedRequests }};
            const completedRequests = {{ $completedRequests }};
            const rejectedRequests = {{ $rejectedRequests }};

            const totalObjections = {{ $totalObjections }};
            const pendingObjections = {{ $pendingObjections }};
            const processedObjections = {{ $processedObjections }};
            const completedObjections = {{ $completedObjections }};
            const rejectedObjections = {{ $rejectedObjections }};

            const purposeCounts = @json($purposeCounts);
            const reasonCounts = @json($reasonCounts);

            // Pie Chart Permohonan Informasi
            const pieCtxRequests = document.getElementById("pieChartRequests").getContext("2d");
            const pieChartRequests = new Chart(pieCtxRequests, {
                type: "pie",
                data: {
                    labels: ["Selesai", "Pending", "Diproses", "Ditolak"],
                    datasets: [{
                        data: [completedRequests, pendingRequests, processedRequests,
                            rejectedRequests
                        ],
                        backgroundColor: ["#1d4ed8", "#b45309", "#16a34a",
                            "#dc2626"
                        ], // blue, yellow, green, red
                        borderWidth: 1,
                    }, ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "bottom",
                        },
                    },
                },
            });

            // Pie Chart Pengajuan Keberatan
            const pieCtxObjections = document.getElementById("pieChartObjections").getContext("2d");
            const pieChartObjections = new Chart(pieCtxObjections, {
                type: "pie",
                data: {
                    labels: ["Selesai", "Pending", "Diproses", "Ditolak"],
                    datasets: [{
                        data: [completedObjections, pendingObjections, processedObjections,
                            rejectedObjections
                        ],
                        backgroundColor: ["#1d4ed8", "#b45309", "#16a34a",
                            "#dc2626"
                        ], // blue, yellow, green, red
                        borderWidth: 1,
                    }, ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "bottom",
                        },
                    },
                },
            });

            // Bar Chart Tujuan Penggunaan Informasi
            const barCtxPurpose = document.getElementById("barChartPurpose").getContext("2d");
            const barChartPurpose = new Chart(barCtxPurpose, {
                type: "bar",
                data: {
                    labels: Object.keys(purposeCounts),
                    datasets: [{
                        label: "Jumlah Permohonan",
                        data: Object.values(purposeCounts),
                        backgroundColor: [
                            "rgba(59, 130, 246, 0.7)", // blue
                            "rgba(16, 185, 129, 0.7)", // green
                            "rgba(245, 158, 11, 0.7)", // yellow
                            "rgba(99, 102, 241, 0.7)", // indigo
                            "rgba(156, 163, 175, 0.7)", // gray
                        ],
                        borderColor: [
                            "rgba(59, 130, 246, 1)",
                            "rgba(16, 185, 129, 1)",
                            "rgba(245, 158, 11, 1)",
                            "rgba(99, 102, 241, 1)",
                            "rgba(156, 163, 175, 1)",
                        ],
                        borderWidth: 1,
                    }, ],
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });

            // Bar Chart Alasan Pengajuan Keberatan
            const barCtxReason = document.getElementById("barChartReason").getContext("2d");
            const barChartReason = new Chart(barCtxReason, {
                type: "bar",
                data: {
                    labels: Object.keys(reasonCounts),
                    datasets: [{
                        label: "Jumlah Pengajuan Keberatan",
                        data: Object.values(reasonCounts),
                        backgroundColor: [
                            "rgba(168, 85, 247, 0.7)", // purple
                            "rgba(236, 72, 153, 0.7)", // pink
                            "rgba(249, 115, 22, 0.7)", // orange
                            "rgba(6, 182, 212, 0.7)", // cyan
                            "rgba(100, 116, 139, 0.7)", // slate
                        ],
                        borderColor: [
                            "rgba(168, 85, 247, 1)",
                            "rgba(236, 72, 153, 1)",
                            "rgba(249, 115, 22, 1)",
                            "rgba(6, 182, 212, 1)",
                            "rgba(100, 116, 139, 1)",
                        ],
                        borderWidth: 1,
                    }, ],
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        });
    </script>
@endpush
