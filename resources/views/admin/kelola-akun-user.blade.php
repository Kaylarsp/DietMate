@extends('admin.layouts.app')

@section('title', 'DietMate Admin - Kelola Akun User')

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

@php $activeRoute = 'users_account'; @endphp

@section('content')
    <header class="flex justify-between items-end mb-16">
        <div>
            <h1 class="text-[40px] font-bold text-[#00685F] leading-tight tracking-tight">Kelola Akun User</h1>
            <p class="text-lg text-[#3D4947] mt-3">Atur dan perbarui data pengguna DietMate.</p>
        </div>
    </header>

    <div id="userLayout" class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-start">
        {{-- Table Section --}}
        <div id="tableSection" class="xl:col-span-2 flex flex-col gap-6">
            <div class="bg-white rounded-xl shadow-[0px_4px_20px_rgba(0,104,95,0.05)] border border-[#bcc9c6]/20 overflow-hidden flex flex-col h-full relative">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#008379]"></div>
                <div class="p-6 border-b border-[#bcc9c6]/30 flex justify-between items-center bg-[#f9f9f9]/50">
                    <h3 class="text-2xl font-semibold text-[#00685F] flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#008379]">group</span>
                        Daftar User
                    </h3>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#3D4947] text-[20px]">search</span>
                        <input id="searchInput" class="pl-10 pr-3 py-1.5 bg-[#eeeeee] rounded-full border-none text-sm focus:ring-2 focus:ring-[#008379] focus:bg-white transition-all w-48 sm:w-64" placeholder="Cari user..." type="text">
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#f3f3f4] text-[#3D4947] text-sm font-semibold tracking-widest uppercase border-b border-[#bcc9c6]/30">
                                <th class="py-3 px-6 pl-8 font-semibold">Nama</th>
                                <th class="py-3 px-4 font-semibold">Email</th>
                                <th class="py-3 px-4 font-semibold">Role</th>
                                <th class="py-3 px-6 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody" class="text-sm divide-y divide-[#bcc9c6]/20">
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
                    Edit User
                </h3>
                <p class="font-body-sm text-sm text-[#6d7a77] mb-6 -mt-4">Perbarui informasi pengguna di bawah ini.</p>
                <form id="editUserForm" class="flex flex-col gap-6">
                    <div id="editFormMessage" class="hidden text-sm font-medium px-4 py-2 rounded-lg"></div>
                    <input type="hidden" id="edit_id" name="id" value="">
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_nama">Nama</label>
                        <input class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77]" id="edit_nama" name="name" type="text" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_email">Email</label>
                        <input class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77]" id="edit_email" name="email" type="email" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_password">Password</label>
                        <input class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77]" id="edit_password" name="password" type="password" placeholder="Kosongkan jika tidak ingin mengubah" autocomplete="new-password">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="edit_role">Role</label>
                        <div class="relative">
                            <select class="w-full px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] appearance-none" id="edit_role" name="role" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] pointer-events-none">expand_more</span>
                        </div>
                    </div>
                    <div class="mt-2 flex gap-3">
                        <button id="updateBtn" class="flex-1 bg-[#676000] hover:bg-[#4e4800] text-white font-semibold text-sm tracking-widest uppercase py-2 px-4 rounded-lg shadow-sm transition-all flex justify-center items-center gap-2" type="submit">
                            <span class="material-symbols-outlined text-[20px]">update</span>
                            Perbarui User
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
        const apiBase = '/api/admin/users';

        const tableBody = document.getElementById('userTableBody');
        const paginationInfo = document.getElementById('paginationInfo');
        const prevBtn = document.getElementById('prevPageBtn');
        const nextBtn = document.getElementById('nextPageBtn');
        const searchInput = document.getElementById('searchInput');
        const editForm = document.getElementById('editUserForm');
        const editFormMessage = document.getElementById('editFormMessage');
        const updateBtn = document.getElementById('updateBtn');
        const editCard = document.getElementById('editCard');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        const userLayout = document.getElementById('userLayout');
        const tableSection = document.getElementById('tableSection');
        function setEditMode(isEditing) {
            if (isEditing) {
                editCard.classList.remove('hidden');
                userLayout.classList.remove('xl:grid-cols-1');
                userLayout.classList.add('xl:grid-cols-3');
                tableSection.classList.remove('xl:col-span-3');
                tableSection.classList.add('xl:col-span-2');
            } else {
                editCard.classList.add('hidden');
                userLayout.classList.remove('xl:grid-cols-3');
                userLayout.classList.add('xl:grid-cols-1');
                tableSection.classList.remove('xl:col-span-2');
                tableSection.classList.add('xl:col-span-3');
            }
        }


        // Dot colors for variety
        const dotColors = [
            'bg-[#008379]',
            'bg-[#BAAE21]',
            'bg-[#6ED8CB]',
            'bg-[#BA1A1A]',
        ];

        const roleLabels = {
            'admin': 'Admin',
            'user': 'User',
        };

        const roleColors = {
            'admin': 'bg-[#F3E79B] text-[#6B5B00]',
            'user': 'bg-[#CEE7E5] text-[#526967]',
        };

        async function fetchUsers(page = 1, search = '') {
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
                console.error('Error fetching users:', error);
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="py-8 text-center text-[#BA1A1A]">
                            <span class="material-symbols-outlined text-[40px] block mb-2">error</span>
                            Gagal memuat data. Silakan coba lagi.
                        </td>
                    </tr>
                `;
                paginationInfo.textContent = 'Gagal memuat data';
            }
        }

        function renderTable(users) {
            if (users.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="py-8 text-center text-[#3D4947]">
                            <span class="material-symbols-outlined text-[40px] block mb-2">group</span>
                            Tidak ada user ditemukan.
                        </td>
                    </tr>
                `;
                return;
            }

            // Preload edit card with first user if edit card has no user loaded yet
            tableBody.innerHTML = users.map((user, index) => {
                const dotColor = dotColors[index % dotColors.length];
                const roleLabel = roleLabels[user.role] || user.role || '-';
                const roleColor = roleColors[user.role] || 'bg-[#eeeeee] text-[#3D4947]';
                return `
                    <tr class="hover:bg-[#f3f3f4]/50 transition-colors group">
                        <td class="py-3 px-6 pl-8 align-top pt-4">
                            <div class="font-bold text-[#00685F] flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full ${dotColor}"></div>
                                ${escapeHtml(user.name)}
                            </div>
                        </td>
                        <td class="py-3 px-4 align-top pt-4">
                            <span class="text-[#3D4947]">${escapeHtml(user.email)}</span>
                        </td>
                        <td class="py-3 px-4 align-top pt-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium ${roleColor}">
                                ${escapeHtml(roleLabel)}
                            </span>
                        </td>
                        <td class="py-3 px-6 align-top pt-4 text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick="editUser(${user.id})" class="p-1 rounded-full text-[#008379] hover:bg-[#008379]/10 transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button onclick="deleteUser(${user.id})" class="p-1 rounded-full text-[#BA1A1A] hover:bg-[#BA1A1A]/10 transition-colors" title="Hapus">
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
            paginationInfo.textContent = `Menampilkan ${start}-${end} dari ${totalItems} user`;

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
                fetchUsers(currentPage, this.value);
            }, 400);
        });

        prevBtn.addEventListener('click', function() {
            if (currentPage > 1) fetchUsers(currentPage - 1, searchInput.value);
        });

        nextBtn.addEventListener('click', function() {
            if (currentPage < lastPage) fetchUsers(currentPage + 1, searchInput.value);
        });

        window.editUser = async function(id) {
            hideMessage(editFormMessage);
            setEditMode(true);
            editCard.scrollIntoView({ behavior: 'smooth', block: 'start' });

            try {
                const response = await axios.get(`${apiBase}/${id}`);
                const user = response.data.data;

                document.getElementById('edit_id').value = user.id;
                document.getElementById('edit_nama').value = user.name;
                document.getElementById('edit_email').value = user.email;
                document.getElementById('edit_password').value = '';
                document.getElementById('edit_role').value = user.role;
            } catch (error) {
                showMessage(editFormMessage, 'Gagal memuat data user.', 'error');
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
                name: formData.get('name'),
                email: formData.get('email'),
                role: formData.get('role'),
            };

            // Only include password if it's not blank
            const password = formData.get('password');
            if (password) {
                data.password = password;
            }

            try {
                const response = await axios.put(`${apiBase}/${id}`, data);
                showMessage(editFormMessage, response.data.message || 'User berhasil diperbarui!', 'success');
                fetchUsers(currentPage, searchInput.value);
            } catch (error) {
                if (error.response?.data?.errors) {
                    const errors = Object.values(error.response.data.errors).flat();
                    showMessage(editFormMessage, errors.join(', '), 'error');
                } else {
                    showMessage(editFormMessage, 'Gagal memperbarui user. Silakan coba lagi.', 'error');
                }
            } finally {
                updateBtn.disabled = false;
                updateBtn.innerHTML = '<span class="material-symbols-outlined text-[20px]">update</span> Perbarui User';
            }
        });

        cancelEditBtn.addEventListener('click', function() {
            hideMessage(editFormMessage);
            editForm.reset();
            document.getElementById('edit_password').value = '';
            setEditMode(false);
        });

        window.deleteUser = async function(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus user ini?')) return;

            try {
                const response = await axios.delete(`${apiBase}/${id}`);
                hideMessage(editFormMessage);
                editForm.reset();
                document.getElementById('edit_password').value = '';
                setEditMode(false);
                fetchUsers(currentPage, searchInput.value);
            } catch (error) {
                const msg = error.response?.data?.message || 'Gagal menghapus user. Silakan coba lagi.';
                alert(msg);
            }
        };

        setEditMode(false);
        fetchUsers(1);
    });
</script>
@endpush