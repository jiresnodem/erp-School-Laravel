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
                            <h5 class="mb-0 text-info">{{ isset($student->id)?"Edit student ":"Information of Student "}}</h5>
                        </div>
                        <hr />
                        <form action="{{ isset($student->id) ? route('student.update', [$student->id]) : route('payment.type') }}" method="get" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="first_name" class="col-sm-3 col-form-label">Matricule or Last name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="maricule_lastname" class="form-control" id="first_name" placeholder=" 2022-dev254 or Jhon" value="{{ isset($student->first_name) ? $student->first_name :'' }}">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <input type="submit" class="btn btn-info" value='{{ isset($student->id)?"Edit":"Next"}}'>
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