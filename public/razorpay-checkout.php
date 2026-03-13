<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>MyPG Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            /* Critical iOS fix: ensure all elements can receive touches */
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        }

        html, body {
            width: 100%;
            height: 100%;
            background: #f8faff;
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
            /* Do NOT use overflow:hidden or position:fixed here —
               that blocks touch events inside Razorpay's iframe */
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .loader {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            gap: 16px;
            padding-bottom: env(safe-area-inset-bottom, 34px);
        }

        .spinner {
            width: 44px;
            height: 44px;
            border: 3px solid #e2e8f0;
            border-top-color: #4f8ef7;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        .loader p {
            font-size: 15px;
            color: #64748b;
        }

        /* Force Razorpay's iframe to be fully interactive */
        iframe {
            pointer-events: all !important;
            touch-action: auto !important;
        }
    </style>
</head>
<body>
    <div class="loader">
        <div class="spinner"></div>
        <p>Opening payment gateway...</p>
    </div>

    <script>
        var params   = new URLSearchParams(window.location.search);
        var key      = params.get('key');
        var amount   = params.get('amount');
        var currency = params.get('currency');
        var order_id = params.get('order_id');
        var user_id  = params.get('user_id');

        function postToApp(data) {
            if (window.ReactNativeWebView) {
                window.ReactNativeWebView.postMessage(JSON.stringify(data));
            }
        }

        if (!key || !order_id) {
            document.body.innerHTML =
                '<div class="loader"><p style="color:#dc2626">Invalid payment link.</p></div>';
        } else {
            var options = {
                key:         key,
                amount:      amount,
                currency:    currency,
                name:        'MyPG',
                description: 'Lifetime Access - Rs.799',
                order_id:    order_id,
                prefill:     {},
                theme:       { color: '#4f8ef7' },
                modal: {
                    backdropclose: true,
                    ondismiss: function () {
                        window.location.href = '/payment-redirect.php?status=cancelled';
                    }
                },

                handler: function (response) {
                    var p = new URLSearchParams({
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id:   response.razorpay_order_id,
                        razorpay_signature:  response.razorpay_signature,
                        user_id:             user_id,
                        status:              'success'
                    });
                    // Go to PHP page — NOT directly to mypg://
                    window.location.href = '/payment-redirect.php?' + p.toString();
                },
            };

            var rzp = new Razorpay(options);

            rzp.on('payment.failed', function (response) {
                window.location.href = '/payment-redirect.php?status=cancelled';
            });



            // Small delay so the page fully renders before popup opens
            // This prevents the iOS touch system from being in a bad state
            setTimeout(function () {
                rzp.open();
            }, 300);
        }
    </script>
</body>
</html>