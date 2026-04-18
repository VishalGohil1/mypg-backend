<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed | MyPG</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f8ef7;
            --error: #dc2626;
            --bg: #f8faff;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #94a3b8;
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
            max-width: 450px;
            text-align: center;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .error-circle {
            width: 96px;
            height: 96px;
            border-radius: 48px;
            background: #fef2f2;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--error);
            font-size: 40px;
            border: 1px solid #fee2e2;
            margin-bottom: 24px;
        }

        h1 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 12px;
            color: #b91c1c;
        }

        .subtitle {
            font-size: 15px;
            color: var(--text-muted);
            line-height: 24px;
            margin-bottom: 32px;
        }

        .reason-box {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 32px;
            text-align: left;
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .reason-header {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            display: block;
        }

        .reason-text {
            font-size: 14px;
            color: #475569;
            line-height: 1.6;
        }

        .btn-retry {
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

        .btn-retry:hover {
            background: #3b7de8;
            transform: translateY(-1px);
        }

        .btn-secondary {
            display: inline-block;
            margin-top: 20px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-secondary:hover {
            color: var(--primary);
        }

        .support-card {
            margin-top: 40px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            text-align: left;
        }

        .support-icon {
            width: 44px;
            height: 44px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 18px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            flex-shrink: 0;
        }

        .support-title {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .support-text {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .support-text a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .support-text a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="error-circle">
            <i class="fas fa-circle-xmark"></i>
        </div>
        <h1>Payment Failed</h1>
        <p class="subtitle">
            We couldn't process your payment. Don't worry, no money was deducted from your account.
        </p>

        <div class="reason-box">
            <span class="reason-header">Probable Reasons</span>
            <p class="reason-text">
                • Insufficient funds in account<br>
                • Bank server or network issues<br>
                • Payment session expired
            </p>
        </div>

        <a href="/payment?user_id={{ request('user_id') }}" class="btn-retry">
            Try Again
            <i class="fas fa-rotate-right"></i>
        </a>

        <div class="support-card">
            <div class="support-icon"><i class="fas fa-headset"></i></div>
            <div class="support-content">
                <span class="support-title">Payment deducted but having issues?</span>
                <p class="support-text">
                    Email us at <a href="mailto:support@ownsoftwaresolutions.com">support@ownsoftwaresolutions.com</a><br>
                    or <a href="mailto:hello@ownsoftwaresolutions.com">hello@ownsoftwaresolutions.com</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
