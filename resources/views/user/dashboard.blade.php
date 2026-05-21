<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DietMate - Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #edf7f5; 
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #f8faf9; /* Warna latar sidebar yang soft */
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
        
        /* Hover & Efek Tombol Aktif Sesuai Gambar */
        .menu-item:hover {
            background: #e2edea;
            color: #0b7a6d;
        }

        .menu-active {
            background: #d4e8e3 !important; /* Warna hijau pastel penuh */
            color: #0b7a6d !important;
            font-weight: 600;
        }

        .text-danger:hover {
            background: #fde8e8;
        }

        .main-content {
            margin-left: 250px;
            padding: 40px 50px;
        }

        .metric-card-custom {
            background: white;
            border: none;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
            position: relative;
            height: 100%;
        }

        .metric-card-custom::before {
            content: '';
            position: absolute;
            left: 0;
            top: 15px;
            bottom: 15px;
            width: 5px;
            background: #0b7a6d; 
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
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 5px 18px rgba(0,0,0,0.03);
            height: 100%;
        }

        .diet-progress-bar {
            height: 6px;
            border-radius: 50px;
            background-color: #e9ecef;
        }

        .tips-list {
            padding-left: 20px;
            margin: 0;
            color: #5c5c5c;
        }

        .tips-list li {
            margin-bottom: 12px;
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
    </style>
</head>
<body>

{{-- SIDEBAR UTAMA --}}
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

        <a href="{{ url('/dashboard') }}" class="menu-item {{ Request::is('user/dashboard') ? 'menu-active' : '' }}">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>

        <a href="{{ url('/user/rencana-makan') }}" class="menu-item {{ Request::is('user/rencana-makan') ? 'menu-active' : '' }}">
            <i class="bi-journal-text"></i> Rencana Makan
        </a>

        <a href="#" class="menu-item {{ Request::is('user/olahraga') ? 'menu-active' : '' }}">
            <i class="bi bi-activity"></i> Rekomendasi Olahraga
        </a>

        <a href="#" class="menu-item {{ Request::is('user/metrik') ? 'menu-active' : '' }}">
            <i class="bi bi-graph-up-arrow"></i> Metrik Kesehatan
        </a>

        <a href="{{ url('/user/profil') }}" class="menu-item {{ Request::is('user/profil') ? 'menu-active' : '' }}">
            <i class="bi bi-person"></i> Profil
        </a>

        <a href="#" class="menu-item {{ Request::is('user/pengaturan') ? 'menu-active' : '' }}">
            <i class="bi bi-gear"></i> Pengaturan
        </a>
    </div>

    <div>
        <a href="#" class="menu-item text-danger">
            <i class="bi bi-box-arrow-left"></i> Keluar
        </a>
    </div>
</div>

    <div>
        <a href="#" class="menu-item text-danger">
            <i class="bi bi-box-arrow-left"></i> Keluar
        </a>
    </div>
</div>

    {{-- KONTEN UTAMA DASHBOARD --}}
    <div class="main-content">
        
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="fw-bold text-dark m-0" style="font-size: 38px;">Halo, Vera 👋</h1>
                <p class="text-muted mt-1 m-0">Selamat datang kembali!</p>
            </div>
            <div>
                <button class="btn bg-white rounded-circle p-2 shadow-sm border border-0 position-relative">
                    <i class="bi bi-bell fs-4 text-dark"></i>
                </button>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="metric-card-custom">
                    <div class="text-muted small mb-2 d-flex align-items-center gap-2 font-medium">
                        <i class="bi bi-clipboard-data"></i> BMI Saat Ini
                    </div>
                    <div class="d-flex align-items-baseline gap-2">
                        <span class="metric-number-big">22.4</span>
                        <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1" style="font-size: 11px; font-weight: 600;">Sehat</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="metric-card-custom">
                    <div class="text-muted small mb-2 d-flex align-items-center gap-2 font-medium">
                        <i class="bi bi-fire"></i> Kebutuhan Kalori
                    </div>
                    <div class="d-flex align-items-baseline gap-2">
                        <span class="metric-number-big">1.850</span>
                        <span class="text-muted small font-medium">kkal</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="metric-card-custom">
                    <div class="text-muted small mb-2 d-flex align-items-center gap-2 font-medium">
                        <i class="bi bi-flag"></i> Target Diet
                    </div>
                    <div class="fw-bold text-dark fs-4 lh-sm mt-1">
                        Jaga<br>Berat Badan
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <h4 class="fw-bold text-dark mb-4" style="font-size: 22px;">Peringkat Diet Terbaik</h4>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="dashboard-card-info">
                        <span class="badge bg-success-subtle text-success rounded-pill mb-3 px-2.5 py-1" style="font-size: 11px; font-weight: 600;">Peringkat 1</span>
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
                        <span class="badge bg-secondary-subtle text-secondary rounded-pill mb-3 px-2.5 py-1" style="font-size: 11px; font-weight: 600;">Peringkat 2</span>
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
                        <span class="badge bg-warning-subtle text-warning rounded-pill mb-3 px-2.5 py-1" style="font-size: 11px; font-weight: 600;">Peringkat 3</span>
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

        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-dark m-0" style="font-size: 22px;">Rencana Menu Harian</h4>
                <a href="#" class="text-success fw-semibold small text-decoration-none hover:underline">Edit Rencana</a>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="metric-card-custom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small font-medium">Sarapan • 08:00</span>
                            <span class="badge bg-light text-dark border rounded-pill px-2 py-1" style="font-size: 11px;">350 kkal</span>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Oatmeal & Buah Beri</h5>
                        <p class="text-muted small mb-0 lh-base">Oat gulung dengan susu almond, ditaburi bluberi segar dan biji chia.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="metric-card-custom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small font-medium">Makan Siang • 13:00</span>
                            <span class="badge bg-light text-dark border rounded-pill px-2 py-1" style="font-size: 11px;">550 kkal</span>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Salad Quinoa</h5>
                        <p class="text-muted small mb-0 lh-base">Sayuran campuran dengan quinoa, tomat ceri, mentimun, dan vinaigrette lemon.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="metric-card-custom">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small font-medium">Makan Malam • 19:00</span>
                            <span class="badge bg-light text-dark border rounded-pill px-2 py-1" style="font-size: 11px;">600 kkal</span>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Salmon Panggang</h5>
                        <p class="text-muted small mb-0 lh-base">Fillet salmon tangkapan liar dengan asparagus kukus dan nasi merah.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <h4 class="fw-bold text-dark mb-4" style="font-size: 22px;">Rekomendasi Olahraga</h4>
            <div class="card border-0 rounded-4 p-4 shadow-xs bg-white">
                <div class="d-flex align-items-center gap-4">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; min-width: 52px;">
                        <i class="bi bi-person-walking fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Jalan Cepat</h5>
                        <p class="text-muted small mb-0">Saran aktivitas fisik harian Anda: 30 menit jalan cepat di pagi atau sore hari.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <h4 class="fw-bold text-dark mb-4" style="font-size: 22px;">Tips Kesehatan</h4>
            <div class="card border-0 rounded-4 p-4 shadow-xs bg-white">
                <ul class="tips-list font-medium" style="font-size: 14px;">
                    <li>Pastikan minum minimal 8 gelas air putih setiap hari.</li>
                    <li>Kurangi asupan gula tambahan dan makanan olahan.</li>
                    <li>Perbanyak konsumsi sayuran hijau dan buah-buahan segar.</li>
                    <li>Tidur yang cukup, idealnya 7-8 jam per malam.</li>
                </ul>
            </div>
        </div>

        {{-- FOOTER BAWAH --}}
        <footer>
            © 2026 DietMate Health. All rights reserved.
        </footer>

    </div>

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>