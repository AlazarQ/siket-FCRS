<!DOCTYPE html>
<html>
<head>
    <title>FCY Request Registration</title>
</head>
<body>
    <p>Hello {{ $user->name }},</p>

    <p>New FCY Request Registerd</p>

    <ul>
        <li><strong>Applicant Name:</strong> {{ $fcy-Request->applicantName }}</li>
    </ul>

    <p>Please log in and change your password immediately.</p>
    <p><img src="{{ asset('images/emailFooter.png') }}" alt="Email Footer" style="width:100%; max-width:100%;"></p>
    <p>Thank you,<br>Siket IBD Team</p>
</body>
</html>
