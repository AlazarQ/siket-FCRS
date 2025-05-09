<!DOCTYPE html>
<html>
<head>
    <title>FCY Request Registration</title>
</head>
<body>
    <p>Hello Admin,</p>

    <p>New FCY Request Registerd</p>

    <ul>
        <li><strong>Applicant Name:</strong> {{ $request->applicantName }}</li>
        <li><strong>Applicant NBE Account:</strong> {{ $request->NBEAccountNumber }}</li>
        <li><strong>Performa Invoice Numnber:</strong> {{ $request->performaInvoiceNumber }}</li>
    </ul>

    <p>Please log in and See the datails on the system.</p>
    <img src="{{ asset('images/emailFooter.png') }}" alt="Email Footer" style="width: 100%; height:100%"/>
    <p>Thank you,<br>Siket IBD Team</p>
</body>
</html>
