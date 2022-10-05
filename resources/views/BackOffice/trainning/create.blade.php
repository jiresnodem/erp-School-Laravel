@extends('BackOffice.layout.default')


@section('content')

<div class="page-content">

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">trainning</h6>
            <hr />
            <div class="card border-top border-0 border-4 border-info">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-trainning me-1 font-22 text-info"></i>
                            </div>
                            <h5 class="mb-0 text-info">{{ isset($trainning->id)?"Edit trainning ":"Trainning Registration "}}</h5>
                        </div>
                        <hr />
                        <form action="{{ isset($trainning->id) ? route('trainning.update', [$trainning->id]) : route('trainning.add') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="title" class="col-sm-3 col-form-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Web disgn" value="{{ isset($trainning->title) ? $trainning->title :'' }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="duration" class="col-sm-3 col-form-label">Duration</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" id="duration" placeholder="Doe" value="{{ isset($trainning->duration) ? $trainning->duration : ''}}">
                                        @error('duration')
                                        <p class="text mt-1 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                            </div>
                            <div class="row mb-3">
                                <label for="amount" class="col-sm-3 col-form-label">Trainning fees</label>
                                <div class="col-sm-9">
                                    <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="300000" value="{{ isset($trainning->amount) ? $trainning->amount : ''}}">
                                    @error('amount')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="first_slice" class="col-sm-3 col-form-label">First slice</label>
                                <div class="col-sm-9">
                                    <input type="number" name="first_slice" class="form-control @error('first_slice') is-invalid @enderror" id="first_slice" placeholder="" value="{{ isset($trainning->first_slice) ? $trainning->first_slice : ''}}">
                                    @error('first_slice')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="second_slice" class="col-sm-3 col-form-label">Second slice</label>
                                <div class="col-sm-9">
                                    <input type="number" name="second_slice" class="form-control @error('second_slice') is-invalid @enderror" id="second_slice" placeholder="" value="{{ isset($trainning->second_slice) ? $trainning->second_slice : ''}}">
                                    @error('second_slice')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="third_slice" class="col-sm-3 col-form-label">Third slice</label>
                                <div class="col-sm-9">
                                    <input type="number" name="third_slice" class="form-control @error('third_slice') is-invalid @enderror" id="third_slice" placeholder="" value="{{ isset($trainning->third_slice) ? $trainning->third_slice : ''}}">
                                    @error('third_slice')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
               

                            <div class="row mb-3">
                                <label for="short_description" class="col-sm-3 col-form-label">Short description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control @error('duration') is-invalid @enderror" name="short_description" id="short_description" rows="3" placeholder="Short description">{{ isset($trainning->short_description)? $trainning->short_description :'' }}</textarea>
                                    @error('short_description')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="long_description" class="col-sm-3 col-form-label">Long description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="long_description" id="long_description" rows="3" placeholder="Long description">{{ isset($trainning->long_description)? $trainning->long_description :'' }}</textarea>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="trainning_photo_path" class="col-sm-3 col-form-label">Trainning picture</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control-file" id="trainning_photo_path" name="image" value='{{isset($trainning->trainning_photo_path)? $trainning->trainning_photo_path :""}}' accept=".png, .jpg, .jpeg">
                                  
                                </div>
                            </div>
              
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <input type="submit" class="btn btn-info" value='{{ isset($trainning->id)?"Edit":"Save"}}'>
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