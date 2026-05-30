@extends('admin.layouts.app')

@section('title', 'DietMate Admin - Kelola Menu Makanan')

@section('head')
    {{-- Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/cropperjs@1.6.2/dist/cropper.min.css" rel="stylesheet">
    <style>
        /* Custom Scrollbar for modern look */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f3f3f4;
        }

        ::-webkit-scrollbar-thumb {
            background: #bcc9c6;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #6d7a77;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0;
        }
    </style>
@endsection

@php $activeRoute = 'menu'; @endphp

@section('content')
    {{-- Page Header --}}
    <header class="flex justify-between items-end mb-16">
        <div>
            <h1 class="text-[40px] font-bold text-[#00685F] leading-tight tracking-tight">Kelola Menu Makanan</h1>
            <p class="text-lg text-[#3D4947] mt-3">Atur dan perbarui daftar menu makanan untuk pengguna.</p>
        </div>
    </header>

    {{-- Dashboard Grid Layout --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-start">
        {{-- Left Column: Data Table (Takes up 2 columns on large screens) --}}
        <div class="xl:col-span-2 flex flex-col gap-6">
            {{-- Table Card --}}
            <div
                class="bg-white rounded-xl shadow-[0px_4px_20px_rgba(0,104,95,0.05)] border border-[#bcc9c6]/20 overflow-hidden flex flex-col h-full relative">
                {{-- Accent Line --}}
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#008379]"></div>
                <div class="p-6 border-b border-[#bcc9c6]/30 flex justify-between items-center bg-[#f9f9f9]/50">
                    <h3 class="text-2xl font-semibold text-[#00685F] flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#008379]">list_alt</span>
                        Daftar Menu
                    </h3>
                    {{-- Search / Filter basic --}}
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#3D4947] text-[20px]">search</span>
                        <input id="searchInput"
                            class="pl-10 pr-3 py-1.5 bg-[#eeeeee] rounded-full border-none text-sm focus:ring-2 focus:ring-[#008379] focus:bg-white transition-all w-48 sm:w-64"
                            placeholder="Cari menu..." type="text">
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-[#f3f3f4] text-[#3D4947] text-sm font-semibold tracking-widest uppercase border-b border-[#bcc9c6]/30">
                                <th class="py-3 px-3 pl-8 font-semibold">Gambar</th>
                                <th class="py-3 px-4 font-semibold">Nama Menu</th>
                                <th class="py-3 px-4 font-semibold">Kategori</th>
                                <th class="py-3 px-4 font-semibold">Kalori</th>
                                <th class="py-3 px-6 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="menuTableBody" class="text-sm divide-y divide-[#bcc9c6]/20">
                            {{-- Table rows will be populated by JavaScript --}}
                        </tbody>
                    </table>
                </div>
                {{-- Pagination Info --}}
                <div id="paginationSection"
                    class="p-6 border-t border-[#bcc9c6]/30 flex justify-between items-center mt-auto bg-[#f9f9f9]/30">
                    <span id="paginationInfo" class="text-sm text-[#3D4947]">Memuat data...</span>
                    <div id="paginationButtons" class="flex gap-2">
                        <button id="prevPageBtn"
                            class="p-1 rounded-lg border border-[#bcc9c6] text-[#3D4947] hover:bg-[#eeeeee] transition-colors disabled:opacity-50"
                            disabled>
                            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                        </button>
                        <button id="nextPageBtn"
                            class="p-1 rounded-lg border border-[#bcc9c6] text-[#3D4947] hover:bg-[#eeeeee] transition-colors disabled:opacity-50"
                            disabled>
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Form --}}
        <div class="xl:col-span-1">
            <div id="addMenuCard"
                class="bg-white rounded-xl shadow-[0px_4px_20px_rgba(0,104,95,0.08)] border border-[#bcc9c6]/20 p-6 relative overflow-hidden">
                {{-- Decorative bg --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#CEE7E5]/30 rounded-bl-full -z-10 blur-2xl"></div>
                <h3
                    class="text-2xl font-semibold text-[#00685F] mb-6 border-b border-[#bcc9c6]/30 pb-3 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#008379]">add_circle</span>
                    Tambah Menu Baru
                </h3>
                <form id="addMenuForm" class="flex flex-col gap-6">
                    <div id="formMessage" class="hidden text-sm font-medium px-4 py-2 rounded-lg"></div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase"
                            for="nama_makanan">Nama Makanan</label>
                        <input
                            class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77]"
                            id="nama_makanan" name="name" placeholder="Contoh: Nasi Merah Panggang" type="text"
                            required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase"
                            for="kategori">Kategori</label>
                        <div class="relative">
                            <select
                                class="w-full px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] appearance-none"
                                id="kategori" name="category" required>
                                <option disabled selected value="">Pilih Waktu Makan</option>
                                <option value="sarapan">Sarapan</option>
                                <option value="siang">Makan Siang</option>
                                <option value="malam">Makan Malam</option>
                                <option value="snack">Snack</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] pointer-events-none">expand_more</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="kalori">Kalori
                            (kcal)</label>
                        <div class="relative">
                            <input
                                class="w-full pl-4 pr-10 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77]"
                                id="kalori" name="calories" placeholder="0" type="number" min="0" required>
                            <span
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] text-xs font-medium">kcal</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase"
                            for="deskripsi">Deskripsi Singkat</label>
                        <textarea
                            class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77] resize-none"
                            id="deskripsi" name="description" placeholder="Bahan utama atau deskripsi nutrisi..." rows="3"></textarea>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="gambar">Gambar
                            Menu</label>
                        <input
                            class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] file:mr-4 file:rounded-md file:border-0 file:bg-[#008379]/10 file:px-3 file:py-1.5 file:text-[#005049]"
                            id="gambar" name="image" type="file" accept="image/*">
                        <p class="text-xs text-[#6d7a77]">Format: JPG/PNG/WEBP, maksimal 2MB.</p>
                        <button id="addImagePreviewBtn" type="button"
                            class="hidden h-16 w-16 overflow-hidden rounded-full ring-1 ring-[#bcc9c6]/50 bg-[#e5e7eb]">
                            <img id="addImagePreview" src="" alt="Preview gambar"
                                class="h-full w-full object-cover">
                        </button>
                    </div>
                    <div class="mt-2">
                        <button id="submitBtn"
                            class="w-full bg-[#008379] hover:bg-[#00685F] text-white font-semibold text-sm tracking-widest uppercase py-2 px-4 rounded-lg shadow-sm transition-all flex justify-center items-center gap-2"
                            type="submit">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            Simpan Menu
                        </button>
                    </div>
                </form>
            </div>

            {{-- Edit Card (hidden by default) --}}
            <div id="editCard"
                class="bg-white rounded-xl shadow-[0px_4px_20px_rgba(0,104,95,0.08)] border border-[#bcc9c6]/20 p-6 relative overflow-hidden hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#BAAE21]/30 rounded-bl-full -z-10 blur-2xl"></div>
                <h3
                    class="text-2xl font-semibold text-[#00685F] mb-6 border-b border-[#bcc9c6]/30 pb-3 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#BAAE21]">edit</span>
                    Edit Menu
                </h3>
                <form id="editMenuForm" class="flex flex-col gap-6">
                    <div id="editFormMessage" class="hidden text-sm font-medium px-4 py-2 rounded-lg"></div>
                    <input type="hidden" id="edit_id" name="id" value="">
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase"
                            for="edit_nama_makanan">Nama Makanan</label>
                        <input
                            class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77]"
                            id="edit_nama_makanan" name="name" type="text" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase"
                            for="edit_kategori">Kategori</label>
                        <div class="relative">
                            <select
                                class="w-full px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] appearance-none"
                                id="edit_kategori" name="category" required>
                                <option value="sarapan">Sarapan</option>
                                <option value="siang">Makan Siang</option>
                                <option value="malam">Makan Malam</option>
                                <option value="snack">Snack</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] pointer-events-none">expand_more</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase"
                            for="edit_kalori">Kalori (kcal)</label>
                        <div class="relative">
                            <input
                                class="w-full pl-4 pr-10 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77]"
                                id="edit_kalori" name="calories" type="number" min="0" required>
                            <span
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] text-xs font-medium">kcal</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase"
                            for="edit_deskripsi">Deskripsi Singkat</label>
                        <textarea
                            class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77] resize-none"
                            id="edit_deskripsi" name="description" rows="3"></textarea>
                    </div>
                    <div class="flex flex-row gap-2 items-center justify-start">
                        <button id="editImagePreviewBtn" type="button"
                            class="hidden h-16 w-16 overflow-hidden rounded-full ring-1 ring-[#bcc9c6]/50 bg-[#e5e7eb]">
                            <img id="editImagePreview" src="" alt="Preview gambar"
                                class="h-full w-full object-cover">
                        </button>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase"
                                for="edit_gambar">Gambar Menu (opsional)</label>
                            <input
                                class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] file:mr-4 file:rounded-md file:border-0 file:bg-[#BAAE21]/15 file:px-3 file:py-1.5 file:text-[#464100]"
                                id="edit_gambar" name="image" type="file" accept="image/*">
                            <p class="text-xs text-[#6d7a77]">Unggah untuk mengganti gambar yang ada.</p>
                        </div>

                    </div>
                    <div class="mt-2 flex gap-3">
                        <button id="updateBtn"
                            class="flex-1 bg-[#676000] hover:bg-[#4e4800] text-white font-semibold text-sm tracking-widest uppercase py-2 px-4 rounded-lg shadow-sm transition-all flex justify-center items-center gap-2"
                            type="submit">
                            <span class="material-symbols-outlined text-[20px]">update</span>
                            Perbarui Menu
                        </button>
                        <button id="cancelEditBtn"
                            class="px-4 py-2 rounded-lg bg-[#eeeeee] hover:bg-[#e2e2e2] text-[#3D4947] font-semibold text-sm tracking-widest uppercase border border-[#bcc9c6] transition-all"
                            type="button">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="imagePreviewModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 p-6">
        <div class="relative max-h-[80vh] max-w-[90vw]">
            <button id="closeImagePreview" type="button"
                class="absolute -right-3 -top-3 rounded-full bg-white p-2 text-[#3D4947] shadow-md">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
            <img id="imagePreviewModalImg" src="" alt="Preview gambar"
                class="max-h-[80vh] max-w-[90vw] rounded-xl object-contain">
        </div>
    </div>

    <div id="cropModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 p-6">
        <div class="w-full max-w-3xl rounded-2xl bg-white shadow-lg">
            <div class="flex items-center justify-between border-b border-[#bcc9c6]/30 px-5 py-4">
                <h4 class="text-lg font-semibold text-[#00685F]">Potong Gambar</h4>
                <button id="closeCropModal" type="button" class="rounded-full bg-[#eeeeee] p-2 text-[#3D4947]">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            <div class="p-5">
                <div class="max-h-[60vh] overflow-hidden rounded-xl bg-[#f3f3f4]">
                    <img id="cropImage" src="" alt="Crop gambar" class="max-h-[60vh] w-full object-contain">
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 border-t border-[#bcc9c6]/30 px-5 py-4">
                <button id="cancelCropBtn" type="button"
                    class="rounded-lg border border-[#bcc9c6] px-4 py-2 text-sm font-semibold text-[#3D4947]">Batal</button>
                <button id="confirmCropBtn" type="button"
                    class="rounded-lg bg-[#008379] px-4 py-2 text-sm font-semibold text-white">Simpan</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/cropperjs@1.6.2/dist/cropper.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // State
            let currentPage = 1;
            let lastPage = 1;
            let totalItems = 0;
            let searchTimeout = null;
            const apiBase = @json(route('admin.api.food-menus.index'));

            // DOM elements
            const tableBody = document.getElementById('menuTableBody');
            const paginationInfo = document.getElementById('paginationInfo');
            const prevBtn = document.getElementById('prevPageBtn');
            const nextBtn = document.getElementById('nextPageBtn');
            const searchInput = document.getElementById('searchInput');
            const addForm = document.getElementById('addMenuForm');
            const editForm = document.getElementById('editMenuForm');
            const formMessage = document.getElementById('formMessage');
            const editFormMessage = document.getElementById('editFormMessage');
            const submitBtn = document.getElementById('submitBtn');
            const updateBtn = document.getElementById('updateBtn');
            const editCard = document.getElementById('editCard');
            const cancelEditBtn = document.getElementById('cancelEditBtn');
            const addMenuCard = document.getElementById('addMenuCard');
            const addImageInput = document.getElementById('gambar');
            const editImageInput = document.getElementById('edit_gambar');
            const addImagePreview = document.getElementById('addImagePreview');
            const editImagePreview = document.getElementById('editImagePreview');
            const addImagePreviewBtn = document.getElementById('addImagePreviewBtn');
            const editImagePreviewBtn = document.getElementById('editImagePreviewBtn');
            const imagePreviewModal = document.getElementById('imagePreviewModal');
            const imagePreviewModalImg = document.getElementById('imagePreviewModalImg');
            const closeImagePreview = document.getElementById('closeImagePreview');
            const cropModal = document.getElementById('cropModal');
            const closeCropModalDocId = document.getElementById('closeCropModal');
            const cancelCropBtn = document.getElementById('cancelCropBtn');
            const confirmCropBtn = document.getElementById('confirmCropBtn');
            const cropImage = document.getElementById('cropImage');
            let cropper = null;
            let activeInput = null;
            let activePreviewImg = null;
            let activePreviewBtn = null;

            // Category badge styles
            const categoryStyles = {
                'sarapan': {
                    bg: 'bg-[#CEE7E5]',
                    text: 'text-[#526967]',
                    label: 'Sarapan'
                },
                'siang': {
                    bg: 'bg-[#BAAE21]/30',
                    text: 'text-[#464100]',
                    label: 'Makan Siang'
                },
                'malam': {
                    bg: 'bg-[#008379]/30',
                    text: 'text-[#005049]',
                    label: 'Makan Malam'
                },
                'snack': {
                    bg: 'bg-[#8BF5E7]/30',
                    text: 'text-[#005049]',
                    label: 'Snack'
                },
            };

            // Fetch menus from API
            async function fetchMenus(page = 1, search = '') {
                try {
                    let url = `${apiBase}?page=${page}&per_page=10`;
                    if (search) {
                        url += `&search=${encodeURIComponent(search)}`;
                    }

                    const response = await axios.get(url);
                    const data = response.data;

                    currentPage = data.current_page;
                    lastPage = data.last_page;
                    totalItems = data.total;

                    renderTable(data.data);
                    renderPagination();
                } catch (error) {
                    console.error('Error fetching menus:', error);
                    tableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="py-8 text-center text-[#BA1A1A]">
                            <span class="material-symbols-outlined text-[40px] block mb-2">error</span>
                            Gagal memuat data. Silakan coba lagi.
                        </td>
                    </tr>
                `;
                    paginationInfo.textContent = 'Gagal memuat data';
                }
            }

            // Render table rows
            function renderTable(menus) {
                if (menus.length === 0) {
                    tableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="py-8 text-center text-[#3D4947]">
                            <span class="material-symbols-outlined text-[40px] block mb-2">restaurant</span>
                            Tidak ada menu ditemukan.
                        </td>
                    </tr>
                `;
                    return;
                }

                tableBody.innerHTML = menus.map(menu => {
                    const style = categoryStyles[menu.category] || categoryStyles['sarapan'];
                    return `
                    <tr class="hover:bg-[#f3f3f4]/50 transition-colors group">
                        <td class="py-3 px-3 pl-8">
                            <button type="button" class="h-10 w-10 overflow-hidden rounded-full bg-[#e5e7eb] ring-1 ring-[#bcc9c6]/50" data-preview-src="${escapeHtml(menu.image_url || '/images/placeholder-food.png')}">
                                     <img src="${escapeHtml(menu.image_url || '/images/placeholder-food.png')}" alt="${escapeHtml(menu.name)}" class="h-full w-full object-cover" onerror="this.onerror=null;this.src='/images/placeholder-food.png'" />
                            </button>
                        </td>
                        <td class="py-3 px-4 text-[#1A1C1C] font-medium">${escapeHtml(menu.name)}</td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full ${style.bg} ${style.text} text-xs font-medium">
                                ${style.label}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-[#3D4947]">${menu.calories} kcal</td>
                        <td class="py-3 px-6 text-right">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick="editMenu(${menu.id})" class="p-1 rounded-full text-[#008379] hover:bg-[#008379]/10 transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button onclick="deleteMenu(${menu.id})" class="p-1 rounded-full text-[#BA1A1A] hover:bg-[#BA1A1A]/10 transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                }).join('');
            }

            // Render pagination
            function renderPagination() {
                const start = ((currentPage - 1) * 10) + 1;
                const end = Math.min(currentPage * 10, totalItems);
                paginationInfo.textContent = `Menampilkan ${start}-${end} dari ${totalItems} menu`;

                prevBtn.disabled = currentPage <= 1;
                nextBtn.disabled = currentPage >= lastPage;
            }

            // Helper: escape HTML
            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            // Helper: show form message
            function showMessage(element, message, type = 'success') {
                element.textContent = message;
                element.className =
                    `text-sm font-medium px-4 py-2 rounded-lg ${type === 'success' ? 'bg-[#CEE7E5] text-[#005049]' : 'bg-[#FFDAD6] text-[#93000A]'} block`;
            }

            function hideMessage(element) {
                element.className = 'hidden text-sm font-medium px-4 py-2 rounded-lg';
            }

            function openImagePreview(src) {
                if (!src) {
                    return;
                }
                imagePreviewModalImg.src = src;
                imagePreviewModal.classList.remove('hidden');
                imagePreviewModal.classList.add('flex');
            }

            function closeImagePreviewModal() {
                imagePreviewModalImg.src = '';
                imagePreviewModal.classList.add('hidden');
                imagePreviewModal.classList.remove('flex');
            }

            function setFormImagePreview(file, imgEl, btnEl) {
                if (!file) {
                    imgEl.src = '';
                    btnEl.classList.add('hidden');
                    return;
                }
                const url = URL.createObjectURL(file);
                imgEl.src = url;
                btnEl.classList.remove('hidden');
            }

            function openCropModal(file, inputEl, previewImgEl, previewBtnEl) {
                if (!file) {
                    return;
                }
                activeInput = inputEl;
                activePreviewImg = previewImgEl;
                activePreviewBtn = previewBtnEl;

                const url = URL.createObjectURL(file);
                cropImage.src = url;
                cropModal.classList.remove('hidden');
                cropModal.classList.add('flex');

                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(cropImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    background: false,
                    movable: true,
                    zoomable: true,
                    scalable: false,
                    rotatable: false,
                });
            }

            function closeCropModal() {
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                cropImage.src = '';
                cropModal.classList.add('hidden');
                cropModal.classList.remove('flex');
            }

            // Search with debounce
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    currentPage = 1;
                    fetchMenus(currentPage, this.value);
                }, 400);
            });

            // Pagination buttons
            prevBtn.addEventListener('click', function() {
                if (currentPage > 1) {
                    fetchMenus(currentPage - 1, searchInput.value);
                }
            });

            nextBtn.addEventListener('click', function() {
                if (currentPage < lastPage) {
                    fetchMenus(currentPage + 1, searchInput.value);
                }
            });

            tableBody.addEventListener('click', function(e) {
                const previewBtn = e.target.closest('[data-preview-src]');
                if (!previewBtn) {
                    return;
                }
                openImagePreview(previewBtn.getAttribute('data-preview-src'));
            });

            addImageInput.addEventListener('change', function() {
                if (this.files[0]) {
                    openCropModal(this.files[0], this, addImagePreview, addImagePreviewBtn);
                }
            });

            editImageInput.addEventListener('change', function() {
                if (this.files[0]) {
                    openCropModal(this.files[0], this, editImagePreview, editImagePreviewBtn);
                }
            });

            addImagePreviewBtn.addEventListener('click', function() {
                openImagePreview(addImagePreview.src);
            });

            editImagePreviewBtn.addEventListener('click', function() {
                openImagePreview(editImagePreview.src);
            });

            closeImagePreview.addEventListener('click', closeImagePreviewModal);
            imagePreviewModal.addEventListener('click', function(e) {
                if (e.target === imagePreviewModal) {
                    closeImagePreviewModal();
                }
            });

            closeCropModalDocId.addEventListener('click', closeCropModal);
            cancelCropBtn.addEventListener('click', function() {
                if (activeInput) {
                    activeInput.value = '';
                }
                closeCropModal();
            });

            confirmCropBtn.addEventListener('click', function() {
                if (!cropper || !activeInput) {
                    closeCropModal();
                    return;
                }

                const canvas = cropper.getCroppedCanvas({
                    width: 600,
                    height: 600,
                    imageSmoothingQuality: 'high',
                });

                canvas.toBlob(function(blob) {
                    if (!blob) {
                        closeCropModal();
                        return;
                    }
                    const file = new File([blob], 'menu.webp', {
                        type: 'image/webp'
                    });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    activeInput.files = dataTransfer.files;
                    setFormImagePreview(file, activePreviewImg, activePreviewBtn);
                    closeCropModal();
                }, 'image/webp', 0.9);
            });

            // Add menu form submission
            addForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                submitBtn.disabled = true;
                submitBtn.innerHTML =
                    '<span class="material-symbols-outlined text-[20px] animate-spin">sync</span> Menyimpan...';

                hideMessage(formMessage);

                const formData = new FormData(addForm);
                formData.set('calories', parseInt(formData.get('calories')) || 0);
                formData.set('description', formData.get('description') || '');

                try {
                    const response = await axios.post(apiBase, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },
                    });
                    showMessage(formMessage, response.data.message || 'Menu berhasil ditambahkan!',
                        'success');
                    addForm.reset();
                    // Refresh table and go to first page
                    currentPage = 1;
                    searchInput.value = '';
                    fetchMenus(1);
                } catch (error) {
                    if (error.response && error.response.data && error.response.data.errors) {
                        const errors = Object.values(error.response.data.errors).flat();
                        showMessage(formMessage, errors.join(', '), 'error');
                    } else {
                        showMessage(formMessage, 'Gagal menyimpan menu. Silakan coba lagi.', 'error');
                    }
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML =
                        '<span class="material-symbols-outlined text-[20px]">save</span> Simpan Menu';
                }
            });

            // Edit menu - load data
            window.editMenu = async function(id) {
                hideMessage(editFormMessage);
                editCard.classList.remove('hidden');
                addMenuCard.classList.add('hidden');
                editCard.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                try {
                    const response = await axios.get(`${apiBase}/${id}`);
                    const menu = response.data.data;

                    document.getElementById('edit_id').value = menu.id;
                    document.getElementById('edit_nama_makanan').value = menu.name;
                    document.getElementById('edit_kategori').value = menu.category;
                    document.getElementById('edit_kalori').value = menu.calories;
                    document.getElementById('edit_deskripsi').value = menu.description || '';

                    if (menu.image_url) {
                        editImagePreview.src = menu.image_url;
                        editImagePreviewBtn.classList.remove('hidden');
                    } else {
                        editImagePreview.src = '';
                        editImagePreviewBtn.classList.add('hidden');
                    }
                } catch (error) {
                    showMessage(editFormMessage, 'Gagal memuat data menu.', 'error');
                }
            };

            const closeEditForm = () => {
                editCard.classList.add('hidden');
                addMenuCard.classList.remove('hidden');
                hideMessage(editFormMessage);
                editForm.reset();
                editImagePreview.src = '';
                editImagePreviewBtn.classList.add('hidden');
            }

            // Update menu form submission
            editForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                updateBtn.disabled = true;
                updateBtn.innerHTML =
                    '<span class="material-symbols-outlined text-[20px] animate-spin">sync</span> Memperbarui...';

                hideMessage(editFormMessage);

                const formData = new FormData(editForm);
                const id = formData.get('id');
                formData.set('calories', parseInt(formData.get('calories')) || 0);
                formData.set('description', formData.get('description') || '');
                formData.set('_method', 'PUT');

                try {
                    const response = await axios.post(`${apiBase}/${id}`, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },
                    });
                    showMessage(editFormMessage, response.data.message || 'Menu berhasil diperbarui!',
                        'success');
                    // Refresh table keeping current page and search
                    fetchMenus(currentPage, searchInput.value);
                    closeEditForm();
                } catch (error) {
                    if (error.response && error.response.data && error.response.data.errors) {
                        const errors = Object.values(error.response.data.errors).flat();
                        showMessage(editFormMessage, errors.join(', '), 'error');
                    } else {
                        showMessage(editFormMessage, 'Gagal memperbarui menu. Silakan coba lagi.',
                            'error');
                    }
                } finally {
                    updateBtn.disabled = false;
                    updateBtn.innerHTML =
                        '<span class="material-symbols-outlined text-[20px]">update</span> Perbarui Menu';
                }
            });

            // Cancel edit
            cancelEditBtn.addEventListener('click', closeEditForm);

            // Delete menu
            window.deleteMenu = async function(id) {
                if (!confirm('Apakah Anda yakin ingin menghapus menu ini?')) {
                    return;
                }

                try {
                    await axios.delete(`${apiBase}/${id}`);
                    // Close edit state if open
                    editCard.classList.add('hidden');
                    addMenuCard.classList.remove('hidden');
                    hideMessage(editFormMessage);
                    editForm.reset();
                    // Refresh table keeping current page and search
                    fetchMenus(currentPage, searchInput.value);
                } catch (error) {
                    alert('Gagal menghapus menu. Silakan coba lagi.');
                }
            };

            // Initial load
            fetchMenus(1);
        });
    </script>
@endpush
