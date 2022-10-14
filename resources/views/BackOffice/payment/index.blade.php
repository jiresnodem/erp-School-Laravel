@extends('BackOffice.layout.default')


@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Invoices</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Invoice Table</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('payment.create') }}" class="btn btn-primary">Add payment</a>
            </div>
        </div>
    </div>

    <div>



        <h6 class="mb-0 text-uppercase">DataTable Import</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Receipt file</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->invoice_path }}</td>
                                <td>{{ $payment->amount_pay }}</td>
                                <td>{{ $payment->created_at }}</td>
                                <td>
                                    <a href="../upload/invoice/{{ $payment->invoice_path }}" class="btn btn-success">view</a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total received </th>
                                <th>{{ $sum_balance }} Fcfa</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>


@endsection