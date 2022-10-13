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
                            <h5 class="mb-0 text-info">{{ isset($slice->id)?"Edit Slice ":"Step 2: Slice Registration "}}</h5>
                        </div>
                        <hr />
                        <form action="{{  route('slice.update', [$slice->id]) }}" method="post">
                            @csrf
                            <input type="hidden" name="trainning_id" value="{{ $trainning_id }}">
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="First slice" value="{{ isset($slice->name) ? $slice->name : old('name') }}">
                                    @error('name')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-sm-3 col-form-label">Amount</label>
                                <div class="col-sm-9">
                                    <input type="numder" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="50000" value="{{ isset($slice->price) ? $slice->price : old('price') }}">
                                    @error('price')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <input type="submit" class="btn btn-info" value='{{ isset($slice->id)?"Edit":"Save"}}'>
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