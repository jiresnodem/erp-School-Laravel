<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #6</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>

<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">GETSMARTER</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: #6</span> <br>
                    <span>Date: {{ date('d / m / Y') }}</span> <br>
                    <span>Zip code : 560077</span> <br>
                    <span>Douala Bonamoussadi_sable</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">

                <th>Student Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>

                <td>Full Name:</td>
                <td>{{ $student->first_name.''.$student->last_name }}</td>

            </tr>
            <tr>

                <td>Email:</td>
                <td>{{ $student->email }}</td>

            </tr>
            <tr>

                <td>Phone:</td>
                <td>{{ $student->student_phone }}</td>

            </tr>
            <tr>

                <td>Trainning:</td>
                <td>{{ $trainning->title}}</td>

            </tr>
            <tr>

                <td>Matricule:</td>
                <td>{{ $student->matricule }}</td>

            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Details
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
                <th>Slice</th>
                <th>Amount slice</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trainning->slices as $slice)
            <tr>
                <td >{{ $i++ }}</td>
                <td>
                  {{ $slice->name }}
                </td>
                <td>{{  $slice->price }}</td>
                <td class="fw-bold">{{  $slice->price }} FCFA</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="total-heading">Total Amount :</td>
                <td colspan="1" class="total-heading">{{ $amount_pay }} FCFA</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for payment with GETSMARTER
    </p>

</body>

</html>