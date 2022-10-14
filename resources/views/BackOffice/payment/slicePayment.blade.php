@extends('BackOffice.layout.default')


@section('content')

<div class="page-content">

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">Payment</h6>
            <hr />
            <div class="card border-top border-0 border-4 border-info">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-student me-1 font-22 text-info"></i>
                            </div>
                            <h5 class="mb-0 text-info">Slice payment</h5>
                        </div>
                        <hr />
                        <form action="{{ route('slice.payment.add') }}" method="post">
                            @csrf

                           
                            <div class="row mb-3">


                                <input type="hidden" name="student_id" class="form-control" id="student_id" placeholder="Jhon" value="{{ $student->id  }}">
                                <input type="hidden" name="trainning_id" class="form-control" id="trainning_id" placeholder="Jhon" value="{{ $data_trainning->id }}">

                            </div>
                            <div class="row mb-3">
                                <label for="matricule" class="col-sm-3 col-form-label">Matricule </label>
                                <div class="col-sm-9">
                                    <input type="text" name="matricule" class="form-control" id="matricule" placeholder=" 2022-dev254 or Jhon" value="{{ isset($student->matricule) ? $student->matricule :'' }}">
                                </div>
                            </div>
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
                                <label for="student_phone" class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="student_phone" class="form-control" id="student_phone" placeholder="Doe" value="{{ isset($student->student_phone) ? $student->student_phone : ''}}">
                                    @error('last_name')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" id="email" placeholder="Doe" value="{{ isset($student->email) ? $student->email : ''}}">
                                    @error('last_name')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Trainning</label>
                                <div class="col-sm-9">
                                    <input type="text" name="trainning" class="form-control" id="last_name" placeholder="Doe" value="{{ isset($data_trainning->title) ? $data_trainning->title : ''}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Enter the amount</label>
                                <div class="col-sm-9">
                                    <input type="text" name="amount_pay" class="form-control" id="last_name" placeholder="Doe">
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <input type="submit" class="btn btn-info" value='Confirm' @if( $total_payment == $data_trainning->amount )) disabled @endif>
                                    @if( $total_payment == $data_trainning->amount ) <p class="mt-4">Schooling ok !!!</p> @endif
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