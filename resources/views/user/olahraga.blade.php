<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DietMate - Rekomendasi Olahraga</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #edf7f5;
        }

        /* SIDEBAR - Struktur Dashboard */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #f8faf9;
            position: fixed;
            padding: 35px 24px;
            border-right: 1px solid #ebf0ee;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .logo-circle {
            width: 42px;
            height: 42px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .logo-circle i {
            color: #0b7a6d;
            font-size: 20px;
        }

        .logo-text-main {
            font-size: 24px;
            font-weight: 700;
            color: #0b7a6d;
            line-height: 1;
        }

        .logo-sub {
            font-size: 12px;
            color: #5c7571;
            display: block;
            margin-top: 2px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
            color: #4a5956;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 6px;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .menu-item i {
            font-size: 22px;
        }

        .menu-item:hover {
            background: #e2edea;
            color: #0b7a6d;
        }

        .menu-active {
            background: #d4e8e3 !important;
            color: #0b7a6d !important;
            font-weight: 600;
        }

        .text-danger:hover {
            background: #fde8e8;
        }

        /* KONTEN UTAMA */
        .main-content {
            margin-left: 260px;
            padding: 40px 50px;
        }

        .card-olahraga {
            background: white;
            border-radius: 24px;
            border: none;
            overflow: hidden; 
            transition: all 0.2s ease;
            height: 100%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        .card-olahraga:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -12px rgba(0,0,0,0.08);
        }

        /* Container Gambar Utama */
        .workout-image-container {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .workout-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Lencana Intensitas Melayang di Atas Gambar */
        .badge-intensitas-floating {
            position: absolute;
            top: 16px;
            left: 16px;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 50px;
            backdrop-filter: blur(8px); /* Efek blur kaca figma */
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .workout-body {
            padding: 24px;
        }

        .durasi-badge, .kalori-badge {
            background: #f4f7f6;
            border-radius: 16px;
            padding: 12px;
            text-align: center;
        }

        .btn-mulai {
            background: #0b7a6d;
            color: white;
            border: none;
            border-radius: 40px;
            padding: 14px;
            font-weight: 600;
            transition: 0.2s;
            width: 100%;
        }

        .btn-mulai:hover {
            background: #096157;
        }

        /* Insight Card */
        .insight-card {
            background: linear-gradient(135deg, #008379 0%, #00a693 100%);
            border-radius: 28px;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 131, 121, 0.25);
        }
        .saran-card {
            background: white;
            border-radius: 20px;
            padding: 16px;
        }

        footer {
            margin-top: 60px;
            background: #e7e7e7;
            padding: 25px;
            border-radius: 14px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div>
        <div class="logo-wrapper">
            <div class="logo-circle">
                <i class="bi bi-leaf"></i>
            </div>
            <div>
                <span class="logo-text-main">DietMate</span>
                <span class="logo-sub">Rekomendasi Diet</span>
            </div>
        </div>

        <a href="#" class="menu-item">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
        <a href="#" class="menu-item">
            <i class="bi bi-journal-text"></i> Rencana Makan
        </a>
        <a href="#" class="menu-item menu-active">
            <i class="bi bi-activity"></i> Rekomendasi Olahraga
        </a>
        <a href="#" class="menu-item">
            <i class="bi bi-graph-up-arrow"></i> Metrik Kesehatan
        </a>
        <a href="#" class="menu-item">
            <i class="bi bi-person"></i> Profil
        </a>
        <a href="#" class="menu-item">
            <i class="bi bi-gear"></i> Pengaturan
        </a>
    </div>
    <div>
        <a href="#" class="menu-item text-danger">
            <i class="bi bi-box-arrow-left"></i> Keluar
        </a>
    </div>
</div>

<div class="main-content">
    
    <div class="mb-5">
        <h1 class="fw-bold text-dark" style="font-size: 34px;">Rekomendasi Olahraga</h1>
        <p class="text-muted">Berdasarkan profil kesehatan dan target diet Anda, kami menyarankan aktivitas berikut untuk mengoptimalkan pembakaran lemak dan kesehatan kardiovaskular.</p>
    </div>

<div class="row g-4 mb-5">

    {{-- JOGGING --}}
    <div class="col-md-6">
        <div class="card-olahraga shadow-sm">
            <div class="workout-image-container">
                <img src="https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?q=80&w=600&auto=format&fit=crop">
                <span class="badge-intensitas-floating bg-success bg-opacity-25 text-success fw-bold">
                    Intensitas Sedang
                </span>
            </div>

            <div class="workout-body">
                <h3 class="fw-bold mb-2 fs-4 text-dark">Jogging</h3>

                <p class="text-muted small mb-4">
                    Lari santai untuk meningkatkan detak jantung dan membakar lemak.
                </p>

                <div class="row g-2 mb-4">
                    <div class="col-6">
                        <div class="durasi-badge">
                            <i class="bi bi-clock text-success fs-5"></i>
                            <div class="fw-bold">30 Menit</div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="durasi-badge">
                            <i class="bi bi-fire text-danger fs-5"></i>
                            <div class="fw-bold">280 kcal</div>
                        </div>
                    </div>
                </div>

                <button class="btn-mulai">
                    <i class="bi bi-play-circle-fill me-2"></i>
                    Mulai Sesi
                </button>
            </div>
        </div>
    </div>

    {{-- YOGA --}}
    <div class="col-md-6">
        <div class="card-olahraga shadow-sm">
            <div class="workout-image-container">
                <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=600&auto=format&fit=crop">
                <span class="badge-intensitas-floating bg-info bg-opacity-25 text-info fw-bold">
                    Intensitas Ringan
                </span>
            </div>

            <div class="workout-body">
                <h3 class="fw-bold mb-2 fs-4 text-dark">Yoga</h3>

                <p class="text-muted small mb-4">
                    Membantu fleksibilitas tubuh dan menjaga ketenangan pikiran.
                </p>

                <div class="row g-2 mb-4">
                    <div class="col-6">
                        <div class="durasi-badge">
                            <i class="bi bi-clock text-info fs-5"></i>
                            <div class="fw-bold">30 Menit</div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="durasi-badge">
                            <i class="bi bi-fire text-warning fs-5"></i>
                            <div class="fw-bold">180 kcal</div>
                        </div>
                    </div>
                </div>

                <button class="btn-mulai">
                    <i class="bi bi-play-circle-fill me-2"></i>
                    Mulai Yoga
                </button>
            </div>
        </div>
    </div>

    {{-- CARDIO --}}
    <div class="col-md-6">
        <div class="card-olahraga shadow-sm">
            <div class="workout-image-container">
                <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=600&auto=format&fit=crop">
                <span class="badge-intensitas-floating bg-danger bg-opacity-25 text-danger fw-bold">
                    Intensitas Tinggi
                </span>
            </div>

            <div class="workout-body">
                <h3 class="fw-bold mb-2 fs-4 text-dark">Cardio HIIT</h3>

                <p class="text-muted small mb-4">
                    Latihan intensitas tinggi untuk membakar kalori lebih cepat.
                </p>

                <div class="row g-2 mb-4">
                    <div class="col-6">
                        <div class="durasi-badge">
                            <i class="bi bi-clock text-danger fs-5"></i>
                            <div class="fw-bold">20 Menit</div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="durasi-badge">
                            <i class="bi bi-fire text-danger fs-5"></i>
                            <div class="fw-bold">420 kcal</div>
                        </div>
                    </div>
                </div>

                <button class="btn-mulai" style="background:#dc3545;">
                    <i class="bi bi-lightning-charge-fill me-2"></i>
                    Mulai HIIT
                </button>
            </div>
        </div>
    </div>

{{-- INSIGHT --}}
<div class="col-md-6">
    <div class="insight-card h-100 p-4 d-flex flex-column justify-content-center text-white">

        {{-- <div class="mb-3">
            <span class="badge bg-light text-success px-3 py-2 rounded-pill fw-semibold">
                Insight Kesehatan
            </span>
        </div> --}}

        <h3 class="fw-bold mb-3" style="line-height:1.4;">
            Insight Kesehatan
        </h3>

        <p class="mb-4" style="color: rgba(255,255,255,0.85);">
            Minggu ini Anda telah membakar total 1.250 kkal dari aktivitas fisik.Anda 15% lebih aktif dibandingkan minggu lalu! 
            Tetaplah konsistenuntuk mencapai target berat badan ideal.
        </p>

        <div class="row g-3">

    <div class="col-6">
        <div 
            class="rounded-4 p-3 h-100"
            style="
                background: rgba(255,255,255,0.12);
                border: 1px solid rgba(255,255,255,0.15);
                backdrop-filter: blur(10px);
            "
        >

            <small style="color: rgba(255,255,255,0.75);">
                Saran Pemulihan
            </small>

            <div class="fw-bold fs-5 mt-2 text-white">
                Istirahat 7 Jam
            </div>

        </div>
    </div>

    <div class="col-6">
        <div 
            class="rounded-4 p-3 h-100"
            style="
                background: rgba(255,255,255,0.12);
                border: 1px solid rgba(255,255,255,0.15);
                backdrop-filter: blur(10px);
            "
        >

            <small style="color: rgba(255,255,255,0.75);">
                Target Harian
            </small>

            <div class="fw-bold fs-5 mt-2 text-white">
                8.000 Langkah
            </div>

        </div>
    </div>

</div>
        </div>

    </div>
</div>
        {{-- FOOTER BAWAH --}}
        <footer>
            © 2026 DietMate Health. All rights reserved.
        </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>