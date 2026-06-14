<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DietMate - Rekomendasi Olahraga</title>

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0b7a6d;
            --primary-mid: #0d9488;
            --primary-light: #dcefed;
            --bg-color: #f8fafc;
            --text-main: #1a2523;
            --sidebar-w: 248px;
        }

        * {
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        body {
            background: var(--bg-color);
            color: var(--text-main);
            overflow-x: hidden;
            margin: 0;
        }

        /* ============================
           SIDEBAR
        ============================ */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid #edf2f7;
            position: fixed;
            top: 0; left: 0;
            padding: 26px 16px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            z-index: 200;
            transition: transform 0.3s ease;
        }

        .logo {
            font-size: 19px;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 8px;
            margin-bottom: 22px;
        }

        .logo i {
            background: var(--primary-light);
            padding: 7px 9px;
            border-radius: 10px;
            font-size: 17px;
            color: var(--primary);
        }

        .menu-section-label {
            font-size: 10px;
            font-weight: 600;
            color: #94a3b8;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 14px 14px 5px;
        }

        .menu-item {
            padding: 10px 14px;
            border-radius: 10px;
            color: #64748b;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 13px;
            font-size: 13.5px;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 2px;
        }

        .menu-item i { font-size: 17px; width: 20px; text-align: center; }
        .menu-item:hover { background: #f1f5f9; color: var(--primary); }

        .menu-active {
            background: var(--primary-light) !important;
            color: var(--primary) !important;
            font-weight: 600;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px solid #f1f5f9;
        }

        .logout-btn { color: #ef4444; }
        .logout-btn:hover { background: #fee2e2 !important; color: #dc2626 !important; }

        /* ============================
           TOPBAR MOBILE
        ============================ */
        .topbar {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0;
            background: #fff;
            border-bottom: 1px solid #edf2f7;
            padding: 0 18px;
            height: 56px;
            align-items: center;
            justify-content: space-between;
            z-index: 199;
        }

        .topbar-logo {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .topbar-logo i {
            background: var(--primary-light);
            padding: 5px 7px;
            border-radius: 8px;
            font-size: 14px;
        }

        .hamburger-btn {
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            font-size: 21px;
            padding: 6px;
            border-radius: 8px;
            line-height: 1;
            transition: background 0.2s;
        }

        .hamburger-btn:hover { background: #f1f5f9; }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.35);
            z-index: 198;
        }

        .sidebar-overlay.open { display: block; }

        /* ============================
           MAIN CONTENT
        ============================ */
        .main-content {
            margin-left: var(--sidebar-w);
            padding: 44px 48px;
            background: linear-gradient(160deg, #ddf0ec 0%, #e8f4f1 30%, #f8fafc 70%);
            min-height: 100vh;
        }

        /* ============================
           PAGE HEADER
        ============================ */
        .page-header { margin-bottom: 36px; }
        .page-title { font-size: 32px; font-weight: 700; color: var(--text-main); margin: 0; }
        .page-subtitle { color: #64748b; font-size: 14px; margin-top: 6px; margin-bottom: 0; line-height: 1.6; }

        /* ============================
           ALERT LOGIN
        ============================ */
        .login-alert {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 14px;
            padding: 14px 18px;
            font-size: 14px;
            color: #1e40af;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
        }

        .login-alert i { font-size: 17px; flex-shrink: 0; }
        .login-alert a { color: #1d4ed8; font-weight: 600; text-decoration: none; }
        .login-alert a:hover { text-decoration: underline; }
        .login-alert .btn-close-alert {
            margin-left: auto; background: none; border: none;
            color: #93c5fd; cursor: pointer; font-size: 16px; padding: 0 4px;
        }

        /* ============================
           BMI CARD
        ============================ */
        .bmi-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-mid) 100%);
            border-radius: 20px;
            padding: 28px 32px;
            color: #fff;
            margin-bottom: 36px;
        }

        .bmi-big-number {
            font-size: 52px;
            font-weight: 800;
            line-height: 1;
        }

        .bmi-category-pill {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(8px);
            border-radius: 99px;
            padding: 5px 16px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 10px;
        }

        .bmi-advice {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .bmi-scale-labels {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            opacity: 0.75;
            margin-bottom: 6px;
        }

        .bmi-track {
            height: 7px;
            border-radius: 99px;
            background: rgba(255,255,255,0.2);
            overflow: hidden;
        }

        .bmi-fill {
            height: 100%;
            border-radius: 99px;
            background: #fff;
        }

        /* ============================
           WORKOUT CARDS GRID
        ============================ */
        .workout-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .card-olahraga {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #f0f4f8;
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            display: flex;
            flex-direction: column;
        }

        .card-olahraga:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px -8px rgba(11,122,109,0.12);
        }

        .workout-image-container {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-mid) 100%);
            flex-shrink: 0;
        }

        .workout-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
            display: block;
        }

        .card-olahraga:hover .workout-image-container img {
            transform: scale(1.05);
        }

        .badge-intensitas-floating {
            position: absolute;
            top: 14px;
            left: 14px;
            font-size: 11px;
            font-weight: 600;
            padding: 5px 14px;
            border-radius: 99px;
            backdrop-filter: blur(8px);
        }

        .workout-body {
            padding: 22px 24px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .workout-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .workout-desc {
            font-size: 13px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 18px;
            flex: 1;
        }

        .workout-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .stat-box {
            background: #f8fafc;
            border: 1px solid #e8edf2;
            border-radius: 12px;
            padding: 12px;
            text-align: center;
        }

        .stat-box i { font-size: 18px; }
        .stat-box .stat-val { font-size: 14px; font-weight: 700; color: var(--text-main); margin-top: 4px; }

        /* ============================
           INSIGHT CARD
        ============================ */
        .insight-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-mid) 100%);
            border-radius: 20px;
            padding: 28px 32px;
            color: #fff;
            margin-bottom: 20px;
        }

        .insight-quote-icon {
            font-size: 36px;
            opacity: 0.4;
            line-height: 1;
            margin-bottom: 4px;
        }

        .insight-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .insight-text {
            font-size: 14px;
            line-height: 1.65;
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .insight-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            color: var(--primary);
            font-size: 13px;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 99px;
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .insight-cta:hover { opacity: 0.88; color: var(--primary); }

        .insight-stats {
            display: flex;
            gap: 28px;
        }

        .insight-stat-label { font-size: 11px; opacity: 0.7; margin-bottom: 2px; }
        .insight-stat-val { font-size: 15px; font-weight: 700; }

        .tips-box {
            background: rgba(255,255,255,0.12);
            border-radius: 14px;
            padding: 18px 20px;
        }

        .tips-box-title {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .tips-box p {
            font-size: 13px;
            opacity: 0.88;
            line-height: 1.6;
            margin: 0;
        }

        /* ============================
           EMPTY STATE
        ============================ */
        .empty-state {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #f0f4f8;
            padding: 60px 40px;
            text-align: center;
        }

        .empty-state i { font-size: 48px; color: #cbd5e1; }
        .empty-state h4 { font-size: 18px; font-weight: 700; color: var(--text-main); margin: 16px 0 8px; }
        .empty-state p { font-size: 14px; color: #64748b; margin: 0; }

        /* ============================
           FOOTER
        ============================ */
        footer {
            margin-top: 20px;
            padding: 28px 0 12px;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
        }

        /* ============================
           RESPONSIVE — TABLET
        ============================ */
        @media (max-width: 1100px) {
            .main-content { padding: 36px 30px; }
            .bmi-card { padding: 24px 24px; }
        }

        @media (max-width: 900px) {
            .bmi-card .row { flex-direction: column; }
            .bmi-card .col-md-4,
            .bmi-card .col-md-8 { width: 100%; max-width: 100%; }
            .bmi-big-number { font-size: 40px; }
        }

        /* ============================
           RESPONSIVE — MOBILE
        ============================ */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); box-shadow: 6px 0 28px rgba(0,0,0,0.12); }
            .topbar { display: flex; }
            .main-content { margin-left: 0; padding: 74px 18px 28px; }

            .page-title { font-size: 24px; }
            .workout-grid { grid-template-columns: 1fr; }
            .insight-card .row { flex-direction: column; }
            .insight-card .col-md-7,
            .insight-card .col-md-5 { width: 100%; max-width: 100%; }
            .tips-box { margin-top: 16px; }
            .insight-card { padding: 24px 20px; }
            .bmi-card { padding: 22px 18px; }
            .bmi-scale-labels { display: none; }
        }

        @media (max-width: 420px) {
            .main-content { padding: 68px 14px 22px; }
            .workout-body { padding: 18px 16px; }
            .workout-image-container { height: 180px; }
            .bmi-big-number { font-size: 36px; }
        }
    </style>
</head>

<body>

    {{-- TOPBAR MOBILE --}}
    <div class="topbar" id="topbar">
        <button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Buka menu">
            <i class="bi bi-list"></i>
        </button>
        <div class="topbar-logo">
            <i class="bi bi-heart-pulse-fill"></i> DietMate
        </div>
        <div style="width:36px"></div>
    </div>

    {{-- OVERLAY MOBILE --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    @include('layouts.sidebar')

    <div class="main-content">

        {{-- ALERT LOGIN --}}
        @if (!$isLoggedIn)
            <div class="login-alert" id="loginAlert">
                <i class="bi bi-info-circle-fill"></i>
                <span>
                    <strong>Tips:</strong> Login atau daftar untuk mendapatkan rekomendasi olahraga yang lebih personal
                    berdasarkan profil kesehatan Anda!
                    <a href="{{ route('login') }}" class="ms-1">Login Sekarang →</a>
                </span>
                <button class="btn-close-alert" onclick="this.parentElement.remove()" aria-label="Tutup">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        @endif

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <h1 class="page-title">Rekomendasi Olahraga</h1>
            <p class="page-subtitle">
                {{ $personalizedHeader ?? 'Berdasarkan profil kesehatan dan target diet Anda, kami menyarankan aktivitas berikut untuk mengoptimalkan pembakaran lemak dan kesehatan kardiovaskular.' }}
            </p>
        </div>

        {{-- BMI CARD --}}
        @if ($bmi)
            <div class="bmi-card">
                <div class="row g-4 align-items-center">
                    <div class="col-md-4 text-center">
                        <div class="bmi-big-number">{{ number_format($bmi, 1) }}</div>
                        <div class="bmi-category-pill">{{ $bmiCategory }}</div>
                    </div>
                    <div class="col-md-8">
                        <h5 class="fw-bold mb-2" style="font-size:16px;">Status BMI Anda: {{ $bmiCategory }}</h5>
                        <p class="bmi-advice">{{ $bmiAdvice }}</p>
                        <div class="bmi-scale-labels">
                            <span>Kurus (&lt;18.5)</span>
                            <span>Normal (18.5–25)</span>
                            <span>Berlebih (25–30)</span>
                            <span>Obesitas (&gt;30)</span>
                        </div>
                        <div class="bmi-track">
                            @php $bmiPercent = min(100, max(0, ($bmi / 40) * 100)); @endphp
                            <div class="bmi-fill" style="width: {{ $bmiPercent }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- WORKOUT GRID --}}
        <div class="workout-grid">
            @forelse($workouts as $workout)
                @php
                    $intensitas = strtolower($workout->intensity);
                    $badgeBg = 'bg-success';
                    $badgeText = 'text-success';
                    $iconFire = 'text-warning';
                    if ($intensitas == 'tinggi') {
                        $badgeBg = 'bg-danger'; $badgeText = 'text-danger'; $iconFire = 'text-danger';
                    } elseif ($intensitas == 'ringan') {
                        $badgeBg = 'bg-info'; $badgeText = 'text-info';
                    } elseif ($intensitas == 'sedang') {
                        $badgeBg = 'bg-warning'; $badgeText = 'text-warning';
                    }
                    $totalKalori = $workout->duration_minutes * $workout->cals_burned_per_min;
                    $workoutNameLower = strtolower($workout->name);
                    if (str_contains($workoutNameLower, 'jalan') || str_contains($workoutNameLower, 'santai')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1444491741275-3747c53c99b4?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'yoga')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'peregangan') || str_contains($workoutNameLower, 'stretching')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1574680178050-55c6a6a96e0a?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'senam')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'jogging') || str_contains($workoutNameLower, 'jog')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'sepeda') || str_contains($workoutNameLower, 'bersepeda')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1511994298241-608e28f14fde?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'renang')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'aerobik')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1538805060514-97d9cc17730c?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'lompat tali')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1526506118085-60ce8714f8c5?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'hiit')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1518611012118-696072aa579a?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'push') || str_contains($workoutNameLower, 'sit')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1532384748853-8f54a8f476e2?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'plank')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1566241142559-40e1dab266c6?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'zumba')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1599058917212-d750089bc07e?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'weight') || str_contains($workoutNameLower, 'beban')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'crossfit')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'sprint')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'boxing') || str_contains($workoutNameLower, 'muay')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1549719386-74dfcbf7dbed?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'deadlift') || str_contains($workoutNameLower, 'squat')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1534367507873-d2d7e24c797f?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'climbing') || str_contains($workoutNameLower, 'panjat')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1522163182402-834f871fd851?q=80&w=600&auto=format';
                    } elseif (str_contains($workoutNameLower, 'triathlon')) {
                        $imageUrl = 'https://images.unsplash.com/photo-1517649763962-0c623066013b?q=80&w=600&auto=format';
                    } else {
                        $imageUrl = 'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=600&auto=format';
                    }
                @endphp

                <div class="card-olahraga">
                    <div class="workout-image-container">
                        <img src="{{ $imageUrl }}" alt="{{ $workout->name }}">
                        <span class="badge-intensitas-floating {{ $badgeBg }} bg-opacity-25 {{ $badgeText }}">
                            Intensitas {{ ucfirst($workout->intensity) }}
                        </span>
                    </div>
                    <div class="workout-body">
                        <div class="workout-name">{{ $workout->name }}</div>
                        <p class="workout-desc">
                            {{ $workout->description ?? ($workoutDescriptions[$workout->name] ?? 'Latihan yang bagus untuk menjaga kebugaran tubuh.') }}
                        </p>
                        <div class="workout-stats">
                            <div class="stat-box">
                                <i class="bi bi-clock text-info"></i>
                                <div class="stat-val">{{ $workout->duration_minutes }} Menit</div>
                            </div>
                            <div class="stat-box">
                                <i class="bi bi-fire {{ $iconFire }}"></i>
                                <div class="stat-val">{{ number_format($totalKalori, 0, ',', '.') }} kcal</div>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <i class="bi bi-person-walking"></i>
                    <h4>Belum ada rekomendasi olahraga</h4>
                    <p>Silakan lengkapi profil kesehatan Anda terlebih dahulu.</p>
                </div>
            @endforelse
        </div>

        {{-- INSIGHT CARD --}}
        <div class="insight-card">
            <div class="row g-4">
                {{-- Kiri: Motivasi --}}
                <div class="col-md-7">
                    <div class="insight-quote-icon"><i class="bi bi-quote"></i></div>
                    <div class="insight-title">Semangat!</div>
                    <p class="insight-text">
                        @php
                            $motivasi = [
                                'Kesehatan bukan tentang menjadi yang terbaik, tapi tentang menjadi lebih baik dari kemarin.',
                                'Jangan menunggu motivasi datang. Mulai dulu, nanti motivasinya akan mengikuti.',
                                '30 menit olahraga hari ini lebih baik daripada 1 jam besok yang tidak jadi dilakukan.',
                                'Bukan tentang seberapa keras, tapi tentang seberapa konsisten.',
                                'Setiap langkah kecil adalah kemenangan. Rayakan progress-mu!',
                            ];
                            echo $motivasi[array_rand($motivasi)];
                        @endphp
                    </p>

                    @if (!$isLoggedIn)
                        <a href="{{ route('login') }}" class="insight-cta">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Login untuk Rekomendasi Personal
                        </a>
                    @elseif (!$profile)
                        <a href="{{ route('profile.dashboard') }}" class="insight-cta">
                            <i class="bi bi-pencil-square"></i>
                            Lengkapi Profil Kesehatan
                        </a>
                    @else
                        <div class="insight-stats">
                            <div>
                                <div class="insight-stat-label">Target Harian</div>
                                <div class="insight-stat-val">{{ number_format($stepTarget ?? 8000, 0, ',', '.') }} Langkah</div>
                            </div>
                            <div>
                                <div class="insight-stat-label">Istirahat</div>
                                <div class="insight-stat-val">{{ $sleepAdvice ?? '7–8 Jam' }}</div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Kanan: Tips Cepat --}}
                <div class="col-md-5 d-flex align-items-center">
                    <div class="tips-box w-100">
                        <div class="tips-box-title"><i class="bi bi-lightbulb me-2" style="color:#ffd700;"></i>Tips Cepat</div>
                        <p>
                            @if ($bmiCategory == 'Obesitas')
                                Mulai dengan jalan kaki 10–15 menit/hari, tingkatkan pelan-pelan.
                            @elseif ($bmiCategory == 'Kelebihan Berat Badan')
                                Kombinasi kardio 3x + strength training 2x per minggu.
                            @elseif ($bmiCategory == 'Normal')
                                Variasikan olahraga agar tidak bosan dan tubuh tetap terstimulasi.
                            @elseif ($bmiCategory == 'Kurus')
                                Fokus latihan beban dan konsumsi protein setelah olahraga.
                            @else
                                Pilih olahraga yang Anda nikmati agar lebih konsisten.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            © {{ date('Y') }} DietMate Health. Hak cipta dilindungi undang-undang.
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar') || document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        }
    </script>

</body>
</html>