<!DOCTYPE html>
<html>
<head>
    <title>FCY Request Allocation - Approved</title>
</head>
<body>
    <p>Hello Admin,</p>

    <p>FCY Request Allocated</p>

    <ul>
        <li><strong>Applicant Name:</strong> {{ $fcyRequest->applicantName }}</li>
        <li><strong>Applicant NBE Account:</strong> {{ $fcyRequest->NBEAccountNumber }}</li>
        <li><strong>Performa Invoice Numnber:</strong> {{ $fcyRequest->performaInvoiceNumber }}</li>
    </ul>

    <p>Please log in and See the datails on the system.</p>
    <img src="{{ asset('images/emailFooter.png') }}" alt="Email Footer"/>
    <p>Thank you,<br>Siket IBD Team</p>
</body>
</html>
