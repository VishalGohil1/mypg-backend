<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPG – Property Management Simplified</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Sen:wght@700;800&display=swap"
        rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --blue: #2D5BE3;
            --blue-dark: #1a3fa8;
            --blue-mid: #3D6FFF;
            --navy: #0F1F5C;
            --light: #EEF2FF;
            --white: #ffffff;
            --gray: #6b7280;
            --text: #111827;
            --green: #16a34a;
            --card-bg: #ffffff;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Nunito', sans-serif;
            color: var(--text);
            background: #f8faff;
            overflow-x: hidden;
        }

        /* ── NAV ── */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(45, 91, 227, 0.08);
            padding: 0 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 68px;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Sen', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--blue);
            text-decoration: none;
        }

        .nav-logo .logo-icon {
            width: 38px;
            height: 38px;
            background: var(--blue);
            border-radius: 10px;
            display: grid;
            place-items: center;
        }

        .nav-logo .logo-icon svg {
            width: 22px;
            height: 22px;
            fill: white;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text);
            font-size: 0.9rem;
            font-weight: 600;
            transition: color .2s;
        }

        .nav-links a:hover {
            color: var(--blue);
        }

        .nav-cta {
            background: var(--blue);
            color: white !important;
            padding: 9px 22px;
            border-radius: 8px;
            transition: background .2s, transform .15s !important;
        }

        .nav-cta:hover {
            background: var(--blue-dark) !important;
            transform: translateY(-1px);
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
        }

        .hamburger span {
            width: 24px;
            height: 2.5px;
            background: var(--text);
            border-radius: 2px;
            transition: .3s;
        }

        .mobile-menu {
            display: none;
            position: fixed;
            top: 68px;
            left: 0;
            right: 0;
            background: white;
            padding: 20px 5%;
            flex-direction: column;
            gap: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            z-index: 99;
        }

        .mobile-menu.open {
            display: flex;
        }

        .mobile-menu a {
            text-decoration: none;
            color: var(--text);
            font-weight: 600;
            font-size: 1rem;
            padding: 10px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #0F1F5C 0%, #1a3fa8 40%, #2D5BE3 100%);
            padding: 120px 5% 80px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .hero-blob {
            position: absolute;
            right: -100px;
            top: -100px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(61, 111, 255, 0.3) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 100px;
            padding: 6px 16px;
            margin-bottom: 24px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.82rem;
            font-weight: 600;
        }

        .hero-badge .dot {
            width: 6px;
            height: 6px;
            background: #4ade80;
            border-radius: 50%;
        }

        .hero h1 {
            font-family: 'Sen', sans-serif;
            font-size: clamp(2.4rem, 5vw, 3.8rem);
            font-weight: 800;
            color: white;
            line-height: 1.15;
            margin-bottom: 20px;
        }

        .hero h1 span {
            color: #93c5fd;
        }

        .hero p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.7;
            margin-bottom: 36px;
            max-width: 480px;
        }

        .hero-btns {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn-android {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: white;
            color: var(--navy);
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-android:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
        }

        .btn-android svg {
            width: 22px;
            height: 22px;
        }

        .btn-ios {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.12);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            transition: background .2s;
        }

        .btn-ios:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .btn-ios svg {
            width: 22px;
            height: 22px;
        }

        .btn-ios .badge-soon {
            background: rgba(255, 255, 255, 0.2);
            font-size: 0.68rem;
            padding: 2px 7px;
            border-radius: 100px;
            letter-spacing: 0.5px;
        }

        .hero-phones {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: -20px;
            position: relative;
        }

        .phone-mockup {
            width: 200px;
            background: #0a1535;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5), 0 0 0 2px rgba(255, 255, 255, 0.1);
            position: relative;
            transform: rotate(-5deg) translateY(20px);
            transition: transform .3s;
        }

        .phone-mockup:first-child {
            transform: rotate(-10deg) translateX(30px);
            z-index: 1;
            opacity: 0.8;
        }

        .phone-mockup.main {
            transform: rotate(0deg) scale(1.05);
            z-index: 2;
            opacity: 1;
        }

        .phone-mockup img {
            width: 100%;
            display: block;
        }

        /* ── STATS ── */
        .stats-bar {
            background: white;
            padding: 32px 5%;
            box-shadow: 0 2px 20px rgba(45, 91, 227, 0.07);
        }

        .stats-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            text-align: center;
        }

        .stat-item {
            padding: 16px;
        }

        .stat-number {
            font-family: 'Sen', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--blue);
            line-height: 1;
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: 6px;
            font-weight: 500;
        }

        /* ── SECTION BASE ── */
        section {
            padding: 90px 5%;
        }

        .section-tag {
            display: inline-block;
            background: var(--light);
            color: var(--blue);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 100px;
            margin-bottom: 14px;
        }

        .section-title {
            font-family: 'Sen', sans-serif;
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            font-weight: 800;
            color: var(--navy);
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .section-sub {
            font-size: 1.05rem;
            color: var(--gray);
            line-height: 1.7;
            max-width: 560px;
        }

        .centered {
            text-align: center;
        }

        .centered .section-sub {
            margin: 0 auto;
        }

        /* ── PRODUCT / FEATURES ── */
        #product {
            background: #f8faff;
        }

        .features-grid {
            max-width: 1200px;
            margin: 60px auto 0;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 32px 28px;
            border: 1px solid rgba(45, 91, 227, 0.08);
            transition: transform .3s, box-shadow .3s;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--blue);
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(45, 91, 227, 0.12);
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: var(--light);
            display: grid;
            place-items: center;
            margin-bottom: 20px;
        }

        .feature-icon svg {
            width: 26px;
            height: 26px;
            fill: var(--blue);
        }

        .feature-card h3 {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: var(--navy);
        }

        .feature-card p {
            font-size: 0.9rem;
            color: var(--gray);
            line-height: 1.65;
        }

        /* ── SCREENSHOTS ── */
        #screenshots {
            background: white;
        }

        .screenshots-scroll {
            max-width: 1200px;
            margin: 50px auto 0;
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding: 20px;
            scroll-snap-type: x mandatory;
        }

        .screenshots-scroll::-webkit-scrollbar {
            height: 4px;
        }

        .screenshots-scroll::-webkit-scrollbar-thumb {
            background: var(--blue);
            border-radius: 4px;
        }

        .screenshot-item {
            flex: 0 0 250px;
            scroll-snap-align: start;
            background: var(--navy);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 16px 40px rgba(15, 31, 92, 0.2);
            transition: transform .3s;
        }

        .screenshot-item:hover {
            transform: scale(1.04);
        }

        .screenshot-item img {
            width: 100%;
            display: block;
        }

        .screenshot-item .scr-label {
            padding: 12px;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* ── ABOUT ── */
        #about {
            background: #f8faff;
        }

        .about-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .about-visual {
            background: linear-gradient(135deg, var(--navy), var(--blue));
            border-radius: 28px;
            padding: 48px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .about-stat {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .about-stat-num {
            font-family: 'Sen', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
        }

        .about-stat-label {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.65);
            margin-top: 2px;
        }

        .about-stat-icon {
            font-size: 2rem;
        }

        .about-content .section-sub {
            margin-bottom: 28px;
        }

        .check-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .check-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 0.95rem;
            color: var(--text);
            font-weight: 500;
        }

        .check-list li::before {
            content: '✓';
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--light);
            color: var(--blue);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 800;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ── CTA BAND ── */
        .cta-band {
            background: linear-gradient(135deg, var(--navy), var(--blue));
            padding: 80px 5%;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-band::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at center, rgba(61, 111, 255, 0.3) 0%, transparent 70%);
        }

        .cta-band h2 {
            font-family: 'Sen', sans-serif;
            font-size: clamp(1.8rem, 3vw, 2.8rem);
            font-weight: 800;
            color: white;
            margin-bottom: 16px;
            position: relative;
        }

        .cta-band p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.05rem;
            margin-bottom: 36px;
            position: relative;
        }

        .cta-btns {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
            position: relative;
        }

        /* ── CONTACT ── */
        #contact {
            background: white;
        }

        .contact-inner {
            max-width: 800px;
            margin: 0 auto;
        }

        .contact-form {
            margin-top: 48px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--navy);
        }

        .form-group input,
        .form-group textarea {
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 13px 16px;
            font-family: 'Nunito', sans-serif;
            font-size: 0.95rem;
            outline: none;
            transition: border-color .2s;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--blue);
        }

        .btn-submit {
            background: var(--blue);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            transition: background .2s, transform .15s;
            align-self: flex-start;
        }

        .btn-submit:hover {
            background: var(--blue-dark);
            transform: translateY(-2px);
        }

        /* ── FOOTER ── */
        footer {
            background: var(--navy);
            color: rgba(255, 255, 255, 0.7);
            padding: 60px 5% 32px;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }

        .footer-brand .nav-logo {
            color: white;
            margin-bottom: 16px;
            display: inline-flex;
        }

        .footer-brand p {
            font-size: 0.9rem;
            line-height: 1.7;
            max-width: 280px;
        }

        .footer-col h4 {
            color: white;
            font-weight: 700;
            margin-bottom: 16px;
            font-size: 0.95rem;
        }

        .footer-col ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-col ul li a {
            color: rgba(255, 255, 255, 0.55);
            text-decoration: none;
            font-size: 0.88rem;
            transition: color .2s;
        }

        .footer-col ul li a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: gap;
        }

        .footer-bottom p {
            font-size: 0.85rem;
        }

        .social-links {
            display: flex;
            gap: 14px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            display: grid;
            place-items: center;
            text-decoration: none;
            transition: background .2s, transform .15s;
            color: white;
        }

        .social-link:hover {
            background: var(--blue);
            transform: translateY(-2px);
        }

        .social-link svg {
            width: 18px;
            height: 18px;
            fill: currentColor;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 0.7s ease both;
        }

        .delay-1 {
            animation-delay: 0.15s;
        }

        .delay-2 {
            animation-delay: 0.3s;
        }

        .delay-3 {
            animation-delay: 0.45s;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .nav-links {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            .hero-inner {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero p {
                margin: 0 auto 36px;
            }

            .hero-btns {
                justify-content: center;
            }

            .hero-phones {
                display: none;
            }

            .stats-inner {
                grid-template-columns: repeat(2, 1fr);
            }

            .features-grid {
                grid-template-columns: 1fr 1fr;
            }

            .about-inner {
                grid-template-columns: 1fr;
            }

            .footer-top {
                grid-template-columns: 1fr 1fr;
            }

            .footer-brand {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 600px) {
            .features-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .footer-top {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }

            .stats-inner {
                grid-template-columns: 1fr 1fr;
            }
        }

        .field-error {
            color: #dc2626;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 4px;
            display: block;
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav>
        <a href="#" class="nav-logo">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
            </div>
            MyPG
        </a>
        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#product">Product</a>
            <a href="#about">About Us</a>
            <a href="#contact">Contact</a>
            <a href="#download" class="nav-cta">Download App</a>
        </div>
        <div class="hamburger" onclick="toggleMenu()">
            <span></span><span></span><span></span>
        </div>
    </nav>

    <div class="mobile-menu" id="mobileMenu">
        <a href="#home" onclick="toggleMenu()">Home</a>
        <a href="#product" onclick="toggleMenu()">Product</a>
        <a href="#about" onclick="toggleMenu()">About Us</a>
        <a href="#contact" onclick="toggleMenu()">Contact</a>
        <a href="#download" onclick="toggleMenu()">Download App</a>
    </div>

    <!-- HERO -->
    <section class="hero" id="home">
        <div class="hero-blob"></div>
        <div class="hero-inner">
            <div>
                <div class="hero-badge fade-up"><span class="dot"></span> Now Available on Android</div>
                <h1 class="fade-up delay-1">Where PG/Hostel<br><span>Meets Simplicity</span></h1>
                <p class="fade-up delay-2">MyPG is an all-in-one app for PG and hostel owners — manage members, track
                    payments, send notices, and grow your business from a single platform.</p>
                <div class="hero-btns fade-up delay-3" id="download">
                    <a href="https://expo.dev/accounts/vishalgohil090601/projects/MyPG/builds/ed65e78d-e7b7-42f3-b41a-16e1fd781559"
                        class="btn-android">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M6 18c0 .55.45 1 1 1h1v3.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5V19h2v3.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5V19h1c.55 0 1-.45 1-1V8H6v10zM3.5 8C2.67 8 2 8.67 2 9.5v7c0 .83.67 1.5 1.5 1.5S5 17.33 5 16.5v-7C5 8.67 4.33 8 3.5 8zm17 0c-.83 0-1.5.67-1.5 1.5v7c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5v-7c0-.83-.67-1.5-1.5-1.5zm-4.97-5.84l1.3-1.3c.2-.2.2-.51 0-.71-.2-.2-.51-.2-.71 0l-1.48 1.48A5.84 5.84 0 0 0 12 1.5c-.96 0-1.86.23-2.66.63L7.88.65c-.2-.2-.51-.2-.71 0-.2.2-.2.51 0 .71l1.3 1.3A5.78 5.78 0 0 0 6.25 7h11.5c0-1.97-.98-3.7-2.22-4.84zM10 5H9V4h1v1zm5 0h-1V4h1v1z" />
                        </svg>
                        Download for Android
                    </a>
                    <a href="#" class="btn-ios">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z" />
                        </svg>
                        iOS App
                        <span class="badge-soon">Coming Soon</span>
                    </a>
                </div>
            </div>
            <div class="hero-phones">
                <div class="phone-mockup">
                    <img src="/screenshots/members.png" alt="Members"
                        onerror="this.style.background='rgba(255,255,255,0.05)';this.style.height='440px'">
                </div>
                <div class="phone-mockup main">
                    <img src="/screenshots/dashboard.png" alt="Dashboard"
                        onerror="this.style.background='rgba(255,255,255,0.05)';this.style.height='400px'">
                </div>
            </div>
        </div>
    </section>

    <!-- STATS -->
    <div class="stats-bar">
        <div class="stats-inner">
            <div class="stat-item">
                <div class="stat-number">60+</div>
                <div class="stat-label">Beds Managed</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">100%</div>
                <div class="stat-label">Cloud Based</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">6</div>
                <div class="stat-label">Core Modules</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">₹799</div>
                <div class="stat-label">Per Year Only</div>
            </div>
        </div>
    </div>

    <!-- PRODUCT -->
    <section id="product">
        <div style="max-width:1200px;margin:0 auto;">
            <div class="centered">
                <span class="section-tag">Product</span>
                <h2 class="section-title">Everything You Need to Run Your PG/Hostel</h2>
                <p class="section-sub">MyPG brings all your property management tools into one clean, intuitive app —
                    built for Indian PG and hostel owners.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H8V4h12v12zM10 9h8v2h-8zm0 3h4v2h-4zm0-6h8v2h-8z" />
                        </svg>
                    </div>
                    <h3>Dashboard Overview</h3>
                    <p>Get a bird's eye view of monthly revenue, bed availability, total members, pending payments, new
                        joiners, and 6-month growth trends — all at a glance.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                        </svg>
                    </div>
                    <h3>Member Management</h3>
                    <p>Add or import members via CSV/Excel, view their room number, rent, and city details. Directly
                        call or WhatsApp them from the list. Filter by payment status.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z" />
                        </svg>
                    </div>
                    <h3>Pending Payments</h3>
                    <p>See all overdue members with how many months their payment is pending. One-tap call or WhatsApp
                        to follow up on outstanding dues.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z" />
                        </svg>
                    </div>
                    <h3>Partners & Managers</h3>
                    <p>Add co-owners or managers who can collect payments and manage members. Track who collected which
                        payment with full attribution on records.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12zM7 9h2v2H7zm4 0h2v2h-2zm4 0h2v2h-2z" />
                        </svg>
                    </div>
                    <h3>WhatsApp Notices</h3>
                    <p>Create reusable message templates for rent reminders, rules, or announcements. One tap opens
                        WhatsApp with the message pre-filled for instant sending.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z" />
                        </svg>
                    </div>
                    <h3>System Settings</h3>
                    <p>Configure your PG name, total bed count, and preferences. Built for multi-property owners with a
                        clean settings panel to keep everything organized.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SCREENSHOTS -->
    <section id="screenshots" style="background:white;">
        <div style="max-width:1200px;margin:0 auto;">
            <div class="centered">
                <span class="section-tag">App Preview</span>
                <h2 class="section-title">See MyPG in Action</h2>
                <p class="section-sub">Clean, intuitive screens designed for real PG owners — not engineers.</p>
            </div>
            <div class="screenshots-scroll">
                <div class="screenshot-item">
                    <img src="/screenshots/login.png" alt="Login"
                        onerror="this.style.minHeight='380px';this.style.background='#1a3fa8'">
                    <div class="scr-label">Sign In</div>
                </div>
                <div class="screenshot-item">
                    <img src="/screenshots/dashboard.png" alt="Dashboard"
                        onerror="this.style.minHeight='380px';this.style.background='#1a3fa8'">
                    <div class="scr-label">Dashboard</div>
                </div>
                <div class="screenshot-item">
                    <img src="/screenshots/members.png" alt="Members"
                        onerror="this.style.minHeight='380px';this.style.background='#1a3fa8'">
                    <div class="scr-label">Members</div>
                </div>
                <div class="screenshot-item">
                    <img src="/screenshots/pending.png" alt="Pending"
                        onerror="this.style.minHeight='380px';this.style.background='#1a3fa8'">
                    <div class="scr-label">Pending Payments</div>
                </div>
                <div class="screenshot-item">
                    <img src="/screenshots/notices.png" alt="Notices"
                        onerror="this.style.minHeight='380px';this.style.background='#1a3fa8'">
                    <div class="scr-label">Notices</div>
                </div>
                <div class="screenshot-item">
                    <img src="/screenshots/partners.png" alt="Partners"
                        onerror="this.style.minHeight='380px';this.style.background='#1a3fa8'">
                    <div class="scr-label">Partners</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section id="about">
        <div class="about-inner">
            <div class="about-visual">
                <div
                    style="color:white;font-family:'Sen',sans-serif;font-size:1.5rem;font-weight:800;margin-bottom:8px;">
                    Built for Indian PG Owners</div>
                <div style="color:rgba(255,255,255,0.6);font-size:0.9rem;margin-bottom:24px;line-height:1.6;">
                    MyPG was designed from the ground up to solve the real challenges of managing a paying guest
                    accommodation in India.
                </div>
                <div class="about-stat">
                    <div>
                        <div class="about-stat-num">₹799/yr</div>
                        <div class="about-stat-label">All features included</div>
                    </div>
                    <div class="about-stat-icon">🏷️</div>
                </div>
                <div class="about-stat">
                    <div>
                        <div class="about-stat-num">Android</div>
                        <div class="about-stat-label">Available now on Play Store</div>
                    </div>
                    <div class="about-stat-icon">📱</div>
                </div>
                <div class="about-stat">
                    <div>
                        <div class="about-stat-num">iOS Soon</div>
                        <div class="about-stat-label">App Store launch coming</div>
                    </div>
                    <div class="about-stat-icon">🚀</div>
                </div>
            </div>
            <div class="about-content">
                <span class="section-tag">About Us</span>
                <h2 class="section-title">Simplifying PG Management Across India</h2>
                <p class="section-sub">We built MyPG because managing a PG shouldn't require spreadsheets, WhatsApp
                    groups, and manual tracking. One app. Everything in one place.</p>
                <ul class="check-list">
                    <li>Track occupancy and available beds in real time</li>
                    <li>Manage members and their payment status effortlessly</li>
                    <li>Add partners or managers with access to collect payments</li>
                    <li>Send WhatsApp notices to all members with a single tap</li>
                    <li>View 6-month revenue trends and yearly performance</li>
                    <li>Import existing members via CSV or Excel</li>
                    <li>Works offline and syncs automatically when connected</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- CTA BAND -->
    <div class="cta-band">
        <h2>Ready to Take Control of Your PG?</h2>
        <p>Download MyPG today and start managing smarter. Just ₹799 for a full year of access.</p>
        <div class="cta-btns">
            <a href="#" class="btn-android">
                <svg viewBox="0 0 24 24" fill="currentColor" style="width:22px;height:22px">
                    <path
                        d="M6 18c0 .55.45 1 1 1h1v3.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5V19h2v3.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5V19h1c.55 0 1-.45 1-1V8H6v10zM3.5 8C2.67 8 2 8.67 2 9.5v7c0 .83.67 1.5 1.5 1.5S5 17.33 5 16.5v-7C5 8.67 4.33 8 3.5 8zm17 0c-.83 0-1.5.67-1.5 1.5v7c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5v-7c0-.83-.67-1.5-1.5-1.5zm-4.97-5.84l1.3-1.3c.2-.2.2-.51 0-.71-.2-.2-.51-.2-.71 0l-1.48 1.48A5.84 5.84 0 0 0 12 1.5c-.96 0-1.86.23-2.66.63L7.88.65c-.2-.2-.51-.2-.71 0-.2.2-.2.51 0 .71l1.3 1.3A5.78 5.78 0 0 0 6.25 7h11.5c0-1.97-.98-3.7-2.22-4.84zM10 5H9V4h1v1zm5 0h-1V4h1v1z" />
                </svg>
                Download for Android
            </a>
            <a href="#" class="btn-ios" style="border-color:rgba(255,255,255,0.4);">
                <svg viewBox="0 0 24 24" fill="currentColor" style="width:22px;height:22px">
                    <path
                        d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z" />
                </svg>
                iOS — Launching Soon
            </a>
        </div>
    </div>

    <!-- CONTACT -->
    <section id="contact">
        <div class="contact-inner">
            <div class="centered">
                <span class="section-tag">Contact Us</span>
                <h2 class="section-title">Get in Touch</h2>
                <p class="section-sub">Have questions about MyPG? We'd love to hear from you. Send us a message and
                    we'll get back to you soon.</p>
            </div>

            <!-- Success Message -->
            <div id="form-success"
                style="display:none; margin-top:24px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:12px; padding:16px 20px; color:#16a34a; font-weight:600; text-align:center;">
                ✅ Thank you! We'll get back to you soon.
            </div>

            <!-- Error Message -->
            <div id="form-error"
                style="display:none; margin-top:24px; background:#fef2f2; border:1px solid #fecaca; border-radius:12px; padding:16px 20px; color:#dc2626; font-weight:600; text-align:center;">
                ❌ Something went wrong. Please try again.
            </div>

            <div class="contact-form" id="contactForm">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" id="first_name" placeholder="Your first name">
                        <span class="field-error" id="err-first_name"></span>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" id="last_name" placeholder="Your last name">
                        <span class="field-error" id="err-last_name"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" id="email" placeholder="you@example.com">
                    <span class="field-error" id="err-email"></span>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea rows="5" id="message" placeholder="Write your message here..."></textarea>
                    <span class="field-error" id="err-message"></span>
                </div>
                <button class="btn-submit" id="submitBtn" onclick="submitContact()">
                    Send Message →
                </button>
            </div>
        </div>
    </section>>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <div class="footer-top">
                <div class="footer-brand">
                    <a href="#" class="nav-logo" style="color:white;margin-bottom:16px;">
                        <div class="logo-icon">
                            <svg viewBox="0 0 24 24" style="width:22px;height:22px;fill:white">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                            </svg>
                        </div>
                        MyPG
                    </a>
                    <p>Property Management Simplified. Designed for PG and hostel owners across India to run their
                        business smarter and faster.</p>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#product">Product</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Product</h4>
                    <ul>
                        <li><a href="#download">Download Android</a></li>
                        <li><a href="#download">iOS — Coming Soon</a></li>
                        <li><a href="#product">Features</a></li>
                        <li><a href="#product">Pricing — ₹799/yr</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2026 MyPG. All rights reserved. Built with ❤️ for PG owners in India.</p>
                <div class="social-links">
                    <!-- LinkedIn -->
                    <a href="#" class="social-link" title="Connect on LinkedIn">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="#" class="social-link" title="Follow on Instagram">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <script>
    // ── Nav menu ──
    function toggleMenu() {
        document.getElementById('mobileMenu').classList.toggle('open');
    }
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('mobileMenu');
        const hamburger = document.querySelector('.hamburger');
        if (!menu.contains(e.target) && !hamburger.contains(e.target)) {
            menu.classList.remove('open');
        }
    });
    window.addEventListener('scroll', () => {
        const nav = document.querySelector('nav');
        nav.style.boxShadow = window.scrollY > 10 ? '0 4px 30px rgba(45,91,227,0.1)' : 'none';
    });

    // ── Contact Form ──
    function submitContact() {
        // Clear previous errors
        ['first_name','last_name','email','message'].forEach(f => {
            document.getElementById('err-' + f).textContent = '';
            document.getElementById(f).style.borderColor = '#e5e7eb';
        });
        document.getElementById('form-success').style.display = 'none';
        document.getElementById('form-error').style.display = 'none';

        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.textContent = 'Sending...';

        const token = document.querySelector('input[name="_token"]') 
                      ? document.querySelector('input[name="_token"]').value 
                      : document.cookie.match(/XSRF-TOKEN=([^;]+)/)?.[1] || '';

        fetch('/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                first_name : document.getElementById('first_name').value,
                last_name  : document.getElementById('last_name').value,
                email      : document.getElementById('email').value,
                message    : document.getElementById('message').value,
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Clear fields
                ['first_name','last_name','email','message'].forEach(f => {
                    document.getElementById(f).value = '';
                });
                document.getElementById('form-success').style.display = 'block';
                document.getElementById('form-success').scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else if (data.errors) {
                // Show validation errors under each field
                Object.keys(data.errors).forEach(field => {
                    const errEl = document.getElementById('err-' + field);
                    const inputEl = document.getElementById(field);
                    if (errEl) errEl.textContent = data.errors[field][0];
                    if (inputEl) inputEl.style.borderColor = '#dc2626';
                });
            } else {
                document.getElementById('form-error').style.display = 'block';
            }
        })
        .catch(() => {
            document.getElementById('form-error').style.display = 'block';
        })
        .finally(() => {
            btn.disabled = false;
            btn.textContent = 'Send Message →';
        });
    }
</script>

    <script>
        function toggleMenu() {
            document.getElementById('mobileMenu').classList.toggle('open');
        }
        // Close mobile menu on outside click
        document.addEventListener('click', function(e) {
            const menu = document.getElementById('mobileMenu');
            const hamburger = document.querySelector('.hamburger');
            if (!menu.contains(e.target) && !hamburger.contains(e.target)) {
                menu.classList.remove('open');
            }
        });
        // Smooth nav highlight on scroll
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            nav.style.boxShadow = window.scrollY > 10 ? '0 4px 30px rgba(45,91,227,0.1)' : 'none';
        });
    </script>
</body>

</html>
