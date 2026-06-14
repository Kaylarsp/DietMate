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

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: white;
            border-right: 1px solid #edf2f7;
            position: fixed;
            top: 0;
            left: 0;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 1000;
            transition: transform 0.3s ease;
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

        /* ========== MAIN CONTENT ========== */
        .main-content {
            margin-left: 260px;
            padding: 40px 50px;
            background: linear-gradient(to bottom, #DDF0EC 5%, #E8F4F1 50%, #F8FAFC 100%);
            min-height: 100vh;
        }

        /* ========== PROFILE HEADER ========== */
        .profile-header {
            display: flex;
            align-items: center;
            gap: 25px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .profile-img-container {
            position: relative;
            flex-shrink: 0;
            cursor: pointer;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: opacity 0.2s;
        }

        .profile-img-container:hover .profile-img {
            opacity: 0.85;
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
            box-shadow: 0 2px 6px rgba(11,122,109,0.3);
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

        /* ========== CARDS ========== */
        .card-custom {
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.04);
            margin-bottom: 24px;
            border: 1px solid #f1f5f9;
            transition: box-shadow 0.2s;
        }

        .card-custom:hover {
            box-shadow: 0 4px 24px rgba(11,122,109,0.08);
        }

        .card-title-custom {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #1e293b;
        }

        /* ========== FORM CONTROLS ========== */
        .form-label {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .form-control,
        .form-select {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 15px;
            font-size: 14px;
            color: #334155;
            transition: border-color 0.2s, box-shadow 0.2s;
            background-color: #fafbfc;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(11, 122, 109, 0.12);
            background-color: white;
        }

        /* ========== TARGET DIET CARDS ========== */
        .target-diet-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .target-card-input {
            display: none;
        }

        .target-card-label {
            display: block;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px 15px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #f8fafc;
            height: 100%;
        }

        .target-card-label:hover {
            border-color: #a7d4cf;
            background: #f0faf9;
        }

        .target-card-input:checked + .target-card-label {
            border-color: var(--primary);
            background: var(--primary-light);
            box-shadow: 0 4px 12px rgba(11, 122, 109, 0.15);
        }

        .target-icon {
            font-size: 22px;
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
            line-height: 1.5;
        }

        /* ========== PREF TAGS ========== */
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
            border: 1.5px solid #e2e8f0;
            background: white;
            color: #64748b;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            user-select: none;
        }

        .pref-tag:hover {
            border-color: #a7d4cf;
            color: var(--primary);
        }

        .pref-checkbox {
            display: none;
        }

        .pref-checkbox + .pref-tag .bi-x {
            display: none;
        }

        .pref-checkbox:checked + .pref-tag {
            background: var(--primary-light);
            border-color: var(--primary);
            color: var(--primary);
            font-weight: 500;
        }

        .pref-checkbox:checked + .pref-tag .bi-x {
            display: inline-block;
        }

        /* ========== ALLERGY BOX ========== */
        .add-allergy-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            border: 1px dashed #cbd5e1;
        }

        /* ========== METRICS ========== */
        .metrics-container {
            background: linear-gradient(135deg, #c8e8e3 0%, #ddf0ec 100%);
            border-radius: 20px;
            padding: 25px;
            position: sticky;
            top: 20px;
        }

        .metrics-header {
            font-size: 11px;
            font-weight: 700;
            color: #4a7a74;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 16px;
        }

        .metric-box {
            background: white;
            border-radius: 16px;
            padding: 22px 20px;
            margin-bottom: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            text-align: center;
        }

        .metric-title {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 10px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
            font-size: 13px;
            font-weight: 500;
            color: #94a3b8;
        }

        .bmi-bar {
            height: 7px;
            border-radius: 10px;
            background: linear-gradient(90deg, #3b82f6 0%, #10b981 50%, #f59e0b 80%, #ef4444 100%);
            margin: 14px 0;
            position: relative;
        }

        .bmi-indicator {
            width: 14px;
            height: 14px;
            background: white;
            border: 2.5px solid #1e293b;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            transition: left 0.5s ease;
        }

        .metric-desc {
            font-size: 12px;
            color: #64748b;
        }

        .metric-desc strong {
            color: var(--primary);
        }

        /* ========== BUTTONS ========== */
        .btn-main {
            background: var(--primary);
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(11,122,109,0.25);
        }

        .btn-main:hover {
            background: #08695e;
            color: white;
            box-shadow: 0 6px 16px rgba(11,122,109,0.35);
            transform: translateY(-1px);
        }

        .btn-main:active {
            transform: translateY(0);
        }

        .btn-outline {
            background: transparent;
            border: 1.5px solid #e2e8f0;
            color: #64748b;
            font-weight: 600;
            font-size: 14px;
            padding: 12px 24px;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .btn-outline:hover {
            border-color: #cbd5e1;
            background: #f1f5f9;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
        }

        /* ========== MOBILE TOGGLE (HAMBURGER) ========== */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 16px;
            left: 16px;
            z-index: 1100;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            width: 42px;
            height: 42px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.35);
            z-index: 999;
        }

        /* ========== RESPONSIVE BREAKPOINTS ========== */

        /* Tablet: 768px – 991px */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
                width: 260px;
                box-shadow: 4px 0 20px rgba(0,0,0,0.1);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-overlay.open {
                display: block;
            }

            .sidebar-toggle {
                display: flex;
            }

            .main-content {
                margin-left: 0;
                padding: 70px 24px 40px;
            }

            .metrics-container {
                position: static;
            }

            .target-diet-options {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Mobile: ≤ 767px */
        @media (max-width: 767px) {
            .main-content {
                padding: 70px 16px 40px;
            }

            .profile-header {
                gap: 18px;
                margin-bottom: 28px;
            }

            .profile-img {
                width: 80px;
                height: 80px;
            }

            .profile-header h2 {
                font-size: 18px !important;
            }

            .profile-header .d-flex {
                flex-wrap: wrap;
            }

            .card-custom {
                padding: 20px 16px;
                border-radius: 14px;
            }

            .target-diet-options {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .target-card-label {
                padding: 16px;
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .target-icon {
                font-size: 24px;
                margin-bottom: 0;
                flex-shrink: 0;
            }

            .add-allergy-box {
                flex-direction: column;
                align-items: stretch;
                gap: 14px;
            }

            .metric-value {
                font-size: 30px;
            }

            .form-actions {
                flex-direction: column-reverse;
                gap: 10px;
            }

            .form-actions .btn-main,
            .form-actions .btn-outline {
                width: 100%;
                text-align: center;
            }

            .metrics-container .btn-main {
                padding: 14px;
            }
        }

        /* Small mobile: ≤ 480px */
        @media (max-width: 480px) {
            .pref-tag {
                font-size: 12px;
                padding: 7px 13px;
            }

            .badge-custom {
                font-size: 11px;
                padding: 5px 11px;
            }

            .profile-header {
                flex-direction: row;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

    {{-- Mobile hamburger toggle --}}
    <div class="sidebar-toggle" id="sidebarToggle">
        <i class="bi bi-list fs-5 text-primary"></i>
    </div>

    {{-- Overlay for mobile sidebar --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    @include('layouts.sidebar')

    <div class="main-content">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="profile-header">
                <div class="profile-img-container" onclick="document.getElementById('profile_image_input').click()">

                    <img src="{{ $profile->image_url ? asset($profile->image_url) : 'https://i.pravatar.cc/150?u=' . Auth::user()->email }}"
                        class="profile-img" id="preview_img" alt="Profile Picture">

                    <div class="edit-img-btn"><i class="bi bi-pencil-fill"></i></div>

                    {{-- INPUT FILE TERSEMBUNYI --}}
                    <input type="file" id="profile_image_input" name="image_url" class="d-none" accept="image/*"
                        onchange="previewImage(event)">
                </div>

                <div>
                    <h2 class="fw-bold mb-1 fs-4">{{ Auth::user()->name }}</h2>
                    <p class="text-muted mb-2 fs-6">{{ Auth::user()->email }}</p>
                    <div class="d-flex gap-2">
                        <span class="badge-custom badge-active"><i class="bi bi-check-circle-fill"></i> Member
                            Aktif</span>
                        <span class="badge-custom badge-target">
                            Target:
                            {{ match ($profile->diet_goal ?? '') {
                                'loss' => 'Weight Loss',
                                'maintain' => 'Maintain Weight',
                                'gain' => 'Weight Gain',
                                default => '-',
                            } }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">

                    {{-- DATA TUBUH --}}
                    <div class="card-custom">
                        <div class="card-title-custom"><i class="bi bi-file-earmark-bar-graph text-primary"></i> Data
                            Tubuh
                            (DSS)</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Umur</label>
                                <input type="number" class="form-control" name="age"
                                    value="{{ $profile->age ?? '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="gender" required>
                                    <option value="female" {{ ($profile->gender ?? '') == 'female' ? 'selected' : '' }}>
                                        Perempuan</option>
                                    <option value="male" {{ ($profile->gender ?? '') == 'male' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tinggi Badan (cm)</label>
                                <input type="number" class="form-control" name="height_cm"
                                    value="{{ $profile->height_cm ?? '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Berat Badan (kg)</label>
                                <input type="number" class="form-control" name="weight_kg"
                                    value="{{ $profile->weight_kg ?? '' }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Aktivitas Harian</label>
                                <select class="form-select" name="activity_level" required>
                                    <option value="sedentary"
                                        {{ ($profile->activity_level ?? '') == 'sedentary' ? 'selected' : '' }}>
                                        Sedenter
                                        (Sedikit/Tidak ada olahraga)</option>
                                    <option value="lightly_active"
                                        {{ ($profile->activity_level ?? '') == 'lightly_active' ? 'selected' : '' }}>
                                        Ringan
                                        (Olahraga 1-3 hari/minggu)</option>
                                    <option value="moderately_active"
                                        {{ ($profile->activity_level ?? '') == 'moderately_active' ? 'selected' : '' }}>
                                        Sedang (Olahraga 3-5 hari/minggu)</option>
                                    <option value="very_active"
                                        {{ ($profile->activity_level ?? '') == 'very_active' ? 'selected' : '' }}>
                                        Sangat
                                        Aktif (Olahraga keras 6-7 hari/minggu)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- TARGET DIET --}}
                    <div class="card-custom">
                        <div class="card-title-custom"><i class="bi bi-flag text-warning"></i> Target Diet</div>
                        <div class="target-diet-options">
                            <label>
                                <input type="radio" name="diet_goal" value="loss" class="target-card-input"
                                    {{ ($profile->diet_goal ?? '') == 'loss' ? 'checked' : '' }} required>
                                <div class="target-card-label">
                                    <div class="target-icon"><i class="bi bi-graph-down"></i></div>
                                    <div>
                                        <div class="target-title">Weight Loss</div>
                                        <div class="target-desc">Fokus pada pembakaran lemak dan defisit kalori.</div>
                                    </div>
                                </div>
                            </label>
                            <label>
                                <input type="radio" name="diet_goal" value="maintain" class="target-card-input"
                                    {{ ($profile->diet_goal ?? '') == 'maintain' ? 'checked' : '' }} required>
                                <div class="target-card-label">
                                    <div class="target-icon"><i class="bi bi-dash-lg"></i></div>
                                    <div>
                                        <div class="target-title">Maintain Weight</div>
                                        <div class="target-desc">Menjaga komposisi tubuh dengan kalori seimbang.</div>
                                    </div>
                                </div>
                            </label>
                            <label>
                                <input type="radio" name="diet_goal" value="gain" class="target-card-input"
                                    {{ ($profile->diet_goal ?? '') == 'gain' ? 'checked' : '' }} required>
                                <div class="target-card-label">
                                    <div class="target-icon"><i class="bi bi-graph-up-arrow"></i></div>
                                    <div>
                                        <div class="target-title">Weight Gain</div>
                                        <div class="target-desc">Membangun massa otot dengan surplus nutrisi.</div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- PREFERENSI MAKANAN --}}
                    <div class="card-custom">
                        <div class="card-title-custom"><i class="bi bi-card-checklist text-secondary"></i> Preferensi
                            Makanan</div>
                        <p class="form-label mb-3">Pilih kategori yang sesuai:</p>

                        <div class="pref-tags">
                            @foreach ($defaultPreferences as $pref)
                                <label>
                                    <input type="checkbox" name="preferences[]" value="{{ $pref }}"
                                        class="pref-checkbox" {{ in_array($pref, $userPrefs) ? 'checked' : '' }}>
                                    <div class="pref-tag">
                                        {{ $pref }} <i class="bi bi-x"></i>
                                    </div>
                                </label>
                            @endforeach

                            @foreach ($userPrefs as $savedPref)
                                @if (!in_array($savedPref, $defaultPreferences))
                                    <label>
                                        <input type="checkbox" name="preferences[]" value="{{ $savedPref }}"
                                            class="pref-checkbox" checked>
                                        <div class="pref-tag">
                                            {{ $savedPref }} <i class="bi bi-x"></i>
                                        </div>
                                    </label>
                                @endif
                            @endforeach
                        </div>

                        <div class="add-allergy-box">
                            <div>
                                <div class="fw-semibold" style="font-size: 13px;">Ada alergi lain?</div>
                                <div class="text-muted" style="font-size: 12px;">Sebutkan bahan makanan yang dihindari
                                    (Pisahkan dengan koma).</div>
                            </div>
                            <div class="d-flex gap-2">
                                <input type="text" name="new_allergy" class="form-control"
                                    placeholder="Misal: Kacang, Susu...">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- METRICS --}}
                <div class="col-lg-4">
                    <div class="metrics-container">
                        <div class="metrics-header">CALCULATED METRICS</div>

                        <div class="metric-box">
                            <div class="metric-title">BMI (Body Mass Index)</div>
                            <div class="metric-value">
                                {{ $profile->bmi ?? '0' }} <span class="metric-unit">kg/m²</span>
                            </div>

                            @php
                                $bmiVal = $profile->bmi ?? 0;
                                $leftPos = 50;
                                if ($bmiVal > 0) {
                                    if ($bmiVal < 18.5) {
                                        $leftPos = 15;
                                    } elseif ($bmiVal >= 18.5 && $bmiVal <= 24.9) {
                                        $leftPos = 40;
                                    } elseif ($bmiVal >= 25 && $bmiVal <= 29.9) {
                                        $leftPos = 70;
                                    } else {
                                        $leftPos = 90;
                                    }
                                }
                            @endphp

                            <div class="bmi-bar">
                                <div class="bmi-indicator" style="left: {{ $leftPos }}%;"></div>
                            </div>
                            <div class="metric-desc">
                                Kategori: <strong>
                                    {{ $bmiVal == 0
                                        ? '-'
                                        : ($bmiVal < 18.5
                                            ? 'Underweight'
                                            : ($bmiVal < 25
                                                ? 'Normal'
                                                : ($bmiVal < 30
                                                    ? 'Overweight'
                                                    : 'Obese'))) }}
                                </strong>
                            </div>
                        </div>

                        <div class="metric-box">
                            <div class="metric-title">Target Kalori Harian</div>
                            <div class="metric-value">
                                {{ number_format($profile->daily_calorie_target ?? 0, 0, ',', ',') }} <span
                                    class="metric-unit">kcal</span>
                            </div>
                            <div class="metric-desc mt-2">
                                Dihitung berdasarkan BMR dan level aktivitas Anda.
                            </div>
                        </div>

                        <button class="btn btn-main w-100 mt-2" type="submit">Update Data</button>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-actions">
                        <button type="reset" class="btn-outline">Batalkan</button>
                        <button type="submit" class="btn-main">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview_img');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        // Mobile sidebar toggle
        const toggle = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('sidebarOverlay');
        const sidebar = document.querySelector('.sidebar');

        if (toggle && sidebar) {
            toggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('open');
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
            });
        }
    </script>
</body>

</html>