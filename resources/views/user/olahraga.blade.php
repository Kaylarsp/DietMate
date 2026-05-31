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
        /* === STYLE DARI DASHBOARD (ROOT & SIDEBAR) === */
        :root {
            --primary: #0b7a6d;
            --primary-light: #dcefed;
            --bg-color: #f8fafc;
            --text-main: #333333;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body { 
            background: var(--bg-color); 
            color: var(--text-main); 
            overflow-x: hidden; 
        }

        .sidebar { width: 260px; min-height: 100vh; background: white; border-right: 1px solid #edf2f7; position: fixed; padding: 30px 20px; display: flex; flex-direction: column; justify-content: space-between; }
        .logo { font-size: 22px; font-weight: 700; color: var(--primary); display: flex; align-items: center; gap: 10px; }
        .logo i { background: var(--primary-light); padding: 5px 8px; border-radius: 8px; font-size: 18px; }
        .menu-item { padding: 12px 16px; border-radius: 10px; color: #64748b; text-decoration: none; display: flex; align-items: center; gap: 14px; margin-bottom: 8px; font-size: 14px; font-weight: 500; transition: all 0.3s ease; }
        .menu-item:hover { background: #f1f5f9; color: var(--primary); }
        .menu-active { background: var(--primary-light) !important; color: var(--primary) !important; font-weight: 600; }
        .logout-btn { margin-top: auto; color: #ef4444; }
        .logout-btn:hover { background: #fee2e2; color: #dc2626; }

        /* === KONTEN UTAMA OLAHRAGA === */
        .main-content {
            margin-left: 260px;
            padding: 40px 50px;
        }

        .card-olahraga {
            background: white;
            border-radius: 24px;
            border: 1px solid #f1f5f9;
            overflow: hidden; 
            transition: all 0.2s ease;
            height: 100%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        .card-olahraga:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -12px rgba(0,0,0,0.08);
        }

        .workout-image-container {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: #e2e8f0; /* Fallback jika tidak ada gambar */
        }

        .workout-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge-intensitas-floating {
            position: absolute;
            top: 16px;
            left: 16px;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 50px;
            backdrop-filter: blur(8px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .workout-body {
            padding: 24px;
        }

        .durasi-badge {
            background: #f4f7f6;
            border-radius: 16px;
            padding: 12px;
            text-align: center;
        }

        .btn-mulai {
            background: var(--primary);
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

        .insight-card {
            background: linear-gradient(135deg, #008379 0%, #00a693 100%);
            border-radius: 28px;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 131, 121, 0.25);
        }

        footer {
            margin-top: 60px;
            background: transparent;
            padding: 25px;
            text-align: center;
            color: #94a3b8;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    {{-- Panggil layout sidebar, styling css nya sudah tercover di atas --}}
    @include('layouts.sidebar')

    <div class="main-content">
        
        <div class="mb-5">
            <h1 class="fw-bold text-dark m-0" style="font-size: 34px;">Rekomendasi Olahraga</h1>
            <p class="text-muted mt-2">Berdasarkan profil kesehatan dan target diet Anda, kami menyarankan aktivitas berikut untuk mengoptimalkan pembakaran lemak dan kesehatan kardiovaskular.</p>
        </div>

        <div class="row g-4 mb-5">
            
            {{-- LOOPING DATA WORKOUT DARI DATABASE --}}
            @foreach($workouts as $workout)
                @php
                    // Menentukan warna badge berdasarkan intensitas
                    $intensitas = strtolower($workout->intensity);
                    $badgeBg = 'bg-success';
                    $badgeText = 'text-success';
                    $btnColor = 'var(--primary)';
                    $btnHover = '#096157';
                    $iconFire = 'text-warning';

                    if($intensitas == 'tinggi') {
                        $badgeBg = 'bg-danger';
                        $badgeText = 'text-danger';
                        $btnColor = '#dc3545';
                        $btnHover = '#bb2d3b';
                        $iconFire = 'text-danger';
                    } elseif($intensitas == 'ringan') {
                        $badgeBg = 'bg-info';
                        $badgeText = 'text-info';
                    }

                    // Total kalori dibakar = durasi * kalori per menit
                    $totalKalori = $workout->duration_minutes * $workout->cals_burned_per_min;
                @endphp

                <div class="col-md-6">
                    <div class="card-olahraga shadow-sm">
                        <div class="workout-image-container">
                            {{-- Karena tidak ada kolom gambar di ERD tabel workouts, kita bisa pakai random unsplash berdasarkan nama workout --}}
                            <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=600&auto=format&fit=crop&query={{ urlencode($workout->name) }}" alt="{{ $workout->name }}">
                            <span class="badge-intensitas-floating {{ $badgeBg }} bg-opacity-25 {{ $badgeText }} fw-bold">
                                Intensitas {{ ucfirst($workout->intensity) }}
                            </span>
                        </div>

                        <div class="workout-body">
                            <h3 class="fw-bold mb-2 fs-4 text-dark">{{ $workout->name }}</h3>

                            <p class="text-muted small mb-4" style="min-height: 40px;">
                                {{ $workout->description ?? 'Latihan yang bagus untuk menjaga kebugaran tubuh.' }}
                            </p>

                            <div class="row g-2 mb-4">
                                <div class="col-6">
                                    <div class="durasi-badge">
                                        <i class="bi bi-clock text-info fs-5"></i>
                                        <div class="fw-bold mt-1">{{ $workout->duration_minutes }} Menit</div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="durasi-badge">
                                        <i class="bi bi-fire {{ $iconFire }} fs-5"></i>
                                        <div class="fw-bold mt-1">{{ $totalKalori }} kcal</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Form untuk action 'Mulai', bisa diarahkan ke fungsi update workout_recommendations --}}
                            <form action="#" method="POST">
                                @csrf
                                <input type="hidden" name="workout_id" value="{{ $workout->id }}">
                                <button type="submit" class="btn-mulai" style="background: {{ $btnColor }};">
                                    <i class="bi bi-play-circle-fill me-2"></i>
                                    Mulai Sesi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- INSIGHT CARD (Dinamis berdasarkan data pengguna) --}}
            <div class="col-md-6">
                <div class="insight-card h-100 p-4 d-flex flex-column justify-content-center text-white">
                    <h3 class="fw-bold mb-3" style="line-height:1.4;">
                        Insight Kesehatan
                    </h3>

                    <p class="mb-4" style="color: rgba(255,255,255,0.85);">
                        Minggu ini Anda telah membakar total <strong>{{ number_format($weeklyCaloriesBurned, 0, ',', '.') }} kkal</strong> dari aktivitas fisik. 
                        Tetaplah konsisten untuk mencapai target berat badan ideal Anda!
                    </p>

                    <div class="row g-3">
                        <div class="col-6">
                            <div class="rounded-4 p-3 h-100" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.15); backdrop-filter: blur(10px);">
                                <small style="color: rgba(255,255,255,0.75);">Saran Pemulihan</small>
                                <div class="fw-bold fs-5 mt-2 text-white">Istirahat 7 Jam</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="rounded-4 p-3 h-100" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.15); backdrop-filter: blur(10px);">
                                <small style="color: rgba(255,255,255,0.75);">Langkah Hari Ini</small>
                                <div class="fw-bold fs-5 mt-2 text-white">{{ number_format($todaySteps, 0, ',', '.') }} <span class="fs-6 fw-normal">/ 8k</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <footer>
            © {{ date('Y') }} DietMate Health. All rights reserved.
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>