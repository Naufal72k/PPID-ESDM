<!-- FileName: MultipleFiles/create.blade.php -->
@extends('layouts.app')

@section('title', 'Permohonan Informasi Publik')

@section('content')
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
            <h4 class="font-bold">Error!</h4>
            <ul class="list-disc pl-5 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="bg-blue-50 border-l-4 border-blue-500 p-6 md:p-8 rounded-lg mb-10 shadow-md">
        <h2 class="text-xl md:text-2xl font-bold text-blue-800 mb-4 md:mb-5">
            <i class="fas fa-info-circle mr-2 md:mr-3 text-blue-600"></i>Petunjuk Pengisian
        </h2>
        <p class="text-gray-700 leading-relaxed">
            Jika Anda tidak menemukan informasi yang dibutuhkan di website, silakan isi form ini dengan melengkapi
            <strong class="text-blue-700">SCAN IDENTITAS (KTP/SIM/Paspor)</strong>.
            Permohonan kelompok/organisasi wajib menyertakan surat resmi.
        </p>
    </section>

    <section class="bg-white rounded-xl shadow-md overflow-hidden mb-10">
        <div class="p-6 md:p-8 border-b">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                Formulir Layanan Informasi Publik
            </h2>
        </div>

        <div x-data="{ activeTab: 'informationRequest' }" class="p-6 md:p-8">
            <div class="mb-6 border-b border-gray-200">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                    data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg"
                            :class="{ 'border-blue-600 text-blue-600': activeTab === 'informationRequest', 'border-transparent hover:text-gray-600 hover:border-gray-300': activeTab !== 'informationRequest' }"
                            @click="activeTab = 'informationRequest'" type="button" role="tab"
                            aria-controls="information-request" aria-selected="true">
                            Permohonan Informasi
                        </button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg"
                            :class="{ 'border-blue-600 text-blue-600': activeTab === 'objectionRequest', 'border-transparent hover:text-gray-600 hover:border-gray-300': activeTab !== 'objectionRequest' }"
                            @click="activeTab = 'objectionRequest'" type="button" role="tab"
                            aria-controls="objection-request" aria-selected="false">
                            Pengajuan Keberatan
                        </button>
                    </li>
                </ul>
            </div>

            <div id="myTabContent">
                {{-- Tab Permohonan Informasi --}}
                <div x-show="activeTab === 'informationRequest'" id="information-request" role="tabpanel"
                    aria-labelledby="information-request-tab">
                    <form id="infoRequestForm" action="{{ route('information-requests.store') }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6 md:space-y-8">
                        @csrf

                        <!-- Data Pemohon -->
                        <div class="space-y-6">
                            <h3 class="text-xl md:text-2xl font-semibold text-gray-700 pb-2 border-b">
                                <i class="fas fa-user-circle mr-2 text-blue-600"></i>Data Pemohon
                            </h3>

                            <!-- Nama Lengkap -->
                            <div>
                                <label for="fullName" class="block text-base font-medium text-gray-700 mb-1">Nama Lengkap
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="fullName" name="full_name" value="{{ old('full_name') }}"
                                    class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                    required placeholder="Nama sesuai identitas">
                                @error('full_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div>
                                <label for="address" class="block text-base font-medium text-gray-700 mb-1">Alamat <span
                                        class="text-red-500">*</span></label>
                                <textarea id="address" name="address" rows="3"
                                    class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                    required placeholder="Alamat lengkap">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- 2 Kolom: Pekerjaan & Identitas -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Pekerjaan -->
                                <div>
                                    <label for="occupation" class="block text-base font-medium text-gray-700 mb-1">Pekerjaan
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="occupation" name="occupation" value="{{ old('occupation') }}"
                                        class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                        required placeholder="Contoh: PNS, Mahasiswa">
                                    @error('occupation')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Jenis Identitas -->
                                <div>
                                    <label for="identityType" class="block text-base font-medium text-gray-700 mb-1">Jenis
                                        Identitas
                                        <span class="text-red-500">*</span></label>
                                    <select id="identityType" name="identity_type"
                                        class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                        required>
                                        <option value="" disabled selected>Pilih Jenis Identitas</option>
                                        <option value="KTP" {{ old('identity_type') == 'KTP' ? 'selected' : '' }}>KTP
                                        </option>
                                        <option value="SIM" {{ old('identity_type') == 'SIM' ? 'selected' : '' }}>SIM
                                        </option>
                                        <option value="Paspor" {{ old('identity_type') == 'Paspor' ? 'selected' : '' }}>
                                            Paspor</option>
                                        <option value="Lainnya" {{ old('identity_type') == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya
                                        </option>
                                    </select>
                                    @error('identity_type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- 2 Kolom: No Identitas & Telepon -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nomor Identitas -->
                                <div>
                                    <label for="identityNumber" class="block text-base font-medium text-gray-700 mb-1">Nomor
                                        Identitas
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="identityNumber" name="identity_number"
                                        value="{{ old('identity_number') }}"
                                        class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                        required placeholder="Nomor KTP/SIM/Paspor">
                                    @error('identity_number')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Telepon -->
                                <div>
                                    <label for="phone"
                                        class="block text-base font-medium text-gray-700 mb-1">Telepon/HP <span
                                            class="text-red-500">*</span></label>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                        class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                        required placeholder="Contoh: 081234567890">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Upload Identitas -->
                            <div>
                                <label class="block text-base font-medium text-gray-700 mb-1">Upload Scan Identitas <span
                                        class="text-red-500">*</span></label>
                                <div id="fileUploadContainer" class="mt-1">
                                    <label for="identityScan" id="fileUploadLabel"
                                        class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-lg p-4 cursor-pointer bg-gray-50 hover:border-blue-500 hover:bg-blue-50 transition">
                                        <div class="flex flex-col items-center justify-center pt-2 pb-3">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                            <p class="mb-1 text-lg font-semibold text-gray-600" id="fileNameDisplay">
                                                <span class="font-bold">Klik untuk upload</span> atau seret & lepas
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                Format: JPG/PNG/PDF (Maks. 2MB)
                                            </p>
                                        </div>
                                        <input id="identityScan" name="identity_scan" type="file" class="hidden"
                                            accept=".jpg,.jpeg,.png,.pdf"> {{-- Hapus required di sini, akan ditangani di form --}}
                                    </label>
                                    @error('identity_scan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    {{-- Elemen untuk pratinjau gambar --}}
                                    <div id="imagePreviewContainer" class="mt-4 hidden">
                                        <img id="imagePreview" src="#" alt="Pratinjau Identitas"
                                            class="max-w-full h-auto rounded-lg shadow-md border border-gray-200">
                                        <p class="text-sm text-gray-600 mt-2">File terpilih: <span id="selectedFileName"
                                                class="font-medium"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rincian Informasi -->
                        <div class="space-y-6">
                            <h3 class="text-xl md:text-2xl font-semibold text-gray-700 pb-2 border-b">
                                <i class="fas fa-info-circle mr-2 text-blue-600"></i>Rincian Informasi
                            </h3>

                            <!-- Detail Informasi -->
                            <div>
                                <label for="informationDetails" class="block text-base font-medium text-gray-700 mb-1">
                                    Rincian Informasi Yang Dibutuhkan <span class="text-red-500">*</span>
                                </label>
                                <textarea id="informationDetails" name="information_details" rows="4"
                                    class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                    required placeholder="Jelaskan secara detail informasi yang dibutuhkan">{{ old('information_details') }}</textarea>
                                @error('information_details')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tujuan -->
                            <div>
                                <label for="purpose" class="block text-base font-medium text-gray-700 mb-1">
                                    Tujuan Penggunaan Informasi <span class="text-red-500">*</span>
                                </label>
                                <textarea id="purpose" name="purpose" rows="4"
                                    class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                    required placeholder="Untuk apa informasi ini digunakan?">{{ old('purpose') }}</textarea>
                                @error('purpose')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- 2 Kolom: Metode -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Cara Dapat Salinan -->
                                <div>
                                    <label for="copyMethod" class="block text-base font-medium text-gray-700 mb-1">
                                        Cara Mendapatkan Salinan
                                    </label>
                                    <select id="copyMethod" name="copy_method"
                                        class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition">
                                        <option value="" selected>Pilih Metode</option>
                                        <option value="Download Website"
                                            {{ old('copy_method') == 'Download Website' ? 'selected' : '' }}>Download dari
                                            Website
                                        </option>
                                        <option value="Email" {{ old('copy_method') == 'Email' ? 'selected' : '' }}>
                                            Dikirim via Email
                                        </option>
                                        <option value="Ambil Langsung"
                                            {{ old('copy_method') == 'Ambil Langsung' ? 'selected' : '' }}>
                                            Ambil Langsung</option>
                                    </select>
                                </div>

                                <!-- Cara Pengambilan -->
                                <div>
                                    <label for="retrievalMethod" class="block text-base font-medium text-gray-700 mb-1">
                                        Cara Pengambilan
                                    </label>
                                    <select id="retrievalMethod" name="retrieval_method"
                                        class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition">
                                        <option value="" selected>Pilih Metode</option>
                                        <option value="Email" {{ old('retrieval_method') == 'Email' ? 'selected' : '' }}>
                                            Dikirim via
                                            Email</option>
                                        <option value="Pos" {{ old('retrieval_method') == 'Pos' ? 'selected' : '' }}>
                                            Dikirim via
                                            Pos
                                        </option>
                                        <option value="Ambil" {{ old('retrieval_method') == 'Ambil' ? 'selected' : '' }}>
                                            Ambil di
                                            Lokasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="flex items-center justify-center px-6 py-3 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg shadow transition hover:shadow-md">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Permohonan
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Tab Pengajuan Keberatan --}}
                <div x-show="activeTab === 'objectionRequest'" id="objection-request" role="tabpanel"
                    aria-labelledby="objection-request-tab">
                    <form id="objectionRequestForm" action="{{ route('information-requests.objection.store') }}"
                        method="POST" enctype="multipart/form-data" class="space-y-6 md:space-y-8">
                        @csrf

                        <!-- Data Pemohon (untuk keberatan) -->
                        <div class="space-y-6">
                            <h3 class="text-xl md:text-2xl font-semibold text-gray-700 pb-2 border-b">
                                <i class="fas fa-user-circle mr-2 text-blue-600"></i>Data Pemohon
                            </h3>

                            <!-- Nama Lengkap -->
                            <div>
                                <label for="objectionFullName" class="block text-base font-medium text-gray-700 mb-1">Nama
                                    Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" id="objectionFullName" name="full_name"
                                    value="{{ old('full_name') }}"
                                    class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                    required placeholder="Nama sesuai identitas">
                                @error('full_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jenis Identitas -->
                            <div>
                                <label for="objectionIdentityType"
                                    class="block text-base font-medium text-gray-700 mb-1">Jenis Identitas
                                    <span class="text-red-500">*</span></label>
                                <select id="objectionIdentityType" name="identity_type"
                                    class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                    required>
                                    <option value="" disabled selected>Pilih Jenis Identitas</option>
                                    <option value="KTP" {{ old('identity_type') == 'KTP' ? 'selected' : '' }}>KTP
                                    </option>
                                    <option value="SIM" {{ old('identity_type') == 'SIM' ? 'selected' : '' }}>SIM
                                    </option>
                                    <option value="Paspor" {{ old('identity_type') == 'Paspor' ? 'selected' : '' }}>Paspor
                                    </option>
                                    <option value="Lainnya" {{ old('identity_type') == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya
                                    </option>
                                </select>
                                @error('identity_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nomor Identitas -->
                            <div>
                                <label for="objectionIdentityNumber"
                                    class="block text-base font-medium text-gray-700 mb-1">Nomor Identitas
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="objectionIdentityNumber" name="identity_number"
                                    value="{{ old('identity_number') }}"
                                    class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                    required placeholder="Nomor KTP/SIM/Paspor">
                                @error('identity_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Upload Identitas -->
                            <div>
                                <label class="block text-base font-medium text-gray-700 mb-1">Upload Scan Identitas <span
                                        class="text-red-500">*</span></label>
                                <div id="objectionFileUploadContainer" class="mt-1">
                                    <label for="objectionIdentityScan" id="objectionFileUploadLabel"
                                        class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-lg p-4 cursor-pointer bg-gray-50 hover:border-blue-500 hover:bg-blue-50 transition">
                                        <div class="flex flex-col items-center justify-center pt-2 pb-3">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                            <p class="mb-1 text-lg font-semibold text-gray-600"
                                                id="objectionFileNameDisplay">
                                                <span class="font-bold">Klik untuk upload</span> atau seret & lepas
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                Format: JPG/PNG/PDF (Maks. 2MB)
                                            </p>
                                        </div>
                                        <input id="objectionIdentityScan" name="identity_scan" type="file"
                                            class="hidden" accept=".jpg,.jpeg,.png,.pdf" required>
                                    </label>
                                    @error('identity_scan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <div id="objectionImagePreviewContainer" class="mt-4 hidden">
                                        <img id="objectionImagePreview" src="#" alt="Pratinjau Identitas"
                                            class="max-w-full h-auto rounded-lg shadow-md border border-gray-200">
                                        <p class="text-sm text-gray-600 mt-2">File terpilih: <span
                                                id="objectionSelectedFileName" class="font-medium"></span></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Telepon -->
                            <div>
                                <label for="objectionPhone"
                                    class="block text-base font-medium text-gray-700 mb-1">Telepon/HP <span
                                        class="text-red-500">*</span></label>
                                <input type="tel" id="objectionPhone" name="phone" value="{{ old('phone') }}"
                                    class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                    required placeholder="Contoh: 081234567890">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Rincian Keberatan -->
                        <div class="space-y-6">
                            <h3 class="text-xl md:text-2xl font-semibold text-gray-700 pb-2 border-b">
                                <i class="fas fa-exclamation-triangle mr-2 text-blue-600"></i>Rincian Keberatan
                            </h3>

                            <!-- Alasan Pengajuan Keberatan -->
                            <div>
                                <label for="reason" class="block text-base font-medium text-gray-700 mb-1">
                                    Alasan Pengajuan Keberatan <span class="text-red-500">*</span>
                                </label>
                                <textarea id="reason" name="reason" rows="4"
                                    class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                    required placeholder="Jelaskan alasan Anda mengajukan keberatan">{{ old('reason') }}</textarea>
                                @error('reason')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Keterangan Tambahan -->
                            <div>
                                <label for="additionalInfo" class="block text-base font-medium text-gray-700 mb-1">
                                    Keterangan Tambahan
                                </label>
                                <textarea id="additionalInfo" name="additional_info" rows="4"
                                    class="w-full px-4 py-2 md:px-5 md:py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition"
                                    placeholder="Tambahkan keterangan lain jika diperlukan">{{ old('additional_info') }}</textarea>
                                @error('additional_info')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="flex items-center justify-center px-6 py-3 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg shadow transition hover:shadow-md">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Pengajuan Keberatan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> {{-- Tambahkan Alpine.js --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // --- Script untuk Form Permohonan Informasi ---
                const infoFileInput = document.getElementById('identityScan');
                const infoFileLabel = document.getElementById('fileUploadLabel');
                const infoFileNameDisplay = document.getElementById('fileNameDisplay');
                const infoImagePreviewContainer = document.getElementById('imagePreviewContainer');
                const infoImagePreview = document.getElementById('imagePreview');
                const infoSelectedFileNameSpan = document.getElementById('selectedFileName');

                function previewInfoFile(file) {
                    if (file) {
                        const fileType = file.type;
                        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        const isImage = validImageTypes.includes(fileType);

                        if (isImage) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                infoImagePreview.src = e.target.result;
                                infoImagePreview.alt = 'Pratinjau Identitas';
                                infoImagePreviewContainer.classList.remove('hidden');
                                infoFileNameDisplay.classList.add('hidden');
                            };
                            reader.readAsDataURL(file);
                        } else if (fileType === 'application/pdf') {
                            infoImagePreview.src = '';
                            infoImagePreview.alt = 'Dokumen PDF';
                            infoImagePreviewContainer.classList.remove('hidden');
                            infoFileNameDisplay.classList.add('hidden');
                        } else {
                            infoImagePreview.src = '';
                            infoImagePreviewContainer.classList.add('hidden');
                            infoFileNameDisplay.classList.remove('hidden');
                            infoFileNameDisplay.innerHTML =
                                '<span class="font-bold">Klik untuk upload</span> atau seret & lepas';
                        }
                        infoSelectedFileNameSpan.textContent = file.name;
                    } else {
                        infoImagePreview.src = '';
                        infoImagePreviewContainer.classList.add('hidden');
                        infoFileNameDisplay.classList.remove('hidden');
                        infoFileNameDisplay.innerHTML =
                            '<span class="font-bold">Klik untuk upload</span> atau seret & lepas';
                        infoSelectedFileNameSpan.textContent = '';
                    }
                }

                infoFileLabel.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    infoFileLabel.classList.add('border-blue-500', 'bg-blue-50');
                });
                infoFileLabel.addEventListener('dragleave', () => {
                    infoFileLabel.classList.remove('border-blue-500', 'bg-blue-50');
                });
                infoFileLabel.addEventListener('drop', (e) => {
                    e.preventDefault();
                    infoFileLabel.classList.remove('border-blue-500', 'bg-blue-50');
                    if (e.dataTransfer.files.length) {
                        infoFileInput.files = e.dataTransfer.files;
                        previewInfoFile(infoFileInput.files[0]);
                    }
                });
                infoFileInput.addEventListener('change', function() {
                    previewInfoFile(this.files[0]);
                });

                // --- Script untuk Form Pengajuan Keberatan ---
                const objectionFileInput = document.getElementById('objectionIdentityScan');
                const objectionFileLabel = document.getElementById('objectionFileUploadLabel');
                const objectionFileNameDisplay = document.getElementById('objectionFileNameDisplay');
                const objectionImagePreviewContainer = document.getElementById('objectionImagePreviewContainer');
                const objectionImagePreview = document.getElementById('objectionImagePreview');
                const objectionSelectedFileNameSpan = document.getElementById('objectionSelectedFileName');

                function previewObjectionFile(file) {
                    if (file) {
                        const fileType = file.type;
                        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        const isImage = validImageTypes.includes(fileType);

                        if (isImage) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                objectionImagePreview.src = e.target.result;
                                objectionImagePreview.alt = 'Pratinjau Identitas';
                                objectionImagePreviewContainer.classList.remove('hidden');
                                objectionFileNameDisplay.classList.add('hidden');
                            };
                            reader.readAsDataURL(file);
                        } else if (fileType === 'application/pdf') {
                            objectionImagePreview.src = '';
                            objectionImagePreview.alt = 'Dokumen PDF';
                            objectionImagePreviewContainer.classList.remove('hidden');
                            objectionFileNameDisplay.classList.add('hidden');
                        } else {
                            objectionImagePreview.src = '';
                            objectionImagePreviewContainer.classList.add('hidden');
                            objectionFileNameDisplay.classList.remove('hidden');
                            objectionFileNameDisplay.innerHTML =
                                '<span class="font-bold">Klik untuk upload</span> atau seret & lepas';
                        }
                        objectionSelectedFileNameSpan.textContent = file.name;
                    } else {
                        objectionImagePreview.src = '';
                        objectionImagePreviewContainer.classList.add('hidden');
                        objectionFileNameDisplay.classList.remove('hidden');
                        objectionFileNameDisplay.innerHTML =
                            '<span class="font-bold">Klik untuk upload</span> atau seret & lepas';
                        objectionSelectedFileNameSpan.textContent = '';
                    }
                }

                objectionFileLabel.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    objectionFileLabel.classList.add('border-blue-500', 'bg-blue-50');
                });
                objectionFileLabel.addEventListener('dragleave', () => {
                    objectionFileLabel.classList.remove('border-blue-500', 'bg-blue-50');
                });
                objectionFileLabel.addEventListener('drop', (e) => {
                    e.preventDefault();
                    objectionFileLabel.classList.remove('border-blue-500', 'bg-blue-50');
                    if (e.dataTransfer.files.length) {
                        objectionFileInput.files = e.dataTransfer.files;
                        previewObjectionFile(objectionFileInput.files[0]);
                    }
                });
                objectionFileInput.addEventListener('change', function() {
                    previewObjectionFile(this.files[0]);
                });
            });
        </script>
    @endpush
@endsection
