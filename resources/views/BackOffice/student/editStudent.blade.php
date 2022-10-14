@extends('BackOffice.layout.default')


@section('content')

<div class="page-content">

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">student</h6>
            <hr />
            <div class="card border-top border-0 border-4 border-info">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-student me-1 font-22 text-info"></i>
                            </div>
                            <h5 class="mb-0 text-info">{{ isset($student->id)?"Edit student ":"Student Registration "}}</h5>
                        </div>
                        <hr />
                        <form action="{{ isset($student->id) ? route('student.update', [$student->id]) : route('student.add') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Jhon" value="{{ isset($student->first_name) ? $student->first_name :'' }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Doe" value="{{ isset($student->last_name) ? $student->last_name : ''}}">
                                    @error('last_name')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputFirstName" class="col-sm-3 col-form-label">Gender</label>
                                <div class="col-sm-9 mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="radio1" value='male' @if($student->gender == 'male') checked @endif >
                                        <label class="form-check-label" for="radio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="radio2" value='feminine' @if($student->gender == 'feminine') checked @endif  >
                                        <label class="form-check-label" for="radio2">Feminine</label>
                                    </div>
                                    @error('gender')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
 
                            <div class="row mb-3">
                                <label for="student_phone" class="col-sm-3 col-form-label">Phone No</label>
                                <div class="col-sm-9">
                                    <input type="text" name="student_phone" class="form-control" id="student_phone" placeholder="Phone No" value="{{ isset($student->student_phone) ? $student->student_phone : '' }}" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" value="{{ isset($student->email)  ? $student->email : '' }}">
                                    @error('email')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="address" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" name="address" class="form-control" id="address" placeholder="Bonamoussadi" value="{{ isset($student->address) ? $student->address :'' }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="student_photo_path" class="col-sm-3 col-form-label">Trainning picture</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control-file" name="image" id="student_photo_path"  value="{{isset($student->student_photo_path)? $student->student_photo_path :''}}" accept=".png, .jpg, .jpeg">
                                  
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="parent_name" class="col-sm-3 col-form-label">Parent name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="parent_name" class="form-control" id="parent_name" placeholder="Phone No" value="{{ isset($student->parent_name) ? $student->parent_name : '' }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="parent_phone" class="col-sm-3 col-form-label">Parent phone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="parent_phone" class="form-control" id="parent_phone" placeholder="" value="{{ isset($student->parent_phone ) ? $student->parent_phone :''}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Select trainning</label>
                                <div class="col-sm-9">
                                    <select name="trainning_id" class="form-control">
                                        @foreach($trainnings as $trainning)
                                        <option value="{{ $trainning->id }}"  @if($student->trainning->title === $trainning->title) selected @endif >{{ $trainning->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 ">Pay type</label>
                                <div class="col-sm-9 mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pay_type" id="radio1" value='complet' @if($student->pay_type === 'complet') checked @endif >
                                        <label class="form-check-label" for="radio1">Complet</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pay_type" id="radio2" value='slice' @if($student->pay_type === 'slice') checked @endif >
                                        <label class="form-check-label" for="radio2">Slice</label>
                                    </div>
                                    @error('slice_pay || complet_pay')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <input type="submit" class="btn btn-info" value='{{ isset($student->id)?"Edit":"Save"}}'>
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