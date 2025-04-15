<!DOCTYPE html>
<html>

<head>
    <title>FCY Requests PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h2>FCY Requests Report</h2>
    <table>
        <thead>
            <tr>
                <th>Applicant Name</th>
                <th>Branch Name</th>
                <th>NBE Account Number</th>
                <th>Currency Type</th>
                <th>Mode of Payment</th>
                <th>Record Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allFcyRequest as $fcyRequest)
                <tr>
                    <td>{{ $fcyRequest->applicantName }}</td>
                    <td>{{ $fcyRequest->branchName }}</td>
                    <td>{{ $fcyRequest->NBEAccountNumber }}</td>
                    <td>{{ $fcyRequest->currencyType }}</td>
                    <td>{{ $fcyRequest->modeOfPayment }}</td>
                    <td>{{ $fcyRequest->recordStatus }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
