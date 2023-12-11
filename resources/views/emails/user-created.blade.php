<!DOCTYPE html>
<html>
<head>
    <title>Welcome to our Jobcloset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .message {
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
        }
        a {
            color: #008CBA;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Welcome to {{ config('app.name') }}, {{ $user->name }}</h2>
    <div class="message">
        <p>We are excited to have you with us. As a new user of our application, we want to make sure your experience is successful and productive.</p>
        <br>
        <p>If you need further assistance, feel free to reach out to our support team. We are more than happy to help!</p>
        <p>Once again, welcome to {{ config('app.name') }}. We look forward to making your experience here a fruitful one.</p>
        <p>Best regards,</p>
        <p>Team LioWebdesign</p>
    </div>
</div>
</body>
</html>
