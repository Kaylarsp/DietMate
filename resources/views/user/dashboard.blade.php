<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DietMate - Dashboard</title>

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0b7a6d;
            --primary-light: #dcefed;
            --bg-color: #f8fafc;
            --text-main: #333333;
        }

        * { font-family: 'Inter', sans-serif; }
        body { background: var(--bg-color); color: var(--text-main); overflow-x: hidden; }

        .sidebar { width: 260px; min-height: 100vh; background: white; border-right: 1px solid #edf2f7; position: fixed; padding: 30px 20px; display: flex; flex-direction: column; justify-content: space-between; }
        .logo { font-size: 22px; font-weight: 700; color: var(--primary); display: flex; align-items: center; gap: 10px; }
        .logo i { background: var(--primary-light); padding: 5px 8px; border-radius: 8px; font-size: 18px; }
        .menu-item { padding: 12px 16px; border-radius: 10px; color: #64748b; text-decoration: none; display: flex; align-items: center; gap: 14px; margin-bottom: 8px; font-size: 14px; font-weight: 500; transition: all 0.3s ease; }
        .menu-item:hover { background: #f1f5f9; color: var(--primary); }
        .menu-active { background: var(--primary-light) !important; color: var(--primary) !important; font-weight: 600; }
        .logout-btn { margin-top: auto; color: #ef4444; }
        .logout-btn:hover { background: #fee2e2; color: #dc2626; }

        /* --- MAIN CONTENT --- */
        .main-content { margin-left: 260px; padding: 40px 50px; }

        .metric-card-custom {
            background: white;
            border: none;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            position: relative;
            height: 100%;
            border: 1px solid #f1f5f9;
        }

        .metric-card-custom::before {
            content: '';
            position: absolute;
            left: -1px;
            top: 15px;
            bottom: 15px;
            width: 5px;
            background: var(--primary); 
            border-radius: 0 4px 4px 0;
        }

        .metric-number-big {
            font-size: 36px;
            font-weight: 700;
            color: #1a2523;
        }

        .dashboard-card-info {
            background: white;
            border: none;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            height: 100%;
            border: 1px solid #f1f5f9;
        }

        .diet-progress-bar {
            height: 6px;
            border-radius: 50px;
            background-color: #e2e8f0;
        }

        .tips-list {
            padding-left: 20px;
            margin: 0;
            color: #64748b;
        }

        .tips-list li { margin-bottom: 12px; }

        footer {
            margin-top: 60px;
            padding: 25px;
            text-align: center;
            color: #94a3b8;
            font-size: 14px;
        }
    </style>
</head>
<body>

    {{-- SIDEBAR IDENTIK --}}
    <div class="sidebar">
        <div>
            <div class="logo mb-5">
                <i class="bi bi-yelp text-primary"></i> DietMate
            </div>
            
            <a href="" class="menu-item menu-active"><i class="bi bi-grid-1x2"></i> Dashboard</a>
            <a href="menu" class="menu-item"><i class="bi bi-journal-text"></i> Rencana Makan</a>
            <a href="exercise" class="menu-item"><i class="bi bi-bicycle"></i> Rekomendasi Olahraga</a>
            <a href="health-metrics" class="menu-item"><i class="bi bi-graph-up"></i> Metrik Kesehatan</a>
            <a href="profile-dashboard" class="menu-item"><i class="bi bi-person-fill"></i> Profil</a>
            <a href="settings" class="menu-item"><i class="bi bi-gear"></i> Pengaturan</a>
        </div>

        {{-- Form Logout (disarankan menggunakan form untuk keamanan POST) --}}
        <form method="POST" action="#">
            @csrf
            <button type="submit" class="btn w-100 text-start menu-item logout-btn">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </button>
        </form>
    </div>

    {{-- KONTEN UTAMA DASHBOARD --}}
    <div class="main-content">
        
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                {{-- Mengambil Kata Pertama dari Nama User --}}
                <h1 class="fw-bold text-dark m-0" style="font-size: 38px;">
                    Halo, {{ explode(' ', $user->name)[0] }} 👋
                </h1>
                <p class="text-muted mt-1 m-0">Selamat datang kembali di aktivitas dietmu!</p>
            </div>
            <div>
                <button class="btn bg-white rounded-circle p-2 shadow-sm border border-0 position-relative">
                    <i class="bi bi-bell fs-4 text-dark"></i>
                </button>
            </div>
        </div>

        {{-- METRICS ATAS --}}
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="metric-card-custom">
                    <div class="text-muted small mb-2 d-flex align-items-center gap-2 font-medium">
                        <i class="bi bi-clipboard-data text-primary"></i> BMI Saat Ini
                    </div>
                    <div class="d-flex align-items-baseline gap-2">
                        <span class="metric-number-big">{{ $profile->bmi ?? '0' }}</span>
                        <span class="badge {{ $bmiBadge }} rounded-pill px-2 py-1" style="font-size: 11px; font-weight: 600;">
                            {{ $bmiCategory }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="metric-card-custom">
                    <div class="text-muted small mb-2 d-flex align-items-center gap-2 font-medium">
                        <i class="bi bi-fire text-danger"></i> Kebutuhan Kalori
                    </div>
                    <div class="d-flex align-items-baseline gap-2">
                        <span class="metric-number-big">{{ number_format($profile->daily_calorie_target ?? 0, 0, ',', '.') }}</span>
                        <span class="text-muted small font-medium">kkal</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="metric-card-custom">
                    <div class="text-muted small mb-2 d-flex align-items-center gap-2 font-medium">
                        <i class="bi bi-flag text-warning"></i> Target Diet
                    </div>
                    <div class="fw-bold text-dark fs-4 lh-sm mt-1">
                        {!! $dietGoalLabel !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- PERINGKAT DIET --}}
        <div class="mb-5">
            <h4 class="fw-bold text-dark mb-4" style="font-size: 22px;">Peringkat Diet Terbaik</h4>
            <div class="row g-4">
                {{-- Data peringkat diet ini sebaiknya di-looping dari database, namun di-hardcode sementara sesuai UI --}}
                <div class="col-md-4">
                    <div class="dashboard-card-info">
                        <span class="badge bg-success-subtle text-success rounded-pill mb-3 px-2 py-1" style="font-size: 11px; font-weight: 600;">Peringkat 1</span>
                        <h5 class="fw-bold text-dark mb-4">Diet Mediterania</h5>
                        <div class="d-flex justify-content-between small text-muted mb-1 font-medium">
                            <span>Skor Kecocokan</span>
                            <span class="text-success fw-bold">98%</span>
                        </div>
                        <div class="progress diet-progress-bar">
                            <div class="progress-bar bg-success" style="width: 98%"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="dashboard-card-info">
                        <span class="badge bg-secondary-subtle text-secondary rounded-pill mb-3 px-2 py-1" style="font-size: 11px; font-weight: 600;">Peringkat 2</span>
                        <h5 class="fw-bold text-dark mb-4">Diet DASH</h5>
                        <div class="d-flex justify-content-between small text-muted mb-1 font-medium">
                            <span>Skor Kecocokan</span>
                            <span class="text-dark fw-bold">92%</span>
                        </div>
                        <div class="progress diet-progress-bar">
                            <div class="progress-bar bg-secondary" style="width: 92%"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="dashboard-card-info">
                        <span class="badge bg-warning-subtle text-warning rounded-pill mb-3 px-2 py-1" style="font-size: 11px; font-weight: 600;">Peringkat 3</span>
                        <h5 class="fw-bold text-dark mb-4">Diet Fleksitarian</h5>
                        <div class="d-flex justify-content-between small text-muted mb-1 font-medium">
                            <span>Skor Kecocokan</span>
                            <span class="text-warning fw-bold">85%</span>
                        </div>
                        <div class="progress diet-progress-bar">
                            <div class="progress-bar bg-warning" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RENCANA MENU HARIAN --}}
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-dark m-0" style="font-size: 22px;">Rencana Menu Harian</h4>
                <a href="#" class="text-success fw-semibold small text-decoration-none hover:underline">Lihat Detail Rencana</a>
            </div>
            
            <div class="row g-4">
                {{-- SARAPAN --}}
                <div class="col-md-4">
                    <div class="metric-card-custom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small font-medium">Sarapan • 08:00</span>
                            <span class="badge bg-light text-dark border rounded-pill px-2 py-1" style="font-size: 11px;">
                                {{ $sarapan->calories ?? 0 }} kkal
                            </span>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">{{ $sarapan->name ?? 'Belum ada menu' }}</h5>
                        <p class="text-muted small mb-0 lh-base">
                            {{ Str::limit($sarapan->description ?? '-', 80) }}
                        </p>
                    </div>
                </div>

                {{-- MAKAN SIANG --}}
                <div class="col-md-4">
                    <div class="metric-card-custom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small font-medium">Makan Siang • 13:00</span>
                            <span class="badge bg-light text-dark border rounded-pill px-2 py-1" style="font-size: 11px;">
                                {{ $makanSiang->calories ?? 0 }} kkal
                            </span>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">{{ $makanSiang->name ?? 'Belum ada menu' }}</h5>
                        <p class="text-muted small mb-0 lh-base">
                            {{ Str::limit($makanSiang->description ?? '-', 80) }}
                        </p>
                    </div>
                </div>

                {{-- MAKAN MALAM --}}
                <div class="col-md-4">
                    <div class="metric-card-custom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small font-medium">Makan Malam • 19:00</span>
                            <span class="badge bg-light text-dark border rounded-pill px-2 py-1" style="font-size: 11px;">
                                {{ $makanMalam->calories ?? 0 }} kkal
                            </span>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">{{ $makanMalam->name ?? 'Belum ada menu' }}</h5>
                        <p class="text-muted small mb-0 lh-base">
                            {{ Str::limit($makanMalam->description ?? '-', 80) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- REKOMENDASI OLAHRAGA --}}
        <div class="mb-5">
            <h4 class="fw-bold text-dark mb-4" style="font-size: 22px;">Rekomendasi Olahraga</h4>
            <div class="card border-0 rounded-4 p-4 shadow-sm bg-white" style="border: 1px solid #f1f5f9 !important;">
                <div class="d-flex align-items-center gap-4">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; min-width: 52px;">
                        <i class="bi bi-person-walking fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">
                            {{ ($profile->activity_level ?? '') == 'sedentary' ? 'Jalan Santai' : 'Olahraga Kardio / Beban' }}
                        </h5>
                        <p class="text-muted small mb-0">
                            Berdasarkan profil Anda, kami sarankan aktivitas fisik setidaknya 30 menit per hari untuk mendukung diet <strong>{!! str_replace('<br>', ' ', $dietGoalLabel) !!}</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- TIPS KESEHATAN --}}
        <div class="mb-5">
            <h4 class="fw-bold text-dark mb-4" style="font-size: 22px;">Tips Kesehatan</h4>
            <div class="card border-0 rounded-4 p-4 shadow-sm bg-white" style="border: 1px solid #f1f5f9 !important;">
                <ul class="tips-list font-medium" style="font-size: 14px;">
                    <li>Pastikan minum minimal 8 gelas air putih setiap hari.</li>
                    <li>Kurangi asupan gula tambahan dan makanan olahan.</li>
                    <li>Perbanyak konsumsi sayuran hijau dan buah-buahan segar.</li>
                    <li>Tidur yang cukup, idealnya 7-8 jam per malam.</li>
                </ul>
            </div>
        </div>

        <footer>
            © {{ date('Y') }} DietMate Health. All rights reserved.
        </footer>

    </div>

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>