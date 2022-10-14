@extends('BackOffice.layout.default')


@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Expenses</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Expense Table</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('expense.create') }}" class="btn btn-primary">Add an expense</a>
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
                                <th>Reason</th>
                                <th>Amount</th>
                         

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expenses as $expense)
                            <tr>
                                <td>{{ $expense->reason }}</td>
                                <td>{{ $expense->amount }} Fcfa</td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total amount of expenses</th>
                                <th>{{  $sum_expence }} Fcfa</th>
                               
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Table head</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <table class="table mb-0">
                <thead class="table-dark">
                    <tr>

                        <th>Reason</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                    <tr>
                        <td>{{ $expense->reason }}</td>
                        <td>{{ $expense->amount }} </td>

                        <td>
                            <a href="{{ route('expense.show', $expense->id ) }}" class="btn btn-success">Show</a>
                            <a href="{{ route('expense.edit', $expense->id ) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('expense.delete', $expense->id ) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                            <tr>
                                <th>Total amount of expenses</th>
                                <th>{{  $sum_expence }} Fcfa</th>
                       
                            </tr>
                        </tfoot>
            </table>
        </div>
    </div>
</div>
</div>
<!--end row-->
</div>

@endsection