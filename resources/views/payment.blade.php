<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Payment | MyPG</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        :root {
            --primary: #4f8ef7;
            --primary-pressed: #3b7de8;
            --bg: #f8faff;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #94a3b8;
            --success: #16a34a;
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
            padding: 40px 20px;
        }

        .container {
            width: 100%;
            max-width: 500px;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            background: #fff;
            padding: 12px 16px;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
        }

        .back-btn {
            width: 36px;
            height: 36px;
            border-radius: 18px;
            background: #eef4ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            text-decoration: none;
            transition: all 0.2s;
        }

        .header-title {
            font-size: 17px;
            font-weight: 700;
        }

        /* Hero Banner */
        .hero-banner {
            background: #fff;
            border-radius: 20px;
            padding: 24px;
            text-align: center;
            margin-bottom: 16px;
            box-shadow: 0 10px 25px -5px rgba(147, 197, 253, 0.12);
        }

        .hero-icon-wrap {
            width: 72px;
            height: 72px;
            border-radius: 36px;
            background: #eef4ff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            color: var(--primary);
            font-size: 32px;
        }

        .hero-title {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .hero-subtitle {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 20px;
        }

        /* Pricing Card */
        .pricing-card {
            background: #fff;
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px -5px rgba(147, 197, 253, 0.12);
            text-align: center;
        }

        .pricing-badge {
            background: #eef4ff;
            border-radius: 8px;
            padding: 4px 12px;
            display: inline-block;
            margin-bottom: 12px;
        }

        .pricing-badge-text {
            font-size: 11px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .price-row {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            margin-bottom: 4px;
        }

        .currency-symbol {
            font-size: 28px;
            font-weight: 700;
            margin-top: 8px;
        }

        .price-amount {
            font-size: 64px;
            font-weight: 900;
            line-height: 72px;
            letter-spacing: -2px;
        }

        .price-note {
            font-size: 13px;
            color: var(--success);
            font-weight: 600;
            margin-bottom: 20px;
        }

        .divider {
            height: 1px;
            background: #f1f5f9;
            margin-bottom: 20px;
        }

        .features-list {
            text-align: left;
        }

        .feature-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .feature-icon-wrap {
            width: 32px;
            height: 32px;
            border-radius: 16px;
            background: #eef4ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 14px;
            flex-shrink: 0;
        }

        .feature-text {
            font-size: 14px;
            color: #475569;
            font-weight: 500;
        }

        /* Action Button */
        .pay-btn {
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
            transition: all 0.2s;
            box-shadow: 0 10px 15px -3px rgba(79, 142, 247, 0.35);
            margin-bottom: 16px;
        }

        .pay-btn:hover {
            background: var(--primary-pressed);
            transform: translateY(-1px);
        }

        .pay-btn:disabled {
            background: #93c5fd;
            cursor: not-allowed;
            box-shadow: none;
        }

        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 12px;
            color: var(--text-muted);
        }

        .loader {
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
            display: none;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <a href="/register" class="back-btn"><i class="fas fa-arrow-left"></i></a>
            <div class="header-title">Complete Payment</div>
            <div style="width: 36px;"></div>
        </div>

        <!-- Hero -->
        <div class="hero-banner">
            <div class="hero-icon-wrap">
                <i class="fas fa-house"></i>
            </div>
            <h1 class="hero-title">Almost There!</h1>
            <p class="hero-subtitle">One payment away from managing your PG smarter</p>
        </div>

        <!-- Pricing Card -->
        <div class="pricing-card">
            <div class="pricing-badge">
                <span class="pricing-badge-text">Get access only at</span>
            </div>
            
            <div class="price-row">
                <span class="currency-symbol">₹</span>
                <span class="price-amount">799</span>
            </div>
            <p class="price-note">Yearly payment · No hidden charges</p>

            <div class="divider"></div>

            <div class="features-list">
                <div class="feature-row">
                    <div class="feature-icon-wrap"><i class="fas fa-users"></i></div>
                    <span class="feature-text">Unlimited member management</span>
                </div>
                <div class="feature-row">
                    <div class="feature-icon-wrap"><i class="fas fa-wallet"></i></div>
                    <span class="feature-text">Rent tracking & payments</span>
                </div>
                <div class="feature-row">
                    <div class="feature-icon-wrap"><i class="fas fa-message"></i></div>
                    <span class="feature-text">Notice templates & WhatsApp sharing</span>
                </div>
                <div class="feature-row">
                    <div class="feature-icon-wrap"><i class="fas fa-user-plus"></i></div>
                    <span class="feature-text">Add partners to manage your PG</span>
                </div>
                <div class="feature-row">
                    <div class="feature-icon-wrap"><i class="fas fa-shield-check"></i></div>
                    <span class="feature-text">Secure & reliable platform</span>
                </div>
            </div>
        </div>

        <!-- Action -->
        <button class="pay-btn" id="payButton" onclick="initiatePayment()">
            <div class="loader" id="loader"></div>
            <i class="fas fa-credit-card" id="btnIcon"></i>
            <span id="btnText">Pay ₹799 Securely</span>
        </button>

        <div class="security-note">
            <i class="fas fa-globe"></i>
            Secured by Razorpay • 256-bit Encryption
        </div>
    </div>

    <script>
        const userId = "{{ request('user_id') }}";
        const email = sessionStorage.getItem('mypg_email') || "{{ request('email') }}";
        const p = sessionStorage.getItem('mypg_pass') || "{{ request('p') }}";

        async function initiatePayment() {
            const btn = document.getElementById('payButton');
            const loader = document.getElementById('loader');
            const btnText = document.getElementById('btnText');
            const btnIcon = document.getElementById('btnIcon');

            btn.disabled = true;
            loader.style.display = 'block';
            btnText.innerText = 'Preparing payment...';
            btnIcon.style.display = 'none';

            try {
                // 1. Create Order
                const orderRes = await fetch('/api/create-order', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ user_id: userId })
                });

                const orderData = await orderRes.json();

                if (!orderData.status) {
                    alert('Could not prepare payment: ' + orderData.message);
                    resetButton();
                    return;
                }

                // 2. Open Razorpay Checkout
                const options = {
                    "key": orderData.key,
                    "amount": orderData.amount,
                    "currency": orderData.currency,
                    "name": "MyPG Management",
                    "description": "Yearly Subscription",
                    "order_id": orderData.order_id,
                    "handler": async function (response) {
                        await verifyPayment(response);
                    },
                    "prefill": {
                        "email": email,
                    },
                    "theme": { "color": "#4f8ef7" }
                };

                const rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function (response) {
                    window.location.href = `/payment-failure?user_id=${userId}`;
                });
                rzp1.open();

            } catch (error) {
                console.error(error);
                alert('An error occurred during payment initialization.');
                resetButton();
            }
        }

        async function verifyPayment(rzpResponse) {
            const btnText = document.getElementById('btnText');
            btnText.innerText = 'Verifying payment...';

            try {
                const res = await fetch('/api/verify-payment', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        razorpay_payment_id: rzpResponse.razorpay_payment_id,
                        razorpay_order_id: rzpResponse.razorpay_order_id,
                        razorpay_signature: rzpResponse.razorpay_signature,
                        user_id: userId
                    })
                });

                const data = await res.json();

                if (data.status) {
                    window.location.href = `/payment-success`;
                } else {
                    alert('Payment verification failed: ' + data.message);
                    resetButton();
                }
            } catch (error) {
                console.error(error);
                alert('Error verifying payment.');
                resetButton();
            }
        }

        function resetButton() {
            const btn = document.getElementById('payButton');
            const loader = document.getElementById('loader');
            const btnText = document.getElementById('btnText');
            const btnIcon = document.getElementById('btnIcon');
            
            btn.disabled = false;
            loader.style.display = 'none';
            btnText.innerText = 'Pay ₹799 Securely';
            btnIcon.style.display = 'block';
        }
    </script>
</body>
</html>