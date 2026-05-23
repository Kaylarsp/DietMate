@extends('admin.layouts.app')

@section('title', 'DietMate Admin - Kelola Profil User')

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

@php $activeRoute = 'users_profile'; @endphp

@section('content')
    <header class="flex justify-between items-end mb-16">
        <div>
            <h1 class="text-[40px] font-bold text-[#00685F] leading-tight tracking-tight">Kelola Profil User</h1>
            <p class="text-lg text-[#3D4947] mt-3">Atur dan perbarui profil pengguna DietMate.</p>
        </div>
    </header>

    <div id="profileLayout" class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-start">
        {{-- Table Section --}}
        <div id="tableSection" class="xl:col-span-2 flex flex-col gap-6">
            <div class="bg-white rounded-xl shadow-[0px_4px_20px_rgba(0,104,95,0.05)] border border-[#bcc9c6]/20 overflow-hidden flex flex-col h-full relative">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#008379]"></div>
                <div class="p-6 border-b border-[#bcc9c6]/30 flex justify-between items-center bg-[#f9f9f9]/50">
                    <h3 class="text-2xl font-semibold text-[#00685F] flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#008379]">badge</span>
                        Daftar Profil User
                    </h3>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#3D4947] text-[20px]">search</span>
                        <input id="searchInput" class="pl-10 pr-3 py-1.5 bg-[#eeeeee] rounded-full border-none text-sm focus:ring-2 focus:ring-[#008379] focus:bg-white transition-all w-48 sm:w-64" placeholder="Cari profil..." type="text">
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#f3f3f4] text-[#3D4947] text-xs font-semibold tracking-widest uppercase border-b border-[#bcc9c6]/30">
                                <th class="py-3 px-6 pl-8 font-semibold">Nama</th>
                                <th class="py-3 px-4 font-semibold">Usia</th>
                                <th class="py-3 px-4 font-semibold">Gender</th>
                                <th class="py-3 px-4 font-semibold">Tinggi (cm)</th>
                                <th class="py-3 px-4 font-semibold">Berat (kg)</th>
                                <th class="py-3 px-4 font-semibold">BMI</th>
                                <th class="py-3 px-4 font-semibold">Kalori Harian</th>
                                <th class="py-3 px-6 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="profileTableBody" class="text-sm divide-y divide-[#bcc9c6]/20">
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

        {{-- Edit Card --}}
        <div class="xl:col-span-1">
            <div id="editCard" class="hidden bg-white rounded-xl shadow-[0px_4px_20px_rgba(0,104,95,0.08)] border border-[#bcc9c6]/20 p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#BAAE21]/30 rounded-bl-full -z-10 blur-2xl"></div>
                <h3 class="text-2xl font-semibold text-[#00685F] mb-6 border-b border-[#bcc9c6]/30 pb-3 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#BAAE21]">edit</span>
                    Edit Profil
                </h3>
                <p class="font-body-sm text-sm text-[#6d7a77] mb-6 -mt-4">Perbarui informasi profil di bawah ini.</p>
                <form id="editProfileForm" class="flex flex-col gap-6">
                    <div id="editFormMessage" class="hidden text-sm font-medium px-4 py-2 rounded-lg"></div>
                    <input type="hidden" id="edit_id" name="id" value="">
                    <input type="hidden" id="edit_user_id" name="user_id" value="">
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_user_name">Nama</label>
                        <input class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C]" id="edit_user_name" name="user_name" type="text" readonly>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_age">Usia</label>
                        <input class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C]" id="edit_age" name="age" type="number" min="0" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_gender">Gender</label>
                        <input class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C]" id="edit_gender" name="gender" type="text" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_height_cm">Tinggi (cm)</label>
                        <input class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C]" id="edit_height_cm" name="height_cm" type="number" step="0.1" min="0" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_weight_kg">Berat (kg)</label>
                        <input class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C]" id="edit_weight_kg" name="weight_kg" type="number" step="0.1" min="0" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_activity_level">Aktivitas</label>
                        <div class="relative">
                            <select class="w-full px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] appearance-none" id="edit_activity_level" name="activity_level" required>
                                <option disabled selected value="">Pilih tingkat aktivitas...</option>
                                <option value="lightly_active">Ringan</option>
                                <option value="moderately_active">Sedang</option>
                                <option value="sedentary">Sedentari</option>
                                <option value="very_active">Sangat Aktif</option>
                                <option value="extra_active">Ekstra Aktif</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] pointer-events-none">expand_more</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_bmi">BMI</label>
                        <input class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C]" id="edit_bmi" name="bmi" type="number" step="0.0001" min="0" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_daily_calorie_target">Kalori Harian</label>
                        <input class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C]" id="edit_daily_calorie_target" name="daily_calorie_target" type="number" min="0" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="cocok_untuk">Diet Goal</label>
                        <div class="relative">
                            <select class="w-full px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] appearance-none" id="cocok_untuk" name="suitable_for" required>
                                <option disabled selected value="">Pilih target pengguna...</option>
                                <option value="weight_loss">Penurunan Berat Badan</option>
                                <option value="maintain">Pemeliharaan Berat Badan</option>
                                <option value="weight_gain">Peningkatan Berat Badan</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] pointer-events-none">expand_more</span>
                        </div>
                    </div>
                    <div class="mt-2 flex gap-3">
                        <button id="updateBtn" class="flex-1 bg-[#676000] hover:bg-[#4e4800] text-white font-semibold text-sm tracking-widest uppercase py-2 px-4 rounded-lg shadow-sm transition-all flex justify-center items-center gap-2" type="submit">
                            <span class="material-symbols-outlined text-[20px]">update</span>
                            Perbarui Profil
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
        const apiBase = @json(route('admin.api.user-profiles.index'));

        const tableBody = document.getElementById('profileTableBody');
        const paginationInfo = document.getElementById('paginationInfo');
        const prevBtn = document.getElementById('prevPageBtn');
        const nextBtn = document.getElementById('nextPageBtn');
        const searchInput = document.getElementById('searchInput');
        const editForm = document.getElementById('editProfileForm');
        const editFormMessage = document.getElementById('editFormMessage');
        const updateBtn = document.getElementById('updateBtn');
        const editCard = document.getElementById('editCard');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        const profileLayout = document.getElementById('profileLayout');
        const tableSection = document.getElementById('tableSection');

        const dotColors = [
            'bg-[#008379]',
            'bg-[#BAAE21]',
            'bg-[#6ED8CB]',
            'bg-[#BA1A1A]',
        ];

        const genderLabels = {
            male: 'Laki-laki',
            female: 'Perempuan',
        };

        const genderColors = {
            male: 'bg-[#CEE7E5] text-[#526967]',
            female: 'bg-[#e449a8] text-[#ffffff]',
        };

        function setEditMode(isEditing) {
            if (isEditing) {
                editCard.classList.remove('hidden');
                profileLayout.classList.remove('xl:grid-cols-1');
                profileLayout.classList.add('xl:grid-cols-3');
                tableSection.classList.remove('xl:col-span-3');
                tableSection.classList.add('xl:col-span-2');
            } else {
                editCard.classList.add('hidden');
                profileLayout.classList.remove('xl:grid-cols-3');
                profileLayout.classList.add('xl:grid-cols-1');
                tableSection.classList.remove('xl:col-span-2');
                tableSection.classList.add('xl:col-span-3');
            }
        }

        async function fetchProfiles(page = 1, search = '') {
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
                console.error('Error fetching profiles:', error);
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="8" class="py-8 text-center text-[#BA1A1A]">
                            <span class="material-symbols-outlined text-[40px] block mb-2">error</span>
                            Gagal memuat data. Silakan coba lagi.
                        </td>
                    </tr>
                `;
                paginationInfo.textContent = 'Gagal memuat data';
            }
        }

        function renderTable(profiles) {
            if (profiles.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="8" class="py-8 text-center text-[#3D4947]">
                            <span class="material-symbols-outlined text-[40px] block mb-2">badge</span>
                            Tidak ada profil ditemukan.
                        </td>
                    </tr>
                `;
                return;
            }

            tableBody.innerHTML = profiles.map((profile, index) => {
                const dotColor = dotColors[index % dotColors.length];
                const genderKey = (profile.gender || '').toString().toLowerCase();
                const genderLabel = genderLabels[genderKey] || profile.gender || '-';
                const genderColor = genderColors[genderKey] || 'bg-[#eeeeee] text-[#3D4947]';
                return `
                    <tr class="hover:bg-[#f3f3f4]/50 transition-colors group">
                        <td class="py-3 px-6 pl-8 align-top pt-4">
                            <div class="font-bold text-[#00685F] flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full ${dotColor}"></div>
                                ${escapeHtml(profile.user?.name || profile.user_name || '-')}
                            </div>
                        </td>
                        <td class="py-3 px-4 align-top pt-4">
                            <span class="text-[#3D4947]">${escapeHtml(profile.age)}</span>
                        </td>
                        <td class="py-3 px-4 align-top pt-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium ${genderColor}">
                                ${escapeHtml(genderLabel)}
                            </span>
                        </td>
                        <td class="py-3 px-4 align-top pt-4">
                            <span class="text-[#3D4947]">${escapeHtml(profile.height_cm)}</span>
                        </td>
                        <td class="py-3 px-4 align-top pt-4">
                            <span class="text-[#3D4947]">${escapeHtml(profile.weight_kg)}</span>
                        </td>
                        <td class="py-3 px-4 align-top pt-4">
                            <span class="text-[#3D4947]">${escapeHtml(profile.bmi)}</span>
                        </td>
                        <td class="py-3 px-4 align-top pt-4">
                            <span class="text-[#3D4947]">${escapeHtml(profile.daily_calorie_target)}</span>
                        </td>
                        <td class="py-3 px-6 align-top pt-4 text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick="editProfile(${profile.id})" class="p-1 rounded-full text-[#008379] hover:bg-[#008379]/10 transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button onclick="deleteProfile(${profile.id})" class="p-1 rounded-full text-[#BA1A1A] hover:bg-[#BA1A1A]/10 transition-colors" title="Hapus">
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
            paginationInfo.textContent = `Menampilkan ${start}-${end} dari ${totalItems} profil`;

            prevBtn.disabled = currentPage <= 1;
            nextBtn.disabled = currentPage >= lastPage;
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text ?? '';
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
                fetchProfiles(currentPage, this.value);
            }, 400);
        });

        prevBtn.addEventListener('click', function() {
            if (currentPage > 1) fetchProfiles(currentPage - 1, searchInput.value);
        });

        nextBtn.addEventListener('click', function() {
            if (currentPage < lastPage) fetchProfiles(currentPage + 1, searchInput.value);
        });

        window.editProfile = async function(id) {
            hideMessage(editFormMessage);
            setEditMode(true);
            editCard.scrollIntoView({ behavior: 'smooth', block: 'start' });

            try {
                const response = await axios.get(`${apiBase}/${id}`);
                const profile = response.data.data;

                document.getElementById('edit_id').value = profile.id;
                document.getElementById('edit_user_id').value = profile.user_id;
                document.getElementById('edit_user_name').value = profile.user?.name || profile.user_name || '';
                document.getElementById('edit_age').value = profile.age;
                document.getElementById('edit_gender').value = profile.gender;
                document.getElementById('edit_height_cm').value = profile.height_cm;
                document.getElementById('edit_weight_kg').value = profile.weight_kg;
                document.getElementById('edit_activity_level').value = profile.activity_level;
                document.getElementById('edit_bmi').value = profile.bmi;
                document.getElementById('edit_daily_calorie_target').value = profile.daily_calorie_target;
                document.getElementById('cocok_untuk').value = profile.diet_goal;
            } catch (error) {
                showMessage(editFormMessage, 'Gagal memuat data profil.', 'error');
            }
        };

        editForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            updateBtn.disabled = true;
            updateBtn.innerHTML = '<span class="material-symbols-outlined text-[20px] animate-spin">sync</span> Memperbarui...';
            hideMessage(editFormMessage);

            const formData = new FormData(editForm);
            const id = formData.get('id');
            const data = {
                user_id: formData.get('user_id'),
                age: formData.get('age'),
                gender: formData.get('gender'),
                height_cm: formData.get('height_cm'),
                weight_kg: formData.get('weight_kg'),
                activity_level: formData.get('activity_level'),
                bmi: formData.get('bmi'),
                daily_calorie_target: formData.get('daily_calorie_target'),
                diet_goal: formData.get('suitable_for'),
            };

            try {
                const response = await axios.put(`${apiBase}/${id}`, data);
                showMessage(editFormMessage, response.data.message || 'Profil berhasil diperbarui!', 'success');
                fetchProfiles(currentPage, searchInput.value);
            } catch (error) {
                if (error.response?.data?.errors) {
                    const errors = Object.values(error.response.data.errors).flat();
                    showMessage(editFormMessage, errors.join(', '), 'error');
                } else {
                    showMessage(editFormMessage, 'Gagal memperbarui profil. Silakan coba lagi.', 'error');
                }
            } finally {
                updateBtn.disabled = false;
                updateBtn.innerHTML = '<span class="material-symbols-outlined text-[20px]">update</span> Perbarui Profil';
            }
        });

        cancelEditBtn.addEventListener('click', function() {
            hideMessage(editFormMessage);
            editForm.reset();
            setEditMode(false);
        });

        window.deleteProfile = async function(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus profil ini?')) return;

            try {
                await axios.delete(`${apiBase}/${id}`);
                hideMessage(editFormMessage);
                editForm.reset();
                setEditMode(false);
                fetchProfiles(currentPage, searchInput.value);
            } catch (error) {
                const msg = error.response?.data?.message || 'Gagal menghapus profil. Silakan coba lagi.';
                alert(msg);
            }
        };

        setEditMode(false);
        fetchProfiles(1);
    });
</script>
@endpush
