<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Approval</title>
</head>
<body>
    <div style="border: 1px solid #f3f3f3; padding: 20px; font-family: Arial, sans-serif;">
        <h2 style="color: #636b6f;">Order Approved</h2>
        <p>Hello,</p>
        <p>We are pleased to inform you that your order has been approved!</p>
        @if($paymentLink)
            <p>You can complete your order by clicking on the following payment link:</p>
            <a href="{{ $paymentLink }}" style="background-color: #ffcc00; color: #000; text-decoration: none; padding: 10px; border-radius: 5px;">Proceed to Payment</a>
        @endif

        <p style="margin-top: 50px;">Thank you for choosing our services,</p>
        <p>JobCloset</p>
    </div>
</body>
</html>
