@extends('admin.layouts.app')

@section('title', 'DietMate Admin - Kelola Olahraga')

@section('head')
    {{-- Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f3f3f4; }
        ::-webkit-scrollbar-thumb { background: #bcc9c6; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #6d7a77; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0; }
    </style>
@endsection

@php $activeRoute = 'exercise'; @endphp

@section('content')
    <header class="flex justify-between items-end mb-16">
        <div>
            <h1 class="text-[40px] font-bold text-[#00685F] leading-tight tracking-tight">Kelola Olahraga</h1>
            <p class="text-lg text-[#3D4947] mt-3">Atur dan perbarui daftar aktivitas olahraga untuk pengguna DietMate.</p>
        </div>
    </header>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-start">
        {{-- Table Section --}}
        <div class="xl:col-span-2 flex flex-col gap-6">
            <div class="bg-white rounded-xl shadow-[0px_4px_20px_rgba(0,104,95,0.05)] border border-[#bcc9c6]/20 overflow-hidden flex flex-col h-full relative">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#008379]"></div>
                <div class="p-6 border-b border-[#bcc9c6]/30 flex justify-between items-center bg-[#f9f9f9]/50">
                    <h3 class="text-2xl font-semibold text-[#00685F] flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#008379]">fitness_center</span>
                        Daftar Workout Aktif
                    </h3>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#3D4947] text-[20px]">search</span>
                        <input id="searchInput" class="pl-10 pr-3 py-1.5 bg-[#eeeeee] rounded-full border-none text-sm focus:ring-2 focus:ring-[#008379] focus:bg-white transition-all w-48 sm:w-64" placeholder="Cari olahraga..." type="text">
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#f3f3f4] text-[#3D4947] text-sm font-semibold tracking-widest uppercase border-b border-[#bcc9c6]/30">
                                <th class="py-3 px-6 pl-8 font-semibold">Nama Olahraga</th>
                                <th class="py-3 px-4 font-semibold">Durasi</th>
                                <th class="py-3 px-4 font-semibold">Intensitas</th>
                                <th class="py-3 px-4 font-semibold">Kalori/mnt</th>
                                <th class="py-3 px-6 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="workoutTableBody" class="text-sm divide-y divide-[#bcc9c6]/20">
                        </tbody>
                    </table>
                </div>
                <div id="paginationSection" class="p-6 border-t border-[#bcc9c6]/30 flex justify-between items-center mt-auto bg-[#f9f9f9]/30">
                    <span id="paginationInfo" class="text-sm text-[#3D4947]">Memuat data...</span>
                    <div id="paginationButtons" class="flex gap-2">
                        <button id="prevPageBtn" class="p-1 rounded-lg border border-[#bcc9c6] text-[#3D4947] hover:bg-[#eeeeee] transition-colors disabled:opacity-50" disabled>
                            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                        </button>
                        <button id="nextPageBtn" class="p-1 rounded-lg border border-[#bcc9c6] text-[#3D4947] hover:bg-[#eeeeee] transition-colors disabled:opacity-50" disabled>
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Section --}}
        <div class="xl:col-span-1">
            {{-- Add Card --}}
            <div id="addWorkoutCard" class="bg-white rounded-xl shadow-[0px_4px_20px_rgba(0,104,95,0.08)] border border-[#bcc9c6]/20 p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#CEE7E5]/30 rounded-bl-full -z-10 blur-2xl"></div>
                <h3 class="text-2xl font-semibold text-[#00685F] mb-6 border-b border-[#bcc9c6]/30 pb-3 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#008379]">add_circle</span>
                    Tambah Workout
                </h3>
                <form id="addWorkoutForm" class="flex flex-col gap-6">
                    <div id="formMessage" class="hidden text-sm font-medium px-4 py-2 rounded-lg"></div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="nama">Nama Olahraga</label>
                        <input class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77]" id="nama" name="name" placeholder="Contoh: Bersepeda" type="text" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="durasi">Durasi (Menit)</label>
                        <div class="relative">
                            <input class="w-full px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77] pr-12" id="durasi" name="duration_minutes" placeholder="30" type="number" min="1" required>
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] text-sm">mnt</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="intensitas">Level Intensitas</label>
                        <div class="relative">
                            <select class="w-full px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] appearance-none" id="intensitas" name="intensity" required>
                                <option disabled selected value="">Pilih intensitas...</option>
                                <option value="santai">Santai</option>
                                <option value="ringan">Ringan</option>
                                <option value="sedang">Sedang</option>
                                <option value="berat">Berat</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] pointer-events-none">expand_more</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="kalori">Kalori per Menit</label>
                        <div class="relative">
                            <input class="w-full px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77] pr-12" id="kalori" name="cals_burned_per_min" placeholder="5.5" type="number" step="0.1" min="0">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] text-sm">kkal</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 flex-1">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="deskripsi">Deskripsi Singkat</label>
                        <textarea class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77] resize-none" id="deskripsi" name="description" placeholder="Tambahkan catatan atau panduan singkat..." rows="3" required></textarea>
                    </div>
                    <div class="mt-2">
                        <button id="submitBtn" class="w-full bg-[#008379] hover:bg-[#00685F] text-white font-semibold text-sm tracking-widest uppercase py-2 px-4 rounded-lg shadow-sm transition-all flex justify-center items-center gap-2" type="submit">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            Simpan Workout
                        </button>
                    </div>
                </form>
            </div>

            {{-- Edit Card --}}
            <div id="editCard" class="bg-white rounded-xl shadow-[0px_4px_20px_rgba(0,104,95,0.08)] border border-[#bcc9c6]/20 p-6 relative overflow-hidden hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#BAAE21]/30 rounded-bl-full -z-10 blur-2xl"></div>
                <h3 class="text-2xl font-semibold text-[#00685F] mb-6 border-b border-[#bcc9c6]/30 pb-3 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#BAAE21]">edit</span>
                    Edit Workout
                </h3>
                <form id="editWorkoutForm" class="flex flex-col gap-6">
                    <div id="editFormMessage" class="hidden text-sm font-medium px-4 py-2 rounded-lg"></div>
                    <input type="hidden" id="edit_id" name="id" value="">
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_nama">Nama Olahraga</label>
                        <input class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77]" id="edit_nama" name="name" type="text" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_durasi">Durasi (Menit)</label>
                        <div class="relative">
                            <input class="w-full px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77] pr-12" id="edit_durasi" name="duration_minutes" type="number" min="1" required>
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] text-sm">mnt</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_intensitas">Level Intensitas</label>
                        <div class="relative">
                            <select class="w-full px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] appearance-none" id="edit_intensitas" name="intensity" required>
                                <option value="">Pilih intensitas...</option>
                                <option value="santai">Santai</option>
                                <option value="ringan">Ringan</option>
                                <option value="sedang">Sedang</option>
                                <option value="berat">Berat</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] pointer-events-none">expand_more</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_kalori">Kalori per Menit</label>
                        <div class="relative">
                            <input class="w-full px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77] pr-12" id="edit_kalori" name="cals_burned_per_min" type="number" step="0.1" min="0">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] text-sm">kkal</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 flex-1">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_deskripsi">Deskripsi Singkat</label>
                        <textarea class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77] resize-none" id="edit_deskripsi" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mt-2 flex gap-3">
                        <button id="updateBtn" class="flex-1 bg-[#676000] hover:bg-[#4e4800] text-white font-semibold text-sm tracking-widest uppercase py-2 px-4 rounded-lg shadow-sm transition-all flex justify-center items-center gap-2" type="submit">
                            <span class="material-symbols-outlined text-[20px]">update</span>
                            Perbarui Workout
                        </button>
                        <button id="cancelEditBtn" class="px-4 py-2 rounded-lg bg-[#eeeeee] hover:bg-[#e2e2e2] text-[#3D4947] font-semibold text-sm tracking-widest uppercase border border-[#bcc9c6] transition-all" type="button">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentPage = 1;
        let lastPage = 1;
        let totalItems = 0;
        let searchTimeout = null;
        const apiBase = @json(route('admin.api.workouts.index'));

        const tableBody = document.getElementById('workoutTableBody');
        const paginationInfo = document.getElementById('paginationInfo');
        const prevBtn = document.getElementById('prevPageBtn');
        const nextBtn = document.getElementById('nextPageBtn');
        const searchInput = document.getElementById('searchInput');
        const addForm = document.getElementById('addWorkoutForm');
        const editForm = document.getElementById('editWorkoutForm');
        const formMessage = document.getElementById('formMessage');
        const editFormMessage = document.getElementById('editFormMessage');
        const submitBtn = document.getElementById('submitBtn');
        const updateBtn = document.getElementById('updateBtn');
        const editCard = document.getElementById('editCard');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        const addWorkoutCard = document.getElementById('addWorkoutCard');

        // Dot colors for variety
        const dotColors = [
            'bg-[#008379]',
            'bg-[#BAAE21]',
            'bg-[#6ED8CB]',
            'bg-[#BA1A1A]',
        ];

        const intensityLabels = {
            'santai': 'Santai',
            'ringan': 'Ringan',
            'sedang': 'Sedang',
            'berat': 'Berat',
        };

        const intensityColors = {
            'santai': 'bg-[#eeeeee] text-[#3D4947]',
            'ringan': 'bg-[#CEE7E5] text-[#526967]',
            'sedang': 'bg-[#BAAE21]/30 text-[#464100]',
            'berat': 'bg-[#FFDAD6] text-[#93000A]',
        };

        async function fetchWorkouts(page = 1, search = '') {
            try {
                let url = `${apiBase}?page=${page}&per_page=10`;
                if (search) url += `&search=${encodeURIComponent(search)}`;

                const response = await axios.get(url);
                const data = response.data;

                currentPage = data.current_page;
                lastPage = data.last_page;
                totalItems = data.total;

                renderTable(data.data);
                renderPagination();
            } catch (error) {
                console.error('Error fetching workouts:', error);
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

        function renderTable(workouts) {
            if (workouts.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="py-8 text-center text-[#3D4947]">
                            <span class="material-symbols-outlined text-[40px] block mb-2">fitness_center</span>
                            Tidak ada workout ditemukan.
                        </td>
                    </tr>
                `;
                return;
            }

            tableBody.innerHTML = workouts.map((workout, index) => {
                const dotColor = dotColors[index % dotColors.length];
                const desc = workout.description.length > 80
                    ? escapeHtml(workout.description.substring(0, 80)) + '...'
                    : escapeHtml(workout.description);
                const intensityLabel = intensityLabels[workout.intensity] || workout.intensity || '-';
                const intensityColor = intensityColors[workout.intensity] || 'bg-[#eeeeee] text-[#3D4947]';
                const kalori = workout.cals_burned_per_min ? parseFloat(workout.cals_burned_per_min).toFixed(1) : '-';
                return `
                    <tr class="hover:bg-[#f3f3f4]/50 transition-colors group">
                        <td class="py-3 px-6 pl-8 align-top pt-4">
                            <div class="font-bold text-[#00685F] flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full ${dotColor}"></div>
                                ${escapeHtml(workout.name)}
                            </div>
                        </td>
                        <td class="py-3 px-4 align-top pt-4">
                            <span class="text-[#3D4947]">${workout.duration_minutes} menit</span>
                        </td>
                        <td class="py-3 px-4 align-top pt-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium ${intensityColor}">
                                ${escapeHtml(intensityLabel)}
                            </span>
                        </td>
                        <td class="py-3 px-4 align-top pt-4">
                            <span class="text-[#3D4947] font-medium">${kalori}</span>
                        </td>
                        <td class="py-3 px-6 align-top pt-4 text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick="editWorkout(${workout.id})" class="p-1 rounded-full text-[#008379] hover:bg-[#008379]/10 transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button onclick="deleteWorkout(${workout.id})" class="p-1 rounded-full text-[#BA1A1A] hover:bg-[#BA1A1A]/10 transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        function renderPagination() {
            const start = ((currentPage - 1) * 10) + 1;
            const end = Math.min(currentPage * 10, totalItems);
            paginationInfo.textContent = `Menampilkan ${start}-${end} dari ${totalItems} workout`;

            prevBtn.disabled = currentPage <= 1;
            nextBtn.disabled = currentPage >= lastPage;
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function showMessage(element, message, type = 'success') {
            element.textContent = message;
            element.className = `text-sm font-medium px-4 py-2 rounded-lg ${type === 'success' ? 'bg-[#CEE7E5] text-[#005049]' : 'bg-[#FFDAD6] text-[#93000A]'} block`;
        }

        function hideMessage(element) {
            element.className = 'hidden text-sm font-medium px-4 py-2 rounded-lg';
        }

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                currentPage = 1;
                fetchWorkouts(currentPage, this.value);
            }, 400);
        });

        prevBtn.addEventListener('click', function() {
            if (currentPage > 1) fetchWorkouts(currentPage - 1, searchInput.value);
        });

        nextBtn.addEventListener('click', function() {
            if (currentPage < lastPage) fetchWorkouts(currentPage + 1, searchInput.value);
        });

        addForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="material-symbols-outlined text-[20px] animate-spin">sync</span> Menyimpan...';
            hideMessage(formMessage);

            const formData = new FormData(addForm);
            const calsVal = formData.get('cals_burned_per_min');
            const data = {
                name: formData.get('name'),
                duration_minutes: parseInt(formData.get('duration_minutes'), 10),
                intensity: formData.get('intensity'),
                description: formData.get('description') || '',
                cals_burned_per_min: calsVal ? parseFloat(calsVal) : 0,
            };

            try {
                const response = await axios.post(apiBase, data);
                showMessage(formMessage, response.data.message || 'Workout berhasil ditambahkan!', 'success');
                addForm.reset();
                currentPage = 1;
                searchInput.value = '';
                fetchWorkouts(1);
            } catch (error) {
                if (error.response?.data?.errors) {
                    const errors = Object.values(error.response.data.errors).flat();
                    showMessage(formMessage, errors.join(', '), 'error');
                } else {
                    showMessage(formMessage, 'Gagal menyimpan workout. Silakan coba lagi.', 'error');
                }
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span class="material-symbols-outlined text-[20px]">save</span> Simpan Workout';
            }
        });

        window.editWorkout = async function(id) {
            hideMessage(editFormMessage);
            editCard.classList.remove('hidden');
            addWorkoutCard.classList.add('hidden');
            editCard.scrollIntoView({ behavior: 'smooth', block: 'start' });

            try {
                const response = await axios.get(`${apiBase}/${id}`);
                const workout = response.data.data;

                document.getElementById('edit_id').value = workout.id;
                document.getElementById('edit_nama').value = workout.name;
                document.getElementById('edit_durasi').value = workout.duration_minutes;
                document.getElementById('edit_intensitas').value = workout.intensity;
                document.getElementById('edit_kalori').value = workout.cals_burned_per_min;
                document.getElementById('edit_deskripsi').value = workout.description;
            } catch (error) {
                showMessage(editFormMessage, 'Gagal memuat data workout.', 'error');
            }
        };

        editForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            updateBtn.disabled = true;
            updateBtn.innerHTML = '<span class="material-symbols-outlined text-[20px] animate-spin">sync</span> Memperbarui...';
            hideMessage(editFormMessage);

            const formData = new FormData(editForm);
            const id = formData.get('id');
            const calsVal = formData.get('cals_burned_per_min');
            const data = {
                name: formData.get('name'),
                duration_minutes: parseInt(formData.get('duration_minutes'), 10),
                intensity: formData.get('intensity'),
                description: formData.get('description') || '',
                cals_burned_per_min: calsVal ? parseFloat(calsVal) : 0,
            };

            try {
                const response = await axios.put(`${apiBase}/${id}`, data);
                showMessage(editFormMessage, response.data.message || 'Workout berhasil diperbarui!', 'success');
                fetchWorkouts(currentPage, searchInput.value);
            } catch (error) {
                if (error.response?.data?.errors) {
                    const errors = Object.values(error.response.data.errors).flat();
                    showMessage(editFormMessage, errors.join(', '), 'error');
                } else {
                    showMessage(editFormMessage, 'Gagal memperbarui workout. Silakan coba lagi.', 'error');
                }
            } finally {
                updateBtn.disabled = false;
                updateBtn.innerHTML = '<span class="material-symbols-outlined text-[20px]">update</span> Perbarui Workout';
            }
        });

        cancelEditBtn.addEventListener('click', function() {
            editCard.classList.add('hidden');
            addWorkoutCard.classList.remove('hidden');
            hideMessage(editFormMessage);
            editForm.reset();
        });

        window.deleteWorkout = async function(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus workout ini?')) return;

            try {
                await axios.delete(`${apiBase}/${id}`);
                editCard.classList.add('hidden');
                addWorkoutCard.classList.remove('hidden');
                hideMessage(editFormMessage);
                editForm.reset();
                fetchWorkouts(currentPage, searchInput.value);
            } catch (error) {
                alert('Gagal menghapus workout. Silakan coba lagi.');
            }
        };

        fetchWorkouts(1);
    });
</script>
@endpush