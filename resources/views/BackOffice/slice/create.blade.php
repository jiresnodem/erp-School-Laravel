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
                        <form action="{{ isset($slice->id) ? route('slice.update', [$slice->id]) : route('slice.add') }}" method="post">
                            @csrf

                            <input type="hidden" name="trainning_id" value="{{ $trainning->id }}">

                            <div class="row mb-3">
                                <label for="trainningAmount" class="col-sm-3 col-form-label">Amount of training selected</label>
                                <div class="col-sm-9">
                                    
                                    <input type="number" class="form-control" id="trainningAmount" placeholder="50000" value="{{ $trainning->amount }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="trainning" class="col-sm-3 col-form-label">Remaining amount</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="trainning" placeholder="Bonamoussadi" value="{{ $remainingAmount }}" readonly>
                                </div>
                            </div>
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
                                    <input type="submit" class="btn btn-info" value='{{ isset($slice->id)?"Edit":"Save"}}' @if( empty($remainingAmount) )) disabled @endif>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class='mt-5'>
            <h6 class="mb-0 text-uppercase">The names of the slices already created</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <table class="table mb-0">
                        <thead class="table-dark">
                            <tr>

                                <th>Name of slice</th>
                                <th>Price</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trainning->slices as $s)
                            <tr>
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->price }}</td>
                                <td class="d-flex ">
                                    <div class="mx-2">
                                        <form action="{{ route('slice.edit', [$s->id] ) }}" post = 'post'>
                                            <input type="hidden" name='trainning_id'value = '{{  $trainning->id }} '>
                                            <button  class="btn btn-primary">Edit</button>
                                        </form> 
                                    </div>
                                  
                                    <a href="{{ route('slice.delete', $s->id ) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total amount of slice created</th>
                                <th>{{ $totalSlice }} Fcfa</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</div>
</div>
</div>


@endsection