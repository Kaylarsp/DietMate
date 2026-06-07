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

        .sidebar { 
            width: 260px; 
            min-height: 100vh; 
            background: white; 
            border-right: 1px solid #edf2f7; 
            position: fixed; 
            padding: 30px 20px; 
            display: flex; 
            flex-direction: column; 
            justify-content: space-between; 
        }

        .logo { 
            font-size: 22px; 
            font-weight: 700; 
            color: var(--primary); 
            display: flex; 
            align-items: center; 
            gap: 10px; 
        }

        .logo i { 
            background: var(--primary-light); 
            padding: 5px 8px; 
            border-radius: 8px; 
            font-size: 18px; 
        }

        .menu-item { 
            padding: 12px 16px; 
            border-radius: 10px; 
            color: #64748b; 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            gap: 14px; 
            margin-bottom: 8px; 
            font-size: 14px; 
            font-weight: 500; 
            transition: all 0.3s ease; 
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

        .logout-btn { 
            margin-top: auto; 
            color: #ef4444; 
        }

        .logout-btn:hover { 
            background: #fee2e2; 
            color: #dc2626; 
        }

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
            background: linear-gradient(135deg, var(--primary) 0%, #00a693 100%);
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

        .insight-card {
            background: linear-gradient(135deg, #008379 0%, #00a693 100%);
            border-radius: 28px;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 131, 121, 0.25);
        }

        .bmi-card {
            background: linear-gradient(135deg, #008379 0%, #00a693 100%);
            border-radius: 28px;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 131, 121, 0.25);
            margin-bottom: 30px;
        }

        .category-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
        }

        .progress-bmi {
            height: 8px;
            border-radius: 10px;
            background: rgba(255,255,255,0.2);
        }

        .progress-bmi-bar {
            background: white;
            border-radius: 10px;
            height: 100%;
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
    
    @include('layouts.sidebar')

    <div class="main-content">

    @if(!$isLoggedIn)
    <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-info-circle-fill me-2"></i>
        <strong>Tips:</strong> Login atau daftar untuk mendapatkan rekomendasi olahraga yang lebih personal berdasarkan profil kesehatan Anda!
        <a href="{{ route('login') }}" class="alert-link ms-2">Login Sekarang →</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

        <div class="mb-5">
            <h1 class="fw-bold text-dark m-0" style="font-size: 34px;">Rekomendasi Olahraga</h1>
            <p class="text-muted mt-2">{{ $personalizedHeader ?? 'Berdasarkan profil kesehatan dan target diet Anda, kami menyarankan aktivitas berikut untuk mengoptimalkan pembakaran lemak dan kesehatan kardiovaskular.' }}</p>
        </div>

        {{-- BMI Info Card --}}
        @if($bmi)
        <div class="bmi-card p-4 text-white mb-4">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="display-4 fw-bold">{{ number_format($bmi, 1) }}</div>
                        <div class="category-badge mt-2">
                            {{ $bmiCategory }}
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h5 class="mb-2 fw-semibold">Status BMI Anda: {{ $bmiCategory }}</h5>
                    <p class="mb-2" style="font-size: 14px; opacity: 0.95;">{{ $bmiAdvice }}</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1 small">
                            <span>Kurus (&lt;18.5)</span>
                            <span>Normal (18.5-25)</span>
                            <span>Berlebih (25-30)</span>
                            <span>Obesitas (&gt;30)</span>
                        </div>
                        <div class="progress-bmi">
                            @php
                                $bmiPercent = min(100, max(0, ($bmi / 40) * 100));
                            @endphp
                            <div class="progress-bmi-bar" style="width: {{ $bmiPercent }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row g-4 mb-5">
            
            {{-- LOOPING DATA WORKOUT DARI DATABASE --}}
            @forelse($workouts as $workout)
                @php
                    $intensitas = strtolower($workout->intensity);
                    $badgeBg = 'bg-success';
                    $badgeText = 'text-success';
                    $iconFire = 'text-warning';

                    if($intensitas == 'tinggi') {
                        $badgeBg = 'bg-danger';
                        $badgeText = 'text-danger';
                        $iconFire = 'text-danger';
                    } elseif($intensitas == 'ringan') {
                        $badgeBg = 'bg-info';
                        $badgeText = 'text-info';
                    } elseif($intensitas == 'sedang') {
                        $badgeBg = 'bg-warning';
                        $badgeText = 'text-warning';
                    }

                    $totalKalori = $workout->duration_minutes * $workout->cals_burned_per_min;
                    
                    // ========== GAMBAR DINAMIS BERDASARKAN NAMA WORKOUT ==========
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

                <div class="col-md-6">
                    <div class="card-olahraga shadow-sm">
                        <div class="workout-image-container">
                            <img src="{{ $imageUrl }}" alt="{{ $workout->name }}">
                            <span class="badge-intensitas-floating {{ $badgeBg }} bg-opacity-25 {{ $badgeText }} fw-bold">
                                Intensitas {{ ucfirst($workout->intensity) }}
                            </span>
                        </div>

                        <div class="workout-body">
                            <h3 class="fw-bold mb-2 fs-4 text-dark">{{ $workout->name }}</h3>
                            <p class="text-muted small mb-4" style="min-height: 60px;">
                                {{ $workout->description ?? ($workoutDescriptions[$workout->name] ?? 'Latihan yang bagus untuk menjaga kebugaran tubuh.') }}
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
                                        <div class="fw-bold mt-1">{{ number_format($totalKalori, 0, ',', '.') }} kcal</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center p-5">
                        <i class="bi bi-info-circle fs-1"></i>
                        <h4 class="mt-3">Belum ada rekomendasi olahraga</h4>
                        <p>Silakan lengkapi profil kesehatan Anda terlebih dahulu.</p>
                    </div>
                </div>
            @endforelse

            {{-- INSIGHT CARD - VERSI HYBRID --}}
            <div class="col-12">
                <div class="insight-card h-100 p-4 text-white">
                    <div class="row g-4">
                        <!-- Kiri: Motivasi -->
                        <div class="col-md-7">
                            <div class="d-flex gap-3 align-items-start">
                                <i class="bi bi-quote fs-1" style="opacity: 0.5;"></i>
                                <div>
                                    <h4 class="fw-bold mb-2">Semangat!</h4>
                                    <p class="mb-3" style="font-size: 15px; line-height: 1.5;">
                                        @php
                                            $motivasi = [
                                                "Kesehatan bukan tentang menjadi yang terbaik, tapi tentang menjadi lebih baik dari kemarin.",
                                                "Jangan menunggu motivasi datang. Mulai dulu, nanti motivasinya akan mengikuti.",
                                                "30 menit olahraga hari ini lebih baik daripada 1 jam besok yang tidak jadi dilakukan.",
                                                "Bukan tentang seberapa keras, tapi tentang seberapa konsisten.",
                                                "Setiap langkah kecil adalah kemenangan. Rayakan progress-mu!"
                                            ];
                                            echo $motivasi[array_rand($motivasi)];
                                        @endphp
                                    </p>
                                    <div class="mt-3">
                                        @if(!$isLoggedIn)
                                            <a href="{{ route('login') }}" class="btn btn-light rounded-pill px-4 py-2" style="background: white; color: var(--primary); font-weight: 500; font-size: 14px;">
                                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                                Login untuk Rekomendasi Personal
                                            </a>
                                        @elseif(!$profile)
                                            <a href="{{ route('profile.dashboard') }}" class="btn btn-light rounded-pill px-4 py-2" style="background: white; color: var(--primary); font-weight: 500; font-size: 14px;">
                                                <i class="bi bi-pencil-square me-2"></i>
                                                Lengkapi Profil Kesehatan
                                            </a>
                                        @else
                                            <div class="d-flex gap-3">
                                                <div>
                                                    <small style="opacity: 0.7;">Target Harian</small>
                                                    <div class="fw-bold">{{ number_format($stepTarget ?? 8000, 0, ',', '.') }} Langkah</div>
                                                </div>
                                                <div>
                                                    <small style="opacity: 0.7;">Istirahat</small>
                                                    <div class="fw-bold">{{ $sleepAdvice ?? '7-8 Jam' }}</div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Kanan: Tips Cepat --}}
                        <div class="col-md-5">
                            <div class="rounded-4 p-3" style="background: rgba(255,255,255,0.1);">
                                <div class="d-flex gap-2 mb-2">
                                    {{-- <i class="bi bi-lightbulb fs-4" style="color: #ffd700;"></i> --}}
                                    <strong>Tips Cepat</strong>
                                </div>
                                <p class="small mb-0" style="line-height: 1.5;">
                                    @if($bmiCategory == 'Obesitas')
                                        Mulai dengan jalan kaki 10-15 menit/hari, tingkatkan pelan-pelan.
                                    @elseif($bmiCategory == 'Kelebihan Berat Badan')
                                        Kombinasi kardio 3x + strength training 2x per minggu.
                                    @elseif($bmiCategory == 'Normal')
                                        Variasikan olahraga agar tidak bosan dan tubuh tetap terstimulasi.
                                    @elseif($bmiCategory == 'Kurus')
                                        Fokus latihan beban dan konsumsi protein setelah olahraga.
                                    @else
                                        Pilih olahraga yang Anda nikmati agar lebih konsisten.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <footer>
            © {{ date('Y') }} DietMate Health. Hak cipta dilindungi undang-undang.
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>