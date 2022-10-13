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
                <th width="40%" colspan="2">
                    <h2 class="text-start">GETSMARTER</h2>
                </th>
                <th width="60%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: #6</span> <br>
                    <span>Date: {{ date('d / m / Y') }}</span> <br>
                    <span>Zip code : 560077</span> <br>
                    <span>Douala Bonamoussadi_sable</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">

                <th colspan="4" width="50%">Student Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>

                <td colspan="1">Matricule:</td>
                <td colspan="3">{{ $student->matricule }}</td>

            </tr>
            <tr>

                <td colspan="1">Full Name:</td>
                <td colspan="3">{{ $student->first_name.''.$student->last_name }}</td>

            </tr>
            <tr>

                <td colspan="1">Email:</td>
                <td colspan="3">{{ $student->email }}</td>

            </tr>
            <tr>

                <td colspan="1">Phone:</td>
                <td colspan="3">{{ $student->student_phone }}</td>

            </tr>
            <tr>

                <td colspan="1">Trainning:</td>
                <td colspan="3">{{ $trainning->title}}</td>

            </tr>
            <tr>

                <td colspan="1">Trainning:</td>
                <td colspan="3">{{ $trainning->duration}}</td>

            </tr>

        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading">
                    Payment Details
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
                <th>Slice</th>
                <th>Amount slice</th>
                <th>Total paid</th>
            </tr>
        </thead>
        <tbody>
            @if($total_payment < $trainning->slices[0]->price )
                <tr>
                    <td width="10%">1</td>
                    <td>
                        {{ $trainning->slices[0]->name }}
                    </td>
                    <td width="10%">{{ $trainning->slices[0]->price }}</td>
                    <td width="15%" class="fw-bold">{{ $total_payment - $trainning->slices[0]->price  }} FCFA</td>
                </tr>
                @else
                <tr>
                    <td width="10%">1</td>
                    <td>
                        {{ $trainning->slices[0]->name }}
                    </td>
                    <td width="10%">{{ $trainning->slices[0]->price }}</td>
                    <td width="15%" class="fw-bold">{{ $trainning->slices[0]->price }} FCFA</td>
                </tr>
                @endif

                @if($total_payment < $trainning->slices[0]->price + $trainning->slices[1]->price )
                    @if($total_payment > $trainning->slices[0]->price )
                    <tr>
                        <td width="10%">2</td>
                        <td>
                            {{ $trainning->slices[1]->name }}
                        </td>
                        <td width="10%">{{ $trainning->slices[1]->price }}</td>
                        <td width="15%" class="fw-bold">{{ ($total_paymentA + $amount_pay ) - ( $trainning->slices[0]->price + $trainning->slices[1]->price )  }} FCFA</td>
                    </tr>
                    @else
                    <tr>
                        <td width="10%">2</td>
                        <td>
                            {{ $trainning->slices[1]->name }}
                        </td>
                        <td width="10%">{{ $trainning->slices[1]->price }}</td>
                        <td width="15%" class="fw-bold">{{ 0 }} FCFA</td>
                    </tr>

                    @endif
                    @else
                    <tr>
                        <td width="10%">2</td>
                        <td>
                            {{ $trainning->slices[1]->name }}
                        </td>
                        <td width="10%">{{ $trainning->slices[1]->price }}</td>
                        <td width="15%" class="fw-bold">{{ $trainning->slices[1]->price }} FCFA</td>
                    </tr>
                    @endif



                    @if($total_payment < $trainning->slices[0]->price + $trainning->slices[1]->price + $trainning->slices[2]->price )
                        @if($total_payment > $trainning->slices[0]->price + $trainning->slices[1]->price)
                        <tr>
                            <td width="10%">3</td>
                            <td>
                                {{ $trainning->slices[2]->name }}
                            </td>
                            <td width="10%">{{ $trainning->slices[2]->price }}</td>
                            <td width="15%" class="fw-bold">{{ ($total_paymentA + $amount_pay ) - ( $trainning->slices[0]->price + $trainning->slices[1]->price + $trainning->slices[2]->price)   }} FCFA</td>
                        </tr>
                        @else
                        <tr>
                            <td width="10%">3</td>
                            <td>
                                {{ $trainning->slices[2]->name }}
                            </td>
                            <td width="10%">{{ $trainning->slices[2]->price }}</td>
                            <td width="15%" class="fw-bold">{{ 0 }} FCFA</td>
                        </tr>

                        @endif
                        @else
                        <tr>
                            <td width="10%">3</td>
                            <td>
                                {{ $trainning->slices[2]->name }}
                            </td>
                            <td width="10%">{{ $trainning->slices[2]->price }}</td>
                            <td width="15%" class="fw-bold">{{ $trainning->slices[2]->price }} FCFA</td>
                        </tr>
                        @endif



                        @if($total_payment < $trainning->slices[0]->price + $trainning->slices[1]->price + $trainning->slices[2]->price + $trainning->slices[3]->price )
                            @if($total_payment > $trainning->slices[0]->price + $trainning->slices[1]->price + $trainning->slices[2]->price )
                            <tr>
                                <td width="10%">4</td>
                                <td>
                                    {{ $trainning->slices[3]->name }}
                                </td>
                                <td width="10%">{{ $trainning->slices[3]->price }}</td>
                                <td width="15%" class="fw-bold">{{ ($total_paymentA + $amount_pay ) - ( $trainning->slices[0]->price + $trainning->slices[1]->price + $trainning->slices[2]->price + $trainning->slices[3]->price )  }} FCFA</td>
                            </tr>
                            @else
                            <tr>
                                <td width="10%">4</td>
                                <td>
                                    {{ $trainning->slices[2]->name }}
                                </td>
                                <td width="10%">{{ $trainning->slices[3]->price }}</td>
                                <td width="15%" class="fw-bold">{{ 0 }} FCFA</td>
                            </tr>

                            @endif
                            @else
                            <tr>
                                <td width="10%">4</td>
                                <td>
                                    {{ $trainning->slices[3]->name }}
                                </td>
                                <td width="10%">{{ $trainning->slices[3]->price }}</td>
                                <td width="15%" class="fw-bold">{{ $trainning->slices[3]->price }} FCFA</td>
                            </tr>
                            @endif



                            @if($total_payment < $trainning->slices[0]->price + $trainning->slices[1]->price + $trainning->slices[2]->price + $trainning->slices[3]->price + $trainning->slices[4]->price )
                                @if($total_payment >= $trainning->slices[0]->price + $trainning->slices[1]->price + $trainning->slices[2]->price + $trainning->slices[3]->price )
                                <tr>
                                    <td width="10%">5</td>
                                    <td>
                                        {{ $trainning->slices[4]->name }}
                                    </td>
                                    <td width="10%">{{ $trainning->slices[4]->price }}</td>
                                    <td width="15%" class="fw-bold">{{ ($total_paymentA + $amount_pay ) - ( $trainning->slices[0]->price + $trainning->slices[1]->price + $trainning->slices[2]->price + $trainning->slices[3]->price + $trainning->slices[4]->price )  }} FCFA</td>
                                </tr>
                                @else
                                <tr>
                                    <td width="10%">5</td>
                                    <td>
                                        {{ $trainning->slices[4]->name }}
                                    </td>
                                    <td width="10%">{{ $trainning->slices[4]->price }}</td>
                                    <td width="15%" class="fw-bold">{{ 0 }} FCFA</td>
                                </tr>

                                @endif
                                @else
                                <tr>
                                    <td width="10%">5</td>
                                    <td>
                                        {{ $trainning->slices[4]->name }}
                                    </td>
                                    <td width="10%">{{ $trainning->slices[4]->price }}</td>
                                    <td width="15%" class="fw-bold">{{ $trainning->slices[4]->price }} FCFA</td>
                                </tr>
                                @endif

                                <tr>
                                    <td colspan="3" class="total-heading">Total Amount paid :</td>
                                    <td colspan="1" class="total-heading">{{ $total_paymentA + $amount_pay }} FCFA</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="total-heading">Total amount remaining:</td>
                                    <td colspan="1" class="total-heading">{{ $trainning->amount - $total_payment  }} FCFA</td>
                                </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        GETSMARTER thanks you for your payment.
    </p>

</body>

</html>