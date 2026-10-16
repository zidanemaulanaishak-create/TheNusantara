<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTN | Permainan Tradisional {{ $pulau['nama'] }}</title>
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

        .pulau-dropdown-inner a.pulau-dropdown-item {
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

        .pulau-dropdown-inner a.pulau-dropdown-item:hover {
            background: rgba(200, 146, 42, 0.1);
            color: #58290D;
        }

        .pulau-dropdown-inner a.pulau-dropdown-item.active {
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

        /* ====== HERO ====== */
        .hero-section {
            height: 75vh;
            min-height: 680px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('{{ !empty($pulau['herosection']) ? asset('storage/foto/'.$pulau['herosection']) : asset('images/heroover.jpeg') }}');
            background-size: cover;
            background-position: center;
            filter: blur(6px);
            transform: scale(1.05);
            z-index: 0;
        }

        .hero-gradient {
            position: absolute;
            inset: 0;
            z-index: 1;
            background: linear-gradient(to top,
                    rgba(26, 10, 2, 0.92) 0%,
                    rgba(26, 10, 2, 0.4) 50%,
                    rgba(0, 0, 0, 0.15) 100%);
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

        .hero-title em {
            color: #ead3af;
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

        /* ====== ISLAND INFO BANNER ====== */
        .island-info-banner {
            padding: 100px 8%;
            display: flex;
            align-items: center;
            gap: 60px;
        }

        .island-info-text {
            flex: 1;
        }

        .info-label {
            font-size: 14px;
            letter-spacing: 0.24em;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .info-title {
            font-family: "DM Serif Display", serif;
            font-size: clamp(2rem, 4vw, 3.2rem);
            color: var(--brown);
            margin-bottom: 16px;
            line-height: 1.1;
        }

        .info-desc {
            font-size: 16px;
            color: rgba(58, 28, 10, 0.78);
            line-height: 1.85;
            max-width: 800px;
        }

        .island-info-img {
            flex-shrink: 0;
            width: 440px;
            height: 320px;
            object-fit: cover;
            border-radius: 14px;
            box-shadow: 0 20px 60px rgba(26, 10, 2, 0.2);
        }

        /* ====== SECTION HEADER ====== */
        .content-wrap {
            padding: 70px 8% 120px;
        }

        .grid-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-bottom: 28px;
        }

        .grid-header::before,
        .grid-header::after {
            content: '';
            flex: 1;
            height: 1.5px;
            background: var(--brown);
            opacity: 0.3;
        }

        .grid-title {
            font-family: "DM Serif Display", serif;
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            color: var(--brown);
            white-space: nowrap;
            font-weight: 400;
        }

        .grid-count {
            font-size: 11px;
            color: var(--muted);
            letter-spacing: 0.06em;
            white-space: nowrap;
        }

        .grid-count strong {
            color: var(--gold);
            font-weight: 700;
        }

        /* ====== SEARCH BAR ====== */
        .content-search {
            margin-bottom: 44px;
        }

        .content-search-form {
            display: flex;
            align-items: center;
            background: var(--cream-3);
            border: 1.5px solid var(--border);
            border-radius: 50px;
            overflow: hidden;
            max-width: 560px;
            margin: 0 auto;
            transition: border-color 0.25s, box-shadow 0.25s;
        }

        .content-search-form:focus-within {
            border-color: rgba(200, 146, 42, 0.5);
            box-shadow: 0 0 0 3px rgba(200, 146, 42, 0.08);
        }

        .content-search-form svg {
            flex-shrink: 0;
            margin-left: 16px;
            color: var(--muted);
        }

        .content-search-form input[type="text"] {
            flex: 1;
            padding: 13px 14px;
            background: transparent;
            border: none;
            outline: none;
            font-family: "Poppins", sans-serif;
            font-size: 13px;
            color: var(--ink);
        }

        .content-search-form input[type="text"]::placeholder {
            color: var(--muted);
        }

        .search-clear {
            flex-shrink: 0;
            padding: 0 10px;
            font-size: 13px;
            color: var(--muted);
            cursor: pointer;
            transition: color 0.2s;
            line-height: 1;
            text-decoration: none;
        }

        .search-clear:hover {
            color: var(--brown);
        }

        .content-search-form button {
            flex-shrink: 0;
            padding: 13px 20px;
            background: var(--brown-dark);
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-family: "Poppins", sans-serif;
            font-size: 11px;
            font-weight: 700;
            color: #ead3af;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            transition: background 0.2s;
        }

        .content-search-form button:hover {
            background: var(--brown-mid);
        }

        /* ====== SLIDER ====== */
        .slider-outer {
            position: relative;
            padding: 0 68px;
        }

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-60%);
            z-index: 10;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--brown-dark);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
            transition: background 0.25s, transform 0.2s, opacity 0.25s;
        }

        .slider-btn:hover {
            background: var(--brown-mid);
            transform: translateY(-60%) scale(1.08);
        }

        .slider-btn.disabled {
            opacity: 0.3;
            pointer-events: none;
        }

        .slider-btn svg {
            width: 20px;
            height: 20px;
            stroke: #ead3af;
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .slider-btn-left {
            left: 0;
        }

        .slider-btn-right {
            right: 0;
        }

        .cards-track {
            display: flex;
            gap: 24px;
            padding: 8px 4px 28px;
            overflow-x: auto;
            scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .cards-track::-webkit-scrollbar {
            display: none;
        }

        .slider-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #c4a882;
            border: none;
            cursor: pointer;
            padding: 0;
            transition: background 0.3s, transform 0.2s, width 0.3s;
        }

        .dot.active {
            background: #3d1b08;
            transform: scale(1.2);
            width: 24px;
            border-radius: 4px;
        }

        /* ====== GAME CARD ====== */
        .game-card {
            flex: 0 0 calc((100% - 48px) / 3);
            max-width: 400px;
            min-width: 220px;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            scroll-snap-align: start;
            text-decoration: none;
            color: inherit;
            position: relative;
            background: #f8f0e6;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .game-card:hover {
            box-shadow: 0 16px 40px rgba(26, 10, 2, 0.18);
            transform: translateY(-4px);
        }

        .game-card-img-wrap {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
            background: #d5c5a8;
            flex-shrink: 0;
        }

        .game-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.55s cubic-bezier(0.25, 0.46, 0.45, 0.94), filter 0.4s;
            filter: saturate(0.9);
        }

        .game-card:hover .game-card-img {
            transform: scale(1.05);
            filter: saturate(1);
        }

        .game-card-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            background: linear-gradient(135deg, #d8c4a0, #c4a97a);
        }

        .game-card-body {
            padding: 18px 18px 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex: 1;
        }

        .game-card-name {
            font-family: "Poppins", sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #1a0a02;
            line-height: 1.3;
            margin: 0;
        }

        .game-card-tags {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .game-tag {
            font-size: 10px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 700;
            color: var(--brown);
            border: 1px solid rgba(88, 41, 13, 0.25);
            padding: 3px 10px;
            border-radius: 4px;
            background: rgba(88, 41, 13, 0.05);
        }

        .game-card-desc {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.7;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .game-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 12px;
            border-top: 1px solid var(--border);
            margin-top: auto;
        }

        .game-card-island {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .island-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #58290dc9;
            flex-shrink: 0;
        }

        .island-label {
            font-size: 12px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #58290dc9;
            font-weight: 600;
        }

        .game-card-cta {
            font-size: 10px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            font-weight: 700;
            color: #58290D;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: gap 0.2s, color 0.2s;
        }

        .game-card:hover .game-card-cta {
            gap: 10px;
            color: var(--gold);
        }

        .cta-arrow {
            width: 22px;
            height: 1.5px;
            background: currentColor;
            position: relative;
            transition: width 0.2s;
        }

        .cta-arrow::after {
            content: '';
            position: absolute;
            right: -1px;
            top: -3px;
            border-top: 3.5px solid transparent;
            border-bottom: 3.5px solid transparent;
            border-left: 5px solid currentColor;
        }

        .game-card:hover .cta-arrow {
            width: 32px;
        }

        .empty-state {
            text-align: center;
            padding: 100px 0;
            color: var(--muted);
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
            .island-info-banner {
                padding: 50px 6%;
                gap: 40px;
            }

            .island-info-img {
                width: 340px;
                height: 260px;
            }

            .content-wrap {
                padding: 60px 6% 80px;
            }

            .slider-outer {
                padding: 0 56px;
            }

            .footer {
                padding: 50px 6%;
            }
        }

        @media (max-width: 860px) {
            .island-info-banner {
                flex-direction: column;
            }

            .island-info-img {
                width: 100%;
                height: 260px;
            }

            .game-card {
                flex: 0 0 calc((100% - 24px) / 2);
            }

            .footer-top {
                flex-wrap: wrap;
            }

            .footer-brand {
                flex: 100%;
            }
        }

        @media (max-width: 600px) {
            .game-card {
                flex: 0 0 85%;
            }

            .game-card-img-wrap {
                height: 180px;
            }

            .hero-title {
                font-size: 2.6rem;
            }

            .slider-outer {
                padding: 0 44px;
            }

            .content-wrap {
                padding: 40px 5% 60px;
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

    <!-- NAVBAR -->
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
    <section class="hero-section">
        <div class="hero-gradient"></div>
        <div class="hero-content">
            <p class="hero-title">{{ $pulau['nama'] }}</p>
            <p class="hero-subtitle">{{ $pulau['keterangan'] }}</p>
        </div>
    </section>

    <!-- ISLAND INFO BANNER -->
    <div class="island-info-banner">
        <div class="island-info-text">
            <p class="info-label">Koleksi Permainan &middot; {{ $pulau['nama'] }} &middot; Indonesia
            </p>
            <h2 class="info-title">Pulau {{ $pulau['nama'] }}</h2>
            <p class="info-desc">
                {{ !empty($pulau['deskripsi'])
                    ? $pulau['deskripsi']
                    : 'Temukan kekayaan warisan leluhur melalui permainan tradisional yang telah diwariskan turun-temurun. Setiap permainan menyimpan nilai filosofi, kebersamaan, dan kecerdasan lokal yang tak ternilai harganya.' }}
            </p>
        </div>
        @if(!empty($pulau['gambar']))
            <img src="{{ asset('storage/foto/'.$pulau['gambar']) }}" alt="{{ $pulau['nama'] }}"
                class="island-info-img">
        @endif
    </div>

    <!-- MAIN CONTENT -->
    <div class="content-wrap">
        <div class="grid-header">
            <h3 class="grid-title">Temukan Permainan Tradisional di Pulau {{ $pulau['nama'] }}</h3>
        </div>

        <!-- SEARCH BAR -->
        <div class="content-search" id="search-section">
            <form method="GET" action="" class="content-search-form" id="searchForm">
                <input type="hidden" name="id" value="{{ $id }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
                <input type="text" name="search"
                    placeholder="Cari permainan tradisional di {{ $pulau['nama'] }}..."
                    value="{{ $search }}">
                @if($search)
                    <a href="{{ route('pulau.show', $id) }}" class="search-clear" title="Hapus pencarian">✕</a>
                @endif
                <button type="submit">Cari</button>
            </form>
        </div>

        @if(!empty($infoData))
            <div class="slider-outer">
                <button class="slider-btn slider-btn-left" id="btnLeft" aria-label="Scroll kiri">
                    <svg viewBox="0 0 24 24">
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                </button>

                <div class="cards-track" id="cardsTrack">
                    @foreach($infoData as $info)
                        <a class="game-card" href="{{ route('informasi.show', $info['id']) }}">
                            <div class="game-card-img-wrap">
                                @if(!empty($info['gambar']))
                                    <img src="{{ asset('storage/foto/'.$info['gambar']) }}"
                                        alt="{{ $info['judul'] }}" class="game-card-img" loading="lazy">
                                @else
                                    <div class="game-card-placeholder"></div>
                                @endif
                            </div>
                            <div class="game-card-body">
                                <h4 class="game-card-name">{{ $info['judul'] }}</h4>
                                <div class="game-card-tags">
                                    <span class="game-tag">Pengertian</span>
                                    <span class="game-tag">Filosofi</span>
                                    <span class="game-tag">Cara Bermain</span>
                                </div>
                                <p class="game-card-desc">
                                    {{ !empty($info['keterangan'])
                                        ? $info['keterangan']
                                        : 'Permainan tradisional warisan leluhur nusantara yang penuh nilai budaya dan filosofi.' }}
                                </p>
                                <div class="game-card-footer">
                                    <div class="game-card-island">
                                        <div class="island-dot"></div>
                                        <span class="island-label">{{ $pulau['nama'] }}</span>
                                    </div>
                                    <div class="game-card-cta">
                                        Lihat <span class="cta-arrow"></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <button class="slider-btn slider-btn-right" id="btnRight" aria-label="Scroll kanan">
                    <svg viewBox="0 0 24 24">
                        <polyline points="9 18 15 12 9 6" />
                    </svg>
                </button>
            </div>
            <div class="slider-dots" id="sliderDots"></div>

        @else
            <div class="empty-state">
                <p>Belum ada permainan{!! $search ? " untuk &ldquo;" . e($search) . "&rdquo;" : "" !!}.</p>
            </div>
        @endif
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-top">
            <div class="footer-brand">
                <h3>The Nusantara</h3>
                <p>Ayo lestarikan permainan tradisional nusantara kita bersama.</p>
            </div>
            <div class="footer-col">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="{{ url('/#beranda') }}">Beranda</a></li>
                    <li><a href="{{ url('/#tentang') }}">Tentang</a></li>
                    <li><a href="{{ url('/#informasi') }}">Pulau</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Jelajahi</h4>
                <ul>
                    <li><a href="{{ url('/#galeri') }}">Galeri</a></li>
                    <li><a href="{{ route('galeri.index') }}">Semua Galeri</a></li>
                    <li><a href="{{ url('/#faq') }}">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Kontak</h4>
                <ul>
                    <li><a href="{{ url('/#masukan') }}">Kritik & Saran</a></li>
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
        const track = document.getElementById('cardsTrack');
        const btnLeft = document.getElementById('btnLeft');
        const btnRight = document.getElementById('btnRight');
        const dotsWrap = document.getElementById('sliderDots');
        const VISIBLE = 3;

        if (track && btnLeft && btnRight) {
            function cardW() {
                const c = track.querySelector('.game-card');
                if (!c) return 300;
                return c.offsetWidth + parseInt(getComputedStyle(track).gap || 24);
            }
            function scrollAmt() { return cardW() * VISIBLE; }

            btnRight.addEventListener('click', () => track.scrollBy({ left: scrollAmt(), behavior: 'smooth' }));
            btnLeft.addEventListener('click', () => track.scrollBy({ left: -scrollAmt(), behavior: 'smooth' }));

            function buildDots() {
                dotsWrap.innerHTML = '';
                const total = track.querySelectorAll('.game-card').length;
                const pages = Math.ceil(total / VISIBLE);
                if (pages <= 1) { dotsWrap.style.display = 'none'; return; }
                dotsWrap.style.display = 'flex';
                for (let i = 0; i < pages; i++) {
                    const d = document.createElement('button');
                    d.className = 'dot' + (i === 0 ? ' active' : '');
                    d.setAttribute('aria-label', 'Halaman ' + (i + 1));
                    d.addEventListener('click', () => {
                        track.scrollTo({ left: cardW() * VISIBLE * i, behavior: 'smooth' });
                    });
                    dotsWrap.appendChild(d);
                }
            }

            function updateDots() {
                const dots = dotsWrap.querySelectorAll('.dot');
                if (!dots.length) return;
                const page = Math.round(track.scrollLeft / scrollAmt());
                dots.forEach((d, i) => d.classList.toggle('active', i === page));
            }

            function updateBtns() {
                btnLeft.classList.toggle('disabled', track.scrollLeft <= 0);
                btnRight.classList.toggle('disabled', track.scrollLeft + track.clientWidth >= track.scrollWidth - 2);
            }

            track.addEventListener('scroll', () => { updateDots(); updateBtns(); });
            window.addEventListener('resize', () => { buildDots(); updateBtns(); });
            buildDots();
            updateBtns();
        }

        /* ====== NAVBAR SCROLL ====== */
        const navbar = document.querySelector('.navbar');
        function updateNavbar() {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        }
        window.addEventListener('scroll', updateNavbar);
        updateNavbar();

        const searchForm = document.getElementById('searchForm');

        if (searchForm) {
            searchForm.addEventListener('submit', function () {
                sessionStorage.setItem('pulau_scroll_pos', window.scrollY);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const savedPos = sessionStorage.getItem('pulau_scroll_pos');
            if (savedPos !== null) {
                window.scrollTo({ top: parseInt(savedPos), behavior: 'instant' });
                sessionStorage.removeItem('pulau_scroll_pos');
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            (function () {
                const btn = document.getElementById('navPulauBtn');
                const dropdown = document.getElementById('pulauDropdown');
                const inner = document.getElementById('pulauDropdownInner');
                const wrap = btn?.closest('.nav-pulau-wrap');
                if (!btn || !wrap) return;

                let loaded = false;
                const CURRENT_ID = {{ (int)($id ?? 0) }};

                function loadPulau() {
                    if (loaded) return;
                    fetch('{{ route('api.pulau') }}')
                        .then(r => r.json())
                        .then(data => {
                            loaded = true;
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
                            loaded = false;
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
        });
    </script>
</body>

</html>
