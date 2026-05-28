<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - DietMate</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #0b7a6d;
            --primary-light: #dcefed;
            --bg-color: #f8fafc;
            --text-main: #333333;
            --text-muted: #888888;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: var(--bg-color);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
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
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 260px;
            padding: 40px 50px;
        }

        /* --- HEADER PROFILE --- */
        .profile-header {
            display: flex;
            align-items: center;
            gap: 25px;
            margin-bottom: 40px;
        }

        .profile-img-container {
            position: relative;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .edit-img-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
            cursor: pointer;
            font-size: 12px;
        }

        .badge-custom {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-active {
            background: var(--primary-light);
            color: var(--primary);
        }

        .badge-target {
            background: #fef0c7;
            color: #b54708;
        }

        /* --- CARDS & FORMS --- */
        .card-custom {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.02);
            margin-bottom: 25px;
            border: 1px solid #f1f5f9;
        }

        .card-title-custom {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-label {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 6px;
        }

        .form-control, .form-select {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 15px;
            font-size: 14px;
            color: #334155;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(11, 122, 109, 0.15);
        }

        /* --- TARGET DIET CARDS (Radio Buttons) --- */
        .target-diet-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }
        
        .target-card-input {
            display: none;
        }
        
        .target-card-label {
            display: block;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px 15px;
            cursor: pointer;
            transition: all 0.2s;
            background: #f8fafc;
            height: 100%;
        }

        .target-card-input:checked + .target-card-label {
            border-color: var(--primary);
            background: var(--primary-light);
            box-shadow: 0 4px 10px rgba(11, 122, 109, 0.1);
        }

        .target-icon {
            font-size: 20px;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .target-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #1e293b;
        }

        .target-desc {
            font-size: 12px;
            color: #64748b;
            line-height: 1.4;
        }

        /* --- PREFERENSI MAKANAN --- */
        .pref-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 25px;
        }

        .pref-tag {
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 13px;
            border: 1px solid #e2e8f0;
            background: white;
            color: #64748b;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .pref-tag.selected {
            background: var(--primary-light);
            border-color: var(--primary-light);
            color: var(--primary);
            font-weight: 500;
        }

        .add-allergy-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        /* --- RIGHT METRICS PANEL --- */
        .metrics-container {
            background: var(--primary-light);
            border-radius: 20px;
            padding: 25px;
        }

        .metrics-header {
            font-size: 12px;
            font-weight: 600;
            color: #5c7b77;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .metric-box {
            background: white;
            border-radius: 16px;
            padding: 25px 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            text-align: center;
        }

        .metric-title {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 10px;
        }

        .metric-value {
            font-size: 36px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 5px;
        }
        
        .metric-unit {
            font-size: 14px;
            font-weight: 500;
            color: #94a3b8;
        }

        .bmi-bar {
            height: 6px;
            border-radius: 10px;
            background: linear-gradient(90deg, #3b82f6 0%, #10b981 50%, #f59e0b 80%, #ef4444 100%);
            margin: 15px 0;
            position: relative;
        }

        .bmi-indicator {
            width: 12px;
            height: 12px;
            background: white;
            border: 2px solid var(--text-main);
            border-radius: 50%;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            /* Positioning is calculated inline based on BMI */
        }

        .metric-desc {
            font-size: 12px;
            color: #64748b;
        }

        .metric-desc strong {
            color: var(--primary);
        }

        .btn-main {
            background: var(--primary);
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-main:hover {
            background: #08695e;
            color: white;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid transparent;
            color: #64748b;
            font-weight: 600;
            font-size: 14px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
        }

        @media (max-width: 992px){
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
                padding: 20px;
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            .target-diet-options {
                grid-template-columns: 1fr;
            }
            .add-allergy-box {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>

<body>

<div class="sidebar">
    <div>
        <div class="logo mb-5">
            <i class="bi bi-yelp text-primary"></i> 
            DietMate
            {{-- <span style="font-size:10px; color:#aaa; font-weight:normal; margin-left:5px;">REKOMENDASI DIET</span> --}}
        </div>

        <a href="dashboard" class="menu-item">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>
        <a href="#" class="menu-item">
            <i class="bi bi-journal-text"></i> Rencana Makan
        </a>
        <a href="#" class="menu-item">
            <i class="bi bi-bicycle"></i> Rekomendasi Olahraga
        </a>
        <a href="#" class="menu-item">
            <i class="bi bi-graph-up"></i> Metrik Kesehatan
        </a>
        <a href="#" class="menu-item menu-active">
            <i class="bi bi-person-fill"></i> Profil
        </a>
        <a href="#" class="menu-item">
            <i class="bi bi-gear"></i> Pengaturan
        </a>
    </div>

    <a href="#" class="menu-item logout-btn">
        <i class="bi bi-box-arrow-right"></i> Keluar
    </a>
</div>

<div class="main-content">

    {{-- HEADER --}}
    <div class="profile-header">
        <div class="profile-img-container">
            <img src="https://i.pravatar.cc/150?u={{ Auth::user()->email }}" class="profile-img" alt="Profile Picture">
            <div class="edit-img-btn">
                <i class="bi bi-pencil-fill"></i>
            </div>
        </div>

        <div>
            <h2 class="fw-bold mb-1 fs-4">{{ Auth::user()->name }}</h2>
            <p class="text-muted mb-2 fs-6">{{ Auth::user()->email }}</p>

            <div class="d-flex gap-2">
                <span class="badge-custom badge-active">
                    <i class="bi bi-check-circle-fill"></i> Member Aktif
                </span>

                <span class="badge-custom badge-target">
                    Target: 
                    {{ match($profile->diet_goal) {
                        'loss' => 'Weight Loss',
                        'maintain' => 'Maintain Weight',
                        'gain' => 'Weight Gain',
                        default => '-'
                    } }}
                </span>
            </div>
        </div>
    </div>

    <form action="#" method="POST">
        @csrf
        <div class="row">
            {{-- LEFT COLUMN: FORMS --}}
            <div class="col-lg-8">
                
                {{-- CARD 1: DATA TUBUH --}}
                <div class="card-custom">
                    <div class="card-title-custom">
                        <i class="bi bi-file-earmark-bar-graph text-primary"></i> Data Tubuh (DSS)
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Umur</label>
                            <input type="number" class="form-control" name="age" value="{{ $profile->age }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="gender">
                                <option value="female" {{ $profile->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
                                <option value="male" {{ $profile->gender == 'male' ? 'selected' : '' }}>Laki-laki</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tinggi Badan (cm)</label>
                            <input type="number" class="form-control" name="height_cm" value="{{ $profile->height_cm }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Berat Badan (kg)</label>
                            <input type="number" class="form-control" name="weight_kg" value="{{ $profile->weight_kg }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Aktivitas Harian</label>
                            <select class="form-select" name="activity_level">
                                <option value="sedentary" {{ $profile->activity_level == 'sedentary' ? 'selected' : '' }}>Sedenter (Sedikit/Tidak ada olahraga)</option>
                                <option value="lightly_active" {{ $profile->activity_level == 'lightly_active' ? 'selected' : '' }}>Ringan (Olahraga 1-3 hari/minggu)</option>
                                <option value="moderately_active" {{ $profile->activity_level == 'moderately_active' ? 'selected' : '' }}>Sedang (Olahraga 3-5 hari/minggu)</option>
                                <option value="very_active" {{ $profile->activity_level == 'very_active' ? 'selected' : '' }}>Sangat Aktif (Olahraga keras 6-7 hari/minggu)</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- CARD 2: TARGET DIET --}}
                <div class="card-custom">
                    <div class="card-title-custom">
                        <i class="bi bi-flag text-warning"></i> Target Diet
                    </div>

                    <div class="target-diet-options">
                        <label>
                            <input type="radio" name="diet_goal" value="loss" class="target-card-input" {{ $profile->diet_goal == 'loss' ? 'checked' : '' }}>
                            <div class="target-card-label">
                                <div class="target-icon"><i class="bi bi-graph-down"></i></div>
                                <div class="target-title">Weight Loss</div>
                                <div class="target-desc">Fokus pada pembakaran lemak dan defisit kalori.</div>
                            </div>
                        </label>

                        <label>
                            <input type="radio" name="diet_goal" value="maintain" class="target-card-input" {{ $profile->diet_goal == 'maintain' ? 'checked' : '' }}>
                            <div class="target-card-label">
                                <div class="target-icon"><i class="bi bi-dash-lg"></i></div>
                                <div class="target-title">Maintain Weight</div>
                                <div class="target-desc">Menjaga komposisi tubuh dengan kalori seimbang.</div>
                            </div>
                        </label>

                        <label>
                            <input type="radio" name="diet_goal" value="gain" class="target-card-input" {{ $profile->diet_goal == 'gain' ? 'checked' : '' }}>
                            <div class="target-card-label">
                                <div class="target-icon"><i class="bi bi-graph-up-arrow"></i></div>
                                <div class="target-title">Weight Gain</div>
                                <div class="target-desc">Membangun massa otot dengan surplus nutrisi.</div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- CARD 3: PREFERENSI MAKANAN --}}
                <div class="card-custom">
                    <div class="card-title-custom">
                        <i class="bi bi-card-checklist text-secondary"></i> Preferensi Makanan
                    </div>
                    
                    <p class="form-label mb-3">Pilih kategori yang sesuai:</p>
                    
                    <div class="pref-tags">
                        {{-- Ini bisa disesuaikan logicnya jika ada relasi database untuk preferensi --}}
                        <div class="pref-tag selected">Vegetarian <i class="bi bi-x"></i></div>
                        <div class="pref-tag">Vegan</div>
                        <div class="pref-tag selected">Alergi Seafood <i class="bi bi-x"></i></div>
                        <div class="pref-tag">Gluten Free</div>
                        <div class="pref-tag selected">Tidak Suka Pedas <i class="bi bi-x"></i></div>
                        <div class="pref-tag">Keto</div>
                    </div>

                    <div class="add-allergy-box">
                        <div>
                            <div class="fw-semibold" style="font-size: 13px;">Ada alergi lain?</div>
                            <div class="text-muted" style="font-size: 12px;">Sebutkan bahan makanan yang ingin Anda hindari dalam rencana makan.</div>
                        </div>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" placeholder="Misal: Kacang, Susu...">
                            <button type="button" class="btn-main px-4">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: METRICS --}}
            <div class="col-lg-4">
                <div class="metrics-container">
                    <div class="metrics-header">CALCULATED METRICS</div>

                    {{-- BMI BOX --}}
                    <div class="metric-box">
                        <div class="metric-title">BMI (Body Mass Index)</div>
                        <div class="metric-value">
                            {{ $profile->bmi }} <span class="metric-unit">kg/m²</span>
                        </div>
                        
                        {{-- Logika persentase posisi indikator BMI (estimasi visual) --}}
                        @php
                            $bmiVal = $profile->bmi;
                            $leftPos = 50; 
                            if($bmiVal < 18.5) $leftPos = 15;
                            elseif($bmiVal >= 18.5 && $bmiVal <= 24.9) $leftPos = 40;
                            elseif($bmiVal >= 25 && $bmiVal <= 29.9) $leftPos = 70;
                            else $leftPos = 90;
                        @endphp

                        <div class="bmi-bar">
                            <div class="bmi-indicator" style="left: {{ $leftPos }}%;"></div>
                        </div>

                        <div class="metric-desc">
                            Kategori: <strong>
                            {{
                                $profile->bmi < 18.5 ? 'Underweight' : 
                                ($profile->bmi < 25 ? 'Normal' : 
                                ($profile->bmi < 30 ? 'Overweight' : 'Obese'))
                            }}
                            </strong>
                        </div>
                    </div>

                    {{-- CALORIES BOX --}}
                    <div class="metric-box">
                        <div class="metric-title">Target Kalori Harian</div>
                        <div class="metric-value">
                            {{ number_format($profile->daily_calorie_target, 0, ',', ',') }} <span class="metric-unit">kcal</span>
                        </div>
                        <div class="metric-desc mt-2">
                            Dihitung berdasarkan BMR dan level aktivitas Anda.
                        </div>
                    </div>

                    <button class="btn btn-main w-100 mt-2" type="submit">Update Data</button>
                </div>
            </div>
            
            {{-- BOTTOM ACTIONS --}}
            <div class="col-12">
                <div class="form-actions">
                    <button type="button" class="btn-outline">Batalkan</button>
                    <button type="submit" class="btn-main">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </form>
</div>

</body>
</html>