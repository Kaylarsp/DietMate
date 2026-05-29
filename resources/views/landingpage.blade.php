<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>DietMate - Sistem Rekomendasi Diet</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --primary: #009688;
    --primary-dark: #00796b;
    --primary-light: #b2dfdb;
    --primary-bg: #e0f2f1;
    --accent: #26a69a;
    --surface: #ffffff;
    --surface-low: #f4fafa;
    --surface-mid: #edf7f6;
    --on-surface: #1a2b2a;
    --on-surface-muted: #4e6665;
    --outline: #cce5e3;
    --outline-faint: #e4f2f0;
    --teal-gradient: linear-gradient(135deg, #009688 0%, #00796b 100%);
    --shadow-card: 0 4px 24px rgba(0,150,136,0.10);
    --shadow-strong: 0 8px 40px rgba(0,150,136,0.18);
    --radius-card: 16px;
    --radius-pill: 999px;
  }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--surface);
    color: var(--on-surface);
    -webkit-font-smoothing: antialiased;
  }

  .material-symbols-outlined {
    font-family: 'Material Symbols Outlined';
    font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    font-size: 22px;
    display: inline-flex;
    align-items: center;
  }

  /* ── NAV ── */
  nav {
    position: sticky; top: 0; z-index: 100;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--outline);
    box-shadow: 0 2px 12px rgba(0,150,136,0.08);
  }
  .nav-inner {
    max-width: 1200px; margin: 0 auto;
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 40px; height: 68px;
  }
  .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
  .nav-brand-name { font-size: 20px; font-weight: 800; color: var(--primary); }
  .nav-links { display: flex; gap: 36px; }
  .nav-links a {
    text-decoration: none; font-size: 14px; font-weight: 600;
    color: var(--on-surface-muted); transition: color .2s;
    padding-bottom: 2px;
    cursor: pointer;
  }
  .nav-links a.active, .nav-links a:hover { color: var(--primary); }
  .nav-links a.active { border-bottom: 2px solid var(--primary); }
  .nav-actions { display: flex; align-items: center; gap: 10px; }
  .btn-ghost {
    background: none; border: none; cursor: pointer;
    font-family: inherit; font-size: 14px; font-weight: 600;
    color: var(--on-surface-muted); padding: 8px 16px;
    border-radius: var(--radius-pill); transition: color .2s, background .2s;
  }
  .btn-ghost:hover { color: var(--primary); background: var(--primary-bg); }
  .btn-primary {
    background: var(--teal-gradient); color: #fff;
    border: none; cursor: pointer;
    font-family: inherit; font-size: 14px; font-weight: 700;
    padding: 10px 22px; border-radius: var(--radius-pill);
    box-shadow: 0 2px 12px rgba(0,150,136,0.3);
    transition: opacity .2s, transform .15s;
    text-decoration: none;
  }
  .btn-primary:hover { opacity: 0.9; transform: translateY(-1px); }

  /* ── HERO ── */
  .hero {
    position: relative; min-height: 520px;
    display: flex; align-items: center; overflow: hidden;
  }
  .hero-bg { position: absolute; inset: 0; }
  .hero-bg img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .hero-bg-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(90deg, rgba(0,80,72,0.82) 0%, rgba(0,120,110,0.55) 60%, rgba(0,0,0,0.1) 100%);
  }
  .hero-content {
    position: relative; z-index: 2;
    max-width: 1200px; margin: 0 auto;
    padding: 80px 40px; width: 100%;
  }
  .hero-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.18); backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.3);
    color: #fff; border-radius: var(--radius-pill);
    padding: 6px 14px; font-size: 12px; font-weight: 600;
    letter-spacing: 0.04em; margin-bottom: 20px;
  }
  .hero-title {
    font-size: clamp(28px, 4vw, 46px); font-weight: 800; color: #fff;
    line-height: 1.15; max-width: 560px; margin-bottom: 18px;
  }
  .hero-desc {
    color: rgba(255,255,255,0.82); font-size: 16px;
    line-height: 1.7; max-width: 480px; margin-bottom: 32px;
  }
  .hero-cta { display: flex; gap: 14px; flex-wrap: wrap; }
  .btn-hero-primary {
    background: #fff; color: var(--primary-dark);
    border: none; cursor: pointer;
    font-family: inherit; font-size: 15px; font-weight: 700;
    padding: 13px 28px; border-radius: var(--radius-pill);
    display: inline-flex; align-items: center; gap: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    transition: transform .15s, box-shadow .15s;
    text-decoration: none;
  }
  .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 28px rgba(0,0,0,0.2); }
  .btn-hero-outline {
    background: rgba(255,255,255,0.15); backdrop-filter: blur(8px);
    color: #fff; border: 1.5px solid rgba(255,255,255,0.5);
    cursor: pointer; font-family: inherit; font-size: 15px; font-weight: 600;
    padding: 13px 28px; border-radius: var(--radius-pill); transition: background .2s;
  }
  .btn-hero-outline:hover { background: rgba(255,255,255,0.25); }

  /* ── SHARED SECTION ── */
  section { padding: 64px 40px; }
  .section-inner { max-width: 1200px; margin: 0 auto; }
  .section-tag {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--primary-bg); color: var(--primary);
    border-radius: var(--radius-pill); padding: 6px 14px;
    font-size: 12px; font-weight: 700; letter-spacing: 0.05em; margin-bottom: 12px;
  }
  .section-title {
    font-size: clamp(24px, 3vw, 34px); font-weight: 800;
    color: var(--on-surface); margin-bottom: 12px;
  }
  .section-subtitle {
    font-size: 16px; color: var(--on-surface-muted);
    line-height: 1.7; max-width: 560px;
  }

  /* ── WHY SECTION (top) ── */
  .why-section { background: #fff; padding: 60px 40px 48px; }
  .why-list { display: flex; flex-direction: column; gap: 12px; margin-top: 4px; }
  .why-item {
    display: flex; align-items: flex-start; gap: 14px;
    background: var(--surface-low); border: 1px solid var(--outline);
    border-radius: var(--radius-card); padding: 16px; transition: box-shadow .2s, transform .2s;
  }
  .why-item:hover { box-shadow: var(--shadow-card); transform: translateX(4px); }
  .why-icon {
    width: 40px; height: 40px; border-radius: 50%;
    background: var(--primary-bg); color: var(--primary);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    transition: background .2s, color .2s;
  }
  .why-item:hover .why-icon { background: var(--primary); color: #fff; }
  .why-item-title { font-size: 14px; font-weight: 700; color: var(--on-surface); margin-bottom: 2px; }
  .why-item-desc { font-size: 13px; color: var(--on-surface-muted); line-height: 1.5; }

  /* ── DIET TYPES SECTION ── */
  .diet-section {
    background: linear-gradient(160deg, #eef8f6 0%, #f4fbf9 40%, #edf8f5 100%);
    padding: 56px 40px 64px;
  }

  /* Filter tabs */
  .diet-filter {
    display: flex; gap: 8px; flex-wrap: wrap;
    margin-bottom: 32px; margin-top: 28px;
  }
  .filter-btn {
    background: #fff; border: 1.5px solid var(--outline);
    color: var(--on-surface-muted); font-family: inherit;
    font-size: 13px; font-weight: 600; padding: 7px 16px;
    border-radius: var(--radius-pill); cursor: pointer;
    transition: all .2s;
  }
  .filter-btn:hover, .filter-btn.active {
    background: var(--primary); border-color: var(--primary);
    color: #fff; box-shadow: 0 2px 10px rgba(0,150,136,0.25);
  }

  /* Diet grid */
  .diet-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
  }

  .diet-card {
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.9);
    border-radius: var(--radius-card);
    padding: 22px 20px;
    box-shadow: var(--shadow-card);
    display: flex; flex-direction: column; gap: 10px;
    transition: transform .22s ease, box-shadow .22s ease;
    position: relative; overflow: hidden;
  }
  .diet-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0; height: 3px;
    background: var(--teal-gradient);
    border-radius: var(--radius-card) var(--radius-card) 0 0;
  }
  .diet-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 32px rgba(0,150,136,0.14);
  }

  .diet-card-header {
    display: flex; align-items: flex-start; justify-content: space-between; gap: 10px;
  }
  .diet-card-name {
    font-size: 15px; font-weight: 800; color: var(--on-surface);
    line-height: 1.3; flex: 1;
  }
  .diet-badge {
    display: inline-flex; align-items: center;
    background: var(--primary-bg); color: var(--primary-dark);
    border-radius: var(--radius-pill); padding: 3px 10px;
    font-size: 10.5px; font-weight: 700; letter-spacing: 0.04em;
    white-space: nowrap; flex-shrink: 0;
  }

  .diet-card-desc {
    font-size: 12.5px; color: var(--on-surface-muted);
    line-height: 1.6;
  }

  .diet-card-advantages {
    margin-top: 4px; padding-top: 10px;
    border-top: 1px solid var(--outline-faint);
  }
  .diet-advantages-label {
    font-size: 11px; font-weight: 700; color: var(--primary);
    letter-spacing: 0.05em; margin-bottom: 6px; display: flex; align-items: center; gap: 4px;
  }
  .diet-advantages-label .material-symbols-outlined { font-size: 13px; }
  .diet-advantage-item {
    display: flex; align-items: flex-start; gap: 7px;
    font-size: 12px; color: var(--on-surface-muted);
    line-height: 1.5; margin-bottom: 4px;
  }
  .diet-advantage-dot {
    width: 5px; height: 5px; border-radius: 50%;
    background: var(--primary); flex-shrink: 0; margin-top: 6px;
  }

  /* Hidden cards for filter */
  .diet-card[data-hidden="true"] { display: none; }

  /* Show more */
  .diet-show-more {
    text-align: center; margin-top: 24px;
  }
  .btn-show-more {
    background: #fff; border: 1.5px solid var(--outline);
    color: var(--primary-dark); font-family: inherit;
    font-size: 14px; font-weight: 700; padding: 11px 28px;
    border-radius: var(--radius-pill); cursor: pointer;
    display: inline-flex; align-items: center; gap: 8px;
    transition: all .2s; box-shadow: var(--shadow-card);
  }
  .btn-show-more:hover {
    background: var(--primary); color: #fff;
    border-color: var(--primary); box-shadow: 0 4px 16px rgba(0,150,136,0.25);
  }

  /* ── FEATURES BENTO ── */
  .features-section { background: #fff; padding: 56px 40px 60px; }
  .features-header { margin-bottom: 32px; }
  .bento-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    grid-template-rows: auto auto; gap: 18px;
  }
  .bento-card {
    background: var(--surface-low); border-radius: var(--radius-card);
    box-shadow: var(--shadow-card); border: 1px solid var(--outline-faint);
    overflow: hidden; transition: transform .22s ease, box-shadow .22s ease;
  }
  .bento-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-strong); }

  .bento-menu {
    grid-column: span 2; grid-row: span 2;
    position: relative; min-height: 480px; display: flex; flex-direction: column;
  }
  .bento-menu-content { padding: 28px 28px 16px; flex: 0 0 auto; }
  .bento-menu-tag {
    display: inline-block; background: rgba(0,150,136,0.10);
    color: var(--primary-dark); border-radius: var(--radius-pill);
    border: 1px solid rgba(0,150,136,0.18);
    padding: 4px 12px; font-size: 11px; font-weight: 700;
    letter-spacing: 0.05em; margin-bottom: 12px;
  }
  .bento-menu-title { font-size: 22px; font-weight: 800; color: var(--on-surface); margin-bottom: 10px; }
  .bento-menu-desc { font-size: 13.5px; color: var(--on-surface-muted); line-height: 1.6; max-width: 260px; }
  .bento-menu-img {
    width: 100%; flex: 1; object-fit: cover; display: block;
    border-radius: 0 0 calc(var(--radius-card) - 1px) calc(var(--radius-card) - 1px);
    min-height: 200px; transition: transform .5s ease;
  }
  .bento-menu:hover .bento-menu-img { transform: scale(1.03); }

  .bento-bmi {
    grid-column: span 2;
    background: var(--teal-gradient) !important;
    color: #fff; padding: 26px;
    display: flex; flex-direction: column; justify-content: space-between;
    min-height: 220px; border: none !important; position: relative; overflow: hidden;
  }
  .bento-bmi::before {
    content: ''; position: absolute; top: -40px; right: -40px;
    width: 160px; height: 160px; border-radius: 50%;
    background: rgba(255,255,255,0.07); pointer-events: none;
  }
  .bento-bmi-icon {
    width: 46px; height: 46px; border-radius: 12px;
    background: rgba(255,255,255,0.18);
    display: flex; align-items: center; justify-content: center; margin-bottom: 12px;
  }
  .bento-bmi-icon .material-symbols-outlined { font-size: 22px; color: #fff; }
  .bento-bmi-title { font-size: 19px; font-weight: 800; margin-bottom: 7px; }
  .bento-bmi-desc { font-size: 13px; opacity: 0.83; line-height: 1.55; margin-bottom: 18px; }
  .bento-bmi-bar-label {
    display: flex; justify-content: space-between;
    font-size: 11px; font-weight: 700; opacity: 0.72; margin-bottom: 7px;
  }
  .bento-bmi-bar { height: 6px; background: rgba(255,255,255,0.22); border-radius: 99px; overflow: hidden; }
  .bento-bmi-bar-fill {
    height: 100%; width: 65%;
    background: linear-gradient(90deg, rgba(255,255,255,0.65), rgba(255,255,255,0.95));
    border-radius: 99px;
  }

  .bento-exercise {
    grid-column: span 2; padding: 26px;
    display: flex; align-items: flex-start; gap: 15px;
    min-height: 200px; border-top: 3px solid var(--primary-light) !important;
    background: linear-gradient(135deg, #f8fdfc 0%, #eef8f6 100%) !important;
  }
  .bento-exercise-icon {
    width: 46px; height: 46px; border-radius: 13px;
    background: var(--primary-bg); color: var(--primary);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    transition: background .2s, color .2s;
  }
  .bento-exercise:hover .bento-exercise-icon { background: var(--primary); color: #fff; }
  .bento-exercise-title { font-size: 17px; font-weight: 700; color: var(--on-surface); margin-bottom: 8px; }
  .bento-exercise-desc { font-size: 13px; color: var(--on-surface-muted); line-height: 1.65; }

  /* ── WHY BOTTOM ── */
  .why-bottom-section {
    background: linear-gradient(160deg, #eef8f6 0%, #f4fbf9 50%, #eaf6f4 100%);
    padding: 60px 40px 64px;
  }
  .why-bottom-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 56px; align-items: center; }
  .why-bottom-img { border-radius: 20px; overflow: hidden; box-shadow: var(--shadow-strong); height: 410px; }
  .why-bottom-img img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .6s ease; }
  .why-bottom-img:hover img { transform: scale(1.04); }
  .why-text { display: flex; flex-direction: column; gap: 10px; }

  /* ── FOOTER ── */
  footer {
    background: linear-gradient(135deg, #0d2320 0%, #0a1e1c 100%);
    color: rgba(255,255,255,0.72); padding: 36px 40px; position: relative;
  }
  footer::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
    background: linear-gradient(90deg, transparent, rgba(0,150,136,0.5), transparent);
  }
  .footer-inner {
    max-width: 1200px; margin: 0 auto;
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: 18px;
  }
  .footer-brand { font-size: 19px; font-weight: 800; color: var(--primary-light); }
  .footer-links { display: flex; gap: 24px; flex-wrap: wrap; }
  .footer-links a { text-decoration: none; font-size: 13px; color: rgba(255,255,255,0.52); transition: color .2s; }
  .footer-links a:hover { color: var(--primary-light); }
  .footer-copy { font-size: 12px; color: rgba(255,255,255,0.35); }

  /* ── RESPONSIVE ── */
  @media (max-width: 960px) {
    section, .why-section, .diet-section, .features-section, .why-bottom-section { padding: 48px 20px; }
    .nav-links, .nav-actions .btn-ghost { display: none; }
    .nav-inner { padding: 0 20px; }
    .hero-content { padding: 60px 20px; }
    .diet-grid { grid-template-columns: 1fr 1fr; }
    .why-bottom-grid { grid-template-columns: 1fr; gap: 28px; }
    .bento-grid { grid-template-columns: 1fr 1fr; }
    .bento-menu { grid-column: span 2; grid-row: span 1; min-height: 360px; }
    .bento-bmi, .bento-exercise { grid-column: span 2; }
    .footer-inner { flex-direction: column; text-align: center; }
  }
  @media (max-width: 600px) {
    .diet-grid { grid-template-columns: 1fr; }
    .diet-filter { gap: 6px; }
    .hero-cta { flex-direction: column; }
    .btn-hero-primary, .btn-hero-outline { width: 100%; justify-content: center; }
    .bento-grid { grid-template-columns: 1fr; }
    .bento-menu, .bento-bmi, .bento-exercise { grid-column: span 1; }
  }
</style>
</head>
<body>

<!-- NAV -->
<nav>
  <div class="nav-inner">
    <a class="nav-brand" href="#home">
      <img src="{{ asset('img/logo.png') }}" alt="DietMate" style="height:34px; width:auto;">
      <span class="nav-brand-name">DietMate</span>
    </a>
    <div class="nav-links">
      <a href="#home" class="active">Beranda</a>
      <a href="#diet">Program Diet</a>
      <a href="#dashboard" id="dashboardLink">Dashboard</a>
      <a href="#menu">Rekomendasi</a>
    </div>
    <div class="nav-actions">
      {{-- <button href="{{ route('login') }}" class="btn-ghost">Masuk</button> --}}
      <a href="login" class="btn-primary">Masuk</a>
    </div>
  </div>
</nav>

<!-- HERO (Beranda) -->
<section id="home" class="hero" style="padding:0;">
  <div class="hero-bg">
    <img src="{{ asset('img/bg.png') }}" alt="bg">
    <div class="hero-bg-overlay"></div>
  </div>
  <div class="hero-content">
    <div class="hero-badge">
      <span class="material-symbols-outlined" style="font-size:14px;">eco</span>
      Sistem Rekomendasi Diet
    </div>
    <h1 class="hero-title">Temukan program diet yang cocok untuk tubuh dan tujuanmu</h1>
    <p class="hero-desc">Raih target diet Anda dengan rekomendasi menu harian yang dipersonalisasi. Sistem kami menggunakan algoritma cerdas berdasarkan kebutuhan kalori, BMI, dan preferensi makanan Anda.</p>
    <div class="hero-cta">
      <a href="{{ route('profile-register') }}" class="btn-hero-primary">
        Mulai Diet Sekarang
       <span class="material-symbols-outlined" style="font-size:18px;font-variation-settings:'FILL' 0;">arrow_forward</span>
      </a>
      <button class="btn-hero-outline">Lihat Fitur</button>
    </div> 
  </div>
</section>

<!-- WHY CHOOSE US (top) -->
<section class="why-section">
  <div class="section-inner">
    <div style="text-align:center; margin-bottom:24px;">
      <div class="section-tag"><span class="material-symbols-outlined" style="font-size:14px;">star</span> Keunggulan Kami</div>
      <h2 class="section-title" style="margin:0 auto 12px;">Mengapa Memilih DietMate?</h2>
      <p class="section-subtitle" style="margin:0 auto; text-align:center;">DietMate membantu pengguna menentukan program diet berdasarkan goal, BMI, kebutuhan kalori, serta memberikan saran makanan dan workout yang relevan.</p>
    </div>
  </div>
</section>

<!-- DIET TYPES (Fitur) -->
<section id="diet" class="diet-section">
  <div class="section-inner">
    <div style="text-align:center;">
      <div class="section-tag"><span class="material-symbols-outlined" style="font-size:14px;">menu_book</span> Program Diet</div>
      <h2 class="section-title" style="margin:0 auto 10px;">Rekomendasi Program Diet</h2>
      <p class="section-subtitle" style="margin:0 auto; text-align:center;">Temukan program diet yang paling sesuai dengan tujuan dan kondisi tubuh Anda. Setiap program dirancang untuk kebutuhan yang berbeda.</p>
    </div>

    <!-- Filter Tabs -->
    <div class="diet-filter">
      <button class="filter-btn active" data-filter="all">Semua</button>
      <button class="filter-btn" data-filter="turun">Turun Berat Badan</button>
      <button class="filter-btn" data-filter="naik">Naik Berat Badan</button>
      <button class="filter-btn" data-filter="sehat">Gaya Hidup Sehat</button>
    </div>

    <div class="diet-grid" id="dietGrid">
      <!-- 1. Keto -->
      <div class="diet-card" data-category="turun">
        <div class="diet-card-header">
          <div class="diet-card-name">Keto Diet</div>
          <span class="diet-badge">Turun BB</span>
        </div>
        <div class="diet-card-desc">Diet tinggi lemak, rendah karbohidrat untuk memicu ketosis — kondisi di mana tubuh membakar lemak sebagai bahan bakar utama.</div>
        <div class="diet-card-advantages">
          <div class="diet-advantages-label"><span class="material-symbols-outlined">check_circle</span> Keunggulan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Turun berat badan cepat</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Stabilkan gula darah</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Kurangi nafsu makan</div>
        </div>
      </div>

      <!-- 2. DASH -->
      <div class="diet-card" data-category="sehat">
        <div class="diet-card-header">
          <div class="diet-card-name">DASH Diet</div>
          <span class="diet-badge">Jantung Sehat</span>
        </div>
        <div class="diet-card-desc">Dietary Approaches to Stop Hypertension — pola makan rendah sodium yang dirancang untuk menurunkan tekanan darah tinggi.</div>
        <div class="diet-card-advantages">
          <div class="diet-advantages-label"><span class="material-symbols-outlined">check_circle</span> Keunggulan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Turunkan tekanan darah</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Turunkan berat badan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Jantung lebih sehat</div>
        </div>
      </div>

      <!-- 3. IF 16:8 -->
      <div class="diet-card" data-category="turun">
        <div class="diet-card-header">
          <div class="diet-card-name">Intermittent Fasting 16:8</div>
          <span class="diet-badge">Turun BB</span>
        </div>
        <div class="diet-card-desc">Puasa selama 16 jam dan makan hanya dalam jendela 8 jam. Tidak membatasi jenis makanan, hanya waktu makannya.</div>
        <div class="diet-card-advantages">
          <div class="diet-advantages-label"><span class="material-symbols-outlined">check_circle</span> Keunggulan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Kurangi asupan kalori</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Tingkatkan metabolisme</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Turun berat badan</div>
        </div>
      </div>

      <!-- 4. Low Carb -->
      <div class="diet-card" data-category="turun">
        <div class="diet-card-header">
          <div class="diet-card-name">Low Carb Diet</div>
          <span class="diet-badge">Turun BB</span>
        </div>
        <div class="diet-card-desc">Membatasi asupan karbohidrat di bawah 100g per hari untuk mendorong tubuh membakar lebih banyak lemak.</div>
        <div class="diet-card-advantages">
          <div class="diet-advantages-label"><span class="material-symbols-outlined">check_circle</span> Keunggulan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Turun berat badan stabil</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Kendalikan insulin</div>
        </div>
      </div>

      <!-- 5. Mediterranean -->
      <div class="diet-card" data-category="sehat">
        <div class="diet-card-header">
          <div class="diet-card-name">Mediterranean Diet</div>
          <span class="diet-badge">Gaya Hidup Sehat</span>
        </div>
        <div class="diet-card-desc">Pola makan ala Mediterania yang kaya buah, sayur, biji-bijian, dan minyak zaitun. Diakui sebagai salah satu pola makan terbaik di dunia.</div>
        <div class="diet-card-advantages">
          <div class="diet-advantages-label"><span class="material-symbols-outlined">check_circle</span> Keunggulan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Jantung sehat</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Stabilkan berat badan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Umur panjang</div>
        </div>
      </div>

      <!-- 6. Balanced 40/30/30 -->
      <div class="diet-card" data-category="sehat">
        <div class="diet-card-header">
          <div class="diet-card-name">Balanced Diet 40/30/30</div>
          <span class="diet-badge">Seimbang</span>
        </div>
        <div class="diet-card-desc">Komposisi makronutrisi 40% karbohidrat, 30% protein, dan 30% lemak untuk keseimbangan energi optimal sepanjang hari.</div>
        <div class="diet-card-advantages">
          <div class="diet-advantages-label"><span class="material-symbols-outlined">check_circle</span> Keunggulan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Energi seimbang</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Pertahankan massa otot</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Berat badan stabil</div>
        </div>
      </div>

      <!-- 7. MIND -->
      <div class="diet-card" data-category="sehat" data-hidden="true">
        <div class="diet-card-header">
          <div class="diet-card-name">MIND Diet</div>
          <span class="diet-badge">Kesehatan Otak</span>
        </div>
        <div class="diet-card-desc">Mediterranean-DASH Intervention for Neurodegenerative Delay — kombinasi DASH dan Mediterranean yang berfokus pada kesehatan otak.</div>
        <div class="diet-card-advantages">
          <div class="diet-advantages-label"><span class="material-symbols-outlined">check_circle</span> Keunggulan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Jaga kesehatan otak</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Cegah Alzheimer</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Pertahankan berat badan</div>
        </div>
      </div>

      <!-- 8. Flexitarian -->
      <div class="diet-card" data-category="sehat" data-hidden="true">
        <div class="diet-card-header">
          <div class="diet-card-name">Flexitarian Diet</div>
          <span class="diet-badge">Fleksibel</span>
        </div>
        <div class="diet-card-desc">Vegetarian yang fleksibel — mayoritas makan nabati, dengan sesekali mengonsumsi daging. Pilihan terbaik untuk transisi hidup sehat.</div>
        <div class="diet-card-advantages">
          <div class="diet-advantages-label"><span class="material-symbols-outlined">check_circle</span> Keunggulan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Sehat & ramah lingkungan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Berat badan stabil</div>
        </div>
      </div>

      <!-- 9. High Protein -->
      <div class="diet-card" data-category="naik" data-hidden="true">
        <div class="diet-card-header">
          <div class="diet-card-name">High Protein Diet</div>
          <span class="diet-badge">Naik BB</span>
        </div>
        <div class="diet-card-desc">Asupan protein tinggi lebih dari 1.6g per kilogram berat badan per hari untuk memaksimalkan pertumbuhan otot dan performa.</div>
        <div class="diet-card-advantages">
          <div class="diet-advantages-label"><span class="material-symbols-outlined">check_circle</span> Keunggulan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Bangun otot</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Naikkan berat badan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Tingkatkan performa olahraga</div>
        </div>
      </div>

      <!-- 10. GOMAD -->
      <div class="diet-card" data-category="naik" data-hidden="true">
        <div class="diet-card-header">
          <div class="diet-card-name">GOMAD Diet</div>
          <span class="diet-badge">Naik BB</span>
        </div>
        <div class="diet-card-desc">Tambahan 1 galon susu (sekitar 3.8L) per hari sebagai suplemen surplus kalori untuk menaikkan berat badan secara agresif.</div>
        <div class="diet-card-advantages">
          <div class="diet-advantages-label"><span class="material-symbols-outlined">check_circle</span> Keunggulan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Naikkan berat badan cepat</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Tingkatkan kalsium</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Bangun otot</div>
        </div>
      </div>

      <!-- 11. Dirty Bulk -->
      <div class="diet-card" data-category="naik" data-hidden="true">
        <div class="diet-card-header">
          <div class="diet-card-name">Dirty Bulk</div>
          <span class="diet-badge">Naik BB</span>
        </div>
        <div class="diet-card-desc">Surplus kalori besar tanpa membatasi jenis makanan — fokus utama adalah menambah massa tubuh secepat mungkin.</div>
        <div class="diet-card-advantages">
          <div class="diet-advantages-label"><span class="material-symbols-outlined">check_circle</span> Keunggulan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Naikkan berat badan cepat</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Naikkan massa otot dengan cepat</div>
        </div>
      </div>

      <!-- 12. Clean Bulk -->
      <div class="diet-card" data-category="naik" data-hidden="true">
        <div class="diet-card-header">
          <div class="diet-card-name">Clean Bulk</div>
          <span class="diet-badge">Naik BB</span>
        </div>
        <div class="diet-card-desc">Surplus kalori moderat dari makanan bergizi tinggi — menaikkan massa otot secara bertahap dengan meminimalkan penumpukan lemak.</div>
        <div class="diet-card-advantages">
          <div class="diet-advantages-label"><span class="material-symbols-outlined">check_circle</span> Keunggulan</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Naikkan otot, minimasi lemak</div>
          <div class="diet-advantage-item"><div class="diet-advantage-dot"></div>Berat badan naik bertahap</div>
        </div>
      </div>
    </div><!-- end diet-grid -->

    <div class="diet-show-more">
      <button class="btn-show-more" id="btnShowMore">
        <span class="material-symbols-outlined" style="font-size:18px;">expand_more</span>
        Lihat Semua Program Diet
      </button>
    </div>
  </div>
</section>

<!-- MENU REKOMENDASI (Tips) -->
<section id="menu" style="background:#fff; padding:56px 40px;">
  <div style="max-width:1200px; margin:0 auto;">
    <div style="text-align:center; margin-bottom:4px;">
      <div class="section-tag"><span class="material-symbols-outlined" style="font-size:14px;">restaurant_menu</span> Menu Harian</div>
      <h2 class="section-title" style="margin:0 auto 10px;">Rekomendasi Menu Makan</h2>
      <p class="section-subtitle" style="margin:0 auto; text-align:center;">Pilihan menu sehat untuk sarapan, makan siang, dan malam — lengkap dengan info kalori dan makronutrisi.</p>
    </div>

    <div style="display:flex; gap:8px; flex-wrap:wrap; margin:24px 0;" id="menuFilter">
      <button class="filter-btn active" data-cat="all">Semua</button>
      <button class="filter-btn" data-cat="sarapan">Sarapan</button>
      <button class="filter-btn" data-cat="siang">Makan Siang</button>
      <button class="filter-btn" data-cat="malam">Makan Malam</button>
    </div>

    <div id="menuGrid" style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px;"></div>
    <div style="text-align:center; margin-top:24px;">
      <button class="btn-show-more" id="menuShowMore">
        <span class="material-symbols-outlined" style="font-size:18px;">expand_more</span> Lihat Semua Menu
      </button>
    </div>
  </div>
</section>

<!-- OLAHRAGA REKOMENDASI (Dashboard) -->
<section id="olahraga" style="background:linear-gradient(160deg,#eef8f6 0%,#f4fbf9 50%,#eaf6f4 100%); padding:56px 40px;">
  <div style="max-width:1200px; margin:0 auto;">
    <div style="text-align:center; margin-bottom:4px;">
      <div class="section-tag"><span class="material-symbols-outlined" style="font-size:14px;">fitness_center</span> Olahraga</div>
      <h2 class="section-title" style="margin:0 auto 10px;">Rekomendasi Olahraga</h2>
      <p class="section-subtitle" style="margin:0 auto; text-align:center;">Pilih intensitas yang sesuai kondisi tubuh — dari santai hingga berat, semua terhitung kalorinya.</p>
    </div>

    <div style="display:flex; gap:8px; flex-wrap:wrap; margin:24px 0;" id="exFilter">
      <button class="filter-btn active" data-int="all">Semua</button>
      <button class="filter-btn" data-int="santai">Santai</button>
      <button class="filter-btn" data-int="ringan">Ringan</button>
      <button class="filter-btn" data-int="sedang">Sedang</button>
      <button class="filter-btn" data-int="berat">Berat</button>
    </div>

    <div id="exGrid" style="display:grid; grid-template-columns:repeat(2,1fr); gap:14px;"></div>
    <div style="text-align:center; margin-top:24px;">
      <button class="btn-show-more" id="exShowMore">
        <span class="material-symbols-outlined" style="font-size:18px;">expand_more</span> Lihat Semua Olahraga
      </button>
    </div>
  </div>
</section>

<!-- Modal Menu -->
<div id="menuModal" style="display:none;position:fixed;inset:0;z-index:1000;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;padding:20px;">
  <div style="background:#fff;border-radius:16px;max-width:380px;width:100%;padding:24px;position:relative;max-height:80vh;overflow-y:auto;">
    <button onclick="document.getElementById('menuModal').style.display='none'" style="position:absolute;top:12px;right:12px;background:none;border:none;font-size:22px;cursor:pointer;color:#4e6665;">✕</button>
    <div id="menuModalContent"></div>
  </div>
</div>

<!-- Modal Exercise -->
<div id="exModal" style="display:none;position:fixed;inset:0;z-index:1000;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;padding:20px;">
  <div style="background:#fff;border-radius:16px;max-width:380px;width:100%;padding:24px;position:relative;max-height:80vh;overflow-y:auto;">
    <button onclick="document.getElementById('exModal').style.display='none'" style="position:absolute;top:12px;right:12px;background:none;border:none;font-size:22px;cursor:pointer;color:#4e6665;">✕</button>
    <div id="exModalContent"></div>
  </div>
</div>

<!-- FEATURES BENTO -->
<section class="features-section">
  <div class="section-inner">
    <div class="features-header">
      <div class="section-tag"><span class="material-symbols-outlined" style="font-size:14px;">auto_awesome</span> Fitur</div>
      <h2 class="section-title">Fitur Cerdas</h2>
      <p class="section-subtitle">Sistem Pendukung Keputusan (DSS) kami memproses data Anda dalam hitungan detik untuk menghasilkan rencana nutrisi yang optimal.</p>
    </div>
    <div class="bento-grid">

      <div class="bento-card bento-menu">
        <div class="bento-menu-content">
          <div class="bento-menu-tag">Fitur Utama</div>
          <div class="bento-menu-title">Menu yang Dipersonalisasi</div>
          <div class="bento-menu-desc">Rekomendasi menu harian disesuaikan dengan kebutuhan kalori, tujuan diet, dan kondisi tubuh pengguna.</div>
        </div>
        <img class="bento-menu-img" src="{{ asset('img/menu.jpg') }}" alt="healthy food">
      </div>

      <div class="bento-card bento-bmi">
        <div>
          <div class="bento-bmi-icon"><span class="material-symbols-outlined" style="color:#fff;">calculate</span></div>
          <div class="bento-bmi-title">Kalkulator BMI</div>
          <div class="bento-bmi-desc">Hitung BMI dan kebutuhan kalori harian secara otomatis untuk membantu menentukan program diet yang tepat.</div>
        </div>
        <div>
          <div class="bento-bmi-bar-label"><span>Kemajuan</span><span>Sesuai Target</span></div>
          <div class="bento-bmi-bar"><div class="bento-bmi-bar-fill"></div></div>
        </div>
      </div>

      <div class="bento-card bento-exercise">
        <div class="bento-exercise-icon"><span class="material-symbols-outlined">fitness_center</span></div>
        <div>
          <div class="bento-exercise-title">Tips Olahraga</div>
          <div class="bento-exercise-desc">Lengkapi diet Anda dengan rutinitas latihan yang dikurasi, disesuaikan dengan tingkat energi dan tujuan Anda saat ini.</div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- WHY CHOOSE US (bottom) -->
<section class="why-bottom-section">
  <div class="section-inner">
    <div class="why-bottom-grid">
      <div class="why-bottom-img">
        <img src="{{ asset('img/olahraga.jpg') }}" alt="Active lifestyle">
      </div>
      <div class="why-text">
        <div class="section-tag"><span class="material-symbols-outlined" style="font-size:14px;">health_and_safety</span> Tentang Kami</div>
        <h2 class="section-title">Keunggulan DietMate</h2>
        <p class="section-subtitle">DietMate menjembatani kesenjangan penting antara keandalan nutrisi klinis dan dorongan harian yang personal.</p>
        <div class="why-list">
          <div class="why-item">
            <div class="why-icon"><span class="material-symbols-outlined">verified</span></div>
            <div>
              <div class="why-item-title">Nutrisi yang Didukung Ahli</div>
              <div class="why-item-desc">Algoritma dikembangkan bersama ahli gizi bersertifikat untuk hasil yang terpercaya.</div>
            </div>
          </div>
          <div class="why-item">
            <div class="why-icon"><span class="material-symbols-outlined">shield</span></div>
            <div>
              <div class="why-item-title">Pendekatan Mengutamakan Privasi</div>
              <div class="why-item-desc">Metrik kesehatan Anda dienkripsi dengan aman dan tidak pernah dibagikan.</div>
            </div>
          </div>
          <div class="why-item">
            <div class="why-icon"><span class="material-symbols-outlined">support_agent</span></div>
            <div>
              <div class="why-item-title">Dukungan Berkelanjutan</div>
              <div class="why-item-desc">Akses 24/7 ke sumber daya pendidikan dan rekomendasi adaptif berbasis AI.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <div class="footer-brand">DietMate</div>
    <div class="footer-links">
      <a href="#">Kebijakan Privasi</a>
      <a href="#">Syarat Layanan</a>
      <a href="#">Dukungan</a>
      <a href="#">Karir</a>
    </div>
    <div class="footer-copy">© 2026 DietMate Health. Hak cipta dilindungi undang-undang.</div>
  </div>
</footer>

<script>
  // ── Filter tabs untuk diet ──
  const filterBtns = document.querySelectorAll('.diet-filter .filter-btn');
  const dietCards  = document.querySelectorAll('.diet-card');
  const btnShowMore = document.getElementById('btnShowMore');
  let showAll = false;

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const filter = btn.dataset.filter;

      // Reset show-more state
      showAll = false;
      btnShowMore.innerHTML = '<span class="material-symbols-outlined" style="font-size:18px;">expand_more</span> Lihat Semua Program Diet';

      let shown = 0;
      dietCards.forEach(card => {
        const match = filter === 'all' || card.dataset.category === filter;
        if (match) {
          shown++;
          card.style.display = shown <= 6 ? 'flex' : 'none';
          card.dataset.hidden = shown > 6 ? 'true' : 'false';
        } else {
          card.style.display = 'none';
          card.dataset.hidden = 'true';
        }
      });

      // Hide show-more if 6 or fewer match
      btnShowMore.parentElement.style.display = shown > 6 ? 'block' : 'none';
    });
  });

  // ── Show more / less ──
  btnShowMore.addEventListener('click', () => {
    showAll = !showAll;
    const activeFilter = document.querySelector('.diet-filter .filter-btn.active').dataset.filter;

    dietCards.forEach(card => {
      const match = activeFilter === 'all' || card.dataset.category === activeFilter;
      if (match) card.style.display = showAll ? 'flex' : '';
    });

    if (!showAll) {
      // Re-hide beyond 6
      let shown = 0;
      dietCards.forEach(card => {
        const match = activeFilter === 'all' || card.dataset.category === activeFilter;
        if (match) {
          shown++;
          if (shown > 6) card.style.display = 'none';
        }
      });
    }

    btnShowMore.innerHTML = showAll
      ? '<span class="material-symbols-outlined" style="font-size:18px;">expand_less</span> Sembunyikan'
      : '<span class="material-symbols-outlined" style="font-size:18px;">expand_more</span> Lihat Semua Program Diet';
  });

  // ── Data Menu ──
  const menuData = [
    {name:"Nasi Goreng Telur",cat:"sarapan",cal:450,pro:15,carb:60,fat:18,desc:"Nasi goreng dengan telur ceplok dan kecap manis",emoji:"🍳"},
    {name:"Bubur Ayam",cat:"sarapan",cal:320,pro:18,carb:45,fat:8,desc:"Bubur beras dengan ayam suwir dan cakwe",emoji:"🍲"},
    {name:"Roti Gandum + Selai Kacang",cat:"sarapan",cal:380,pro:14,carb:42,fat:16,desc:"2 lembar roti gandum dengan selai kacang natural",emoji:"🍞"},
    {name:"Oatmeal Pisang",cat:"sarapan",cal:290,pro:10,carb:52,fat:5,desc:"Oatmeal dengan irisan pisang dan madu",emoji:"🍌"},
    {name:"Omelet Sayuran",cat:"sarapan",cal:260,pro:18,carb:8,fat:18,desc:"Omelet dengan paprika, bawang, dan bayam",emoji:"🥚"},
    {name:"Smoothie Mangga Yogurt",cat:"sarapan",cal:210,pro:8,carb:38,fat:3,desc:"Smoothie dari mangga segar dan yogurt plain",emoji:"🥤"},
    {name:"Avocado Toast",cat:"sarapan",cal:330,pro:8,carb:28,fat:20,desc:"Roti gandum panggang dengan alpukat dan telur poach",emoji:"🥑"},
    {name:"Yogurt Parfait",cat:"sarapan",cal:240,pro:12,carb:35,fat:4,desc:"Yogurt greek dengan granola dan buah beri",emoji:"🍓"},
    {name:"Granola + Susu",cat:"sarapan",cal:310,pro:10,carb:48,fat:8,desc:"Granola panggang dengan susu rendah lemak",emoji:"🥣"},
    {name:"Ubi Kukus + Teh Hijau",cat:"sarapan",cal:180,pro:3,carb:40,fat:1,desc:"Ubi jalar kukus sebagai pengganti nasi",emoji:"🍠"},
    {name:"Nasi Ayam Bakar",cat:"siang",cal:620,pro:35,carb:72,fat:18,desc:"Nasi putih dengan ayam bakar bumbu kecap",emoji:"🍗"},
    {name:"Gado-Gado",cat:"siang",cal:480,pro:20,carb:45,fat:25,desc:"Sayuran rebus dengan bumbu kacang dan kerupuk",emoji:"🥜"},
    {name:"Soto Ayam",cat:"siang",cal:390,pro:28,carb:30,fat:14,desc:"Soto bening ayam dengan nasi putih dan emping",emoji:"🍜"},
    {name:"Salad Ayam Panggang",cat:"siang",cal:310,pro:32,carb:15,fat:12,desc:"Salad segar dengan dada ayam panggang dan vinaigrette",emoji:"🥗"},
    {name:"Sup Sayur Tahu",cat:"siang",cal:280,pro:14,carb:28,fat:10,desc:"Sup bening dengan tahu, wortel, dan kentang",emoji:"🥣"},
    {name:"Bakso Kuah",cat:"siang",cal:440,pro:25,carb:48,fat:14,desc:"Bakso sapi dengan kuah kaldu dan mi bihun",emoji:"🍱"},
    {name:"Pecel Lele",cat:"siang",cal:550,pro:30,carb:55,fat:22,desc:"Lele goreng dengan nasi dan sambal pecel",emoji:"🐟"},
    {name:"Capcay Seafood",cat:"siang",cal:350,pro:26,carb:32,fat:12,desc:"Tumis sayuran dengan udang dan cumi",emoji:"🦐"},
    {name:"Tumis Brokoli Ayam",cat:"malam",cal:340,pro:30,carb:18,fat:14,desc:"Brokoli dan ayam fillet tumis bawang putih",emoji:"🥦"},
    {name:"Ikan Bakar Bumbu Kuning",cat:"malam",cal:360,pro:38,carb:12,fat:16,desc:"Ikan kembung bakar dengan bumbu kuning rempah",emoji:"🐟"},
    {name:"Salad Tuna",cat:"malam",cal:260,pro:28,carb:12,fat:10,desc:"Salad romaine dengan tuna kaleng dan lemon dressing",emoji:"🥗"},
    {name:"Sup Tom Yum Udang",cat:"malam",cal:250,pro:24,carb:15,fat:8,desc:"Sup tom yum pedas dengan udang segar",emoji:"🍲"},
    {name:"Ayam Rebus Jahe",cat:"malam",cal:290,pro:34,carb:6,fat:10,desc:"Dada ayam rebus dengan jahe dan bawang putih",emoji:"🍗"},
    {name:"Grilled Chicken Salad",cat:"malam",cal:280,pro:35,carb:10,fat:10,desc:"Dada ayam bakar dengan salad mix dan olive oil",emoji:"🥗"},
    {name:"Kentang Panggang + Salmon",cat:"malam",cal:450,pro:36,carb:38,fat:14,desc:"Salmon panggang dengan kentang wedges dan lemon",emoji:"🐟"},
    {name:"Nasi Merah + Telur Dadar",cat:"malam",cal:380,pro:16,carb:52,fat:12,desc:"Nasi merah dengan telur dadar sayuran",emoji:"🍚"},
    {name:"Sayur Asem",cat:"malam",cal:180,pro:6,carb:28,fat:4,desc:"Sayur asem segar dengan jagung, kacang, dan melinjo",emoji:"🌽"},
    {name:"Tumis Kangkung Belacan",cat:"malam",cal:160,pro:6,carb:14,fat:8,desc:"Kangkung tumis dengan belacan dan cabe",emoji:"🥬"},
  ];

  const exData = [
    {id:1,name:"Jalan Santai",dur:30,int:"santai",desc:"Berjalan kaki dengan kecepatan normal di sekitar rumah atau taman.",cals:3.5,emoji:"🚶"},
    {id:2,name:"Yoga Pagi",dur:45,int:"santai",desc:"Serangkaian gerakan yoga untuk fleksibilitas dan ketenangan pikiran.",cals:3,emoji:"🧘"},
    {id:3,name:"Peregangan (Stretching)",dur:20,int:"santai",desc:"Gerakan peregangan seluruh tubuh untuk kelenturan otot.",cals:2.5,emoji:"🤸"},
    {id:4,name:"Senam Lansia",dur:30,int:"santai",desc:"Senam ringan yang aman untuk semua usia.",cals:3.2,emoji:"💃"},
    {id:5,name:"Jogging Ringan",dur:30,int:"ringan",desc:"Berlari kecil dengan kecepatan 6-7 km/jam.",cals:6,emoji:"🏃"},
    {id:6,name:"Bersepeda Santai",dur:45,int:"ringan",desc:"Bersepeda dengan kecepatan 12-14 km/jam di jalan datar.",cals:5.5,emoji:"🚴"},
    {id:7,name:"Renang Gaya Bebas",dur:30,int:"ringan",desc:"Berenang gaya bebas dengan kecepatan moderat.",cals:6.5,emoji:"🏊"},
    {id:8,name:"Senam Aerobik",dur:40,int:"ringan",desc:"Senam aerobik berirama untuk meningkatkan detak jantung.",cals:5.8,emoji:"🎽"},
    {id:9,name:"Lompat Tali",dur:20,int:"sedang",desc:"Jump rope dengan variasi single bounce dan double bounce.",cals:9,emoji:"🪢"},
    {id:10,name:"HIIT 20 Menit",dur:20,int:"sedang",desc:"High Intensity Interval Training dengan interval 40:20.",cals:10,emoji:"⚡"},
    {id:11,name:"Push-Up & Sit-Up",dur:30,int:"sedang",desc:"Latihan kalistenik dasar untuk kekuatan otot inti.",cals:7,emoji:"💪"},
    {id:12,name:"Plank Challenge",dur:15,int:"sedang",desc:"Latihan plank berbagai variasi untuk kekuatan core.",cals:6.5,emoji:"🏋️"},
    {id:13,name:"Zumba",dur:45,int:"sedang",desc:"Aerobik dance bergaya Latin yang menyenangkan.",cals:8,emoji:"🕺"},
    {id:14,name:"Weight Training Pemula",dur:45,int:"sedang",desc:"Latihan beban dengan barbel dan dumbbell untuk pemula.",cals:6.8,emoji:"🏋️"},
    {id:15,name:"CrossFit",dur:45,int:"berat",desc:"Latihan fungsional intensitas tinggi kombinasi cardio dan beban.",cals:12,emoji:"🔥"},
    {id:16,name:"Sprint Interval",dur:25,int:"berat",desc:"Sprint 100m dengan recovery walk, 8-10 repetisi.",cals:11.5,emoji:"⚡"},
    {id:17,name:"Boxing / Muay Thai",dur:60,int:"berat",desc:"Latihan tinju dan tendangan untuk kekuatan dan cardio.",cals:10.5,emoji:"🥊"},
    {id:18,name:"Deadlift & Squat Heavy",dur:50,int:"berat",desc:"Latihan compound berat: deadlift, squat, bench press.",cals:9.5,emoji:"🏋️"},
    {id:19,name:"Rock Climbing Indoor",dur:60,int:"berat",desc:"Panjat tebing indoor untuk kekuatan dan ketangkasan.",cals:9,emoji:"🧗"},
    {id:20,name:"Triathlon Training",dur:90,int:"berat",desc:"Kombinasi renang, bersepeda, dan berlari jarak jauh.",cals:11,emoji:"🏆"},
  ];

  // ── Menu rendering ──
  const MENU_INIT = 6, EX_INIT = 6;
  let menuShowAll = false, exShowAll = false, menuCat = 'all', exInt = 'all';

  function renderMenuGrid() {
    const filtered = menuCat === 'all' ? menuData : menuData.filter(m => m.cat === menuCat);
    const items = menuShowAll ? filtered : filtered.slice(0, MENU_INIT);
    document.getElementById('menuGrid').innerHTML = items.map((m, i) => `
      <div onclick="openMenuModal(${menuData.indexOf(m)})" style="background:#f4fafa;border:1px solid #e4f2f0;border-radius:16px;overflow:hidden;cursor:pointer;transition:transform .2s,box-shadow .2s;position:relative;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 32px rgba(0,150,136,0.14)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
        <div style="width:100%;height:110px;background:linear-gradient(135deg,#e0f2f1,#b2dfdb);display:flex;align-items:center;justify-content:center;font-size:40px;">${m.emoji}</div>
        <span style="position:absolute;top:8px;right:8px;background:rgba(0,150,136,0.9);color:#fff;border-radius:999px;padding:2px 8px;font-size:10px;font-weight:700;">${m.cat}</span>
        <div style="padding:12px;">
          <div style="font-size:13px;font-weight:700;color:#1a2b2a;margin-bottom:4px;line-height:1.3;">${m.name}</div>
          <div style="font-size:11px;color:#4e6665;line-height:1.5;margin-bottom:8px;">${m.desc}</div>
          <div style="display:flex;gap:5px;flex-wrap:wrap;">
            <span style="background:#fff3e0;color:#e65100;border-radius:999px;padding:2px 7px;font-size:10px;font-weight:700;">🔥 ${m.cal}</span>
            <span style="background:#e8f5e9;color:#1b5e20;border-radius:999px;padding:2px 7px;font-size:10px;font-weight:700;">P ${m.pro}g</span>
            <span style="background:#e3f2fd;color:#0d47a1;border-radius:999px;padding:2px 7px;font-size:10px;font-weight:700;">K ${m.carb}g</span>
            <span style="background:#fce4ec;color:#880e4f;border-radius:999px;padding:2px 7px;font-size:10px;font-weight:700;">L ${m.fat}g</span>
          </div>
        </div>
      </div>
    `).join('');
    const btn = document.getElementById('menuShowMore');
    btn.style.display = filtered.length > MENU_INIT ? 'inline-flex' : 'none';
    btn.innerHTML = menuShowAll
      ? '<span class="material-symbols-outlined" style="font-size:18px;">expand_less</span> Sembunyikan'
      : '<span class="material-symbols-outlined" style="font-size:18px;">expand_more</span> Lihat Semua Menu';
  }

  function renderExGrid() {
    const filtered = exInt === 'all' ? exData : exData.filter(e => e.int === exInt);
    const items = exShowAll ? filtered : filtered.slice(0, EX_INIT);
    const intColors = {santai:'#e8f5e9;color:#1b5e20',ringan:'#e3f2fd;color:#0d47a1',sedang:'#fff3e0;color:#e65100',berat:'#fce4ec;color:#880e4f'};
    document.getElementById('exGrid').innerHTML = items.map(e => `
      <div onclick="openExModal(${e.id-1})" style="background:rgba(255,255,255,0.85);border:1px solid rgba(255,255,255,0.9);border-radius:16px;padding:16px;cursor:pointer;display:flex;gap:12px;align-items:flex-start;box-shadow:0 4px 24px rgba(0,150,136,0.10);transition:transform .2s,box-shadow .2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 32px rgba(0,150,136,0.14)'" onmouseout="this.style.transform='';this.style.boxShadow='0 4px 24px rgba(0,150,136,0.10)'">
        <div style="width:42px;height:42px;border-radius:12px;background:#e0f2f1;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0;">${e.emoji}</div>
        <div style="flex:1;">
          <div style="font-size:13px;font-weight:700;color:#1a2b2a;margin-bottom:3px;">${e.name}</div>
          <div style="font-size:11px;color:#4e6665;line-height:1.5;margin-bottom:6px;">${e.desc}</div>
          <div style="display:flex;gap:5px;flex-wrap:wrap;">
            <span style="background:${intColors[e.int]};border-radius:999px;padding:2px 7px;font-size:10px;font-weight:700;">${e.int}</span>
            <span style="background:#e0f2f1;color:#00796b;border-radius:999px;padding:2px 7px;font-size:10px;font-weight:700;">⏱ ${e.dur} mnt</span>
            <span style="background:#f3e5f5;color:#4a148c;border-radius:999px;padding:2px 7px;font-size:10px;font-weight:700;">🔥 ${e.cals} kkal/mnt</span>
          </div>
        </div>
      </div>
    `).join('');
    const btn = document.getElementById('exShowMore');
    btn.style.display = filtered.length > EX_INIT ? 'inline-flex' : 'none';
    btn.innerHTML = exShowAll
      ? '<span class="material-symbols-outlined" style="font-size:18px;">expand_less</span> Sembunyikan'
      : '<span class="material-symbols-outlined" style="font-size:18px;">expand_more</span> Lihat Semua Olahraga';
  }

  document.getElementById('menuFilter').addEventListener('click', e => {
    const btn = e.target.closest('[data-cat]'); if (!btn) return;
    document.querySelectorAll('#menuFilter [data-cat]').forEach(b => b.classList.remove('active'));
    btn.classList.add('active'); menuCat = btn.dataset.cat; menuShowAll = false; renderMenuGrid();
  });
  document.getElementById('exFilter').addEventListener('click', e => {
    const btn = e.target.closest('[data-int]'); if (!btn) return;
    document.querySelectorAll('#exFilter [data-int]').forEach(b => b.classList.remove('active'));
    btn.classList.add('active'); exInt = btn.dataset.int; exShowAll = false; renderExGrid();
  });
  document.getElementById('menuShowMore').addEventListener('click', () => { menuShowAll = !menuShowAll; renderMenuGrid(); });
  document.getElementById('exShowMore').addEventListener('click', () => { exShowAll = !exShowAll; renderExGrid(); });

  function openMenuModal(idx) {
    const m = menuData[idx];
    document.getElementById('menuModalContent').innerHTML = `
      <div style="font-size:48px;text-align:center;margin-bottom:12px;">${m.emoji}</div>
      <div style="font-size:18px;font-weight:800;color:#1a2b2a;margin-bottom:6px;">${m.name}</div>
      <span style="background:#e0f2f1;color:#00796b;border-radius:999px;padding:3px 10px;font-size:11px;font-weight:700;display:inline-block;margin-bottom:10px;">${m.cat}</span>
      <p style="font-size:13px;color:#4e6665;line-height:1.6;margin-bottom:14px;">${m.desc}</p>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
        <div style="background:#f4fafa;border-radius:10px;padding:10px;text-align:center;"><div style="font-size:20px;font-weight:800;color:#e65100;">${m.cal}</div><div style="font-size:10px;color:#4e6665;font-weight:600;">KALORI (kkal)</div></div>
        <div style="background:#f4fafa;border-radius:10px;padding:10px;text-align:center;"><div style="font-size:20px;font-weight:800;color:#1b5e20;">${m.pro}g</div><div style="font-size:10px;color:#4e6665;font-weight:600;">PROTEIN</div></div>
        <div style="background:#f4fafa;border-radius:10px;padding:10px;text-align:center;"><div style="font-size:20px;font-weight:800;color:#0d47a1;">${m.carb}g</div><div style="font-size:10px;color:#4e6665;font-weight:600;">KARBOHIDRAT</div></div>
        <div style="background:#f4fafa;border-radius:10px;padding:10px;text-align:center;"><div style="font-size:20px;font-weight:800;color:#880e4f;">${m.fat}g</div><div style="font-size:10px;color:#4e6665;font-weight:600;">LEMAK</div></div>
      </div>
    `;
    const modal = document.getElementById('menuModal');
    modal.style.display = 'flex';
    modal.addEventListener('click', e => { if (e.target === modal) modal.style.display = 'none'; }, {once:true});
  }

  function openExModal(idx) {
    const e = exData[idx];
    const total = Math.round(e.cals * e.dur);
    document.getElementById('exModalContent').innerHTML = `
      <div style="font-size:48px;text-align:center;margin-bottom:12px;">${e.emoji}</div>
      <div style="font-size:18px;font-weight:800;color:#1a2b2a;margin-bottom:6px;">${e.name}</div>
      <span style="background:#e0f2f1;color:#00796b;border-radius:999px;padding:3px 10px;font-size:11px;font-weight:700;display:inline-block;margin-bottom:10px;">${e.int}</span>
      <p style="font-size:13px;color:#4e6665;line-height:1.6;margin-bottom:14px;">${e.desc}</p>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
        <div style="background:#f4fafa;border-radius:10px;padding:10px;text-align:center;"><div style="font-size:20px;font-weight:800;color:#009688;">${e.dur}</div><div style="font-size:10px;color:#4e6665;font-weight:600;">DURASI (mnt)</div></div>
        <div style="background:#f4fafa;border-radius:10px;padding:10px;text-align:center;"><div style="font-size:20px;font-weight:800;color:#e65100;">${e.cals}</div><div style="font-size:10px;color:#4e6665;font-weight:600;">KKAL/MENIT</div></div>
        <div style="background:#f4fafa;border-radius:10px;padding:10px;text-align:center;grid-column:span 2;"><div style="font-size:24px;font-weight:800;color:#009688;">~${total}</div><div style="font-size:10px;color:#4e6665;font-weight:600;">TOTAL KALORI TERBAKAR</div></div>
      </div>
    `;
    const modal = document.getElementById('exModal');
    modal.style.display = 'flex';
    modal.addEventListener('click', e => { if (e.target === modal) modal.style.display = 'none'; }, {once:true});
  }

  // ── Smooth Scroll untuk Navigasi ──
  document.querySelectorAll('.nav-links a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const targetId = this.getAttribute('href');
      
      // Khusus untuk Dashboard (belum ada halaman)
      if (targetId === '#dashboard') {
        e.preventDefault();
        alert('Fitur Dashboard sedang dalam pengembangan. Silahkan coba lagi nanti! 🚀');
        return;
      }
      
      // Untuk link yang mengarah ke section yang ada
      if (targetId && targetId !== '#') {
        e.preventDefault();
        const targetElement = document.querySelector(targetId);
        
        if (targetElement) {
          // Update active class
          document.querySelectorAll('.nav-links a').forEach(a => a.classList.remove('active'));
          this.classList.add('active');
          
          // Smooth scroll
          targetElement.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      }
    });
  });

  // Optional: Update active class saat scroll (biar active state berubah otomatis)
  window.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('section[id]');
    const scrollPosition = window.scrollY + 100;
    
    sections.forEach(section => {
      const sectionTop = section.offsetTop;
      const sectionBottom = sectionTop + section.offsetHeight;
      const sectionId = section.getAttribute('id');
      
      if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
        document.querySelectorAll('.nav-links a').forEach(link => {
          link.classList.remove('active');
          // Abaikan dashboard link karena tidak punya section
          if (link.getAttribute('href') === `#${sectionId}`) {
            link.classList.add('active');
          }
        });
      }
    });
  });

  renderMenuGrid();
  renderExGrid();
</script>

</body>
</html>