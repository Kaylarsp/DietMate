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
            --primary-light: #dcefed;
            --bg-color: #f8fafc;
            --text-main: #333333;
        }

        * { font-family: 'Inter', sans-serif; }
        body { background: var(--bg-color); color: var(--text-main); overflow-x: hidden; }

        /* --- SIDEBAR SAMA DENGAN PROFILE --- */
        .sidebar { width: 260px; min-height: 100vh; background: white; border-right: 1px solid #edf2f7; position: fixed; padding: 30px 20px; display: flex; flex-direction: column; justify-content: space-between; }
        .logo { font-size: 22px; font-weight: 700; color: var(--primary); display: flex; align-items: center; gap: 10px; }
        .logo i { background: var(--primary-light); padding: 5px 8px; border-radius: 8px; font-size: 18px; }
        .menu-item { padding: 12px 16px; border-radius: 10px; color: #64748b; text-decoration: none; display: flex; align-items: center; gap: 14px; margin-bottom: 8px; font-size: 14px; font-weight: 500; transition: all 0.3s ease; }
        .menu-item:hover { background: #f1f5f9; color: var(--primary); }
        .menu-active { background: var(--primary-light) !important; color: var(--primary) !important; font-weight: 600; }
        .logout-btn { margin-top: auto; }

        /* --- MAIN CONTENT --- */
        .main-content { margin-left: 260px; padding: 40px 50px; }
        .page-title { font-size: 32px; font-weight: 700; color: #1e293b; }

        .meal-title { display: flex; align-items: center; gap: 14px; margin-bottom: 20px; margin-top: 35px; }
        .meal-title h3 { margin: 0; font-weight: 600; font-size: 22px;}
        .meal-time { background: var(--primary-light); color: var(--primary); font-size: 13px; padding: 5px 14px; border-radius: 50px; font-weight: 600; }

        .meal-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.03); margin-bottom: 35px; border: 1px solid #f1f5f9;}
        .meal-image { width: 100%; height: 100%; min-height: 250px; object-fit: cover; }
        .meal-content { padding: 35px; }
        .meal-name { font-size: 28px; font-weight: 700; margin-bottom: 12px; color: #1e293b;}
        .meal-desc { color: #64748b; line-height: 1.6; margin-bottom: 25px; font-size: 15px;}

        .nutrition-box { background: #f8fafc; border-radius: 14px; padding: 15px; text-align: center; border: 1px solid #e2e8f0;}
        .nutrition-title { color: #64748b; font-size: 13px; font-weight: 500; }
        .nutrition-value { font-size: 22px; font-weight: 700; color: var(--primary); margin-top: 5px;}

        .tip { margin-top: 25px; color: #64748b; font-size: 14px; background: #fffbeb; padding: 12px 15px; border-radius: 10px; border: 1px solid #fef3c7;}
        .tip i { color: #d97706; margin-right: 5px; }

        .summary-card { border-radius: 20px; padding: 30px; height: 100%; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02);}
        .summary-green { background: var(--primary); color: white; border: none; }
        .summary-white { background: white; }
        .summary-soft { background: var(--primary-light); border: none;}
        .big-number { font-size: 42px; font-weight: 700; }
        .progress { height: 8px; border-radius: 50px; background: #e2e8f0; }

        footer { margin-top: 60px; padding: 30px; text-align: center; color: #94a3b8; font-size: 14px; }
    </style>
</head>
<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div>
            <div class="logo mb-5">
                <i class="bi bi-yelp text-primary"></i> DietMate
            </div>
            <a href="#" class="menu-item"><i class="bi bi-grid-1x2"></i> Dashboard</a>
            <a href="#" class="menu-item menu-active"><i class="bi bi-journal-text"></i> Rencana Makan</a>
            <a href="#" class="menu-item"><i class="bi bi-bicycle"></i> Rekomendasi Olahraga</a>
            <a href="#" class="menu-item"><i class="bi bi-graph-up"></i> Metrik Kesehatan</a>
            <a href="#" class="menu-item"><i class="bi bi-person-fill"></i> Profil</a>
            <a href="#" class="menu-item"><i class="bi bi-gear"></i> Pengaturan</a>
        </div>
        <a href="#" class="menu-item logout-btn"><i class="bi bi-box-arrow-right"></i> Keluar</a>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="main-content">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="page-title">Rekomendasi Menu Makan</h1>
                <p class="text-muted">Menu diet seimbang untuk hari ini, {{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
            <div>
                <i class="bi bi-bell fs-4 text-muted"></i>
            </div>
        </div>

        {{-- SARAPAN --}}
        @if($sarapan)
        <div class="meal-title">
            <div style="width:5px;height:30px;background:var(--primary);border-radius:10px;"></div>
            <h3>Sarapan</h3>
            <span class="meal-time">07:00 - 08:30</span>
        </div>
        <div class="meal-card">
            <div class="row g-0">
                <div class="col-lg-4">
                    <img src="{{ $sarapan->image_url ?? 'https://images.unsplash.com/photo-1547592180-85f173990554?q=80&w=1200' }}" class="meal-image" alt="Sarapan">
                </div>
                <div class="col-lg-8">
                    <div class="meal-content">
                        <h2 class="meal-name">{{ $sarapan->name }}</h2>
                        <p class="meal-desc">{{ $sarapan->description }}</p>

                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Kalori</div>
                                    <div class="nutrition-value">{{ $sarapan->calories }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Protein</div>
                                    <div class="nutrition-value">{{ $sarapan->protein_g }}g</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Karb</div>
                                    <div class="nutrition-value">{{ $sarapan->carbs_g }}g</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Lemak</div>
                                    <div class="nutrition-value">{{ $sarapan->fat_g }}g</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- MAKAN SIANG --}}
        @if($makanSiang)
        <div class="meal-title">
            <div style="width:5px;height:30px;background:var(--primary);border-radius:10px;"></div>
            <h3>Makan Siang</h3>
            <span class="meal-time">12:00 - 13:30</span>
        </div>
        <div class="meal-card">
            <div class="row g-0">
                <div class="col-lg-8">
                    <div class="meal-content">
                        <h2 class="meal-name">{{ $makanSiang->name }}</h2>
                        <p class="meal-desc">{{ $makanSiang->description }}</p>

                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Kalori</div>
                                    <div class="nutrition-value">{{ $makanSiang->calories }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Protein</div>
                                    <div class="nutrition-value">{{ $makanSiang->protein_g }}g</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Karb</div>
                                    <div class="nutrition-value">{{ $makanSiang->carbs_g }}g</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Lemak</div>
                                    <div class="nutrition-value">{{ $makanSiang->fat_g }}g</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <img src="{{ $makanSiang->image_url ?? 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=1200' }}" class="meal-image" alt="Makan Siang">
                </div>
            </div>
        </div>
        @endif

        {{-- MAKAN MALAM --}}
        @if($makanMalam)
        <div class="meal-title">
            <div style="width:5px;height:30px;background:var(--primary);border-radius:10px;"></div>
            <h3>Makan Malam</h3>
            <span class="meal-time">18:30 - 20:00</span>
        </div>
        <div class="meal-card">
            <div class="row g-0">
                <div class="col-lg-4">
                    <img src="{{ $makanMalam->image_url ?? 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?q=80&w=1200' }}" class="meal-image" alt="Makan Malam">
                </div>
                <div class="col-lg-8">
                    <div class="meal-content">
                        <h2 class="meal-name">{{ $makanMalam->name }}</h2>
                        <p class="meal-desc">{{ $makanMalam->description }}</p>

                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Kalori</div>
                                    <div class="nutrition-value">{{ $makanMalam->calories }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Protein</div>
                                    <div class="nutrition-value">{{ $makanMalam->protein_g }}g</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Karb</div>
                                    <div class="nutrition-value">{{ $makanMalam->carbs_g }}g</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Lemak</div>
                                    <div class="nutrition-value">{{ $makanMalam->fat_g }}g</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- SUMMARY --}}
        <div class="row mt-5 g-4">
            <div class="col-lg-4">
                <div class="summary-card summary-green">
                    <p class="mb-2">Total Kalori Menu</p>
                    <div class="big-number">
                        {{ number_format($totalKaloriMenu, 0, ',', ',') }}
                        <span style="font-size:20px; font-weight: 500;">kcal</span>
                    </div>
                    <small class="opacity-75">
                        {{ $persentaseKalori }}% dari target harian Anda ({{ number_format($targetKalori, 0, ',', ',') }} kcal)
                    </small>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="summary-card summary-white">
                    <h5 class="mb-1 text-dark fw-bold">Hidrasi</h5>
                    <div class="d-flex align-items-center gap-3 my-3">
                        <i class="bi bi-droplet-fill fs-1 text-primary"></i>
                        <div class="big-number text-primary" style="font-size:36px;">
                            0/8 <span style="font-size: 16px; color:#64748b;">Gelas</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" style="width:0%"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="summary-card summary-soft">
                    <h5 class="mb-2 text-dark fw-bold">Rekomendasi Camilan</h5>
                    <p class="text-muted" style="font-size: 14px;">
                        Almond atau apel potong untuk menjaga metabolisme.
                    </p>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <span class="badge bg-white text-dark border">Protein Tinggi</span>
                        <span class="badge bg-white text-dark border">Rendah Gula</span>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            © {{ date('Y') }} DietMate. All rights reserved.
        </footer>
    </div>

</body>
</html>