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
            top: 0;
            left: 0;
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

        .menu-item i {
            font-size: 17px;
            width: 20px;
            text-align: center;
        }

        .menu-item:hover {
            background: #f1f5f9;
            color: var(--primary);
        }

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

        .logout-btn {
            color: #ef4444;
        }

        .logout-btn:hover {
            background: #fee2e2 !important;
            color: #dc2626 !important;
        }

        /* ============================
           TOPBAR MOBILE
        ============================ */
        .topbar {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
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

        .hamburger-btn:hover {
            background: #f1f5f9;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: 198;
        }

        .sidebar-overlay.open {
            display: block;
        }

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
           GREETING
        ============================ */
        .greeting {
            margin-bottom: 36px;
        }

        .greeting h1 {
            font-size: 34px;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
        }

        .greeting p {
            color: #64748b;
            margin-top: 5px;
            margin-bottom: 0;
            font-size: 14px;
        }

        /* ============================
           METRIC CARDS
        ============================ */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 42px;
        }

        .metric-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f0f4f8;
            padding: 22px 24px;
            position: relative;
            overflow: hidden;
        }

        .metric-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 16px;
            bottom: 16px;
            width: 4px;
            background: var(--primary);
            border-radius: 0 4px 4px 0;
        }

        .metric-card .card-label {
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 10px;
        }

        .metric-card .card-label i {
            font-size: 15px;
        }

        .metric-value {
            font-size: 34px;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1;
        }

        .metric-unit {
            font-size: 13px;
            color: #94a3b8;
            font-weight: 500;
            margin-left: 4px;
        }

        .metric-goal {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.3;
            margin-top: 4px;
        }

        /* ============================
           SECTION TITLE
        ============================ */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
        }

        .section-link {
            font-size: 13px;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .section-link:hover {
            text-decoration: underline;
            color: var(--primary);
        }

        /* ============================
           RANK CARDS
        ============================ */
        .rank-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 42px;
        }

        .rank-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f0f4f8;
            padding: 22px;
        }

        .rank-badge {
            font-size: 11px;
            font-weight: 600;
            border-radius: 99px;
            padding: 3px 12px;
            display: inline-block;
            margin-bottom: 12px;
        }

        .rank-1 {
            background: #dcfce7;
            color: #166534;
        }

        .rank-2 {
            background: #f1f5f9;
            color: #475569;
        }

        .rank-3 {
            background: #fefce8;
            color: #854d0e;
        }

        .rank-card h5 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 16px;
        }

        .score-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 7px;
        }

        .progress-track {
            height: 6px;
            background: #e2e8f0;
            border-radius: 99px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 99px;
        }

        .fill-green {
            background: #22c55e;
        }

        .fill-slate {
            background: #94a3b8;
        }

        .fill-amber {
            background: #f59e0b;
        }

        /* ============================
           MENU HARIAN
        ============================ */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 42px;
        }

        .menu-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f0f4f8;
            padding: 22px;
            position: relative;
            overflow: hidden;
        }

        .menu-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 16px;
            bottom: 16px;
            width: 4px;
            background: var(--primary);
            border-radius: 0 4px 4px 0;
        }

        .menu-time-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .menu-time-label {
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
        }

        .kcal-badge {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-main);
            padding: 3px 10px;
        }

        .menu-card h5 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .menu-card p {
            font-size: 13px;
            color: #64748b;
            line-height: 1.55;
            margin: 0;
        }

        /* ============================
           OLAHRAGA
        ============================ */
        .exercise-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f0f4f8;
            padding: 24px 28px;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 42px;
        }

        .exercise-icon {
            width: 54px;
            height: 54px;
            min-width: 54px;
            background: linear-gradient(135deg, var(--primary), var(--primary-mid));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 22px;
        }

        .exercise-card h5 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 5px;
        }

        .exercise-card p {
            font-size: 13px;
            color: #64748b;
            line-height: 1.55;
            margin: 0;
        }

        /* ============================
           TIPS
        ============================ */
        .tips-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f0f4f8;
            padding: 8px 28px;
            margin-bottom: 42px;
        }

        .tips-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .tips-list li {
            font-size: 13.5px;
            color: #475569;
            padding: 13px 0;
            border-bottom: 1px solid #f8fafc;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-weight: 500;
        }

        .tips-list li:last-child {
            border-bottom: none;
        }

        .tip-dot {
            width: 7px;
            height: 7px;
            min-width: 7px;
            background: var(--primary);
            border-radius: 50%;
            margin-top: 5px;
        }

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
            .main-content {
                padding: 36px 32px;
            }

            .metrics-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .rank-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .menu-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* ============================
           RESPONSIVE — MOBILE
        ============================ */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: none;
            }

            .sidebar.open {
                transform: translateX(0);
                box-shadow: 6px 0 28px rgba(0, 0, 0, 0.12);
            }

            .topbar {
                display: flex;
            }

            .main-content {
                margin-left: 0;
                padding: 74px 18px 28px;
            }

            .greeting h1 {
                font-size: 26px;
            }

            .metrics-grid {
                grid-template-columns: 1fr;
            }

            .rank-grid {
                grid-template-columns: 1fr;
            }

            .menu-grid {
                grid-template-columns: 1fr;
            }

            .metric-value {
                font-size: 28px;
            }

            .exercise-card {
                flex-direction: row;
                gap: 16px;
                padding: 20px;
            }
        }

        @media (max-width: 420px) {
            .main-content {
                padding: 68px 14px 22px;
            }

            .section-title {
                font-size: 17px;
            }

            .greeting h1 {
                font-size: 22px;
            }

            .tips-card {
                padding: 4px 18px;
            }
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

    {{-- SIDEBAR --}}
    @include('layouts.sidebar')

    {{-- KONTEN UTAMA DASHBOARD --}}
    <div class="main-content">

        {{-- GREETING --}}
        <div class="greeting">
            <h1>Halo, {{ explode(' ', $user->name)[0] }} 👋</h1>
            <p>Selamat datang kembali di aktivitas dietmu!</p>
        </div>

        {{-- METRICS ATAS --}}
        <div class="metrics-grid">

            {{-- BMI --}}
            <div class="metric-card">
                <div class="card-label">
                    <i class="bi bi-clipboard-data text-primary"></i> BMI Saat Ini
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="metric-value">{{ $profile->bmi ?? '0' }}</span>
                    <span class="badge {{ $bmiBadge }} rounded-pill px-2 py-1" style="font-size: 11px; font-weight: 600;">
                        {{ $bmiCategory }}
                    </span>
                </div>
            </div>

            {{-- KALORI --}}
            <div class="metric-card">
                <div class="card-label">
                    <i class="bi bi-fire text-danger"></i> Kebutuhan Kalori
                </div>
                <div class="d-flex align-items-baseline gap-1">
                    <span class="metric-value">{{ number_format($profile->daily_calorie_target ?? 0, 0, ',', '.') }}</span>
                    <span class="metric-unit">kkal</span>
                </div>
            </div>

            {{-- TARGET DIET --}}
            <div class="metric-card">
                <div class="card-label">
                    <i class="bi bi-flag text-warning"></i> Target Diet
                </div>
                <div class="metric-goal">
                    {!! $dietGoalLabel !!}
                </div>
            </div>

        </div>

        {{-- PERINGKAT DIET --}}
        <div class="mb-2">
            <div class="section-header">
                <h4 class="section-title">Peringkat Diet Terbaik</h4>
            </div>
            <div class="rank-grid">

                <div class="rank-card">
                    <span class="rank-badge rank-1">Peringkat 1</span>
                    <h5>Diet Mediterania</h5>
                    <div class="score-row">
                        <span>Skor Kecocokan</span>
                        <span style="color:#166534; font-weight:700;">98%</span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill fill-green" style="width: 98%"></div>
                    </div>
                </div>

                <div class="rank-card">
                    <span class="rank-badge rank-2">Peringkat 2</span>
                    <h5>Diet DASH</h5>
                    <div class="score-row">
                        <span>Skor Kecocokan</span>
                        <span style="color:#475569; font-weight:700;">92%</span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill fill-slate" style="width: 92%"></div>
                    </div>
                </div>

                <div class="rank-card">
                    <span class="rank-badge rank-3">Peringkat 3</span>
                    <h5>Diet Fleksitarian</h5>
                    <div class="score-row">
                        <span>Skor Kecocokan</span>
                        <span style="color:#854d0e; font-weight:700;">85%</span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill fill-amber" style="width: 85%"></div>
                    </div>
                </div>

            </div>
        </div>

        {{-- RENCANA MENU HARIAN --}}
        <div class="mb-2">
            <div class="section-header">
                <h4 class="section-title">Rencana Menu Harian</h4>
                <a href="menu" class="section-link">Lihat Detail →</a>
            </div>
            <div class="menu-grid">

                {{-- SARAPAN --}}
                <div class="menu-card">
                    <div class="menu-time-row">
                        <span class="menu-time-label">Sarapan · 08:00</span>
                        <span class="kcal-badge">{{ $sarapan->calories ?? 0 }} kkal</span>
                    </div>
                    <h5>{{ $sarapan->name ?? 'Belum ada menu' }}</h5>
                    <p>{{ Str::limit($sarapan->description ?? '-', 90) }}</p>
                </div>

                {{-- MAKAN SIANG --}}
                <div class="menu-card">
                    <div class="menu-time-row">
                        <span class="menu-time-label">Makan Siang · 13:00</span>
                        <span class="kcal-badge">{{ $makanSiang->calories ?? 0 }} kkal</span>
                    </div>
                    <h5>{{ $makanSiang->name ?? 'Belum ada menu' }}</h5>
                    <p>{{ Str::limit($makanSiang->description ?? '-', 90) }}</p>
                </div>

                {{-- MAKAN MALAM --}}
                <div class="menu-card">
                    <div class="menu-time-row">
                        <span class="menu-time-label">Makan Malam · 19:00</span>
                        <span class="kcal-badge">{{ $makanMalam->calories ?? 0 }} kkal</span>
                    </div>
                    <h5>{{ $makanMalam->name ?? 'Belum ada menu' }}</h5>
                    <p>{{ Str::limit($makanMalam->description ?? '-', 90) }}</p>
                </div>

            </div>
        </div>

        {{-- REKOMENDASI OLAHRAGA --}}
        <div class="mb-2">
            <div class="section-header">
                <h4 class="section-title">Rekomendasi Olahraga</h4>
            </div>
            <div class="exercise-card">
                <div class="exercise-icon">
                    <i class="bi bi-person-walking"></i>
                </div>
                <div>
                    <h5>
                        {{ ($profile->activity_level ?? '') == 'sedentary' ? 'Jalan Santai' : 'Olahraga Kardio / Beban' }}
                    </h5>
                    <p>
                        Berdasarkan profil Anda, kami sarankan aktivitas fisik setidaknya <strong>30 menit per hari</strong>
                        untuk mendukung diet <strong>{!! str_replace('<br>', ' ', $dietGoalLabel) !!}</strong>.
                    </p>
                </div>
            </div>
        </div>

        {{-- TIPS KESEHATAN --}}
        <div class="mb-2">
            <div class="section-header">
                <h4 class="section-title">Tips Kesehatan</h4>
            </div>
            <div class="tips-card">
                <ul class="tips-list">
                    <li>
                        <div class="tip-dot"></div>
                        Pastikan minum minimal 8 gelas air putih setiap hari.
                    </li>
                    <li>
                        <div class="tip-dot"></div>
                        Kurangi asupan gula tambahan dan makanan olahan.
                    </li>
                    <li>
                        <div class="tip-dot"></div>
                        Perbanyak konsumsi sayuran hijau dan buah-buahan segar.
                    </li>
                    <li>
                        <div class="tip-dot"></div>
                        Tidur yang cukup, idealnya 7–8 jam per malam.
                    </li>
                </ul>
            </div>
        </div>

        <footer>
            © {{ date('Y') }} DietMate Health. All rights reserved.
        </footer>

    </div>

    {{-- Bootstrap JS Bundle --}}
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