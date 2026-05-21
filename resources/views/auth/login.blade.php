<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>DietMate - Selamat Datang Kembali</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary-fixed": "#081f1e",
                        "surface-container-low": "#f3f3f4",
                        "surface-tint": "#006a62",
                        "on-tertiary-fixed-variant": "#4e4800",
                        "on-background": "#1a1c1c",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "primary-container": "#008379",
                        "surface-variant": "#e2e2e2",
                        "tertiary-fixed": "#f3e658",
                        "secondary-fixed-dim": "#b3cbca",
                        "surface": "#f9f9f9",
                        "on-tertiary-container": "#464100",
                        "on-secondary-container": "#526967",
                        "on-tertiary-fixed": "#1f1c00",
                        "on-tertiary": "#ffffff",
                        "inverse-primary": "#6ed8cb",
                        "surface-bright": "#f9f9f9",
                        "primary-fixed-dim": "#6ed8cb",
                        "on-primary-container": "#f4fffc",
                        "primary": "#00685f",
                        "on-primary-fixed": "#00201d",
                        "inverse-surface": "#2f3131",
                        "surface-container": "#eeeeee",
                        "secondary-container": "#cee7e5",
                        "tertiary-fixed-dim": "#d6ca3e",
                        "error-container": "#ffdad6",
                        "tertiary": "#676000",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#e8e8e8",
                        "outline-variant": "#bcc9c6",
                        "on-primary-fixed-variant": "#005049",
                        "background": "#f9f9f9",
                        "tertiary-container": "#baae21",
                        "on-secondary-fixed-variant": "#344b4a",
                        "on-secondary": "#ffffff",
                        "on-surface": "#1a1c1c",
                        "surface-container-highest": "#e2e2e2",
                        "on-error-container": "#93000a",
                        "surface-dim": "#dadada",
                        "secondary": "#4c6361",
                        "primary-fixed": "#8bf5e7",
                        "on-primary": "#ffffff",
                        "on-surface-variant": "#3d4947",
                        "inverse-on-surface": "#f0f1f1",
                        "secondary-fixed": "#cee7e5",
                        "outline": "#6d7a77"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "lg": "40px",
                        "xl": "64px",
                        "xs": "4px",
                        "base": "8px",
                        "md": "24px",
                        "gutter": "24px",
                        "container-max": "1200px",
                        "sm": "12px"
                    },
                    "fontFamily": {
                        "label-md": ["Manrope"],
                        "body-sm": ["Manrope"],
                        "headline-md": ["Manrope"],
                        "label-lg": ["Manrope"],
                        "headline-xl": ["Manrope"],
                        "body-md": ["Manrope"],
                        "body-lg": ["Manrope"],
                        "headline-lg": ["Manrope"]
                    },
                    "fontSize": {
                        "label-md": ["12px", {"lineHeight": "14px", "fontWeight": "500"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "label-lg": ["14px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "headline-xl": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .form-input-shadow {
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="bg-[#f8f9fc] text-on-background min-h-screen flex items-center justify-center font-body-md p-4 md:p-0">
<main class="w-full max-w-[1000px] h-full md:h-[720px] flex flex-col md:flex-row bg-surface-container-lowest rounded-xl overflow-hidden shadow-xl">

    <!-- Left Column: Image Area (Full Height) -->
    <section class="hidden md:flex flex-1 relative overflow-hidden">
        <img src="{{ asset('img/login.jpg') }}" alt="Login Image" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent"></div>
        <div class="relative z-10 p-lg mt-auto mb-lg">
            <h2 class="font-headline-lg text-headline-lg text-white mb-sm">Solusi Diet Berbasis Data.</h2>
            <p class="font-body-md text-body-md text-white/90 leading-relaxed max-w-sm">
                Bergabunglah dengan ribuan pengguna yang telah mencapai target diet mereka melalui panduan terstruktur dan terpercaya.
            </p>
        </div>
    </section>

    <!-- Right Column: Login Form -->
    <section class="flex-1 flex flex-col justify-center px-gutter py-xl md:px-lg bg-[#f9fbff]">
        <div class="w-full max-w-md mx-auto">

            <div class="mb-lg">
                <h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Selamat Datang Kembali</h1>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Silakan masukkan kredensial Anda untuk melanjutkan ke dashboard.
                </p>
            </div>

            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
                <div class="mb-md p-sm bg-error-container rounded-lg">
                    <ul class="list-disc list-inside text-on-error-container font-body-sm text-body-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Tampilkan pesan status (misal: setelah logout) --}}
            @if (session('status'))
                <div class="mb-md p-sm bg-secondary-container rounded-lg">
                    <p class="text-on-secondary-container font-body-sm text-body-sm">{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-md">
                @csrf

                <!-- Email Input -->
                <div class="space-y-xs">
                    <label class="font-label-lg text-label-lg text-on-surface-variant block" for="email">Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant/70">mail</span>
                        <input
                            class="w-full bg-white border border-outline-variant rounded-lg py-sm pl-xl pr-sm text-on-background focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none font-body-md form-input-shadow @error('email') border-error @enderror"
                            id="email"
                            name="email"
                            placeholder="contoh@email.com"
                            required
                            type="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                        >
                    </div>
                    @error('email')
                        <p class="text-error font-body-sm text-body-sm mt-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="space-y-xs">
                    <label class="font-label-lg text-label-lg text-on-surface-variant block" for="password">Password</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant/70">lock</span>
                        <input
                            class="w-full bg-white border border-outline-variant rounded-lg py-sm pl-xl pr-[44px] text-on-background focus:border-primary focus:ring-1 focus:ring-primary transition-all outline-none font-body-md form-input-shadow @error('password') border-error @enderror"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            type="password"
                            autocomplete="current-password"
                        >
                        <button
                            class="absolute right-sm top-1/2 -translate-y-1/2 text-on-surface-variant/70 hover:text-primary transition-colors"
                            type="button"
                            onclick="togglePassword()"
                            id="toggle-password-btn"
                        >
                            <span class="material-symbols-outlined" id="toggle-password-icon">visibility_off</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-error font-body-sm text-body-sm mt-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Options Row -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-xs cursor-pointer group">
                        <input
                            class="w-4 h-4 rounded text-primary border-outline-variant focus:ring-primary"
                            type="checkbox"
                            name="remember"
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <span class="font-body-sm text-body-sm text-on-surface-variant group-hover:text-on-background">Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="font-label-lg text-label-lg text-primary hover:underline" href="{{ route('password.request') }}">
                            Lupa Password
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button
                    class="w-full bg-primary text-on-primary font-label-lg text-label-lg py-sm rounded-lg hover:bg-primary-container transition-all flex items-center justify-center gap-xs shadow-md active:scale-[0.99]"
                    type="submit"
                >
                    Masuk Ke Akun
                    <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-lg">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-outline-variant"></div>
                </div>
                <div class="relative flex justify-center text-label-md">
                    <span class="bg-[#f9fbff] px-sm text-on-surface-variant font-medium">ATAU MASUK DENGAN</span>
                </div>
            </div>

            <!-- Social Logins -->
            <div class="grid grid-cols-2 gap-sm">
                <a
                    href="{{ route('login.google') }}"
                    class="flex items-center justify-center gap-xs border border-outline-variant rounded-lg py-sm font-label-lg text-on-surface hover:bg-surface-container transition-colors bg-white"
                >
                     <img src="{{ asset('img/google.png') }}" alt="Google" class="w-7 h-5" src="https://www.google.com/imgres?q=logo%20google&imgurl=https%3A%2F%2Fs3-alpha.figma.com%2Fhub%2Ffile%2F2729744958%2F2a5758d6-4edb-4047-87bb-e6b94dbbbab0-cover.png&imgrefurl=https%3A%2F%2Fwww.figma.com%2Fcommunity%2Ffile%2F1182911837704380004%2Fgoogle-logo&docid=ktmeawYwZvlteM&tbnid=kWYzBA9u4sZOyM&vet=12ahUKEwjj9dvY7smUAxUmS2cHHRcFFFUQnPAOegQIFxAB..i&w=1920&h=960&hcb=2&ved=2ahUKEwjj9dvY7smUAxUmS2cHHRcFFFUQnPAOegQIFxAB#imgdii=kWYzBA9u4sZOyM">
                    Google
                </a>
                <a
                    href="{{ route('login.apple') }}"
                    class="flex items-center justify-center gap-xs border border-outline-variant rounded-lg py-sm font-label-lg text-on-surface hover:bg-surface-container transition-colors bg-white"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 384 512">
                        <path d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"/>
                    </svg>
                    Apple
                </a>
            </div>

            <!-- Footer -->
            <div class="mt-lg text-center">
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Belum punya akun?
                    <a class="font-label-lg text-label-lg text-primary hover:underline ml-xs" href="{{ route('register') }}">
                        Daftar Sekarang
                    </a>
                </p>
            </div>

        </div>
    </section>
</main>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('toggle-password-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility_off';
        }
    }
</script>
</body>
</html>