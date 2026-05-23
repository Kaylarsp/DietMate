@extends('admin.layouts.app')

@section('title', 'DietMate Admin - Kelola Menu Makanan')

@section('head')
    {{-- Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
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
            <div class="bg-white rounded-xl shadow-[0px_4px_20px_rgba(0,104,95,0.05)] border border-[#bcc9c6]/20 overflow-hidden flex flex-col h-full relative">
                {{-- Accent Line --}}
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#008379]"></div>
                <div class="p-6 border-b border-[#bcc9c6]/30 flex justify-between items-center bg-[#f9f9f9]/50">
                    <h3 class="text-2xl font-semibold text-[#00685F] flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#008379]">list_alt</span>
                        Daftar Menu
                    </h3>
                    {{-- Search / Filter basic --}}
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#3D4947] text-[20px]">search</span>
                        <input class="pl-10 pr-3 py-1.5 bg-[#eeeeee] rounded-full border-none text-sm focus:ring-2 focus:ring-[#008379] focus:bg-white transition-all w-48 sm:w-64" placeholder="Cari menu..." type="text">
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#f3f3f4] text-[#3D4947] text-sm font-semibold tracking-widest uppercase border-b border-[#bcc9c6]/30">
                                <th class="py-3 px-6 pl-8 font-semibold">Nama Menu</th>
                                <th class="py-3 px-4 font-semibold">Kategori</th>
                                <th class="py-3 px-4 font-semibold">Kalori</th>
                                <th class="py-3 px-6 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-[#bcc9c6]/20">
                            <tr class="hover:bg-[#f3f3f4]/50 transition-colors group">
                                <td class="py-3 px-6 pl-8 text-[#1A1C1C] font-medium">Oatmeal</td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-[#CEE7E5] text-[#526967] text-xs font-medium">
                                        Sarapan
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-[#3D4947]">350 kcal</td>
                                <td class="py-3 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button class="p-1 rounded-full text-[#008379] hover:bg-[#008379]/10 transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                        <button class="p-1 rounded-full text-[#BA1A1A] hover:bg-[#BA1A1A]/10 transition-colors" title="Hapus">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-[#f3f3f4]/50 transition-colors group">
                                <td class="py-3 px-6 pl-8 text-[#1A1C1C] font-medium">Salad Quinoa</td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-[#BAAE21]/30 text-[#464100] text-xs font-medium">
                                        Siang
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-[#3D4947]">550 kcal</td>
                                <td class="py-3 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button class="p-1 rounded-full text-[#008379] hover:bg-[#008379]/10 transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                        <button class="p-1 rounded-full text-[#BA1A1A] hover:bg-[#BA1A1A]/10 transition-colors" title="Hapus">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-[#f3f3f4]/50 transition-colors group">
                                <td class="py-3 px-6 pl-8 text-[#1A1C1C] font-medium">Grilled Chicken Breast</td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-[#008379]/30 text-[#005049] text-xs font-medium">
                                        Malam
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-[#3D4947]">420 kcal</td>
                                <td class="py-3 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button class="p-1 rounded-full text-[#008379] hover:bg-[#008379]/10 transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                        <button class="p-1 rounded-full text-[#BA1A1A] hover:bg-[#BA1A1A]/10 transition-colors" title="Hapus">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- Pagination Info --}}
                <div class="p-6 border-t border-[#bcc9c6]/30 flex justify-between items-center mt-auto bg-[#f9f9f9]/30">
                    <span class="text-sm text-[#3D4947]">Menampilkan 3 dari 24 menu</span>
                    <div class="flex gap-2">
                        <button class="p-1 rounded-lg border border-[#bcc9c6] text-[#3D4947] hover:bg-[#eeeeee] transition-colors disabled:opacity-50">
                            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                        </button>
                        <button class="p-1 rounded-lg border border-[#bcc9c6] text-[#3D4947] hover:bg-[#eeeeee] transition-colors">
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Form --}}
        <div class="xl:col-span-1">
            <div class="bg-white rounded-xl shadow-[0px_4px_20px_rgba(0,104,95,0.08)] border border-[#bcc9c6]/20 p-6 relative overflow-hidden">
                {{-- Decorative bg --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#CEE7E5]/30 rounded-bl-full -z-10 blur-2xl"></div>
                <h3 class="text-2xl font-semibold text-[#00685F] mb-6 border-b border-[#bcc9c6]/30 pb-3 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[#008379]">add_circle</span>
                    Tambah Menu Baru
                </h3>
                <form class="flex flex-col gap-6">
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="nama_makanan">Nama Makanan</label>
                        <input class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77]" id="nama_makanan" placeholder="Contoh: Nasi Merah Panggang" type="text">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="kategori">Kategori</label>
                        <div class="relative">
                            <select class="w-full px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] appearance-none" id="kategori">
                                <option disabled selected value="">Pilih Waktu Makan</option>
                                <option value="sarapan">Sarapan</option>
                                <option value="siang">Makan Siang</option>
                                <option value="malam">Makan Malam</option>
                                <option value="snack">Snack</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] pointer-events-none">expand_more</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="kalori">Kalori (kcal)</label>
                        <div class="relative">
                            <input class="w-full pl-4 pr-10 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77]" id="kalori" placeholder="0" type="number">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6d7a77] text-xs font-medium">kcal</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-[#3D4947] tracking-widest uppercase" for="deskripsi">Deskripsi Singkat</label>
                        <textarea class="px-4 py-2 bg-[#f9f9f9] rounded-lg border border-[#bcc9c6] focus:border-[#008379] focus:ring-2 focus:ring-[#008379]/20 focus:outline-none transition-all text-base text-[#1A1C1C] placeholder:text-[#6d7a77] resize-none" id="deskripsi" placeholder="Bahan utama atau deskripsi nutrisi..." rows="3"></textarea>
                    </div>
                    <div class="mt-2 flex gap-3">
                        <button class="flex-1 bg-[#008379] hover:bg-[#00685F] text-white font-semibold text-sm tracking-widest uppercase py-2 px-4 rounded-lg shadow-sm transition-all flex justify-center items-center gap-2" type="submit">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            Simpan Menu
                        </button>
                        <button class="px-4 py-2 rounded-lg bg-[#eeeeee] hover:bg-[#e2e2e2] text-[#3D4947] font-semibold text-sm tracking-widest uppercase border border-[#bcc9c6] transition-all" type="reset">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection