<?php
$payment_id = $_GET['razorpay_payment_id'] ?? '';
$order_id   = $_GET['razorpay_order_id'] ?? '';
$signature  = $_GET['razorpay_signature'] ?? '';
$user_id    = $_GET['user_id'] ?? '';
$status     = $_GET['status'] ?? 'success';

if ($status === 'cancelled') {
    $deep_link = 'mypg://payment-cancelled';
} else {
    $deep_link = 'mypg://payment-success?'
        . 'razorpay_payment_id=' . urlencode($payment_id)
        . '&razorpay_order_id='  . urlencode($order_id)
        . '&razorpay_signature=' . urlencode($signature)
        . '&user_id='            . urlencode($user_id);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <style>
        body {
            font-family: -apple-system, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #f8faff;
            gap: 16px;
            padding: 32px;
            text-align: center;
        }
        .icon { font-size: 56px; }
        h2 { color: #1e293b; font-size: 22px; }
        p  { color: #64748b; font-size: 15px; line-height: 1.5; }
        a.btn {
            display: inline-block;
            margin-top: 8px;
            background: #4f8ef7;
            color: #fff;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="icon">✅</div>
    <h2>Payment Successful!</h2>
    <p>Tap the button below to return to the app.</p>

    <!-- This <a> tag is what iOS allows — user tap on a link CAN open custom schemes -->
    <a class="btn" href="<?= htmlspecialchars($deep_link) ?>">Return to MyPG App</a>

    <script>
        // Try auto-redirect after short delay (works on Android, sometimes iOS)
        setTimeout(function() {
            window.location.href = "<?= addslashes($deep_link) ?>";
        }, 1000);
    </script>
</body>
</html>