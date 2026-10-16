<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PTN | Permainan Tradisional Nusantara</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Baskervville+SC:wght@400..700&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&family=Baskervville+SC:wght@400..700&display=swap");

        :root {
            --color-primary: #1e1e1e;
            --color-secondary: #d9d9d9;
            --color-accent: #daa520;
            --color-text-light: #f5f5dc;
            --color-text-dark: #333;
            --color-body-bg: #e4dcd1;
            --color-brown-dark: #58290d;
            --color-brown-section: #7b4f2e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--color-body-bg);
            color: var(--color-text-dark);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        /* ========== NAVBAR ========== */
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
            color: #58290D;
        }

        .faq-toggle,
        .menu-toggle {
            display: none;
        }

        /* ========== HERO ========== */
        .hero-section {
            height: 90vh;
            background-image: url("{{ asset('images/heroover.jpeg') }}");
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .hero-overlay {
            font-family: "Baskervville SC", serif;
            color: white;
            padding: 40px;
        }

        .hero-overlay p {
            font-size: 3em;
            letter-spacing: 5px;
            margin-bottom: 5px;
        }

        .hero-overlay h1 {
            font-size: 6em;
            margin: 10px 0;
            border-top: 2px solid white;
            border-bottom: 2px solid white;
            padding: 10px 0;
        }

        /* ========== INFO SECTION (Tentang) ========== */
        .info-section {
            position: relative;
            display: flex;
            align-items: center;
            padding: 180px 120px;
            overflow: hidden;
            gap: 60px;
        }

        .image-gallery {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 200px 200px;
            gap: 25px;
            order: 1;
        }

        .img-placeholder {
            background-size: cover;
            background-position: center;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s;
        }

        .img-placeholder:hover {
            transform: scale(1.02);
        }

        .img-placeholder:first-child {
            grid-row: 1 / 3;
            border-radius: 16px;
        }

        .text-content {
            flex: 1;
            color: #58290d;
            order: 2;
        }

        .text-content .sub-judul {
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #58290d;
            margin-bottom: 12px;
        }

        .text-content h2 {
            font-family: "Poppins";
            font-size: 55px;
            font-weight: 600;
            color: #58290d;
            margin-bottom: 20px;
            line-height: 1.1;
        }

        .text-content p {
            font-size: 18px;
            line-height: 1.9;
            color: #58290d;
            margin-bottom: 0;
        }

        .info-divider {
            width: 635px;
            height: 3px;
            background-color: #58290d;
            border-radius: 2px;
            margin: 24px 0;
        }

        /* ========== KATEGORI PULAU — HORIZONTAL SCROLL ========== */
        .island-category-section {
            background-color: var(--color-body-bg);
            padding: 80px 120px;
            text-align: center;
        }

        .island-category-section .section-header {
            padding: 0 120px;
            margin-bottom: 50px;
        }

        .island-category-section .section-title {
            font-size: 18px;
            font-weight: 500;
            color: #58290D;
            letter-spacing: 5px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .island-category-section .section-subtitle {
            font-family: "Poppins";
            font-size: 45px;
            color: #58290D;
            margin-bottom: 0;
            font-weight: 600;
        }

        .slider-wrapper {
            position: relative;
            padding: 0 120px;
        }

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background-color: #58290D;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
            transition: background-color 0.3s, transform 0.2s;
            flex-shrink: 0;
        }

        .slider-btn:hover {
            background-color: #a0672a;
            transform: translateY(-50%) scale(1.08);
        }

        .slider-btn svg {
            width: 22px;
            height: 22px;
            stroke: #ead3af;
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .slider-btn-left {
            left: 14px;
        }

        .slider-btn-right {
            right: 14px;
        }

        .island-cards-track {
            display: flex;
            gap: 24px;
            overflow-x: auto;
            scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
            padding: 10px 4px 24px;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .island-cards-track::-webkit-scrollbar {
            display: none;
        }

        .island-card {
            flex: 0 0 calc((100vw - 160px - 72px) / 4);
            max-width: 320px;
            min-width: 200px;
            background-color: #ead3afa8;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #58290D;
            display: flex;
            flex-direction: column;
            align-items: center;
            aspect-ratio: 1 / 1;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            text-decoration: none;
            scroll-snap-align: start;
        }

        .island-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
        }

        .island-card-img-wrap {
            width: 100%;
            height: 70%;
            border-bottom: 1px solid #58290D;
            background-color: #ead3afa8;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .island-map-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .island-card-body {
            padding: 16px 20px 0;
            width: 100%;
            word-break: break-word;
            overflow-wrap: break-word;
            text-align: left;
        }

        .island-card-name {
            font-size: 18px;
            font-weight: 700;
            color: #5c3317;
            letter-spacing: 2px;
        }

        .island-card-desc {
            font-size: 14px;
            color: #5c3317;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.6;
        }

        .slider-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 28px;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #c4a882;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            padding: 0;
        }

        .dot.active {
            background-color: #58290D;
            transform: scale(1.3);
        }

        /* ========== GALERI SECTION ========== */
        .gallery-section {
            padding: 140px 120px;
            background-color: var(--color-body-bg);
            display: flex;
            align-items: center;
            gap: 60px;
        }

        .gallery-text {
            flex: 1.1;
        }

        .gallery-text h2 {
            font-size: 50px;
            font-weight: 600;
            color: #683615;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .gallery-text p {
            font-size: 20px;
            color: #683615;
            line-height: 1.75;
            margin-bottom: 30px;
        }

        .gallery-image-wrap {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 220px 220px;
            gap: 25px;
        }

        .gallery-image-wrap img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s;
        }

        .gallery-image-wrap img:hover {
            transform: scale(1.03);
            filter: brightness(0.9);
        }

        .gallery-image-wrap img:first-child {
            grid-row: 1 / 3;
            height: 100%;
            border-radius: 16px;
        }

        .btn-gallery-more {
            display: inline-block;
            background-color: #ead9bebe;
            color: #683615;
            border: 1px solid #683615;
            padding: 9px 28px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn-gallery-more:hover {
            transform: translateY(-5px);
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.3);
        }

        /* ========== FAQ SECTION ========== */
        .faq-section {
            padding: 100px 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
            scroll-margin-top: 100px;
            background-color: var(--color-body-bg);
        }

        .faq-header {
            text-align: center;
            margin-bottom: 56px;
        }

        .faq-header .faq-label {
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #58290D;
            margin-bottom: 10px;
        }

        .faq-header h2 {
            font-size: 44px;
            font-weight: 700;
            color: #58290D;
            line-height: 1.2;
            margin-bottom: 14px;
        }

        .faq-header p {
            font-size: 17px;
            color: #58290D;
            opacity: 0.6;
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .faq-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            width: 100%;
            max-width: 1040px;
        }

        .faq-item {
            border-radius: 14px;
            background-color: #ead9bebe;
            overflow: hidden;
            border: 1px solid #58290D;
            box-shadow: 0 2px 12px rgba(88, 41, 13, 0.08);
            transition: box-shadow 0.2s;
        }

        .faq-item:hover {
            box-shadow: 0 4px 20px rgba(88, 41, 13, 0.15);
        }

        .faq-toggle-cb {
            display: none;
        }

        .faq-question {
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            font-size: 17px;
            color: #58290D;
            gap: 14px;
            user-select: none;
        }

        .faq-question span {
            flex-grow: 1;
        }

        .faq-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #58290D;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform 0.3s;
            font-style: normal;
            font-size: 13px;
            color: #ead3af;
        }

        .faq-toggle-cb:checked+.faq-question .faq-icon {
            transform: rotate(180deg);
        }

        .faq-toggle-cb:checked+.faq-question {
            border-bottom: 1px solid #58290D;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease, padding 0.3s ease;
            color: #58290D;
            word-break: break-word;
            overflow-wrap: break-word;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.75;
            padding: 0 24px;
            opacity: 0.8;
        }

        .faq-toggle-cb:checked+.faq-question+.faq-answer {
            max-height: 300px;
            padding: 12px 24px 20px;
        }

        /* ========== CONTACT ========== */
        .contact-section {
            padding: 120px 120px;
            background-color: var(--color-body-bg);
            display: flex;
            gap: 80px;
            align-items: center;
            scroll-margin-top: 100px;
        }

        .contact-left {
            flex: 1;
        }

        .contact-left h2 {
            font-size: 45px;
            font-weight: 800;
            color: #58290D;
            line-height: 1.25;
            margin-bottom: 15px;
        }

        .contact-left p {
            font-size: 20px;
            color: #58290D;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .contact-label {
            font-size: 18px;
            font-weight: 700;
            color: #58290D;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .contact-info-item {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
            font-size: 18px;
            color: #58290D;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            background-color: #58290D;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .contact-right {
            flex: 1.1;
        }

        #beranda,
        #tentang,
        #informasi,
        #galeri,
        #faq,
        #masukan,
        #kontak {
            scroll-margin-top: 100px;
        }

        .contact-form-card {
            background-color: #ccbb9fbe;
            border-radius: 24px;
            padding: 40px 38px;
            border: 1px solid #58290D;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .contact-form-card label {
            display: block;
            color: #58290D;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            margin-top: 20px;
        }

        .contact-form-card label:first-child {
            margin-top: 0;
        }

        .contact-form-card input[type="text"],
        .contact-form-card input[type="email"],
        .contact-form-card textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #3a3030;
            border-radius: 12px;
            background-color: #ead9bebe;
            color: #58290D;
            font-family: "Poppins", sans-serif;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
        }

        .contact-form-card input[type="text"]:focus,
        .contact-form-card input[type="email"]:focus,
        .contact-form-card textarea:focus {
            border-color: #a0672a;
        }

        .contact-form-card input[type="text"],
        .contact-form-card input[type="email"] {
            height: 48px;
        }

        .contact-form-card textarea {
            height: 120px;
            resize: none;
        }

        .contact-form-card input::placeholder,
        .contact-form-card textarea::placeholder {
            color: #58290D;
        }

        .form-bottom-row {
            display: flex;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .kirim-btn {
            background-color: #ead9bebe;
            color: #58290D;
            border: 2px solid #58290D;
            border-radius: 50px;
            padding: 12px 36px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            letter-spacing: 0.5px;
        }

        .kirim-btn:hover {
            background-color: #a0672a;
            color: #ead3af;
        }

        /* ========== FOOTER ========== */
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
    <!-- ===== NAVBAR ===== -->
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
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#informasi">Pulau</a></li>
                <li><a href="#galeri">Galeri</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <!-- ===== HERO ===== -->
    <section class="hero-section" id="beranda">
        <div class="hero-overlay">
            <p>PERMAINAN</p>
            <h1>TRADISIONAL</h1>
            <p>NUSANTARA</p>
        </div>
    </section>

    <!-- ===== INFO / TENTANG ===== -->
    <section class="info-section" id="tentang">
        <div class="image-gallery">
            @if(!empty($tentang['gambar']))
                <div class="img-placeholder"
                    style="background-image: url('{{ asset('storage/foto/'.$tentang['gambar']) }}')"></div>
            @endif
            @if(!empty($tentang['gambar2']))
                <div class="img-placeholder"
                    style="background-image: url('{{ asset('storage/foto/'.$tentang['gambar2']) }}')"></div>
            @endif
            @if(!empty($tentang['gambar3']))
                <div class="img-placeholder"
                    style="background-image: url('{{ asset('storage/foto/'.$tentang['gambar3']) }}')"></div>
            @endif
        </div>
        <div class="text-content">
            <p class="sub-judul">Warisan Leluhur Nusantara</p>
            <h2>{{ $tentang['judul'] ?? 'Permainan Tradisional' }}</h2>
            <div class="info-divider"></div>
            <p>{!! nl2br(e($tentang['isi'] ?? '')) !!}</p>
        </div>
    </section>

    <!-- ===== KATEGORI PULAU — HORIZONTAL SCROLL ===== -->
    <section class="island-category-section" id="informasi">
        <div class="section-header">
            <p class="section-title">Jelajahi Nusantara</p>
            <h2 class="section-subtitle">KATEGORI PULAU</h2>
        </div>

        <div class="slider-wrapper">
            <!-- Tombol kiri -->
            <button class="slider-btn slider-btn-left" id="btnLeft" aria-label="Scroll kiri">
                <svg viewBox="0 0 24 24">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </button>

            <!-- Track kartu scroll -->
            <div class="island-cards-track" id="cardsTrack">
                @foreach($pulauResult as $pulau)
                    <a href="{{ route('pulau.show', $pulau['id']) }}" class="island-card">
                        <div class="island-card-img-wrap">
                            @if(!empty($pulau['gambar']))
                                <img src="{{ asset('storage/foto/'.$pulau['gambar']) }}"
                                    alt="{{ $pulau['nama'] }}" class="island-map-image">
                            @else
                                <div style="color:#a0672a; font-size:40px;">🏝️</div>
                            @endif
                        </div>
                        <div class="island-card-body">
                            <p class="island-card-name">{{ strtoupper($pulau['nama']) }}</p>
                            <div class="island-card-divider"></div>
                            <p class="island-card-desc">{{ $pulau['keterangan'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Tombol kanan -->
            <button class="slider-btn slider-btn-right" id="btnRight" aria-label="Scroll kanan">
                <svg viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
            </button>
        </div>

        <!-- Dot indicator -->
        <div class="slider-dots" id="sliderDots"></div>
    </section>

    <!-- ===== GALERI ===== -->
    <section class="gallery-section" id="galeri">
        <div class="gallery-text">
            <h2>Galeri Permainan<br />Tradisional</h2>
            <p>
                Melestarikan identitas budaya dan warisan nenek moyang bangsa,
                memperkuat jati diri melalui nilai-nilai seperti kebersamaan dan
                ketekunan, serta menunjang kesehatan fisik dan mental anak melalui
                aktivitas yang melatih motorik, kognitif, dan emosional.
            </p>
            <a href="{{ route('galeri.index') }}" class="btn-gallery-more">Selengkapnya</a>
        </div>
        <div class="gallery-image-wrap">
            <img src="{{ asset('images/gebo (1).jpg') }}" alt="Congklak" />
            <img src="{{ asset('images/KLRNG.jpg') }}" alt="Gasing" />
            <img src="{{ asset('images/engklek.jpg') }}" alt="Bola Bekel" />
        </div>
    </section>

    <!-- ===== FAQ ===== -->

    <section class="faq-section" id="faq">
        <div class="faq-header">
            <p class="faq-label">Pusat Bantuan</p>
            <h2>Pertanyaan yang Sering<br>Diajukan (FAQ)</h2>
            <p>Berikut pertanyaan yang sering ditanyakan tentang permainan tradisional nusantara dan website ini.</p>
        </div>

        <div class="faq-grid">
            @if(!empty($faqData))
                @foreach($faqData as $i => $faq)
                    <div class="faq-item">
                        <input type="checkbox" id="faq-{{ $faq['id'] }}" class="faq-toggle-cb" />
                        <label for="faq-{{ $faq['id'] }}" class="faq-question">
                            <span>{{ $faq['pertanyaan'] }}</span>
                            <i class="faq-icon">&#9660;</i>
                        </label>
                        <div class="faq-answer">{!! nl2br(e($faq['jawaban'])) !!}</div>
                    </div>
                @endforeach
            @else
                <p style="color:#999; text-align:center;">Belum ada FAQ tersedia.</p>
            @endif
        </div>
    </section>

    <!-- ===== KRITIK & SARAN ===== -->
    <section class="contact-section" id="masukan">
        <div class="contact-left">
            <h2>Berikan Kritik dan Saran<br />Untuk Website Ini</h2>
            <p>Ingin memberi kritik dan saran untuk website ini? Silahkan mengisi formulir yang sudah kami berikan. Kami
                siap menerima kritik dan saran dari anda.</p>
            <p class="contact-label">Contact us:</p>
            <div class="contact-info-item">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="#f0e6cc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.06 1.18 2 2 0 012.03 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" />
                    </svg>
                </div>
                <span>+62847284802</span>
            </div>
            <div class="contact-info-item">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="#f0e6cc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 1118 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                </div>
                <span>Jalan Kuranggapa No. 12</span>
            </div>
            <div class="contact-info-item">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="#f0e6cc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                </div>
                <span>thenusantara@gmail.com</span>
            </div>
        </div>
        <div class="contact-right" id="kontak">
            <div class="contact-form-card">
                <form action="{{ route('laporan.store') }}" method="POST">
                    @csrf
                    <label for="nama">Your Name</label>
                    <input type="text" id="nama" name="nama" placeholder="Your Name" />
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email" />
                    <label for="pesan">Pesan</label>
                    <textarea id="pesan" name="pesan" placeholder="Tulis pesan Anda..."></textarea>
                    <div class="form-bottom-row">
                        <button type="submit" name="submit" class="kirim-btn">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
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

    <!-- ===== SLIDER SCRIPT ===== -->
    <script>
        const track = document.getElementById('cardsTrack');
        const btnLeft = document.getElementById('btnLeft');
        const btnRight = document.getElementById('btnRight');
        const dotsWrap = document.getElementById('sliderDots');

        // Hitung lebar satu kartu + gap
        function cardWidth() {
            const card = track.querySelector('.island-card');
            if (!card) return 300;
            const gap = parseInt(getComputedStyle(track).gap) || 28;
            return card.offsetWidth + gap;
        }

        // Scroll sejumlah 4 kartu per klik (atau lebih kecil jika layar sempit)
        function scrollAmount() {
            return cardWidth() * 4;
        }

        btnRight.addEventListener('click', () => {
            track.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
        });

        btnLeft.addEventListener('click', () => {
            track.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
        });

        // ---- Dot indicator ----
        function buildDots() {
            dotsWrap.innerHTML = '';
            const cards = track.querySelectorAll('.island-card');
            const total = cards.length;
            if (total <= 4) { dotsWrap.style.display = 'none'; return; }

            // Jumlah "halaman"
            const pages = Math.ceil(total / 4);
            for (let i = 0; i < pages; i++) {
                const dot = document.createElement('button');
                dot.className = 'dot' + (i === 0 ? ' active' : '');
                dot.setAttribute('aria-label', 'Halaman ' + (i + 1));
                dot.addEventListener('click', () => {
                    track.scrollTo({ left: cardWidth() * 4 * i, behavior: 'smooth' });
                });
                dotsWrap.appendChild(dot);
            }
        }

        function updateDots() {
            const dots = dotsWrap.querySelectorAll('.dot');
            if (!dots.length) return;
            const page = Math.round(track.scrollLeft / scrollAmount());
            dots.forEach((d, i) => d.classList.toggle('active', i === page));
        }

        // Tombol disable saat di ujung
        function updateButtons() {
            btnLeft.style.opacity = track.scrollLeft <= 0 ? '0.35' : '1';
            btnRight.style.opacity = track.scrollLeft + track.clientWidth >= track.scrollWidth - 2 ? '0.35' : '1';
        }

        track.addEventListener('scroll', () => { updateDots(); updateButtons(); });
        window.addEventListener('resize', buildDots);

        // Init
        buildDots();
        updateButtons();

        const navbar = document.querySelector('.navbar');
        function updateNavbar() {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        }
        window.addEventListener('scroll', updateNavbar);
        updateNavbar();
    </script>
</body>

</html>
