<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTN | {{ $info['judul'] }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --brown: #58290D;
            --brown-mid: #7a3c18;
            --brown-dark: #3d1b08;
            --gold: #c8922a;
            --gold-light: #e8b86d;
            --cream: #EDE5D8;
            --cream-2: #e4dcd1;
            --cream-3: #FBF8F3;
            --muted: #9c7355;
            --border: rgba(88, 41, 13, 0.15);
            --ink: #1a0a02;
        }

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--cream-2);
            color: var(--ink);
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        /* ====== NAVBAR ====== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 200;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 5%;
            background: transparent;
            transition: background 0.4s, padding 0.4s, box-shadow 0.4s;
        }

        .navbar.scrolled {
            padding: 14px 5%;
            background: rgba(228, 220, 209, 0.95);
            backdrop-filter: blur(16px);
            box-shadow: 0 1px 0 rgba(88, 41, 13, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            font-size: 18px;
            letter-spacing: 2px;
            font-weight: 600;
            transition: color 0.4s;
        }

        .navbar.scrolled .logo {
            color: var(--brown);
        }

        .logo-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1.5px solid var(--gold);
        }

        .navbar nav ul {
            display: flex;
            gap: 32px;
        }

        .navbar nav ul a {
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 600;
            transition: color 0.25s;
        }

        .navbar nav ul a:hover {
            color: var(--gold-light);
        }

        .navbar.scrolled nav ul a {
            color: var(--brown);
        }

        .navbar.scrolled nav ul a:hover {
            color: var(--gold);
        }

        .faq-toggle,
        .menu-toggle {
            display: none;
        }

        /* ====== HERO ====== */
        .hero-section {
            height: 60vh;
            min-height: 420px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            inset: -20px;
            background-image: inherit;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            filter: blur(8px);
            transform: scale(1.05);
            z-index: 0;
        }

        .hero-gradient {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                    rgba(26, 10, 2, 0.92) 0%,
                    rgba(26, 10, 2, 0.5) 50%,
                    rgba(0, 0, 0, 0.25) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 0 8%;
            width: 100%;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero-title {
            font-family: "DM Serif Display", serif;
            font-size: 6em;
            color: #fff;
            line-height: 1.0;
            font-weight: 500;
            margin-bottom: 16px;
        }

        .hero-subtitle {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-size: 16px;
            color: rgba(255, 255, 255, 0.7);
            letter-spacing: 0.1em;
            font-weight: 500;
        }

        /* ====== BREADCRUMB ====== */
        .breadcrumb {
            padding: 16px 8%;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            color: var(--muted);
            letter-spacing: 0.06em;
            background: var(--cream-3);
            border-bottom: 1px solid var(--border);
        }

        .breadcrumb a {
            color: var(--brown);
            font-weight: 600;
            transition: color 0.2s;
        }

        .breadcrumb a:hover {
            color: var(--gold);
        }

        .breadcrumb-sep {
            color: var(--border);
            font-size: 14px;
        }

        /* ====== LAYOUT ====== */
        .detail-wrap {
            padding: 80px 0px;
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 80px;
            align-items: start;
        }

        /* ====== CONTENT BLOCKS ====== */
        .content-block {
            margin-bottom: 64px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.6s ease forwards;
        }

        .content-block:last-child {
            margin-bottom: 0;
        }

        .content-block:nth-child(1) {
            animation-delay: 0.1s;
        }

        .content-block:nth-child(2) {
            animation-delay: 0.2s;
        }

        .content-block:nth-child(3) {
            animation-delay: 0.3s;
        }

        .content-block:nth-child(4) {
            animation-delay: 0.4s;
        }

        .content-block:nth-child(5) {
            animation-delay: 0.5s;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            font-family: "DM Serif Display", serif;
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            color: var(--brown-dark);
            line-height: 1.1;
            padding: auto;
        }

        .content-text {
            font-size: 18px;
            line-height: 1.5;
            padding: 3% 0px;
            color: rgba(58, 28, 10, 0.78);
        }

        .content-step-text {
            font-size: 18px;
            line-height: 1.2;
            padding: 3% 0px;
            text-align: justify;
            color: rgba(58, 28, 10, 0.8);
            white-space: pre-line;
        }

        .filosofi-quote {
            position: relative;
            padding: 15px 0 0;
            border-radius: 12px;
        }

        .filosofi-quote p {
            font-size: 18px;
            line-height: 1.5;
            color: rgba(58, 28, 10, 0.82);
            font-style: italic;
            white-space: pre-line;
        }

        /* Galeri tambahan */
        .additional-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-top: 32px;
        }

        .gallery-item {
            border-radius: 12px;
            height: 90%;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(88, 41, 13, 0.05);
        }

        .gallery-img-wrapper {
            width: 100%;
            aspect-ratio: 4/3;
            overflow: hidden;
        }

        .gallery-img {
            width: 100%;
            height: 90%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover .gallery-img {
            transform: scale(1.06);
        }

        .gallery-caption {
            padding: 14px 18px;
            font-size: 13px;
            line-height: 1.5;
            color: var(--brown);
            font-style: italic;
            border-top: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.5);
        }

        /* ====== SIDEBAR ====== */
        .detail-right {
            position: sticky;
            top: 100px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .sidebar-img {
            width: 100%;
            aspect-ratio: 3/4;
            object-fit: cover;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(26, 10, 2, 0.2);
            display: block;
        }

        .sidebar-img-placeholder {
            width: 100%;
            aspect-ratio: 3/4;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--brown-dark), var(--brown-mid));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
        }

        /* ====== MINI CARD LIST ====== */
        .sidebar-section-label {
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: #58290D;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .mini-card-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .mini-card {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--cream-3);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 10px 14px;
            transition: border-color 0.25s, box-shadow 0.25s, transform 0.2s;
            text-decoration: none;
            color: inherit;
        }

        .mini-card:hover {
            border-color: rgba(200, 146, 42, 0.45);
            box-shadow: 0 6px 20px rgba(88, 41, 13, 0.08);
            transform: translateY(-2px);
        }

        .mini-thumb {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            background: #d5c5a8;
            flex-shrink: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .mini-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .mini-info {
            flex: 1;
            min-width: 0;
        }

        .mini-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--brown-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 6px;
        }

        .mini-sub {
            font-size: 12px;
            color: var(--muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .mini-arrow {
            font-size: 24px;
            color: var(--gold);
            flex-shrink: 0;
            line-height: 1;
            transition: transform 0.2s;
        }

        .mini-card:hover .mini-arrow {
            transform: translateX(3px);
        }

        .sidebar-pulau-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 20px;
            background: transparent;
            color: var(--brown);
            border: 1.5px solid #58290D;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            transition: border-color 0.25s, color 0.25s, background 0.25s;
        }

        .sidebar-pulau-btn:hover {
            border-color: var(--gold);
            background: rgba(200, 146, 42, 0.04);
        }

        .sidebar-pulau-btn svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ====== PULAU DROPDOWN ====== */
        .nav-pulau-wrap {
            position: relative;
        }

        .pulau-dropdown {
            position: absolute;
            top: calc(100% + 16px);
            left: 50%;
            transform: translateX(-50%) translateY(-8px);
            min-width: 200px;
            background: var(--cream-2);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 16px 48px rgba(26, 10, 2, 0.18);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s, transform 0.25s;
            z-index: 300;
            overflow: hidden;
        }

        .pulau-dropdown-inner a.pulau-dropdown-item {
            color: var(--brown);
        }

        .pulau-dropdown.open {
            opacity: 1;
            pointer-events: auto;
            transform: translateX(-50%) translateY(0);
        }

        .pulau-dropdown::before {
            content: '';
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 12px;
            height: 12px;
            background: var(--cream-3);
            border-left: 1px solid var(--border);
            border-top: 1px solid var(--border);
            rotate: 45deg;
        }

        .pulau-dropdown-inner {
            padding: 8px;
            display: flex;
            flex-direction: column;
            gap: 2px;
            max-height: 320px;
            overflow-y: auto;
        }

        .pulau-dropdown-loading {
            padding: 12px 16px;
            font-size: 13px;
            color: #58290D;
            text-align: center;
        }

        .pulau-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--brown);
            transition: background 0.18s, color 0.18s;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
        }

        .pulau-dropdown-item:hover {
            background: rgba(200, 146, 42, 0.1);
            color: #58290D;
        }

        .pulau-dropdown-item.active {
            background: rgba(88, 41, 13, 0.08);
            font-weight: 700;
            color: var(--brown-dark);
        }

        .pulau-dot-item {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #58290D;
            flex-shrink: 0;
        }

        .nav-pulau-toggle svg {
            transition: transform 0.3s;
        }

        .nav-pulau-wrap.open .nav-pulau-toggle svg {
            transform: rotate(180deg);
        }

        /* ====== FOOTER ====== */
        .footer {
            background-color: #3d1b08;
            color: #ead3af;
            padding: 75px 120px;
        }

        .footer-top {
            display: flex;
            gap: 40px;
            padding-bottom: 35px;
            border-bottom: 1px solid #ead3af;
        }

        .footer-brand {
            flex: 1.5;
        }

        .footer-brand h3 {
            font-size: 20px;
            font-weight: 700;
            color: #ead3af;
            margin-bottom: 10px;
        }

        .footer-brand p {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.75;
        }

        .footer-col {
            flex: 1;
        }

        .footer-col h4 {
            font-size: 18px;
            font-weight: 600;
            color: #ead3af;
            margin-bottom: 14px;
        }

        .footer-col ul li {
            margin-bottom: 8px;
        }

        .footer-col ul li a {
            font-size: 16px;
            color: #ead3af;
            opacity: 0.8;
            transition: opacity 0.2s;
        }

        .footer-col ul li a:hover {
            opacity: 1;
        }

        .footer-bottom {
            padding-top: 20px;
            text-align: center;
            font-size: 14px;
            opacity: 0.5;
        }

        /* ====== RESPONSIVE ====== */
        @media (max-width: 1100px) {
            .detail-wrap {
                grid-template-columns: 1fr 280px;
                gap: 48px;
            }

            .footer {
                padding: 50px 6%;
            }
        }

        @media (max-width: 860px) {
            .detail-wrap {
                grid-template-columns: 1fr;
            }

            .detail-right {
                position: static;
            }

            .sidebar-img,
            .sidebar-img-placeholder {
                aspect-ratio: 16/9;
            }

            .hero-content {
                grid-template-columns: 1fr;
            }

            .hero-right {
                text-align: left;
            }
        }

        @media (max-width: 600px) {
            .hero-title {
                font-size: 2.6rem;
            }

            .detail-wrap {
                padding: 40px 5% 60px;
                gap: 40px;
            }

            .footer {
                padding: 44px 5%;
            }

            .footer-top {
                flex-direction: column;
                gap: 28px;
            }

            .navbar nav {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 76px;
                left: 4%;
                right: 4%;
                background: var(--cream-2);
                border: 1px solid var(--border);
                border-radius: 10px;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
                z-index: 90;
            }

            .navbar nav ul {
                flex-direction: column;
                padding: 8px 0;
            }

            .navbar nav ul a {
                padding: 10px 20px;
                display: block;
                text-align: center;
            }

            .menu-toggle {
                display: block;
                cursor: pointer;
                padding: 5px;
            }

            .menu-toggle span {
                display: block;
                width: 24px;
                height: 2.5px;
                background: var(--brown);
                margin: 5px 0;
                transition: 0.35s;
            }

            #nav-toggle:checked~nav {
                display: flex;
            }

            #nav-toggle:checked~.menu-toggle span:nth-child(1) {
                transform: rotate(-45deg) translate(-5px, 6px);
            }

            #nav-toggle:checked~.menu-toggle span:nth-child(2) {
                opacity: 0;
            }

            #nav-toggle:checked~.menu-toggle span:nth-child(3) {
                transform: rotate(45deg) translate(-5px, -6px);
            }
        }
    </style>
</head>

<body>

    <header class="navbar">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img">
            The Nusantara
        </div>
        <input type="checkbox" id="nav-toggle" class="faq-toggle">
        <label for="nav-toggle" class="menu-toggle">
            <span></span><span></span><span></span>
        </label>
        <nav>
            <ul>
                <li><a href="{{ url('/#beranda') }}">Beranda</a></li>
                <li><a href="{{ url('/#tentang') }}">Tentang</a></li>
                <li class="nav-pulau-wrap">
                    <a href="#" class="nav-pulau-toggle" id="navPulauBtn">
                        Pulau
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                            style="margin-left:4px; vertical-align:middle; transition:transform 0.3s;">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </a>
                    <div class="pulau-dropdown" id="pulauDropdown">
                        <div class="pulau-dropdown-inner" id="pulauDropdownInner">
                            <div class="pulau-dropdown-loading">Memuat...</div>
                        </div>
                    </div>
                </li>
                <li><a href="{{ url('/#galeri') }}">Galeri</a></li>
                <li><a href="{{ url('/#faq') }}">FAQ</a></li>
                <li><a href="{{ url('/#kontak') }}">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <!-- HERO -->
    @php
        $heroBg = !empty($info['gambar'])
            ? asset('storage/foto/'.$info['gambar'])
            : (!empty($info['gambar_pulau'])
                ? asset('storage/foto/'.$info['gambar_pulau'])
                : asset('images/heroover.jpeg'));
    @endphp
    <section class="hero-section" style="background-image: url('{{ $heroBg }}')">
        <div class="hero-gradient"></div>
        <div class="hero-content">
            <p class="hero-title">{{ $info['judul'] }}</p>
            <p class="hero-subtitle">{{ $info['pulau'] }}</p>
        </div>
    </section>

    <div class="breadcrumb">
        <a href="{{ url('/') }}">Beranda</a>
        <span class="breadcrumb-sep">›</span>
        <a href="{{ route('pulau.show', (int)($info['pulau_id'] ?? 0)) }}">
            {{ $info['pulau'] }}
        </a>
        <span class="breadcrumb-sep">›</span>
        <span>{{ $info['judul'] }}</span>
    </div>

    <div class="detail-wrap">

        <!-- KIRI: Konten utama -->
        <div class="detail-left">

            <div class="content-block">
                <h2 class="section-title">{{ $info['judul'] }}</h2>
                <p class="content-text">
                    {!! nl2br(e(!empty($info['pengertian']) ? $info['pengertian'] : ($info['isi'] ?? '-'))) !!}
                </p>
                @if(!empty($info['gambar2']))
                    <div class="additional-gallery">
                        @php
                            $gambar_tambahan = [['file' => $info['gambar2'], 'caption' => $info['caption2'] ?? '']];
                        @endphp
                        @foreach($gambar_tambahan as $gt)
                            @if(!empty($gt['file']))
                                <div class="gallery-item">
                                    <div class="gallery-img-wrapper">
                                        <img src="{{ asset('storage/foto/'.$gt['file']) }}" class="gallery-img"
                                            alt="Foto Pendukung">
                                    </div>
                                    @if(!empty($gt['caption']))
                                        <div class="gallery-caption">{{ $gt['caption'] }}</div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            @if(!empty($info['asal_usul']))
                <div class="content-block">
                    <h2 class="section-title">Sejarah &amp; Asal Usul</h2>
                    <p class="content-text">{!! nl2br(e($info['asal_usul'])) !!}</p>
                </div>
            @endif

            @if(!empty($info['filosofi']))
                <div class="content-block">
                    <h2 class="section-title">Nilai &amp; Filosofi</h2>
                    <div class="filosofi-quote">
                        <p>{!! nl2br(e($info['filosofi'])) !!}</p>
                    </div>
                </div>
            @endif

            @if(!empty($info['gambar3']))
                <div class="content-block">
                    <div class="additional-gallery">
                        @php
                            $gambar_tambahan = [['file' => $info['gambar3'], 'caption' => $info['caption3'] ?? '']];
                        @endphp
                        @foreach($gambar_tambahan as $gt)
                            @if(!empty($gt['file']))
                                <div class="gallery-item">
                                    <div class="gallery-img-wrapper">
                                        <img src="{{ asset('storage/foto/'.$gt['file']) }}" class="gallery-img"
                                            alt="Foto Pendukung">
                                    </div>
                                    @if(!empty($gt['caption']))
                                        <div class="gallery-caption">{{ $gt['caption'] }}</div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            @if(!empty($info['cara_bermain']))
                <div class="content-block">
                    <h2 class="section-title">Bagaimana Cara Bermainnya?</h2>
                    <div class="content-steps">
                        <div class="content-step-text">{!! nl2br(e($info['cara_bermain'])) !!}</div>
                    </div>
                </div>
            @endif

        </div>

        <!-- KANAN: Sidebar -->
        <div class="detail-right">

            @if(!empty($permainanLain))
                <div>
                    <p class="sidebar-section-label">Permainan Lain di {{ $info['pulau'] }}</p>
                    <div class="mini-card-list">
                        @foreach($permainanLain as $lain)
                            <a href="{{ route('informasi.show', (int)$lain['id']) }}" class="mini-card">
                                <div class="mini-thumb">
                                    @if(!empty($lain['gambar']))
                                        <img src="{{ asset('storage/foto/'.$lain['gambar']) }}"
                                            alt="{{ $lain['judul'] }}">
                                    @else
                                        🎮
                                    @endif
                                </div>
                                <div class="mini-info">
                                    <div class="mini-name">{{ $lain['judul'] }}</div>
                                    <div class="mini-sub">
                                        {{ mb_substr($lain['keterangan'] ?? '', 0, 40) }}...
                                    </div>
                                </div>
                                <div class="mini-arrow">›</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <a href="{{ route('pulau.show', (int)($info['pulau_id'] ?? 0)) }}" class="sidebar-pulau-btn">
                <svg viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
                Lihat Semua di {{ $info['pulau'] }}
            </a>

        </div>
    </div>

    <footer class="footer" id="kontak">
        <div class="footer-top">
            <div class="footer-brand">
                <h3>The Nusantara</h3>
                <p>Ayo lestarikan permainan tradisional nusantara kita bersama.</p>
            </div>
            <div class="footer-col">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#tentang">Tentang</a></li>
                    <li><a href="#informasi">Pulau</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Jelajahi</h4>
                <ul>
                    <li><a href="#galeri">Galeri</a></li>
                    <li><a href="{{ route('galeri.index') }}">Semua Galeri</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Kontak</h4>
                <ul>
                    <li><a href="#masukan">Kritik & Saran</a></li>
                    <li><a href="mailto:thenusantara@gmail.com">Email Kami</a></li>
                    <li><a href="tel:+62847284802">Telepon</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Sosial</h4>
                <ul>
                    <li><a href="https://instagram.com" target="_blank">Instagram</a></li>
                    <li><a href="https://tiktok.com" target="_blank">TikTok</a></li>
                    <li><a href="https://facebook.com" target="_blank">Facebook</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 The Nusantara. Inspired by Pinterest. Edited by Zidane &amp; Alvin.</p>
        </div>
    </footer>

    <script>
        const navbar = document.querySelector('.navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        });
        navbar.classList.toggle('scrolled', window.scrollY > 60);


        // ====== PULAU DROPDOWN ======
        (function () {
            const btn = document.getElementById('navPulauBtn');
            const dropdown = document.getElementById('pulauDropdown');
            const inner = document.getElementById('pulauDropdownInner');
            const wrap = btn?.closest('.nav-pulau-wrap');
            if (!btn) return;

            let loaded = false;
            const CURRENT_ID = {{ $id }};

            function loadPulau() {
                if (loaded) return;
                loaded = true;
                fetch('{{ route('api.pulau') }}')
                    .then(r => r.json())
                    .then(data => {
                        inner.innerHTML = '';
                        data.forEach(p => {
                            const a = document.createElement('a');
                            a.href = '{{ url('/pulau') }}/' + p.id;
                            a.className = 'pulau-dropdown-item' + (p.id == CURRENT_ID ? ' active' : '');
                            a.innerHTML = `<span class="pulau-dot-item"></span>${p.nama}`;
                            inner.appendChild(a);
                        });
                    })
                    .catch(() => {
                        inner.innerHTML = '<div class="pulau-dropdown-loading">Gagal memuat.</div>';
                    });
            }

            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                const isOpen = dropdown.classList.contains('open');
                if (!isOpen) loadPulau();
                dropdown.classList.toggle('open');
                wrap.classList.toggle('open');
            });

            document.addEventListener('click', function (e) {
                if (!wrap.contains(e.target)) {
                    dropdown.classList.remove('open');
                    wrap.classList.remove('open');
                }
            });
        })();
    </script>

</body>

</html>
