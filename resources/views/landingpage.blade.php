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
    <a class="nav-brand" href="#">
      <img src="{{ asset('img/logo.png') }}" alt="DietMate" style="height:34px; width:auto;">
      <span class="nav-brand-name">DietMate</span>
    </a>
    <div class="nav-links">
      <a href="#" class="active">Beranda</a>
      <a href="#">Fitur</a>
      <a href="#">Dashboard</a>
      <a href="#">Tips</a>
    </div>
    <div class="nav-actions">
      <button class="btn-ghost">Masuk</button>
      <button class="btn-primary">Daftar</button>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero" style="padding:0;">
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
      <button class="btn-hero-primary">
        Mulai Diet Sekarang
        <span class="material-symbols-outlined" style="font-size:18px;font-variation-settings:'FILL' 0;">arrow_forward</span>
      </button>
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

<!-- DIET TYPES -->
<section class="diet-section">
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
  // ── Filter tabs ──
  const filterBtns = document.querySelectorAll('.filter-btn');
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
    const activeFilter = document.querySelector('.filter-btn.active').dataset.filter;

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
</script>

</body>
</html>