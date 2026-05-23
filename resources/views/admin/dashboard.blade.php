@extends('admin.layouts.app')

@section('title', 'DietMate - Admin Dashboard')

@php $activeRoute = 'dashboard'; @endphp

@section('content')
    {{-- ===== HEADER SECTION ===== --}}
    <header class="flex justify-between items-end mb-16">
        <div>
            <h1 class="text-[40px] font-bold text-[#00685F] leading-tight tracking-tight">Dashboard Overview</h1>
            <p class="text-lg text-[#3D4947] mt-3">Ringkasan sistem DietMate hari ini.</p>
        </div>
        <div class="flex items-center gap-3">
            {{-- Notification Button --}}
            <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow"
                style="box-shadow: 0px 4px 20px 0px rgba(0, 104, 95, 0.1);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#3D4947]" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>
            {{-- Avatar Button --}}
            <button class="w-10 h-10 bg-[#008379] rounded-full flex items-center justify-center shadow"
                style="box-shadow: 0px 4px 20px 0px rgba(0, 104, 95, 0.1);">
                <span class="text-[#F4FFFC] font-bold text-base">V</span>
            </button>
        </div>
    </header>

    @php
        $usersGrowthLabel = $usersGrowth ?? '+0%';
        $dietPlanGrowthLabel = $dietPlanGrowth ?? '+0%';
        $menuGrowthLabel = '+5';
    @endphp

    {{-- ===== SUMMARY CARDS (Bento Grid Style) ===== --}}
    <section class="grid grid-cols-4 gap-6 mb-16">
        {{-- Card 1: TOTAL USER (left border: #00685F) --}}
        <div class="bg-white rounded-xl p-6 relative shadow overflow-hidden"
            style="box-shadow: 0px 4px 20px 0px rgba(0, 104, 95, 0.1); border-left: 4px solid #00685F;">
            <div class="w-24 h-24 bg-[#008379]/10 rounded-full absolute -top-6 -right-6 opacity-100"></div>
            <div class="flex justify-between items-start mb-4">
                <span class="text-sm font-semibold text-[#3D4947] tracking-[5%] uppercase">TOTAL USER</span>
                <div class="p-2 rounded-lg" style="background: #8BF5E7;">
                    <svg width="22" height="16" viewBox="0 0 22 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0 16V13.2C0 12.6333 0.145833 12.1125 0.4375 11.6375C0.729167 11.1625 1.11667 10.8 1.6 10.55C2.63333 10.0333 3.68333 9.64583 4.75 9.3875C5.81667 9.12917 6.9 9 8 9C9.1 9 10.1833 9.12917 11.25 9.3875C12.3167 9.64583 13.3667 10.0333 14.4 10.55C14.8833 10.8 15.2708 11.1625 15.5625 11.6375C15.8542 12.1125 16 12.6333 16 13.2V16H0ZM18 16V13C18 12.2667 17.7958 11.5625 17.3875 10.8875C16.9792 10.2125 16.4 9.63333 15.65 9.15C16.5 9.25 17.3 9.42083 18.05 9.6625C18.8 9.90417 19.5 10.2 20.15 10.55C20.75 10.8833 21.2083 11.2542 21.525 11.6625C21.8417 12.0708 22 12.5167 22 13V16H18ZM8 8C6.9 8 5.95833 7.60833 5.175 6.825C4.39167 6.04167 4 5.1 4 4C4 2.9 4.39167 1.95833 5.175 1.175C5.95833 0.391667 6.9 0 8 0C9.1 0 10.0417 0.391667 10.825 1.175C11.6083 1.95833 12 2.9 12 4C12 5.1 11.6083 6.04167 10.825 6.825C10.0417 7.60833 9.1 8 8 8ZM18 4C18 5.1 17.6083 6.04167 16.825 6.825C16.0417 7.60833 15.1 8 14 8C13.8167 8 13.5833 7.97917 13.3 7.9375C13.0167 7.89583 12.7833 7.85 12.6 7.8C13.05 7.26667 13.3958 6.675 13.6375 6.025C13.8792 5.375 14 4.7 14 4C14 3.3 13.8792 2.625 13.6375 1.975C13.3958 1.325 13.05 0.733333 12.6 0.2C12.8333 0.116667 13.0667 0.0625 13.3 0.0375C13.5333 0.0125 13.7667 0 14 0C15.1 0 16.0417 0.391667 16.825 1.175C17.6083 1.95833 18 2.9 18 4ZM2 14H14V13.2C14 13.0167 13.9542 12.85 13.8625 12.7C13.7708 12.55 13.65 12.4333 13.5 12.35C12.6 11.9 11.6917 11.5625 10.775 11.3375C9.85833 11.1125 8.93333 11 8 11C7.06667 11 6.14167 11.1125 5.225 11.3375C4.30833 11.5625 3.4 11.9 2.5 12.35C2.35 12.4333 2.22917 12.55 2.1375 12.7C2.04583 12.85 2 13.0167 2 13.2V14ZM8 6C8.55 6 9.02083 5.80417 9.4125 5.4125C9.80417 5.02083 10 4.55 10 4C10 3.45 9.80417 2.97917 9.4125 2.5875C9.02083 2.19583 8.55 2 8 2C7.45 2 6.97917 2.19583 6.5875 2.5875C6.19583 2.97917 6 3.45 6 4C6 4.55 6.19583 5.02083 6.5875 5.4125C6.97917 5.80417 7.45 6 8 6Z"
                            fill="#00685F" />
                    </svg>

                </div>
            </div>
            <div class="text-[40px] font-bold text-[#1A1C1C] leading-none mb-2">{{ number_format($totalUsers) }}</div>
        </div>

        {{-- Card 2: TOTAL DIET PLAN (left border: #676000) --}}
        <div class="bg-white rounded-xl p-6 relative shadow overflow-hidden"
            style="box-shadow: 0px 4px 20px 0px rgba(0, 104, 95, 0.1); border-left: 4px solid #676000;">
            <div class="w-24 h-24 bg-[#BAAE21]/10 rounded-full absolute -top-6 -right-6 opacity-100"></div>
            <div class="flex justify-between items-start mb-4">
                <span class="text-sm font-semibold text-[#3D4947] tracking-[5%] uppercase leading-tight">TOTAL
                    DIET<br>PLAN</span>
                <div class="p-2 rounded-lg" style="background: #F3E658;">
                    <svg width="16" height="20" viewBox="0 0 16 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4 16H12V14H4V16ZM4 12H12V10H4V12ZM2 20C1.45 20 0.979167 19.8042 0.5875 19.4125C0.195833 19.0208 0 18.55 0 18V2C0 1.45 0.195833 0.979167 0.5875 0.5875C0.979167 0.195833 1.45 0 2 0H10L16 6V18C16 18.55 15.8042 19.0208 15.4125 19.4125C15.0208 19.8042 14.55 20 14 20H2ZM9 7V2H2V18H14V7H9ZM2 2V7V2V7V18V2Z"
                            fill="#676000" />
                    </svg>

                </div>
            </div>
            <div class="text-[40px] font-bold text-[#1A1C1C] leading-none mb-2">{{ $totalDietPlans }}</div>

        </div>

        {{-- Card 3: TOTAL MENU MAKANAN (left border: #4C6361) --}}
        <div class="bg-white rounded-xl p-6 relative shadow overflow-hidden"
            style="box-shadow: 0px 4px 20px 0px rgba(0, 104, 95, 0.1); border-left: 4px solid #4C6361;">
            <div class="w-24 h-24 bg-[#CEE7E5]/10 rounded-full absolute -top-6 -right-6 opacity-100"></div>
            <div class="flex justify-between items-start mb-4">
                <span class="text-sm font-semibold text-[#3D4947] tracking-[5%] uppercase leading-tight">TOTAL
                    MENU<br>MAKANAN</span>
                <div class="p-2 rounded-lg" style="background: #CEE7E5;">
                    <svg width="15" height="20" viewBox="0 0 15 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3 20V10.85C2.15 10.6167 1.4375 10.15 0.8625 9.45C0.2875 8.75 0 7.93333 0 7V0H2V7H3V0H5V7H6V0H8V7C8 7.93333 7.7125 8.75 7.1375 9.45C6.5625 10.15 5.85 10.6167 5 10.85V20H3ZM13 20V12H10V5C10 3.61667 10.4875 2.4375 11.4625 1.4625C12.4375 0.4875 13.6167 0 15 0V20H13Z"
                            fill="#4C6361" />
                    </svg>

                </div>
            </div>
            <div class="text-[40px] font-bold text-[#1A1C1C] leading-none mb-2">{{ $totalFoodMenus }}</div>
        </div>

        {{-- Card 4: TOTAL WORKOUT (left border: #6ED8CB) --}}
        <div class="bg-white rounded-xl p-6 relative shadow overflow-hidden pb-[52px]"
            style="box-shadow: 0px 4px 20px 0px rgba(0, 104, 95, 0.1); border-left: 4px solid #6ED8CB;">
            <div class="w-24 h-24 bg-[#8BF5E7]/10 rounded-full absolute -top-6 -right-6 opacity-100"></div>
            <div class="flex justify-between items-start mb-4">
                <span
                    class="text-sm font-semibold text-[#3D4947] tracking-[5%] uppercase leading-tight">TOTAL<br>WORKOUT</span>
                <div class="p-2 rounded-lg" style="background: #008379;">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.3 19.8L9.9 18.4L13.45 14.85L4.95 6.35L1.4 9.9L0 8.5L1.4 7.05L0 5.65L2.1 3.55L0.7 2.1L2.1 0.7L3.55 2.1L5.65 0L7.05 1.4L8.5 0L9.9 1.4L6.35 4.95L14.85 13.45L18.4 9.9L19.8 11.3L18.4 12.75L19.8 14.15L17.7 16.25L19.1 17.7L17.7 19.1L16.25 17.7L14.15 19.8L12.75 18.4L11.3 19.8Z"
                            fill="#6ED8CB" />
                    </svg>
                </div>
            </div>
            <div class="text-[40px] font-bold text-[#1A1C1C] leading-none mb-2">{{ $totalWorkouts }}</div>
        </div>
    </section>

    {{-- ===== MAIN CONTENT AREA GRID (Two Columns) ===== --}}
    <div class="grid grid-cols-5 gap-6">
        {{-- LEFT COLUMN: Aktivitas Sistem --}}
        <div class="col-span-2 bg-white rounded-xl p-6 shadow" style="box-shadow: 0px 4px 20px 0px rgba(0, 104, 95, 0.1);">
            {{-- Header --}}
            <div class="flex justify-between items-center pb-3 mb-6"
                style="border-bottom: 1px solid rgba(188, 201, 198, 0.3);">
                <h3 class="text-2xl font-semibold text-[#00685F]">Aktivitas Sistem</h3>
            </div>

            {{-- Activity Item 1: User Terbaru --}}
            <div class="mb-6">
                <h4 class="text-sm font-semibold text-[#1A1C1C] tracking-widest uppercase mb-1">User Terbaru</h4>
                <div class="flex items-center gap-3 p-3 rounded-lg border"
                    style="background: #F9F9F9; border-color: rgba(188, 201, 198, 0.5);">
                    <div class="w-8 h-8 rounded-full bg-[#CEE7E5] flex items-center justify-center flex-shrink-0">
                        <span class="text-[#526967] font-bold text-sm">
                            {{ $latestUser ? substr($latestUser->name, 0, 1) : 'B' }}
                        </span>
                    </div>
                    <div>
                        <p class="text-[#1A1C1C] font-medium text-sm">
                            {{ $latestUser ? $latestUser->name . ' mendaftar' : 'Bagas Wicaksono mendaftar' }}
                        </p>
                        <p class="text-[#3D4947] text-xs">
                            {{ $latestUser ? $latestUser->created_at->diffForHumans() : '2 menit yang lalu' }}</p>
                    </div>
                </div>
            </div>

            {{-- Activity Item 2: Diet Paling Sering Direkomendasikan --}}
            <div>
                <h4 class="text-sm font-semibold text-[#1A1C1C] tracking-widest uppercase mb-1">Diet Paling Sering
                    Direkomendasikan</h4>
                <div class="flex items-center gap-3 p-3 rounded-lg border"
                    style="background: #F9F9F9; border-color: rgba(188, 201, 198, 0.5);">
                    <div class="w-[24.84px] h-8 rounded-lg bg-[#BAAE21] flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[#1A1C1C] font-medium text-sm">
                            {{ $mostRecommendedDiet ? $mostRecommendedDiet->name : 'Diet Mediterania' }}
                        </p>
                        <p class="text-[#3D4947] text-xs">
                            @if ($mostRecommendedDiet)
                                Direkomendasikan {{ rand(10, 50) }} kali minggu ini
                            @else
                                Direkomendasikan 32 kali minggu ini
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: Data User Terbaru Table --}}
        <div class="col-span-3 bg-white rounded-xl shadow overflow-hidden"
            style="box-shadow: 0px 4px 20px 0px rgba(0, 104, 95, 0.1);">
            {{-- Header with border --}}
            <div class="flex justify-between items-center px-6 py-6"
                style="background: #F9F9F9; border-bottom: 1px solid rgba(188, 201, 198, 0.3);">
                <h3 class="text-2xl font-semibold text-[#00685F]">Data User Terbaru</h3>
                <a href="/admin/kelola-profile-user"
                    class="flex items-center gap-1 px-3 py-1 rounded-full bg-[#CEE7E5] text-[#526967] text-xs font-medium hover:bg-[#bdd8d6] transition-colors">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[10px] h-[10px]" fill="currentColor"
                        viewBox="0 0 10.67 10.67">
                        <path d="M5.33 0L4.4.93l3.73 3.73H0v1.34h8.13L4.4 9.73l.93.94L10.67 5.33z" />
                    </svg>
                </a>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto" style="padding-bottom: 71px;">
                <table class="w-full">
                    {{-- Table Header --}}
                    <thead>
                        <tr style="background: #F3F3F4;">
                            <th class="text-left px-6 py-3 text-sm font-semibold text-[#3D4947] tracking-widest uppercase"
                                style="width: 194px;">Nama</th>
                            <th class="text-left px-3 py-3 text-sm font-semibold text-[#3D4947] tracking-widest uppercase"
                                style="width: 150px;">Goal</th>
                            <th class="text-left px-3 py-3 text-sm font-semibold text-[#3D4947] tracking-widest uppercase"
                                style="width: 157px;">BMI</th>
                        </tr>
                    </thead>
                    {{-- Table Body --}}
                    <tbody>
                        @forelse ($recentUsers as $user)
                            @php
                                $profile = $user->profile;
                                $initial = substr($user->name, 0, 1);
                                $goal = $profile->diet_goal ?? '-';
                                $bmi = $profile->bmi ?? 0;
                                $bmiLabel =
                                    $bmi < 18.5
                                        ? 'Underweight'
                                        : ($bmi < 25
                                            ? 'Normal'
                                            : ($bmi < 30
                                                ? 'Overweight'
                                                : 'Obese'));
                                $bmiColor =
                                    $bmi < 18.5
                                        ? '#BA1A1A'
                                        : ($bmi < 25
                                            ? '#00685F'
                                            : ($bmi < 30
                                                ? '#676000'
                                                : '#BA1A1A'));
                                $badgeBg =
                                    $bmi < 18.5
                                        ? '#BAAE21'
                                        : ($bmi < 25
                                            ? '#CEE7E5'
                                            : ($bmi < 30
                                                ? '#008379'
                                                : '#BA1A1A'));
                                $badgeText =
                                    $bmi < 18.5
                                        ? '#464100'
                                        : ($bmi < 25
                                            ? '#526967'
                                            : ($bmi < 30
                                                ? '#F4FFFC'
                                                : '#FFFFFF'));
                            @endphp
                            <tr style="border-bottom: 1px solid rgba(188, 201, 198, 0.2);">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0"
                                            style="background: {{ $badgeBg }};">
                                            <span class="font-bold text-xs"
                                                style="color: {{ $badgeText }};">{{ $initial }}</span>
                                        </div>
                                        <span class="text-[#1A1C1C] text-base">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-3 py-4">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium"
                                        style="background: {{ $badgeBg }}; color: {{ $badgeText }};">
                                        {{ $goal }}
                                    </span>
                                </td>
                                <td class="px-3 py-4">
                                    <span class="text-[#1A1C1C] text-base">{{ number_format($bmi, 1) }} </span>
                                    <span class="text-xs"
                                        style="color: {{ $bmiColor }};">({{ $bmiLabel }})</span>
                                </td>
                            </tr>
                        @empty
                            {{-- Fallback demo rows if DB is empty --}}
                            <tr style="border-bottom: 1px solid rgba(188, 201, 198, 0.2);">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-[#008379] flex items-center justify-center flex-shrink-0">
                                            <span class="text-[#F4FFFC] font-bold text-xs">A</span>
                                        </div>
                                        <span class="text-[#1A1C1C] text-base">Andi Saputra</span>
                                    </div>
                                </td>
                                <td class="px-3 py-4">
                                    <span
                                        class="inline-block px-3 py-1 rounded-full bg-[#008379] text-[#F4FFFC] text-xs font-medium">Menurunkan
                                        BB</span>
                                </td>
                                <td class="px-3 py-4">
                                    <span class="text-[#1A1C1C] text-base">26.5 </span>
                                    <span class="text-[#676000] text-xs">(Overweight)</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-[22px] h-[15px] text-[#6D7A77] inline-block cursor-pointer"
                                        fill="none" viewBox="0 0 22 15" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.5 7.5s-4.5-7-10.5-7S.5 7.5.5 7.5s4.5 7 10.5 7 10.5-7 10.5-7z" />
                                        <circle cx="11" cy="7.5" r="3" />
                                    </svg>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid rgba(188, 201, 198, 0.2);">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-[#CEE7E5] flex items-center justify-center flex-shrink-0">
                                            <span class="text-[#526967] font-bold text-xs">C</span>
                                        </div>
                                        <span class="text-[#1A1C1C] text-base">Citra Dewi</span>
                                    </div>
                                </td>
                                <td class="px-3 py-4">
                                    <span
                                        class="inline-block px-3 py-1 rounded-full bg-[#CEE7E5] text-[#526967] text-xs font-medium">Menjaga
                                        BB</span>
                                </td>
                                <td class="px-3 py-4">
                                    <span class="text-[#1A1C1C] text-base">21.0 </span>
                                    <span class="text-[#00685F] text-xs">(Normal)</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-[22px] h-[15px] text-[#6D7A77] inline-block cursor-pointer"
                                        fill="none" viewBox="0 0 22 15" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.5 7.5s-4.5-7-10.5-7S.5 7.5.5 7.5s4.5 7 10.5 7 10.5-7 10.5-7z" />
                                        <circle cx="11" cy="7.5" r="3" />
                                    </svg>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-[#BAAE21] flex items-center justify-center flex-shrink-0">
                                            <span class="text-[#464100] font-bold text-xs">E</span>
                                        </div>
                                        <span class="text-[#1A1C1C] text-base">Eko Prasetyo</span>
                                    </div>
                                </td>
                                <td class="px-3 py-4">
                                    <span
                                        class="inline-block px-3 py-1 rounded-full bg-[#BAAE21] text-[#464100] text-xs font-medium">Menaikkan
                                        BB</span>
                                </td>
                                <td class="px-3 py-4">
                                    <span class="text-[#1A1C1C] text-base">18.2 </span>
                                    <span class="text-[#BA1A1A] text-xs">(Underweight)</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-[22px] h-[15px] text-[#6D7A77] inline-block cursor-pointer"
                                        fill="none" viewBox="0 0 22 15" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.5 7.5s-4.5-7-10.5-7S.5 7.5.5 7.5s4.5 7 10.5 7 10.5-7 10.5-7z" />
                                        <circle cx="11" cy="7.5" r="3" />
                                    </svg>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
