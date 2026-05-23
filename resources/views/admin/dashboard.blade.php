<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DietMate - Admin Dashboard</title>

    {{-- Google Fonts: Manrope --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind CSS via Vite --}}
    @vite(['resources/css/app.css'])
</head>

<body class="font-sans antialiased"
    style="background: linear-gradient(141deg, #F9F9F9 0%, #CEE7E5 100%); min-height: 100vh;">

    {{-- ============================= --}}
    {{-- SIDENAVBAR (Left Sidebar, 256px) --}}
    {{-- ============================= --}}
    <aside
        class="fixed top-0 left-0 w-[256px] h-screen bg-[#F3F3F4] border-r border-[#BCC9C6] z-50 flex flex-col justify-between"
        style="box-shadow: 0px 2px 4px -2px rgba(0,0,0,0.1), 0px 4px 6px -1px rgba(0,0,0,0.1);">

        {{-- Top Section: Logo + Navigation --}}
        <div>
            {{-- Logo Area --}}
            <div class="px-6 pt-16 pb-10">
                <div class="flex items-center gap-3">
                    {{-- Logo Image --}}
                    <img src="{{ asset('images/admin/logo.png') }}" alt="DietMate Logo"
                        class="w-12 h-12 rounded-full object-cover">
                    {{-- Logo Text --}}
                    <div>
                        <span class="block text-2xl font-bold text-[#00685F] leading-tight">DietMate</span>
                        <span class="block text-xs text-[#526967] mt-0.5">Rekomendasi Diet</span>
                    </div>
                </div>
            </div>

            {{-- Navigation Links --}}
            <nav class="flex flex-col">
                {{-- Dashboard (Active Tab) --}}
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-6 py-3 bg-[#008379] text-[#F4FFFC] border-r-4 border-[#00685F] font-semibold"
                    style="font-size: 14px; line-height: 16px; letter-spacing: 5%;">
                    <img src="{{ asset('images/admin/icon-dashboard.svg') }}" alt=""
                        class="w-[18px] h-[18px] brightness-0 invert">
                    <span>Dashboard</span>
                </a>

                {{-- Kelola Menu Makanan (Inactive) --}}
                <a href="#"
                    class="flex items-center gap-3 px-6 py-3 text-[#344B4A] hover:bg-[#e2e7e6] transition-colors"
                    style="font-size: 14px; line-height: 16px; letter-spacing: 5%; font-weight: 600;">
                    <img src="{{ asset('images/admin/icon-menu.svg') }}" alt=""
                        class="w-[18px] h-[18px] opacity-70">
                    <span>Kelola Menu Makanan</span>
                </a>

                {{-- Kelola Diet Plan --}}
                <a href="#"
                    class="flex items-center gap-3 px-6 py-3 text-[#344B4A] hover:bg-[#e2e7e6] transition-colors"
                    style="font-size: 14px; line-height: 16px; letter-spacing: 5%; font-weight: 600;">
                    <img src="{{ asset('images/admin/icon-dietplan.svg') }}" alt=""
                        class="w-[15px] h-[20px] opacity-70">
                    <span>Kelola Diet Plan</span>
                </a>

                {{-- Kelola Olahraga --}}
                <a href="#"
                    class="flex items-center gap-3 px-6 py-3 text-[#344B4A] hover:bg-[#e2e7e6] transition-colors"
                    style="font-size: 14px; line-height: 16px; letter-spacing: 5%; font-weight: 600;">
                    <img src="{{ asset('images/admin/icon-exercise.svg') }}" alt=""
                        class="w-[16px] h-[20px] opacity-70">
                    <span>Kelola Olahraga</span>
                </a>

                {{-- Data User --}}
                <a href="#"
                    class="flex items-center gap-3 px-6 py-3 text-[#344B4A] hover:bg-[#e2e7e6] transition-colors"
                    style="font-size: 14px; line-height: 16px; letter-spacing: 5%; font-weight: 600;">
                    <img src="{{ asset('images/admin/icon-users.svg') }}" alt=""
                        class="w-[22px] h-[16px] opacity-70">
                    <span>Data User</span>
                </a>
            </nav>
        </div>

        {{-- Bottom Section: Logout --}}
        <div class="pb-16 px-0">
            <a href="#"
                class="flex items-center gap-3 px-6 py-3 text-[#BA1A1A] hover:bg-[#fde8e8] transition-colors"
                style="font-size: 14px; line-height: 16px; letter-spacing: 5%; font-weight: 600;">
                <img src="{{ asset('images/admin/icon-logout.svg') }}" alt=""
                    class="w-[18px] h-[18px] brightness-0"
                    style="filter: brightness(0) saturate(100%) invert(18%) sepia(73%) saturate(3529%) hue-rotate(346deg) brightness(83%) contrast(112%);">
                <span>Keluar</span>
            </a>
        </div>
    </aside>

    {{-- ============================= --}}
    {{-- MAIN CONTENT (offset by sidebar) --}}
    {{-- ============================= --}}
    <main class="ml-[256px] p-16" style="min-height: 100vh;">

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
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#3D4947]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#00685F]" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"
                                fill-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="text-[40px] font-bold text-[#1A1C1C] leading-none mb-2">{{ number_format($totalUsers) }}</div>
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-[#008379]" fill="currentColor"
                        viewBox="0 0 12 12">
                        <path d="M6 0l6 7H0z" />
                    </svg>
                    <span class="text-sm font-semibold text-[#008379]">{{ $usersGrowthLabel }}</span>
                    <span class="text-sm text-[#3D4947]">Dari bulan lalu</span>
                </div>
            </div>

            {{-- Card 2: TOTAL DIET PLAN (left border: #676000) --}}
            <div class="bg-white rounded-xl p-6 relative shadow overflow-hidden"
                style="box-shadow: 0px 4px 20px 0px rgba(0, 104, 95, 0.1); border-left: 4px solid #676000;">
                <div class="w-24 h-24 bg-[#BAAE21]/10 rounded-full absolute -top-6 -right-6 opacity-100"></div>
                <div class="flex justify-between items-start mb-4">
                    <span
                        class="text-sm font-semibold text-[#3D4947] tracking-[5%] uppercase leading-tight">TOTAL
                        DIET<br>PLAN</span>
                    <div class="p-2 rounded-lg" style="background: #F3E658;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#676000]" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="text-[40px] font-bold text-[#1A1C1C] leading-none mb-2">{{ $totalDietPlans }}</div>
                <div class="flex items-center gap-1">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 12C5.16667 12 4.38611 11.8417 3.65833 11.525C2.93056 11.2083 2.29722 10.7806 1.75833 10.2417C1.21944 9.70278 0.791667 9.06944 0.475 8.34167C0.158333 7.61389 0 6.83333 0 6C0 5.16667 0.158333 4.38611 0.475 3.65833C0.791667 2.93056 1.21944 2.29722 1.75833 1.75833C2.29722 1.21944 2.93056 0.791667 3.65833 0.475C4.38611 0.158333 5.16667 0 6 0C6.91111 0 7.775 0.194444 8.59167 0.583333C9.40833 0.972222 10.1 1.52222 10.6667 2.23333V0.666667H12V4.66667H8V3.33333H9.83333C9.37778 2.71111 8.81667 2.22222 8.15 1.86667C7.48333 1.51111 6.76667 1.33333 6 1.33333C4.7 1.33333 3.59722 1.78611 2.69167 2.69167C1.78611 3.59722 1.33333 4.7 1.33333 6C1.33333 7.3 1.78611 8.40278 2.69167 9.30833C3.59722 10.2139 4.7 10.6667 6 10.6667C7.16667 10.6667 8.18611 10.2889 9.05833 9.53333C9.93056 8.77778 10.4444 7.82222 10.6 6.66667H11.9667C11.8 8.18889 11.1472 9.45833 10.0083 10.475C8.86944 11.4917 7.53333 12 6 12ZM7.86667 8.8L5.33333 6.26667V2.66667H6.66667V5.73333L8.8 7.86667L7.86667 8.8Z"
                            fill="#3D4947" />
                    </svg>
                    <span class="text-sm text-[#3D4947]">Baru diperbarui</span>
                </div>
            </div>

            {{-- Card 3: TOTAL MENU MAKANAN (left border: #4C6361) --}}
            <div class="bg-white rounded-xl p-6 relative shadow overflow-hidden"
                style="box-shadow: 0px 4px 20px 0px rgba(0, 104, 95, 0.1); border-left: 4px solid #4C6361;">
                <div class="w-24 h-24 bg-[#CEE7E5]/10 rounded-full absolute -top-6 -right-6 opacity-100"></div>
                <div class="flex justify-between items-start mb-4">
                    <span
                        class="text-sm font-semibold text-[#3D4947] tracking-[5%] uppercase leading-tight">TOTAL
                        MENU<br>MAKANAN</span>
                    <div class="p-2 rounded-lg" style="background: #CEE7E5;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#4C6361]" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                    </div>
                </div>
                <div class="text-[40px] font-bold text-[#1A1C1C] leading-none mb-2">{{ $totalFoodMenus }}</div>
                <div class="flex items-center gap-1">
                    <span class="text-sm font-semibold text-[#008379]">{{ $menuGrowthLabel }}</span>
                      <span class="text-sm text-[#3D4947]">Menu baru</span>
                </div>
            </div>

            {{-- Card 4: TOTAL WORKOUT (left border: #6ED8CB) --}}
            <div class="bg-white rounded-xl p-6 relative shadow overflow-hidden pb-[52px]"
                style="box-shadow: 0px 4px 20px 0px rgba(0, 104, 95, 0.1); border-left: 4px solid #6ED8CB;">
                <div class="w-24 h-24 bg-[#8BF5E7]/10 rounded-full absolute -top-6 -right-6 opacity-100"></div>
                <div class="flex justify-between items-start mb-4">
                    <span
                        class="text-sm font-semibold text-[#3D4947] tracking-[5%] uppercase leading-tight">TOTAL<br>WORKOUT</span>
                    <div class="p-2 rounded-lg" style="background: #008379;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18.388 1.612a2.996 2.996 0 00-3.185.572l-2.23 2.23a.5.5 0 01-.707 0L9.026 1.704a2.996 2.996 0 00-4.24 0l-.792.792a2.996 2.996 0 000 4.24l2.23 2.23a.5.5 0 010 .708l-2.23 2.23a2.996 2.996 0 000 4.24l.792.792a2.996 2.996 0 004.24 0l2.23-2.23a.5.5 0 01.707 0l2.23 2.23a2.996 2.996 0 004.24 0l.792-.792a2.996 2.996 0 000-4.24l-2.23-2.23a.5.5 0 010-.707l2.23-2.23a2.996 2.996 0 00.572-3.186 1.002 1.002 0 01-1.63-1.087zm-1.415 10.01l-2.23 2.23a2.5 2.5 0 01-3.536 0l-2.23-2.23a2.5 2.5 0 010-3.536l2.23-2.23a2.5 2.5 0 013.536 0l2.23 2.23a2.5 2.5 0 010 3.536z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="text-[40px] font-bold text-[#1A1C1C] leading-none mb-2">{{ $totalWorkouts }}</div>
            </div>
        </section>

        {{-- ===== MAIN CONTENT AREA GRID (Two Columns) ===== --}}
        <div class="grid grid-cols-5 gap-6">
            {{-- LEFT COLUMN: Aktivitas Sistem --}}
            <div class="col-span-2 bg-white rounded-xl p-6 shadow"
                style="box-shadow: 0px 4px 20px 0px rgba(0, 104, 95, 0.1);">
                {{-- Header --}}
                <div class="flex justify-between items-center pb-3 mb-6"
                    style="border-bottom: 1px solid rgba(188, 201, 198, 0.3);">
                    <h3 class="text-2xl font-semibold text-[#00685F]">Aktivitas Sistem</h3>
                    <button class="p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#3D4947]" fill="currentColor"
                            viewBox="0 0 16 4">
                            <circle cx="2" cy="2" r="1.5" />
                            <circle cx="8" cy="2" r="1.5" />
                            <circle cx="14" cy="2" r="1.5" />
                        </svg>
                    </button>
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
                            <p class="text-[#3D4947] text-xs">{{ $latestUser ? $latestUser->created_at->diffForHumans() : '2 menit yang lalu' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Activity Item 2: Diet Paling Sering Direkomendasikan --}}
                <div>
                    <h4 class="text-sm font-semibold text-[#1A1C1C] tracking-widest uppercase mb-1">Diet Paling Sering
                        Direkomendasikan</h4>
                    <div class="flex items-center gap-3 p-3 rounded-lg border"
                        style="background: #F9F9F9; border-color: rgba(188, 201, 198, 0.5);">
                        <div
                            class="w-[24.84px] h-8 rounded-lg bg-[#BAAE21] flex items-center justify-center flex-shrink-0">
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
                    <a href="#"
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
                                <th
                                    class="text-right px-6 py-3 text-sm font-semibold text-[#3D4947] tracking-widest uppercase">
                                    Aksi</th>
                            </tr>
                        </thead>
                        {{-- Table Body --}}
                        <tbody>
                            @forelse ($recentUsers as $user)
                                @php
                                    $profile = $user->profile;
                                    $initial = substr($user->name, 0, 1);
                                    $goal = $profile->diet_goal ?? 'Menjaga BB';
                                    $bmi = $profile->bmi ?? 22.0;
                                    $bmiLabel = $bmi < 18.5 ? 'Underweight' : ($bmi < 25 ? 'Normal' : ($bmi < 30 ? 'Overweight' : 'Obese'));
                                    $bmiColor = $bmi < 18.5 ? '#BA1A1A' : ($bmi < 25 ? '#00685F' : ($bmi < 30 ? '#676000' : '#BA1A1A'));
                                    $badgeBg = $bmi < 18.5 ? '#BAAE21' : ($bmi < 25 ? '#CEE7E5' : ($bmi < 30 ? '#008379' : '#BA1A1A'));
                                    $badgeText = $bmi < 18.5 ? '#464100' : ($bmi < 25 ? '#526967' : ($bmi < 30 ? '#F4FFFC' : '#FFFFFF'));
                                @endphp
                                <tr style="border-bottom: 1px solid rgba(188, 201, 198, 0.2);">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0"
                                                style="background: {{ $badgeBg }};">
                                                <span class="font-bold text-xs" style="color: {{ $badgeText }};">{{ $initial }}</span>
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
                                        <span class="text-xs" style="color: {{ $bmiColor }};">({{ $bmiLabel }})</span>
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
                            @empty
                                {{-- Fallback demo rows if DB is empty --}}
                                <tr style="border-bottom: 1px solid rgba(188, 201, 198, 0.2);">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-[#008379] flex items-center justify-center flex-shrink-0">
                                                <span class="text-[#F4FFFC] font-bold text-xs">A</span>
                                            </div>
                                            <span class="text-[#1A1C1C] text-base">Andi Saputra</span>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4">
                                        <span class="inline-block px-3 py-1 rounded-full bg-[#008379] text-[#F4FFFC] text-xs font-medium">Menurunkan BB</span>
                                    </td>
                                    <td class="px-3 py-4">
                                        <span class="text-[#1A1C1C] text-base">26.5 </span>
                                        <span class="text-[#676000] text-xs">(Overweight)</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[22px] h-[15px] text-[#6D7A77] inline-block cursor-pointer" fill="none" viewBox="0 0 22 15" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.5 7.5s-4.5-7-10.5-7S.5 7.5.5 7.5s4.5 7 10.5 7 10.5-7 10.5-7z"/>
                                            <circle cx="11" cy="7.5" r="3"/>
                                        </svg>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid rgba(188, 201, 198, 0.2);">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-[#CEE7E5] flex items-center justify-center flex-shrink-0">
                                                <span class="text-[#526967] font-bold text-xs">C</span>
                                            </div>
                                            <span class="text-[#1A1C1C] text-base">Citra Dewi</span>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4">
                                        <span class="inline-block px-3 py-1 rounded-full bg-[#CEE7E5] text-[#526967] text-xs font-medium">Menjaga BB</span>
                                    </td>
                                    <td class="px-3 py-4">
                                        <span class="text-[#1A1C1C] text-base">21.0 </span>
                                        <span class="text-[#00685F] text-xs">(Normal)</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[22px] h-[15px] text-[#6D7A77] inline-block cursor-pointer" fill="none" viewBox="0 0 22 15" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.5 7.5s-4.5-7-10.5-7S.5 7.5.5 7.5s4.5 7 10.5 7 10.5-7 10.5-7z"/>
                                            <circle cx="11" cy="7.5" r="3"/>
                                        </svg>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-[#BAAE21] flex items-center justify-center flex-shrink-0">
                                                <span class="text-[#464100] font-bold text-xs">E</span>
                                            </div>
                                            <span class="text-[#1A1C1C] text-base">Eko Prasetyo</span>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4">
                                        <span class="inline-block px-3 py-1 rounded-full bg-[#BAAE21] text-[#464100] text-xs font-medium">Menaikkan BB</span>
                                    </td>
                                    <td class="px-3 py-4">
                                        <span class="text-[#1A1C1C] text-base">18.2 </span>
                                        <span class="text-[#BA1A1A] text-xs">(Underweight)</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[22px] h-[15px] text-[#6D7A77] inline-block cursor-pointer" fill="none" viewBox="0 0 22 15" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.5 7.5s-4.5-7-10.5-7S.5 7.5.5 7.5s4.5 7 10.5 7 10.5-7 10.5-7z"/>
                                            <circle cx="11" cy="7.5" r="3"/>
                                        </svg>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

</body>

</html>