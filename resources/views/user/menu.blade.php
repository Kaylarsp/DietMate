<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DietMate - Rencana Makan</title>

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
           PAGE HEADER
        ============================ */
        .page-header {
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 0;
        }

        /* ============================
           MEAL SECTION TITLE
        ============================ */
        .meal-section {
            margin-bottom: 28px;
            margin-top: 44px;
        }

        .meal-section:first-of-type {
            margin-top: 0;
        }

        .meal-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .meal-accent {
            width: 5px;
            height: 28px;
            background: var(--primary);
            border-radius: 10px;
            flex-shrink: 0;
        }

        .meal-title h3 {
            margin: 0;
            font-weight: 700;
            font-size: 20px;
            color: var(--text-main);
        }

        .meal-time-badge {
            background: var(--primary-light);
            color: var(--primary);
            font-size: 12px;
            padding: 4px 14px;
            border-radius: 99px;
            font-weight: 600;
        }

        /* ============================
           MEAL CARD
        ============================ */
        .meal-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #f0f4f8;
        }

        .meal-image-wrap {
            height: 100%;
            min-height: 260px;
            overflow: hidden;
            position: relative;
        }

        .meal-image {
            width: 100%;
            height: 100%;
            min-height: 260px;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }

        .meal-card:hover .meal-image {
            transform: scale(1.03);
        }

        .meal-content {
            padding: 32px 36px;
        }

        .meal-name {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 10px;
        }

        .meal-desc {
            color: #64748b;
            line-height: 1.65;
            margin-bottom: 24px;
            font-size: 14px;
        }

        /* ============================
           NUTRITION BOXES
        ============================ */
        .nutrition-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .nutrition-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 14px 10px;
            text-align: center;
            border: 1px solid #e8edf2;
        }

        .nutrition-title {
            color: #94a3b8;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .nutrition-value {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            margin-top: 4px;
            line-height: 1;
        }

        .nutrition-unit {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 500;
        }

        /* ============================
           SUMMARY CARDS
        ============================ */
        .summary-section {
            margin-top: 48px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .summary-card {
            border-radius: 20px;
            padding: 30px 32px;
        }

        .summary-green {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-mid) 100%);
            color: #fff;
        }

        .summary-white {
            background: #fff;
            border: 1px solid #f0f4f8;
        }

        .summary-card .s-label {
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 10px;
            opacity: 0.85;
        }

        .summary-card .s-label-dark {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 10px;
        }

        .big-number {
            font-size: 44px;
            font-weight: 700;
            line-height: 1;
        }

        .big-number .unit {
            font-size: 18px;
            font-weight: 500;
            margin-left: 4px;
            opacity: 0.75;
        }

        .summary-green .s-note {
            font-size: 13px;
            opacity: 0.75;
            margin-top: 10px;
            margin-bottom: 0;
        }

        .hydration-row {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 14px 0 12px;
        }

        .hydration-icon {
            width: 52px;
            height: 52px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 22px;
            flex-shrink: 0;
        }

        .hydration-number {
            font-size: 38px;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
        }

        .hydration-unit {
            font-size: 14px;
            color: #94a3b8;
            font-weight: 500;
        }

        .hydration-desc {
            font-size: 13px;
            color: #64748b;
            line-height: 1.55;
            margin: 0;
        }

        /* ============================
           FOOTER
        ============================ */
        footer {
            margin-top: 60px;
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
                padding: 36px 30px;
            }

            .meal-content {
                padding: 26px 28px;
            }
        }

        @media (max-width: 992px) {
            .nutrition-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .meal-image-wrap,
            .meal-image {
                min-height: 220px;
            }
        }

        /* ============================
           RESPONSIVE — MOBILE
        ============================ */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
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

            .page-title {
                font-size: 24px;
            }

            .meal-card .row {
                flex-direction: column !important;
            }

            .meal-card .col-lg-4,
            .meal-card .col-lg-8 {
                width: 100% !important;
                max-width: 100% !important;
            }

            /* makan siang: gambar ke atas, konten ke bawah */
            .meal-card.reverse-mobile .row {
                flex-direction: column-reverse !important;
            }

            .meal-image-wrap,
            .meal-image {
                min-height: 200px;
                max-height: 220px;
            }

            .meal-content {
                padding: 22px 20px;
            }

            .meal-name {
                font-size: 20px;
            }

            .nutrition-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .big-number {
                font-size: 36px;
            }
        }

        @media (max-width: 420px) {
            .main-content {
                padding: 68px 14px 22px;
            }

            .meal-title h3 {
                font-size: 17px;
            }

            .meal-time-badge {
                font-size: 11px;
                padding: 3px 10px;
            }

            .nutrition-value {
                font-size: 17px;
            }

            .summary-card {
                padding: 22px 20px;
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

    @include('layouts.sidebar')

    {{-- MAIN CONTENT --}}
    <div class="main-content">

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <h1 class="page-title">Rekomendasi Menu Makan</h1>
            <p class="page-subtitle">Menu diet seimbang untuk hari ini, {{ now()->translatedFormat('l, d F Y') }}</p>
        </div>

        {{-- SARAPAN --}}
        @if ($sarapan)
            <div class="meal-section">
                <div class="meal-title">
                    <div class="meal-accent"></div>
                    <h3>Sarapan</h3>
                    <span class="meal-time-badge">07:00 – 08:30</span>
                </div>
                <div class="meal-card">
                    <div class="row g-0">
                        <div class="col-lg-4">
                            <div class="meal-image-wrap">
                                <img src="{{ $sarapan->image_url ?? 'https://images.unsplash.com/photo-1547592180-85f173990554?q=80&w=1200' }}"
                                    class="meal-image" alt="Sarapan">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="meal-content">
                                <h2 class="meal-name">{{ $sarapan->name }}</h2>
                                <p class="meal-desc">{{ $sarapan->description }}</p>
                                <div class="nutrition-grid">
                                    <div class="nutrition-box">
                                        <div class="nutrition-title">Kalori</div>
                                        <div class="nutrition-value">{{ $sarapan->calories }}</div>
                                        <div class="nutrition-unit">kcal</div>
                                    </div>
                                    <div class="nutrition-box">
                                        <div class="nutrition-title">Protein</div>
                                        <div class="nutrition-value">{{ $sarapan->protein_g }}</div>
                                        <div class="nutrition-unit">gram</div>
                                    </div>
                                    <div class="nutrition-box">
                                        <div class="nutrition-title">Karbo</div>
                                        <div class="nutrition-value">{{ $sarapan->carbs_g }}</div>
                                        <div class="nutrition-unit">gram</div>
                                    </div>
                                    <div class="nutrition-box">
                                        <div class="nutrition-title">Lemak</div>
                                        <div class="nutrition-value">{{ $sarapan->fat_g }}</div>
                                        <div class="nutrition-unit">gram</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- MAKAN SIANG --}}
        @if ($makanSiang)
            <div class="meal-section">
                <div class="meal-title">
                    <div class="meal-accent"></div>
                    <h3>Makan Siang</h3>
                    <span class="meal-time-badge">12:00 – 13:30</span>
                </div>
                <div class="meal-card reverse-mobile">
                    <div class="row g-0">
                        <div class="col-lg-8">
                            <div class="meal-content">
                                <h2 class="meal-name">{{ $makanSiang->name }}</h2>
                                <p class="meal-desc">{{ $makanSiang->description }}</p>
                                <div class="nutrition-grid">
                                    <div class="nutrition-box">
                                        <div class="nutrition-title">Kalori</div>
                                        <div class="nutrition-value">{{ $makanSiang->calories }}</div>
                                        <div class="nutrition-unit">kcal</div>
                                    </div>
                                    <div class="nutrition-box">
                                        <div class="nutrition-title">Protein</div>
                                        <div class="nutrition-value">{{ $makanSiang->protein_g }}</div>
                                        <div class="nutrition-unit">gram</div>
                                    </div>
                                    <div class="nutrition-box">
                                        <div class="nutrition-title">Karbo</div>
                                        <div class="nutrition-value">{{ $makanSiang->carbs_g }}</div>
                                        <div class="nutrition-unit">gram</div>
                                    </div>
                                    <div class="nutrition-box">
                                        <div class="nutrition-title">Lemak</div>
                                        <div class="nutrition-value">{{ $makanSiang->fat_g }}</div>
                                        <div class="nutrition-unit">gram</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="meal-image-wrap">
                                <img src="{{ $makanSiang->image_url ?? 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=1200' }}"
                                    class="meal-image" alt="Makan Siang">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- MAKAN MALAM --}}
        @if ($makanMalam)
            <div class="meal-section">
                <div class="meal-title">
                    <div class="meal-accent"></div>
                    <h3>Makan Malam</h3>
                    <span class="meal-time-badge">18:30 – 20:00</span>
                </div>
                <div class="meal-card">
                    <div class="row g-0">
                        <div class="col-lg-4">
                            <div class="meal-image-wrap">
                                <img src="{{ $makanMalam->image_url ?? 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?q=80&w=1200' }}"
                                    class="meal-image" alt="Makan Malam">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="meal-content">
                                <h2 class="meal-name">{{ $makanMalam->name }}</h2>
                                <p class="meal-desc">{{ $makanMalam->description }}</p>
                                <div class="nutrition-grid">
                                    <div class="nutrition-box">
                                        <div class="nutrition-title">Kalori</div>
                                        <div class="nutrition-value">{{ $makanMalam->calories }}</div>
                                        <div class="nutrition-unit">kcal</div>
                                    </div>
                                    <div class="nutrition-box">
                                        <div class="nutrition-title">Protein</div>
                                        <div class="nutrition-value">{{ $makanMalam->protein_g }}</div>
                                        <div class="nutrition-unit">gram</div>
                                    </div>
                                    <div class="nutrition-box">
                                        <div class="nutrition-title">Karbo</div>
                                        <div class="nutrition-value">{{ $makanMalam->carbs_g }}</div>
                                        <div class="nutrition-unit">gram</div>
                                    </div>
                                    <div class="nutrition-box">
                                        <div class="nutrition-title">Lemak</div>
                                        <div class="nutrition-value">{{ $makanMalam->fat_g }}</div>
                                        <div class="nutrition-unit">gram</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- SUMMARY --}}
        <div class="summary-section">
            <div class="summary-grid">

                {{-- TOTAL KALORI --}}
                <div class="summary-card summary-green">
                    <p class="s-label">Total Kalori Menu</p>
                    <div class="big-number">
                        {{ number_format($totalKaloriMenu, 0, ',', '.') }}
                        <span class="unit">kcal</span>
                    </div>
                    <p class="s-note">
                        {{ $persentaseKalori }}% dari target harian Anda
                        ({{ number_format($targetKalori, 0, ',', '.') }} kcal)
                    </p>
                </div>

                {{-- HIDRASI --}}
                <div class="summary-card summary-white">
                    <p class="s-label-dark">Hidrasi Harian</p>
                    <div class="hydration-row">
                        <div class="hydration-icon">
                            <i class="bi bi-droplet-fill"></i>
                        </div>
                        <div>
                            <div class="hydration-number">8 <span class="hydration-unit">Gelas</span></div>
                        </div>
                    </div>
                    <p class="hydration-desc">
                        Minum air putih secara teratur untuk mendukung metabolisme dan pencernaan yang optimal.
                    </p>
                </div>

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