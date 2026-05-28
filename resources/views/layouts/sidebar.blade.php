    <div class="sidebar">
        <div>
            <div class="logo mb-5">
                <i class="bi bi-yelp text-primary"></i> DietMate
            </div>
            
            <a href="dashboard" class="menu-item menu-active"><i class="bi bi-grid-1x2"></i> Dashboard</a>
            <a href="menu" class="menu-item"><i class="bi bi-journal-text"></i> Rencana Makan</a>
            <a href="exercise" class="menu-item"><i class="bi bi-bicycle"></i> Rekomendasi Olahraga</a>
            {{-- <a href="health-metrics" class="menu-item"><i class="bi bi-graph-up"></i> Metrik Kesehatan</a> --}}
            <a href="profile-dashboard" class="menu-item"><i class="bi bi-person-fill"></i> Profil</a>
            {{-- <a href="settings" class="menu-item"><i class="bi bi-gear"></i> Pengaturan</a> --}}
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn w-100 text-start menu-item logout-btn">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </button>
        </form>
    </div>