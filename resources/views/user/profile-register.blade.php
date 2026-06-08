<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Profile - Registration</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #0b7a6d;
            --primary-light: #dcefed;
            --primary-hover: #08695e;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --bg-body: #f8fafc;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: var(--bg-body);
            color: var(--text-main);
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: white;
            border-right: 1px solid #e2e8f0;
            position: fixed;
            padding: 30px 20px;
        }
        .logo { font-size: 24px; font-weight: 700; color: var(--primary); }
        .menu-item {
            padding: 12px 15px; border-radius: 12px; color: var(--text-muted);
            text-decoration: none; display: flex; align-items: center; gap: 12px; margin-bottom: 10px; font-weight: 500; transition: all 0.2s;
        }
        .menu-active { background: var(--primary-light); color: var(--primary); font-weight: 600; }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 270px;
            padding: 40px;
        }

        /* --- HEADER --- */
        .profile-header {
            display: flex; align-items: center; gap: 20px; margin-bottom: 40px;
        }
        .profile-img {
            width: 80px; height: 80px; border-radius: 50%; object-fit: cover;
            border: 3px solid white; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        /* --- CARDS --- */
        .card-custom {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            margin-bottom: 25px;
            border: 1px solid #f1f5f9;
        }
        .card-title-custom {
            font-size: 20px; font-weight: 700; color: var(--text-main);
            margin-bottom: 24px; display: flex; align-items: center; gap: 10px;
        }
        .card-title-custom i { color: var(--primary); }

        /* --- FORM STYLING --- */
        .form-label {
            font-size: 13px; font-weight: 600; color: var(--text-muted); margin-bottom: 8px; letter-spacing: 0.3px;
        }
        .form-control, .form-select {
            border-radius: 12px; padding: 12px 16px; border: 1px solid #e2e8f0;
            background-color: #f8fafc; font-size: 14px; transition: all 0.3s ease; color: var(--text-main);
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary); box-shadow: 0 0 0 4px rgba(11, 122, 109, 0.1); background-color: #ffffff;
        }

        /* --- RIGHT METRIC CARD --- */
        .metric-card-wrapper {
            position: sticky; top: 40px; /* Biar ngikut pas di-scroll */
        }
        .metric-card {
            background: linear-gradient(145deg, #dcefed, #c9e6e3);
            border-radius: 24px; padding: 35px; height: 100%; display: flex; flex-direction: column;
            border: 1px solid rgba(255,255,255,0.5);
        }
        .metric-box {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px); border: 1px solid white;
            border-radius: 16px; padding: 20px; margin-bottom: 15px; text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }
        .metric-number {
            font-size: 32px; font-weight: 800; color: var(--primary); margin-top: 5px;
        }

        /* --- BUTTON --- */
        .btn-main {
            background: var(--primary); border: none; color: white; padding: 16px 28px;
            border-radius: 16px; font-weight: 600; font-size: 15px; width: 100%;
            transition: all 0.3s ease; box-shadow: 0 8px 20px rgba(11, 122, 109, 0.2);
            margin-top: 20px;
        }
        .btn-main:hover {
            background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 10px 25px rgba(11, 122, 109, 0.3); color: white;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 992px) {
            .sidebar { width: 100%; min-height: auto; position: relative; border-right: none; padding: 20px; }
            .main-content { margin-left: 0; padding: 20px; }
            .metric-card-wrapper { position: relative; top: 0; margin-top: 20px; }
        }
    </style>
</head>

<body>

    {{-- @include('layouts.sidebar') --}}

    <div class="main-content">

        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="profile-header">
            <img src="https://i.pravatar.cc/150?img=32" class="profile-img" alt="Profile">
            <div>
                <h2 class="fw-bold mb-1" style="color: var(--text-main);">Buat Akun Diet Kamu</h2>
                <p class="text-muted mb-0" style="font-size: 15px;">Lengkapi data diri dan profil tubuhmu untuk rekomendasi terbaik.</p>
            </div>
        </div>

        <form action="{{ route('profile-register') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    
                    {{-- ACCOUNT DATA --}}
                    <div class="card-custom">
                        <h4 class="card-title-custom"><i class="bi bi-person-badge"></i> Data Akun</h4>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="contoh@email.com" value="{{ old('email') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter">
                            </div>
                        </div>
                    </div>

                    {{-- BODY DATA --}}
                    <div class="card-custom">
                        <h4 class="card-title-custom"><i class="bi bi-clipboard2-pulse"></i> Data Tubuh</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Umur</label>
                                <div class="input-group">
                                    <input type="number" name="age" class="form-control" placeholder="Contoh: 21" value="{{ old('age') }}">
                                    <span class="input-group-text border-0 bg-light text-muted" style="border-radius: 0 12px 12px 0;">Tahun</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="gender">
                                    <option value="" hidden>Pilih Gender</option>
                                    <option value="male">Laki-laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tinggi Badan</label>
                                <div class="input-group">
                                    <input type="number" step="0.1" name="height_cm" class="form-control" placeholder="Contoh: 165" value="{{ old('height_cm') }}">
                                    <span class="input-group-text border-0 bg-light text-muted" style="border-radius: 0 12px 12px 0;">cm</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Berat Badan</label>
                                <div class="input-group">
                                    <input type="number" step="0.1" name="weight_kg" class="form-control" placeholder="Contoh: 55" value="{{ old('weight_kg') }}">
                                    <span class="input-group-text border-0 bg-light text-muted" style="border-radius: 0 12px 12px 0;">kg</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Aktivitas Harian</label>
                                <select class="form-select" name="activity_level">
                                    <option value="" hidden>Pilih tingkat aktivitas kamu</option>
                                    <option value="sedentary">Sedentary (Jarang berolahraga)</option>
                                    <option value="lightly_active">Lightly Active (Olahraga ringan 1-3 hari/minggu)</option>
                                    <option value="moderately_active">Moderately Active (Olahraga sedang 3-5 hari/minggu)</option>
                                    <option value="very_active">Very Active (Olahraga berat 6-7 hari/minggu)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="metric-card-wrapper">
                        <div class="metric-card">
                            <h6 class="text-uppercase fw-bold mb-4" style="color: #0b7a6d; letter-spacing: 1px;">
                                <i class="bi bi-bullseye me-2"></i>Target Diet
                            </h6>

                            <div class="mb-4">
                                <label class="form-label text-dark">Diet Goal</label>
                                <select class="form-select border-0 shadow-sm" name="diet_goal">
                                    <option value="" hidden>Pilih Target</option>
                                    <option value="loss">Weight Loss (Turun Berat Badan)</option>
                                    <option value="maintain">Maintain Weight (Jaga Berat Badan)</option>
                                    <option value="gain">Weight Gain (Naik Berat Badan)</option>
                                </select>
                            </div>

                            <div class="metric-box">
                                <small class="text-muted fw-semibold text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">BMI Estimate</small>
                                <div class="metric-number">Auto</div>
                            </div>

                            <div class="metric-box">
                                <small class="text-muted fw-semibold text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">Daily Calories</small>
                                <div class="metric-number">Auto</div>
                            </div>

                            <button type="submit" class="btn btn-main">
                                Buat Akun Sekarang <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>