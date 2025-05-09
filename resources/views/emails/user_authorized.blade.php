<!DOCTYPE html>
<html>
<head>
    <title>User Access Granted - FCRS</title>
</head>
<body>
    <p>Hello {{ $user->name }},</p>

    <p>Your account has been authorized. Here are your credentials:</p>

    <ul>
        <li><strong>Username:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Default Password:</strong> 123456</li>
    </ul>

    <p>Please log in and change your password immediately.</p>
    <p><img src="{{ asset('images/emailFooter.png') }}" alt="Email Footer" ></p>
    <p>Thank you,<br>The Team</p>
</body>
</html>
