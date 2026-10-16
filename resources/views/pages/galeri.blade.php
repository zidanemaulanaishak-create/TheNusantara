<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTN | Galeri Permainan Tradisional</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet">
    <style>
        /* ====== CSS VARIABLES ====== */
        :root {
            --brown: #58290D;
            --brown-mid: #7a3c18;
            --brown-dark: #3d1b08;
            --gold: #c8922a;
            --gold-light: #e8b86d;
            --cream-2: #e4dcd1;
            --cream-3: #FBF8F3;
            --muted: #9c7355;
            --border: rgba(88, 41, 13, 0.15);
            --ink: #1a0a02;
        }

        /* ====== RESET ====== */
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
            backdrop-filter: blur(16px);
            box-shadow: 0 1px 0 rgba(88, 41, 13, 0.1);
            background: rgba(228, 220, 209, 0.95);
            transition: background 0.4s, padding 0.4s, box-shadow 0.4s;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--brown);
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
            color: var(--brown);
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

        /* ====== GALLERY WRAP ====== */
        .gallery-wrap {
            padding: 120px 120px;
            max-width: 1800px;
            margin: 0 auto;
            flex: 1;
            width: 100%;
        }

        .gallery-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 36px;
        }

        .gallery-label {
            font-size: 10px;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 700;
            margin-bottom: 6px;
        }

        .gallery-title {
            font-family: "DM Serif Display", serif;
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            color: var(--brown-dark);
        }

        .gallery-count {
            font-size: 12px;
            color: var(--muted);
        }

        .gallery-count strong {
            font-family: "DM Serif Display", serif;
            font-size: 2.5rem;
            color: var(--brown);
            display: block;
            line-height: 1;
        }

        /* ====== MASONRY GRID ====== */
        .masonry-grid {
            columns: 5 220px;
            column-gap: 16px;
        }

        .masonry-item {
            break-inside: avoid;
            margin-bottom: 16px;
            position: relative;
            border-radius: 18px;
            overflow: hidden;
            cursor: pointer;
            display: block;
        }

        .masonry-item img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 18px;
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94), filter 0.4s;
            filter: saturate(0.85);
        }

        .masonry-item:hover img {
            transform: scale(1.04);
            filter: saturate(1) brightness(0.85);
        }

        /* Overlay saat hover */
        .masonry-item-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(26, 10, 2, 0.75) 0%, transparent 55%);
            border-radius: 18px;
            opacity: 0;
            transition: opacity 0.3s;
            display: flex;
            align-items: flex-end;
            padding: 18px 16px;
        }

        .masonry-item:hover .masonry-item-overlay {
            opacity: 1;
        }

        .masonry-item-label {
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            letter-spacing: 0.04em;
            line-height: 1.3;
        }

        /* Save button (Pinterest style) */
        .masonry-item-save {
            position: absolute;
            top: 12px;
            right: 12px;
            background: var(--gold);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 7px 16px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            opacity: 0;
            transform: translateY(-4px);
            transition: opacity 0.25s, transform 0.25s, background 0.2s;
            font-family: "Poppins", sans-serif;
            letter-spacing: 0.06em;
        }

        .masonry-item:hover .masonry-item-save {
            opacity: 1;
            transform: translateY(0);
        }

        .masonry-item-save:hover {
            background: var(--brown-dark);
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 80px 0;
            color: var(--muted);
        }

        /* ====== FOOTER ====== */
        footer {
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

        /* ========== MEDIA QUERIES ========== */
        @media (max-width: 1024px) {
            .navbar {
                padding: 15px 5%;
                max-width: 95%;
                top: 10px;
            }

            .navbar nav ul {
                gap: 20px;
            }

            .hero-section {
                height: 600px;
            }

            .hero-overlay h1 {
                font-size: 3em;
            }

            .hero-overlay p {
                font-size: 1.2em;
            }

            .info-section {
                padding: 60px 6%;
            }

            .image-gallery {
                width: 100%;
            }

            .img-placeholder {
                height: 220px;
            }

            .island-category-section .section-header {
                padding: 0 6%;
            }

            .slider-wrapper {
                padding: 0 60px;
            }

            .slider-btn-left {
                left: 4px;
            }

            .slider-btn-right {
                right: 4px;
            }

            /* 3 kartu per halaman di tablet */
            .island-card {
                flex: 0 0 calc((100vw - 120px - 48px) / 3);
                max-width: 280px;
            }

            .gallery-section {
                flex-direction: column;
                padding: 60px 8%;
            }

            .gallery-image-wrap img {
                height: 280px;
            }

            .faq-section {
                padding: 60px 5%;
            }

            .faq-grid {
                grid-template-columns: 1fr;
            }

            .contact-section {
                flex-direction: column;
                padding: 60px 8%;
            }

            .footer-top {
                flex-wrap: wrap;
            }

            .footer-brand {
                flex: 100%;
            }
        }

        @media (max-width: 600px) {
            .navbar nav {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 80px;
                left: 5%;
                right: 5%;
                background-color: #e4dcd1;
                border: 1px solid #1e1e1e;
                border-radius: 10px;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                z-index: 90;
            }

            .navbar nav ul {
                flex-direction: column;
                padding: 10px 0;
            }

            .navbar nav ul a {
                padding: 10px 20px;
                width: 100%;
                text-align: center;
            }

            .menu-toggle {
                display: block;
                cursor: pointer;
                padding: 5px;
            }

            .menu-toggle span {
                display: block;
                width: 25px;
                height: 3px;
                background-color: #1e1e1e;
                margin: 5px 0;
                transition: 0.4s;
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

            .hero-section {
                height: 400px;
                margin-top: -60px;
            }

            .hero-overlay h1 {
                font-size: 2.5em;
            }

            .hero-overlay p {
                font-size: 1em;
                letter-spacing: 3px;
            }

            .slider-wrapper {
                padding: 0 48px;
            }

            /* 2 kartu per halaman di mobile */
            .island-card {
                flex: 0 0 calc((100vw - 96px - 24px) / 2);
                min-width: 140px;
            }

            .slider-btn {
                width: 40px;
                height: 40px;
            }

            .gallery-text h2 {
                font-size: 1.8em;
            }

            .faq-header h2 {
                font-size: 1.6em;
            }

            .contact-left h2 {
                font-size: 1.8em;
            }

            .footer-top {
                flex-direction: column;
                gap: 25px;
            }
        }
    </style>
</head>

<body>

    <!-- ====== NAVBAR ====== -->
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
                <li><a href="{{ url('/#informasi') }}">Pulau</a></li>
                <li><a href="{{ url('/#galeri') }}">Galeri</a></li>
                <li><a href="{{ url('/#faq') }}">FAQ</a></li>
                <li><a href="{{ url('/#kontak') }}">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <!-- ====== GALLERY CONTENT ====== -->
    <div class="gallery-wrap">
        <div class="gallery-header">
            <div class="gallery-header-left">
                <h2 class="gallery-title">Permainan Tradisional Nusantara</h2>
            </div>
            <div style="display:flex; align-items:center; gap:16px;">
                <!-- Search bar -->
                <div
                    style="display:flex; align-items:center; background:var(--cream-3); border:1.5px solid var(--border); border-radius:50px; overflow:hidden; padding:4px 4px 4px 16px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="#9c7355" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        style="flex-shrink:0; margin-right:8px;">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input type="text" id="searchInput" placeholder="Cari permainan..."
                        style="border:none; outline:none; background:transparent; font-family:'Poppins',sans-serif; font-size:13px; color:var(--ink); width:180px; padding:6px 0;">
                    <button onclick="filterGallery()"
                        style="flex-shrink:0; padding:8px 18px; background:var(--brown-dark); border:none; border-radius:50px; cursor:pointer; font-family:'Poppins',sans-serif; font-size:11px; font-weight:700; color:#ead3af; letter-spacing:0.08em; text-transform:uppercase;">
                        Cari
                    </button>
                </div>
            </div>
        </div>

        @if(!empty($gambarData))
            <div class="masonry-grid" id="masonryGrid">
                @foreach($gambarData as $item)
                    <div class="masonry-item" data-label="{{ $item['judul'] }}">
                        <img src="{{ asset('storage/foto/'.$item['gambar']) }}"
                            alt="{{ $item['judul'] }}" loading="lazy">
                        <div class="masonry-item-overlay">
                            <div>
                                <div class="masonry-item-label">{{ $item['judul'] }}</div>
                                <div
                                    style="font-size:11px; color:rgba(255,255,255,0.6); margin-top:3px; letter-spacing:0.1em; text-transform:uppercase;">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <p style="font-size:3rem; margin-bottom:16px;">📷</p>
                <p>Belum ada foto tersedia.</p>
            </div>
        @endif
    </div>

    <!-- ====== FOOTER ====== -->
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
        // ====== Filter / Search Gallery ======
        function filterGallery() {
            const q = document.getElementById('searchInput').value.toLowerCase();
            const items = document.querySelectorAll('.masonry-item');

            items.forEach(item => {
                const label = item.dataset.label.toLowerCase();
                item.style.display = label.includes(q) ? 'block' : 'none';
            });
        }

        // Enter key → trigger search
        document.getElementById('searchInput').addEventListener('keydown', e => {
            if (e.key === 'Enter') filterGallery();
        });

        // Live search saat mengetik
        document.getElementById('searchInput').addEventListener('input', filterGallery);
    </script>

</body>

</html>
