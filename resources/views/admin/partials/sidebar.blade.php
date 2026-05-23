{{-- ============================= --}}
{{-- SIDENAVBAR (Left Sidebar, 256px) --}}
{{-- Usage: @include('admin.partials.sidebar', ['activeRoute' => 'dashboard']) --}}
{{-- activeRoute options: dashboard, menu, diet-plan, exercise, users --}}
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
            @php
                $links = [
                    'dashboard' => [
                        'route' => 'admin.dashboard',
                        'label' => 'Dashboard',
                        'icon' => 'icon-dashboard.svg',
                        'iconWidth' => 'w-[18px]',
                        'iconHeight' => 'h-[18px]',
                    ],
                    'menu' => [
                        'route' => 'admin.menu',
                        'label' => 'Kelola Menu Makanan',
                        'icon' => 'icon-menu.svg',
                        'iconWidth' => 'w-[18px]',
                        'iconHeight' => 'h-[18px]',
                    ],
                    'diet-plan' => [
                        'route' => 'admin.diet-plan',
                        'label' => 'Kelola Diet Plan',
                        'icon' => 'icon-dietplan.svg',
                        'iconWidth' => 'w-[15px]',
                        'iconHeight' => 'h-[20px]',
                    ],
                    'exercise' => [
                        'route' => 'admin.exercise',
                        'label' => 'Kelola Olahraga',
                        'icon' => 'icon-exercise.svg',
                        'iconWidth' => 'w-[16px]',
                        'iconHeight' => 'h-[20px]',
                    ],
                    'users_account' => [
                        'route' => 'admin.users.account',
                        'label' => 'Data Akun User',
                        'icon' => 'icon-users.svg',
                        'iconWidth' => 'w-[22px]',
                        'iconHeight' => 'h-[16px]',
                    ],
                     'users_profile' => [
                        'route' => 'admin.users.profile',
                        'label' => 'Data Profile User',
                        'icon' => 'icon-users.svg',
                        'iconWidth' => 'w-[22px]',
                        'iconHeight' => 'h-[16px]',
                    ],
                ];
            @endphp

            @foreach ($links as $key => $link)
                @php
                    $isActive = $activeRoute === $key;
                @endphp
                <a href="{{ in_array($key, ['dashboard', 'menu', 'diet-plan', 'exercise', 'users_account', 'users_profile']) ? route($link['route']) : $link['route'] }}"
                    class="flex items-center gap-3 px-6 py-3 {{ $isActive ? 'bg-[#008379] text-[#F4FFFC] border-r-4 border-[#00685F] font-semibold' : 'text-[#344B4A] hover:bg-[#e2e7e6] transition-colors' }}"
                    style="font-size: 14px; line-height: 16px; letter-spacing: 5%; {{ $isActive ? '' : 'font-weight: 600;' }}">
                    <img src="{{ asset('images/admin/' . $link['icon']) }}" alt=""
                        class="{{ $link['iconWidth'] }} {{ $link['iconHeight'] }} {{ $isActive ? 'brightness-0 invert' : 'opacity-70' }}">
                    <span>{{ $link['label'] }}</span>
                </a>
            @endforeach
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