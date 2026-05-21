<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Profile</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        *{
            font-family: 'Inter', sans-serif;
        }

        body{
            background: #f4f7f6;
        }

        .sidebar{
            width: 250px;
            min-height: 100vh;
            background: white;
            border-right: 1px solid #ddd;
            position: fixed;
            padding: 30px 20px;
        }

        .logo{
            font-size: 24px;
            font-weight: 700;
        }

        .menu-item{
            padding: 12px 15px;
            border-radius: 12px;
            color: #5c5c5c;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        .menu-item:hover,
        .menu-active{
            background: #dcefed;
            color: #0b7a6d;
        }

        .main-content{
            margin-left: 270px;
            padding: 40px;
        }

        .profile-header{
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .profile-img{
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .badge-custom{
            background: #d8f3ea;
            color: #0b7a6d;
            padding: 8px 14px;
            border-radius: 50px;
            font-size: 13px;
        }

        .target-badge{
            background: #fff2b8;
            color: #7b6b00;
        }

        .card-custom{
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .section-title{
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .metric-card{
            background: #dcefed;
            border-radius: 20px;
            padding: 25px;
            height: 100%;
        }

        .metric-box{
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .metric-number{
            font-size: 40px;
            font-weight: 700;
            color: #0b7a6d;
        }

        .diet-option{
            border: 1.5px solid #d8d8d8;
            border-radius: 16px;
            padding: 20px;
            transition: 0.3s;
            cursor: pointer;
        }

        .diet-option:hover,
        .diet-active{
            border-color: #0b7a6d;
            background: #f2fbf8;
        }

        .tag{
            border: 1px solid #0b7a6d;
            color: #0b7a6d;
            padding: 10px 18px;
            border-radius: 50px;
            display: inline-block;
            margin: 5px;
            font-size: 14px;
        }

        .btn-main{
            background: #0b7a6d;
            border: none;
            color: white;
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 600;
        }

        .btn-main:hover{
            background: #08695e;
        }

        .btn-secondary-custom{
            background: transparent;
            border: none;
            color: #555;
            font-weight: 500;
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

        <a href="#" class="menu-item">
            <i class="bi bi-journal-text"></i>
            Rencana Makan
        </a>

        <a href="#" class="menu-item">
            <i class="bi bi-heart-pulse"></i>
            Rekomendasi Olahraga
        </a>

        <a href="#" class="menu-item">
            <i class="bi bi-bar-chart"></i>
            Metrik Kesehatan
        </a>

        <a href="#" class="menu-item menu-active">
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

        {{-- Profile Header --}}
        <div class="profile-header">

            <img src="https://i.pravatar.cc/150?img=32" class="profile-img">

            <div>
                <h2 class="fw-bold mb-1">Vera Efita</h2>
                <p class="text-muted mb-2">vera@gmail.com</p>

                <div class="d-flex gap-2">
                    <span class="badge-custom">
                        <i class="bi bi-patch-check-fill"></i>
                        Member Aktif
                    </span>

                    <span class="badge-custom target-badge">
                        Target: Maintain Weight
                    </span>
                </div>
            </div>

        </div>

        {{-- Data Tubuh --}}
        <div class="row">

            <div class="col-lg-8">

                <div class="card-custom">

                    <h4 class="fw-bold mb-4">
                        <i class="bi bi-clipboard2-data"></i>
                        Data Tubuh (DSS)
                    </h4>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Umur</label>
                            <input type="text" class="form-control" value="21">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin</label>

                            <select class="form-select">
                                <option>Perempuan</option>
                                <option>Laki-laki</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tinggi Badan</label>
                            <input type="text" class="form-control" value="154">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Berat Badan</label>
                            <input type="text" class="form-control" value="47">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Aktivitas Harian</label>

                            <select class="form-select">
                                <option>Sedenter</option>
                                <option>Aktif</option>
                            </select>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Metrics --}}
            <div class="col-lg-4">

                <div class="metric-card">

                    <h6 class="text-uppercase text-muted fw-bold mb-4">
                        Calculated Metrics
                    </h6>

                    <div class="metric-box">
                        <small class="text-muted">BMI</small>

                        <div class="metric-number">
                            22.9
                        </div>

                        <small class="text-success fw-semibold">
                            Kategori: Normal
                        </small>
                    </div>

                    <div class="metric-box">
                        <small class="text-muted">Target Kalori Harian</small>

                        <div class="metric-number">
                            2150
                        </div>

                        <small class="text-muted">
                            kcal
                        </small>
                    </div>

                    <button class="btn btn-main w-100">
                        Update Data
                    </button>

                </div>

            </div>

        </div>

        {{-- Target Diet --}}
        <div class="card-custom">

            <h4 class="fw-bold mb-4">
                <i class="bi bi-flag"></i>
                Target Diet
            </h4>

            <div class="row g-3">

                <div class="col-md-4">
                    <div class="diet-option diet-active">
                        <h5 class="fw-bold">Weight Loss</h5>
                        <p class="text-muted mb-0">
                            Fokus pada pembakaran lemak dan defisit kalori.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="diet-option">
                        <h5 class="fw-bold">Maintain Weight</h5>
                        <p class="text-muted mb-0">
                            Menjaga komposisi tubuh tetap seimbang.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="diet-option">
                        <h5 class="fw-bold">Weight Gain</h5>
                        <p class="text-muted mb-0">
                            Membangun massa otot dan surplus nutrisi.
                        </p>
                    </div>
                </div>

            </div>

        </div>

        {{-- Preferensi --}}
        <div class="card-custom">

            <h4 class="fw-bold mb-4">
                <i class="bi bi-cup-hot"></i>
                Preferensi Makanan
            </h4>

            <div class="mb-4">

                <span class="tag">Vegetarian ✕</span>
                <span class="tag">Vegan ✕</span>
                <span class="tag">Alergi Seafood ✕</span>
                <span class="tag">Gluten Free ✕</span>
                <span class="tag">Tidak Suka Pedas ✕</span>

            </div>

            <div class="p-4 rounded-4" style="background: #f7f7f7">

                <div class="row align-items-center">

                    <div class="col-md-4">
                        <h6 class="fw-bold">Ada alergi lain?</h6>

                        <small class="text-muted">
                            Sebutkan bahan makanan yang ingin dihindari.
                        </small>
                    </div>

                    <div class="col-md-5 mt-3 mt-md-0">
                        <input type="text"
                               class="form-control"
                               placeholder="Misal: Kacang, Susu">
                    </div>

                    <div class="col-md-3 mt-3 mt-md-0">
                        <button class="btn btn-main w-100">
                            Tambah
                        </button>
                    </div>

                </div>

            </div>

        </div>

        {{-- Action --}}
        <div class="d-flex justify-content-end gap-3 pb-5">

            <button class="btn btn-secondary-custom">
                Batalkan
            </button>

            <button class="btn btn-main">
                Simpan Perubahan
            </button>

        </div>

    </div>

</body>
</html>