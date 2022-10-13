@extends('BackOffice.layout.default')


@section('content')

<div class="page-content">

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">Creation of training sections</h6>
            <hr />
            <div class="card border-top border-0 border-4 border-info">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-student me-1 font-22 text-info"></i>
                            </div>
                            <h5 class="mb-0 text-info">Step 1: Choice training</h5>
                        </div>
                        <hr />
                        <form action="{{ route('slice.create') }}" method="get">
                            @csrf

                            <div class="row mb-3">
                                <label for="trainning_id" class="col-sm-3 col-form-label">Select trainning</label>
                                <div class="col-sm-9">
                                    <select name="training_id" id="trainning_id" class="form-control">
                                        @foreach($trainnings as $trainning)
                                        <option value="{{ $trainning->id }}">{{ $trainning->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <input type="submit" class="btn btn-info" value="Next">
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