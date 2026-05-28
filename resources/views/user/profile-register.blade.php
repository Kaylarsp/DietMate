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
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f4f7f6;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: white;
            border-right: 1px solid #ddd;
            position: fixed;
            padding: 30px 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
        }

        .menu-item {
            padding: 12px 15px;
            border-radius: 12px;
            color: #5c5c5c;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .menu-active {
            background: #dcefed;
            color: #0b7a6d;
        }

        .main-content {
            margin-left: 270px;
            padding: 40px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .profile-img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .card-custom {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .metric-card {
            background: #dcefed;
            border-radius: 20px;
            padding: 25px;
            height: 100%;
        }

        .metric-box {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .metric-number {
            font-size: 40px;
            font-weight: 700;
            color: #0b7a6d;
        }

        .btn-main {
            background: #0b7a6d;
            border: none;
            color: white;
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 600;
        }

        .btn-main:hover {
            background: #08695e;
        }

        @media (max-width: 992px) {

            .sidebar {
                width: 100%;
                min-height: auto;
                position: relative;
                border-right: none;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .profile-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 576px) {

            .metric-number {
                font-size: 28px;
            }

            .card-custom {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    {{-- @include('layouts.sidebar') --}}

    <div class="main-content">

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <div class="profile-header">

            <img src="https://i.pravatar.cc/150?img=32"
                 class="profile-img">

            <div>

                <h2 class="fw-bold mb-1">
                    Buat Akun Diet Kamu
                </h2>

                <p class="text-muted mb-2">
                    Lengkapi data diri dan profil tubuhmu.
                </p>

            </div>

        </div>

        <form action="{{ route('profile-register') }}"
              method="POST">

            @csrf

            <div class="row">

                <div class="col-lg-8">

                    {{-- ACCOUNT --}}
                    <div class="card-custom">

                        <h4 class="fw-bold mb-4">
                            Data Akun
                        </h4>

                        <div class="row">

                            <div class="col-md-12 mb-3">

                                <label class="form-label">
                                    Nama Lengkap
                                </label>

                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="{{ old('name') }}">

                            </div>

                            <div class="col-md-12 mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       value="{{ old('email') }}">

                            </div>

                            <div class="col-md-12 mb-3">

                                <label class="form-label">
                                    Password
                                </label>

                                <input type="password"
                                       name="password"
                                       class="form-control">

                            </div>

                        </div>

                    </div>

                    {{-- BODY DATA --}}
                    <div class="card-custom">

                        <h4 class="fw-bold mb-4">
                            Data Tubuh
                        </h4>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Umur
                                </label>

                                <input type="number"
                                       name="age"
                                       class="form-control"
                                       value="{{ old('age') }}">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Jenis Kelamin
                                </label>

                                <select class="form-select"
                                        name="gender">

                                    <option value="">
                                        Pilih Gender
                                    </option>

                                    <option value="male">
                                        Laki-laki
                                    </option>

                                    <option value="female">
                                        Perempuan
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Tinggi Badan (cm)
                                </label>

                                <input type="number"
                                       step="0.1"
                                       name="height_cm"
                                       class="form-control"
                                       value="{{ old('height_cm') }}">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Berat Badan (kg)
                                </label>

                                <input type="number"
                                       step="0.1"
                                       name="weight_kg"
                                       class="form-control"
                                       value="{{ old('weight_kg') }}">

                            </div>

                            <div class="col-12 mb-3">

                                <label class="form-label">
                                    Aktivitas Harian
                                </label>

                                <select class="form-select"
                                        name="activity_level">

                                    <option value="">
                                        Pilih Aktivitas
                                    </option>

                                    <option value="sedentary">
                                        Sedentary
                                    </option>

                                    <option value="lightly_active">
                                        Lightly Active
                                    </option>

                                    <option value="moderately_active">
                                        Moderately Active
                                    </option>

                                    <option value="very_active">
                                        Very Active
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="metric-card">

                        <h6 class="text-uppercase text-muted fw-bold mb-4">
                            Target Diet
                        </h6>

                        <div class="mb-3">

                            <label class="form-label">
                                Diet Goal
                            </label>

                            <select class="form-select"
                                    name="diet_goal">

                                <option value="">
                                    Pilih Target
                                </option>

                                <option value="loss">
                                    Weight Loss
                                </option>

                                <option value="maintain">
                                    Maintain Weight
                                </option>

                                <option value="gain">
                                    Weight Gain
                                </option>

                            </select>

                        </div>

                        <div class="metric-box">

                            <small class="text-muted">
                                BMI Estimate
                            </small>

                            <div class="metric-number">
                                Auto
                            </div>

                        </div>

                        <div class="metric-box">

                            <small class="text-muted">
                                Daily Calories
                            </small>

                            <div class="metric-number">
                                Auto
                            </div>

                        </div>

                        <button type="submit"
                                class="btn btn-main w-100">

                            Buat Akun Sekarang

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</body>

</html>