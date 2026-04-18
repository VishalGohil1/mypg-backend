<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful | MyPG</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f8ef7;
            --success: #16a34a;
            --bg: #f8faff;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #94a3b8;
            --input-bg: #f8fafc;
            --input-border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
        }

        .container {
            width: 100%;
            max-width: 500px;
            text-align: center;
            animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes popIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Success Hero */
        .success-circle {
            width: 96px;
            height: 96px;
            border-radius: 48px;
            background: var(--success);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            box-shadow: 0 10px 20px -5px rgba(22, 163, 74, 0.4);
            margin-bottom: 24px;
        }

        h1 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            font-size: 15px;
            color: var(--text-muted);
            line-height: 24px;
            margin-bottom: 32px;
        }

        /* Highlight Info */
        .info-card {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: left;
        }

        .info-card i {
            font-size: 20px;
            color: #92400e;
        }

        .info-card-text {
            font-size: 14px;
            font-weight: 600;
            color: #92400e;
        }

        /* Credentials Card */
        .credentials-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 32px;
            box-shadow: 0 10px 25px -5px rgba(147, 197, 253, 0.12);
            text-align: left;
        }

        .card-header {
            font-size: 13px;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
            display: block;
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-group:last-child {
            margin-bottom: 0;
        }

        label {
            display: block;
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 6px;
            font-weight: 600;
        }

        .value-wrapper {
            background: var(--input-bg);
            border: 1.5px solid var(--input-border);
            border-radius: 12px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .value-text {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
        }

        .copy-btn {
            color: var(--primary);
            cursor: pointer;
            font-size: 16px;
            transition: transform 0.2s;
        }

        .copy-btn:active {
            transform: scale(0.9);
        }

        /* Action Button */
        .action-btn {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 16px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 10px 15px -3px rgba(79, 142, 247, 0.35);
        }

        .action-btn:hover {
            background: #3b7de8;
            transform: translateY(-1px);
        }

        .notice-text {
            margin-top: 24px;
            font-size: 13px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

    </style>
</head>
<body>

    <div class="container">
        <!-- Hero -->
        <div class="success-circle">
            <i class="fas fa-check"></i>
        </div>
        <h1>Payment Successful!</h1>
        <p class="subtitle">
            Your subscription is now active.<br>
            Please use the credentials below to log in.
        </p>

        <!-- Instruction -->
        <div class="info-card">
            <i class="fas fa-mobile-screen"></i>
            <span class="info-card-text">Go back to your app and login using these credentials</span>
        </div>

        <!-- Credentials -->
        <div class="credentials-card">
            <span class="card-header">Account Credentials</span>
            
            <div class="field-group">
                <label>Email Address</label>
                <div class="value-wrapper">
                    <span class="value-text" id="emailVal">Loading...</span>
                    <i class="far fa-copy copy-btn" onclick="copy('emailVal')"></i>
                </div>
            </div>

            <div class="field-group">
                <label>Default Password</label>
                <div class="value-wrapper">
                    <span class="value-text" id="passVal">Loading...</span>
                    <i class="far fa-copy copy-btn" onclick="copy('passVal')"></i>
                </div>
            </div>
        </div>

        <!-- Action -->
        <!-- <a href="http://localhost:5173/login" class="action-btn">
            Go to Login
            <i class="fas fa-arrow-right"></i>
        </a> -->

        <div class="notice-text">
            <i class="fas fa-envelope-circle-check"></i>
            We've also sent this details to your email.
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const email = sessionStorage.getItem('mypg_email');
            const pass = sessionStorage.getItem('mypg_pass');
            if (email) document.getElementById('emailVal').innerText = email;
            if (pass) document.getElementById('passVal').innerText = pass;
        });

        function copy(id) {
            const text = document.getElementById(id).innerText;
            navigator.clipboard.writeText(text);
            const btn = event.target;
            btn.classList.replace('far', 'fas');
            setTimeout(() => {
                btn.classList.replace('fas', 'far');
            }, 1500);
        }
    </script>
</body>
</html>