{{-- resources/views/recommendation.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DietMate - Rencana Makan</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Inter', sans-serif;
        }

        body{
            background: #edf7f5;
        }

        .sidebar{
            width: 250px;
            min-height: 100vh;
            background: white;
            position: fixed;
            padding: 30px 20px;
            border-right: 1px solid #e5e5e5;
        }

        .logo{
            font-size: 30px;
            font-weight: 700;
            color: #0b7a6d;
        }

        .menu-item{
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #4f4f4f;
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        .menu-item:hover,
        .menu-active{
            background: #cfe8e4;
            color: #0b7a6d;
        }

        .main-content{
            margin-left: 250px;
            padding: 40px 50px;
        }

        .page-title{
            font-size: 42px;
            font-weight: 700;
            color: #24312f;
        }

        .meal-title{
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
            margin-top: 35px;
        }

        .meal-title h3{
            margin: 0;
            font-weight: 600;
        }

        .meal-time{
            background: #d9ece8;
            color: #0b7a6d;
            font-size: 13px;
            padding: 5px 12px;
            border-radius: 50px;
            font-weight: 600;
        }

        .meal-card{
            background: white;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 5px 18px rgba(0,0,0,0.05);
            margin-bottom: 35px;
        }

        .meal-image{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .meal-content{
            padding: 35px;
        }

        .meal-name{
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .meal-desc{
            color: #666;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .nutrition-box{
            background: #f6f6f6;
            border-radius: 14px;
            padding: 15px;
            text-align: center;
        }

        .nutrition-title{
            color: #777;
            font-size: 13px;
        }

        .nutrition-value{
            font-size: 24px;
            font-weight: 700;
            color: #0b7a6d;
        }

        .tip{
            margin-top: 25px;
            color: #666;
            font-size: 14px;
        }

        .summary-card{
            border-radius: 20px;
            padding: 30px;
            height: 100%;
        }

        .summary-green{
            background: #0b8b7d;
            color: white;
        }

        .summary-white{
            background: white;
        }

        .summary-soft{
            background: #dcefed;
        }

        .big-number{
            font-size: 48px;
            font-weight: 700;
        }

        .progress{
            height: 10px;
            border-radius: 50px;
        }

        footer{
            margin-top: 80px;
            background: #e7e7e7;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">

        <div class="logo mb-5">
            DietMate
        </div>

        <a href="#" class="menu-item">
            <i class="bi bi-grid"></i>
            Dashboard
        </a>

        <a href="#" class="menu-item menu-active">
            <i class="bi bi-fork-knife"></i>
            Rencana Makan
        </a>

        <a href="#" class="menu-item">
            <i class="bi bi-activity"></i>
            Rekomendasi Olahraga
        </a>

        <a href="#" class="menu-item">
            <i class="bi bi-bar-chart"></i>
            Metrik Kesehatan
        </a>

        <a href="#" class="menu-item">
            <i class="bi bi-person"></i>
            Profil
        </a>

        <a href="#" class="menu-item">
            <i class="bi bi-gear"></i>
            Pengaturan
        </a>

        <div class="mt-5 pt-5">
            <a href="#" class="menu-item">
                <i class="bi bi-box-arrow-left"></i>
                Keluar
            </a>
        </div>

    </div>

    {{-- Main Content --}}
    <div class="main-content">

        <div class="d-flex justify-content-between align-items-center mb-5">

            <div>
                <h1 class="page-title">
                    Rekomendasi Menu Makan
                </h1>

                <p class="text-muted">
                    Menu diet seimbang untuk Selasa, 24 Oktober
                </p>
            </div>

            <div>
                <i class="bi bi-bell fs-4"></i>
            </div>

        </div>

        {{-- Sarapan --}}
        <div class="meal-title">
            <div style="width:4px;height:40px;background:#0b7a6d;border-radius:10px;"></div>

            <h3>Sarapan</h3>

            <span class="meal-time">
                07:00 - 08:30
            </span>
        </div>

        <div class="meal-card">

            <div class="row g-0">

                <div class="col-lg-4">
                    <img
                        src="https://images.unsplash.com/photo-1547592180-85f173990554?q=80&w=1200"
                        class="meal-image"
                    >
                </div>

                <div class="col-lg-8">

                    <div class="meal-content">

                        <h2 class="meal-name">
                            Berry Smoothie Bowl
                        </h2>

                        <p class="meal-desc">
                            Campuran buah beri segar dengan yogurt Greek rendah lemak
                            dan chia seed untuk energi pagi.
                        </p>

                        <div class="row g-3">

                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Kalori</div>
                                    <div class="nutrition-value">320</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Protein</div>
                                    <div class="nutrition-value">15g</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Karb</div>
                                    <div class="nutrition-value">42g</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Lemak</div>
                                    <div class="nutrition-value">8g</div>
                                </div>
                            </div>

                        </div>

                        <div class="tip">
                            <i class="bi bi-info-circle"></i>
                            Blender semua bahan dan sajikan dingin dengan granola.
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Makan Siang --}}
        <div class="meal-title">
            <div style="width:4px;height:40px;background:#0b7a6d;border-radius:10px;"></div>

            <h3>Makan Siang</h3>

            <span class="meal-time">
                12:00 - 13:30
            </span>
        </div>

        <div class="meal-card">

            <div class="row g-0">

                <div class="col-lg-8">

                    <div class="meal-content">

                        <h2 class="meal-name">
                            Mediterranean Quinoa Salad
                        </h2>

                        <p class="meal-desc">
                            Salad quinoa sehat dengan sayuran organik, chickpeas,
                            dan dressing lemon zaitun.
                        </p>

                        <div class="row g-3">

                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Kalori</div>
                                    <div class="nutrition-value">450</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Protein</div>
                                    <div class="nutrition-value">18g</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Karb</div>
                                    <div class="nutrition-value">55g</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Lemak</div>
                                    <div class="nutrition-value">22g</div>
                                </div>
                            </div>

                        </div>

                        <div class="tip">
                            <i class="bi bi-stars"></i>
                            Campurkan semua bahan dan tambahkan balsamic sauce.
                        </div>

                    </div>

                </div>

                <div class="col-lg-4">
                    <img
                        src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=1200"
                        class="meal-image"
                    >
                </div>

            </div>

        </div>

        {{-- Makan Malam --}}
        <div class="meal-title">
            <div style="width:4px;height:40px;background:#0b7a6d;border-radius:10px;"></div>

            <h3>Makan Malam</h3>

            <span class="meal-time">
                18:30 - 20:00
            </span>
        </div>

        <div class="meal-card">

            <div class="row g-0">

                <div class="col-lg-4">
                    <img
                        src="https://images.unsplash.com/photo-1467003909585-2f8a72700288?q=80&w=1200"
                        class="meal-image"
                    >
                </div>

                <div class="col-lg-8">

                    <div class="meal-content">

                        <h2 class="meal-name">
                            Lemon Herb Grilled Salmon
                        </h2>

                        <p class="meal-desc">
                            Salmon panggang dengan asparagus kukus dan rempah pilihan
                            untuk nutrisi maksimal.
                        </p>

                        <div class="row g-3">

                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Kalori</div>
                                    <div class="nutrition-value">380</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Protein</div>
                                    <div class="nutrition-value">34g</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Karb</div>
                                    <div class="nutrition-value">12g</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="nutrition-box">
                                    <div class="nutrition-title">Lemak</div>
                                    <div class="nutrition-value">24g</div>
                                </div>
                            </div>

                        </div>

                        <div class="tip">
                            <i class="bi bi-fire"></i>
                            Panggang salmon selama 15 menit suhu 200°C.
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Summary --}}
        <div class="row mt-5 g-4">

            <div class="col-lg-4">

                <div class="summary-card summary-green">

                    <p>Total Kalori Hari Ini</p>

                    <div class="big-number">
                        1,150
                        <span style="font-size:22px;">kcal</span>
                    </div>

                    <small>
                        75% dari target harian Anda
                    </small>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="summary-card summary-white">

                    <h5>Hidrasi</h5>

                    <div class="d-flex align-items-center gap-3 my-4">
                        <i class="bi bi-droplet fs-1 text-success"></i>

                        <div class="big-number" style="font-size:40px;">
                            6/8
                        </div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar bg-success"
                             style="width:75%">
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="summary-card summary-soft">

                    <h5>Rekomendasi Camilan</h5>

                    <p class="mt-3 text-muted">
                        Almond atau apel potong untuk menjaga metabolisme.
                    </p>

                    <div class="d-flex gap-2 mt-4">
                        <span class="badge text-bg-light">
                            Protein Tinggi
                        </span>

                        <span class="badge text-bg-light">
                            Rendah Gula
                        </span>
                    </div>

                </div>

            </div>

        </div>

        {{-- Footer --}}
        <footer>
            © 2026 DietMate Health. All rights reserved.
        </footer>

    </div>

</body>
</html>