@extends('BackOffice.layout.default')


@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Basic Table</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('student.create') }}" class="btn btn-primary">Add students</a>
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
                                <th>Matricule</th>
                                <th>First name</th>
                                <th>last_name</th>
                                <th>email</th>
                                <th>trainning</th>
                                <th>Training costs</th>
                                <th>Remaining amount training</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $student->matricule }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->last_name }} </td>
                                <td>{{ $student->email}}</td>
                                <td>{{ $student->trainning->title}}</td>
                                <td>{{ $student->trainning->amount}}</td>
                                <td>{{ $student->Remaining_amount}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Matricule</th>
                                <th>First name</th>
                                <th>last_name</th>
                                <th>email</th>
                                <th>trainning</th>
                                <th>Training costs</th>
                                <th>Remaining amount training</th>

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

                        <th>First name</th>
                        <th>last_name</th>
                        <th>email</th>
                        <th>trainning</th>
                        <th>Training costs</th>
                        <th>Remaining amount training</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }} </td>
                        <td>{{ $student->email}}</td>
                        <td>{{ $student->trainning->title}}</td>
                        <td>{{ $student->trainning->amount}}</td>
                        <td>{{ $student->Remaining_amount}}</td>
                        <td>
                            <a href="{{ route('student.detail', $student->id ) }}" class="btn btn-success">Show</a>
                            <a href="{{ route('student.edit', $student->id ) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('student.delete', $student->id ) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!--end row-->
</div>

@endsection