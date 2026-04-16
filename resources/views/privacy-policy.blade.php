<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy – MyPG</title>
    <meta name="description" content="MyPG Privacy Policy – Learn how we collect, use, and protect your personal data in the MyPG property management app.">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Sen:wght@700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
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
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Nunito', sans-serif;
            color: var(--text);
            background: #f8faff;
            overflow-x: hidden;
        }

        /* ── NAV ── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
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
            width: 38px; height: 38px;
            background: var(--blue);
            border-radius: 10px;
            display: grid;
            place-items: center;
        }

        .nav-logo .logo-icon svg {
            width: 22px; height: 22px;
            fill: white;
        }

        .nav-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--gray);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: color .2s;
        }

        .nav-back:hover { color: var(--blue); }

        .nav-back svg {
            width: 16px; height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ── HERO BANNER ── */
        .policy-hero {
            background: linear-gradient(135deg, #0F1F5C 0%, #1a3fa8 40%, #2D5BE3 100%);
            padding: 120px 5% 70px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .policy-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .policy-hero-blob {
            position: absolute;
            right: -100px; top: -100px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(61, 111, 255, 0.3) 0%, transparent 70%);
            border-radius: 50%;
        }

        .policy-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 100px;
            padding: 6px 16px;
            margin-bottom: 20px;
            color: rgba(255,255,255,0.9);
            font-size: 0.82rem;
            font-weight: 600;
            position: relative;
        }

        .policy-hero-badge .dot {
            width: 6px; height: 6px;
            background: #4ade80;
            border-radius: 50%;
        }

        .policy-hero h1 {
            font-family: 'Sen', sans-serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            color: white;
            margin-bottom: 14px;
            position: relative;
        }

        .policy-hero .subtitle {
            color: rgba(255,255,255,0.7);
            font-size: 1rem;
            position: relative;
        }

        .policy-hero .subtitle span {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.18);
            padding: 4px 12px;
            border-radius: 100px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* ── CONTENT WRAPPER ── */
        .policy-wrap {
            max-width: 820px;
            margin: 0 auto;
            padding: 60px 24px 100px;
        }

        /* ── TOC ── */
        .toc-card {
            background: white;
            border-radius: 20px;
            padding: 32px 36px;
            border: 1px solid rgba(45,91,227,0.1);
            box-shadow: 0 4px 24px rgba(45,91,227,0.06);
            margin-bottom: 48px;
        }

        .toc-card h2 {
            font-family: 'Sen', sans-serif;
            font-size: 1rem;
            font-weight: 800;
            color: var(--navy);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .toc-card h2::before {
            content: '';
            width: 4px; height: 18px;
            background: var(--blue);
            border-radius: 2px;
            display: inline-block;
        }

        .toc-list {
            list-style: none;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px 24px;
        }

        .toc-list li a {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
            transition: color .2s;
        }

        .toc-list li a:hover { color: var(--blue); }

        .toc-num {
            width: 22px; height: 22px;
            background: var(--light);
            color: var(--blue);
            border-radius: 6px;
            font-size: 0.72rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* ── SECTIONS ── */
        .policy-section {
            background: white;
            border-radius: 20px;
            padding: 36px 40px;
            border: 1px solid rgba(45,91,227,0.08);
            box-shadow: 0 2px 16px rgba(45,91,227,0.05);
            margin-bottom: 24px;
            transition: box-shadow .3s;
        }

        .policy-section:hover {
            box-shadow: 0 8px 32px rgba(45,91,227,0.1);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 22px;
        }

        .section-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            background: var(--light);
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .section-icon svg {
            width: 26px; height: 26px;
            fill: var(--blue);
        }

        .section-title-wrap h2 {
            font-family: 'Sen', sans-serif;
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--navy);
            line-height: 1.3;
        }

        .section-title-wrap .section-num {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--blue);
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .policy-section p {
            font-size: 0.95rem;
            color: #374151;
            line-height: 1.8;
            margin-bottom: 14px;
        }

        .policy-section p:last-child { margin-bottom: 0; }

        .data-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        .data-tag {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--light);
            color: var(--blue);
            font-size: 0.82rem;
            font-weight: 700;
            padding: 7px 14px;
            border-radius: 8px;
            border: 1px solid rgba(45,91,227,0.15);
        }

        .data-tag svg {
            width: 14px; height: 14px;
            fill: var(--blue);
        }

        .highlight-box {
            background: linear-gradient(135deg, #EEF2FF, #e0e7ff);
            border-left: 4px solid var(--blue);
            border-radius: 0 12px 12px 0;
            padding: 16px 20px;
            margin-top: 16px;
            font-size: 0.9rem;
            color: var(--navy);
            font-weight: 600;
            line-height: 1.6;
        }

        .security-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
        }

        .security-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            padding: 12px 18px;
            flex: 1;
            min-width: 180px;
        }

        .security-badge .badge-icon {
            width: 36px; height: 36px;
            background: #dcfce7;
            border-radius: 10px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .security-badge .badge-icon svg {
            width: 18px; height: 18px;
            fill: var(--green);
        }

        .security-badge .badge-text strong {
            display: block;
            font-size: 0.88rem;
            font-weight: 700;
            color: #166534;
        }

        .security-badge .badge-text span {
            font-size: 0.78rem;
            color: #4b7a5a;
        }

        .contact-card {
            background: linear-gradient(135deg, var(--navy), var(--blue-dark));
            border-radius: 16px;
            padding: 28px 32px;
            margin-top: 16px;
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .contact-card-icon {
            width: 56px; height: 56px;
            background: rgba(255,255,255,0.12);
            border-radius: 14px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .contact-card-icon svg {
            width: 28px; height: 28px;
            fill: white;
        }

        .contact-card-text p {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            margin-bottom: 4px;
        }

        .contact-card-text a {
            color: white;
            font-size: 1rem;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.3px;
            transition: opacity .2s;
        }

        .contact-card-text a:hover { opacity: 0.8; }

        .contact-card-links {
            margin-left: auto;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .contact-card-links a {
            display: flex;
            align-items: center;
            gap: 6px;
            color: rgba(255,255,255,0.65);
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            transition: color .2s;
        }

        .contact-card-links a:hover { color: white; }

        .contact-card-links a svg {
            width: 14px; height: 14px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ── FOOTER ── */
        footer {
            background: var(--navy);
            color: rgba(255,255,255,0.7);
            padding: 40px 5% 28px;
        }

        .footer-bottom {
            max-width: 820px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-bottom p { font-size: 0.85rem; }

        .footer-bottom a {
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            transition: color .2s;
        }

        .footer-bottom a:hover { color: white; }

        .footer-links { display: flex; gap: 20px; }

        /* ── RESPONSIVE ── */
        @media (max-width: 640px) {
            .policy-wrap { padding: 40px 16px 80px; }
            .policy-section { padding: 28px 24px; }
            .toc-card { padding: 24px; }
            .toc-list { grid-template-columns: 1fr; }
            .contact-card { flex-direction: column; }
            .contact-card-links { margin-left: 0; }
            .footer-bottom { flex-direction: column; text-align: center; }
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav>
        <a href="/" class="nav-logo">
            <span class="logo-icon">
                <svg viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
            </span>
            MyPG
        </a>
        <a href="/" class="nav-back">
            <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            Back to Home
        </a>
    </nav>

    <!-- HERO BANNER -->
    <div class="policy-hero">
        <div class="policy-hero-blob"></div>
        <div class="policy-hero-badge">
            <span class="dot"></span>
            Legal &amp; Transparency
        </div>
        <h1>Privacy Policy</h1>
        <p class="subtitle">
            <span>Last updated: April 15, 2025</span>
        </p>
    </div>

    <!-- CONTENT -->
    <div class="policy-wrap">

        <!-- TOC -->
        <div class="toc-card">
            <h2>Table of Contents</h2>
            <ul class="toc-list">
                <li><a href="#section-1"><span class="toc-num">1</span> Information We Collect</a></li>
                <li><a href="#section-2"><span class="toc-num">2</span> Why We Collect It</a></li>
                <li><a href="#section-3"><span class="toc-num">3</span> How We Use Your Data</a></li>
                <li><a href="#section-4"><span class="toc-num">4</span> Data Security</a></li>
                <li><a href="#section-5"><span class="toc-num">5</span> Data Retention</a></li>
                <li><a href="#section-6"><span class="toc-num">6</span> Your Rights</a></li>
                <li><a href="#section-7"><span class="toc-num">7</span> Third-Party Services</a></li>
                <li><a href="#section-8"><span class="toc-num">8</span> Contact Us</a></li>
            </ul>
        </div>

        <!-- INTRO -->
        <div class="policy-section" style="border-left: 4px solid var(--blue);">
            <p>
                Welcome to <strong>MyPG</strong>, a property management application developed by
                <strong>Own Software Solutions</strong>. This Privacy Policy explains how we collect,
                use, and protect your personal information when you use the MyPG mobile application
                and its associated services.
            </p>
            <p>
                By using MyPG, you agree to the collection and use of information in accordance
                with this policy. If you have any concerns, please contact us at the details provided below.
            </p>
        </div>

        <!-- 1. WHAT WE COLLECT -->
        <div class="policy-section" id="section-1">
            <div class="section-header">
                <div class="section-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div class="section-title-wrap">
                    <div class="section-num">Section 01</div>
                    <h2>Information We Collect</h2>
                </div>
            </div>

            <p>When you register and use the MyPG app, we collect the following personal information:</p>

            <div class="data-tags">
                <span class="data-tag">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Full Name
                </span>
                <span class="data-tag">
                    <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    Email Address
                </span>
                <span class="data-tag">
                    <svg viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                    Phone Number
                </span>
                <span class="data-tag">
                    <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    PG / Room Details
                </span>
                <span class="data-tag">
                    <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                    Payment Records
                </span>
            </div>

            <div class="highlight-box">
                We do <strong>not</strong> collect sensitive data such as government ID numbers, biometric data, or financial account credentials.
            </div>
        </div>

        <!-- 2. WHY WE COLLECT -->
        <div class="policy-section" id="section-2">
            <div class="section-header">
                <div class="section-icon">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                </div>
                <div class="section-title-wrap">
                    <div class="section-num">Section 02</div>
                    <h2>Why We Collect It</h2>
                </div>
            </div>
            <p>
                Your data is collected solely for the purpose of operating the MyPG application and
                delivering its core functionality. Specifically:
            </p>
            <p>
                <strong>Authentication</strong> — Your name and email are used to create and verify
                your account, ensuring that only you can access your data and manage your PG records.
            </p>
            <p>
                <strong>PG Management</strong> — Room assignments, rent due dates, and payment history
                are stored to help you (and your PG owner) track tenancy seamlessly.
            </p>
            <p>
                <strong>Payments</strong> — Payment records are stored to provide accurate rent
                history and pending payment notifications.
            </p>
        </div>

        <!-- 3. HOW WE USE -->
        <div class="policy-section" id="section-3">
            <div class="section-header">
                <div class="section-icon">
                    <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </div>
                <div class="section-title-wrap">
                    <div class="section-num">Section 03</div>
                    <h2>How We Use Your Data</h2>
                </div>
            </div>
            <p>We use the information collected to:</p>
            <p>
                • Create and manage your user account and profile<br>
                • Authenticate you securely when you log in<br>
                • Display your PG details, room information, and payment records<br>
                • Send in-app notifications about pending or upcoming payments<br>
                • Provide customer support when you reach out to us
            </p>
            <p>
                We do <strong>not</strong> sell, rent, or share your personal data with any third
                party for marketing purposes. Your data is never used for advertising.
            </p>
        </div>

        <!-- 4. DATA SECURITY -->
        <div class="policy-section" id="section-4">
            <div class="section-header">
                <div class="section-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div class="section-title-wrap">
                    <div class="section-num">Section 04</div>
                    <h2>Data Security</h2>
                </div>
            </div>
            <p>
                We take the security of your personal data seriously and implement industry-standard
                measures to protect it:
            </p>

            <div class="security-badges">
                <div class="security-badge">
                    <div class="badge-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="badge-text">
                        <strong>HTTPS / TLS Encryption</strong>
                        <span>All data in transit is encrypted</span>
                    </div>
                </div>
                <div class="security-badge">
                    <div class="badge-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    </div>
                    <div class="badge-text">
                        <strong>Hashed Passwords</strong>
                        <span>Passwords are never stored in plain text</span>
                    </div>
                </div>
                <div class="security-badge">
                    <div class="badge-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="badge-text">
                        <strong>Secure API Tokens</strong>
                        <span>Token-based authentication (Sanctum)</span>
                    </div>
                </div>
                <div class="security-badge">
                    <div class="badge-icon">
                        <svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>
                    </div>
                    <div class="badge-text">
                        <strong>Secure Database</strong>
                        <span>Data stored on protected servers</span>
                    </div>
                </div>
            </div>

            <p style="margin-top: 16px;">
                All API communication between the MyPG app and our servers at
                <strong>https://mypg.ownsoftwaresolutions.com</strong> is served exclusively
                over HTTPS, ensuring your data is encrypted during transmission.
            </p>
        </div>

        <!-- 5. DATA RETENTION -->
        <div class="policy-section" id="section-5">
            <div class="section-header">
                <div class="section-icon">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="section-title-wrap">
                    <div class="section-num">Section 05</div>
                    <h2>Data Retention</h2>
                </div>
            </div>
            <p>
                We retain your personal data for as long as your account is active or as necessary
                to provide you services. If you request deletion of your account, your personal data
                will be removed from our systems within <strong>30 days</strong>.
            </p>
            <p>
                Payment records may be retained for a limited period to comply with applicable
                financial record-keeping obligations.
            </p>
        </div>

        <!-- 6. YOUR RIGHTS -->
        <div class="policy-section" id="section-6">
            <div class="section-header">
                <div class="section-icon">
                    <svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div class="section-title-wrap">
                    <div class="section-num">Section 06</div>
                    <h2>Your Rights</h2>
                </div>
            </div>
            <p>You have the following rights regarding your personal data:</p>
            <p>
                • <strong>Access</strong> — Request a copy of the data we hold about you<br>
                • <strong>Correction</strong> — Request correction of inaccurate or incomplete data<br>
                • <strong>Deletion</strong> — Request deletion of your account and associated data<br>
                • <strong>Portability</strong> — Request your data in a portable format<br>
                • <strong>Objection</strong> — Object to processing of your personal data
            </p>
            <p>
                To exercise any of these rights, please contact us at the email address provided in the Contact section below.
            </p>
        </div>

        <!-- 7. THIRD-PARTY SERVICES -->
        <div class="policy-section" id="section-7">
            <div class="section-header">
                <div class="section-icon">
                    <svg viewBox="0 0 24 24"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                </div>
                <div class="section-title-wrap">
                    <div class="section-num">Section 07</div>
                    <h2>Third-Party Services</h2>
                </div>
            </div>
            <p>
                MyPG uses <strong>Razorpay</strong> as its payment gateway for processing rent
                payments. When you make a payment, you will be redirected to Razorpay's secure
                payment interface. Razorpay independently collects and processes payment
                information according to their own
                <a href="https://razorpay.com/privacy/" target="_blank" rel="noopener" style="color: var(--blue); font-weight: 600;">Privacy Policy</a>.
            </p>
            <p>
                We do not store your card details or banking credentials. We only receive a
                payment confirmation status from Razorpay.
            </p>
            <div class="highlight-box">
                MyPG does not use any analytics SDKs, advertising networks, or tracking cookies that collect data without your knowledge.
            </div>
        </div>

        <!-- 8. CONTACT -->
        <div class="policy-section" id="section-8">
            <div class="section-header">
                <div class="section-icon">
                    <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
                <div class="section-title-wrap">
                    <div class="section-num">Section 08</div>
                    <h2>Contact Us</h2>
                </div>
            </div>
            <p>
                If you have any questions, concerns, or requests regarding this Privacy Policy or
                your personal data, please reach out to us:
            </p>

            <div class="contact-card">
                <div class="contact-card-icon">
                    <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
                <div class="contact-card-text">
                    <p>Email us at</p>
                    <a href="mailto:support@ownsoftwaresolutions.com">support@ownsoftwaresolutions.com</a>
                </div>
                <div class="contact-card-links">
                    <a href="https://ownsoftwaresolutions.com" target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        ownsoftwaresolutions.com
                    </a>
                    <a href="https://mypg.ownsoftwaresolutions.com" target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        mypg.ownsoftwaresolutions.com
                    </a>
                </div>
            </div>

            <p style="margin-top: 20px;">
                <strong>Company:</strong> Own Software Solutions<br>
                We will respond to all privacy-related requests within <strong>72 hours</strong>.
            </p>
        </div>

    </div><!-- /policy-wrap -->

    <!-- FOOTER -->
    <footer>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Own Software Solutions. All rights reserved.</p>
            <div class="footer-links">
                <a href="/">Home</a>
                <a href="/privacy-policy">Privacy Policy</a>
                <a href="https://ownsoftwaresolutions.com" target="_blank" rel="noopener">Company</a>
            </div>
        </div>
    </footer>

</body>
</html>
