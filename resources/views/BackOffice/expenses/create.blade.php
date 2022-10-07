@extends('BackOffice.layout.default')


@section('content')

<div class="page-content">

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">Expense</h6>
            <hr />
            <div class="card border-top border-0 border-4 border-info">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            
                            <h5 class="mb-0 text-info">{{isset($expense->id)? 'Edit Expense' :'Expense Registration' }}</h5>
                        </div>
                        <hr />
                        <form action="{{ isset($expense->id) ? route('expense.update', $expense->id)  :route('expense.add') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="reason" class="col-sm-3 col-form-label">Reason</label>
                                <div class="col-sm-9">
                                    <input type="text" name="reason" class="form-control @error('reason') is-invalid @enderror" id="reason" placeholder="Jhon" value="{{ isset($expense->reason) ? $expense->reason : old('reason') }}">
                                    @error('reason')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                                <div class="col-sm-9">
                                    <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="Doe" value="{{ isset($expense->amount) ? $expense->amount : old('amount') }}">
                                    @error('amount')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="detail_reason" class="col-sm-3 col-form-label">Detail_reason</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="detail_reason" id="detail_reason" rows="3" placeholder="Details of reason ">{{ isset($expense->detail_reason)? $expense->detail_reason :'' }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <input type="submit" class="btn btn-info" value='{{ isset($expense->id)?"Edit":"Save"}}'>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</div>
</div>
</div>


@endsection