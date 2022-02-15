<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <style>
        body {
            font-family : Inter, sans-serif;
        }

        .text-sm {
            font-size : 11px;
        }

        .text-center {
            text-align : center;
        }

        .text-right {
            text-align : right;
        }

        .font-weight-bold {
            font-weight : bold;
        }
        table, td, th {
            border-collapse: separate;
            border-spacing: 0px;
            white-space: nowrap;
        }

        .heading{
            font-size: 16px;
        }
        
        thead  td, th {
            border: 1px solid black;
            border-spacing: 0px;
            font-size: 16px;
        }
        tbody  td {
            font-size: 14px;
        }
        tfoot  td {
            border: none;
            border-spacing: 0px;
        }
        span {
            border: 1px solid black;
            padding: 1px 12px 1px 12px;
        }
        .left{
            margin-left: 180px;
        }
        .right{
            margin-top: -80px;
        }

        .text-uppercase {
            text-transform :uppercase;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <img src="file:///laragon/www/sci-app/public/assets/images/logo.png"  width="90">
        </div>
        <div class="right">
            <div class="heading text-center" style="margin-bottom:3px">Republic of the Philippines</div>
            <div class="heading text-center" style="margin-bottom:3px">PROVINCE OF SURIGAO DEL SUR</div>
            <div class="heading text-center" style="margin-bottom:3px">Tandag City, Surigao del Sur</div><br>
        </div>
    </div>
    <hr color="black">

    <h3 class='text-center text-uppercase'>
        List of all employees
    </h3>
    <p class='text-uppercase font-weight-bold'>
        Total Employees : {{ $employees->count() }}
    </p>
    <p class='text-uppercase font-weight-bold'>
        Total Amount : {{ $totalAmount }}
    </p>

    <table width='100%' cellpadding="3" border="1">
        <thead>
            <tr>
                <th class='text-uppercase'>Employee ID</th>
                <th class='text-uppercase'>Fullname</th>
                <th class='text-uppercase'>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td class='text-center'>{{ str_pad($employee->EmployeeID, 4, "0", STR_PAD_LEFT) }}</td>
                <td>{{ $employee->FullName }}</td>
                <td class='text-center'>{{ number_format($employee->Amount, 2, '.', ','); }}</td>
            </tr>
            @endforeach
        </tbody>
        
    </table>
</body>
</html>