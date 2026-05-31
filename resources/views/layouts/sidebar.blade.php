<div class="sidebar">
    <div>
        <div class="logo mb-5">
            <i class="bi bi-yelp text-primary"></i> DietMate
        </div>

        <a href="{{ route('dashboard') }}"
            class="menu-item {{ request()->routeIs('dashboard') ? 'menu-active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>

        <a href="{{ route('user.menu') }}"
            class="menu-item {{ request()->routeIs('user.menu*') ? 'menu-active' : '' }}">
            <i class="bi bi-journal-text"></i> Rencana Makan
        </a>

        <a href="{{ route('user.olahraga') }}"
            class="menu-item {{ request()->routeIs('user.olahraga*') ? 'menu-active' : '' }}">
            <i class="bi bi-bicycle"></i> Rekomendasi Olahraga
        </a>

        {{-- <a href="{{ route('health-metrics') }}"
            class="menu-item {{ request()->routeIs('health-metrics*') ? 'menu-active' : '' }}">
            <i class="bi bi-graph-up"></i> Metrik Kesehatan
        </a> --}}

        <a href="{{ route('profile.dashboard') }}"
            class="menu-item {{ request()->routeIs('profile.dashboard*') ? 'menu-active' : '' }}">
            <i class="bi bi-person-fill"></i> Profil
        </a>

        {{-- <a href="{{ route('settings') }}"
            class="menu-item {{ request()->routeIs('settings*') ? 'menu-active' : '' }}">
            <i class="bi bi-gear"></i> Pengaturan
        </a> --}}
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn w-100 text-start menu-item logout-btn">
            <i class="bi bi-box-arrow-right"></i> Keluar
        </button>
    </form>
</div>