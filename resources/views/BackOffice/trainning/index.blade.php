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
                <a href="{{ route('trainning.create') }}" class="btn btn-primary">Add trainnings</a>
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
                                <th>Title</th>
                                <th>Duration</th>
                                <th>Amount</th>
                                <th>Registration fees</th>
                                <th>First slice</th>
                                <th>Second slice</th>
                                <th>Third slice</th>
                                <th>Fourth slice</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trainnings as $trainning)
                            <tr>
                                <td>{{ $trainning->title }}</td>
                                <td>{{ $trainning->duration }} </td>
                                <td>{{ $trainning->amount}} </td>
                                @foreach($trainning->slices as $slice)
                                <td>{{ $slice->price}}</td>
                                @endforeach

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Duration</th>
                                <th>Amount</th>
                                <th>Registration fees</th>
                                <th>First slice</th>
                                <th>Second slice</th>
                                <th>Third slice</th>
                                <th>Fourth slice</th>
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

                        <th>Title</th>
                        <th>Duration</th>
                        <th>Amount</th>
                     
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trainnings as $trainning)
                    <tr>
                        <td>{{ $trainning->title }}</td>
                        <td>{{ $trainning->duration }} </td>
                        <td>{{ $trainning->amount}} </td>
                    
                        <td>
                            <a href="{{ route('trainning.detail', $trainning->id ) }}" class="btn btn-success">Show</a>
                            <a href="{{ route('trainning.edit', $trainning->id ) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('trainning.delete', $trainning->id ) }}" class="btn btn-danger">Delete</a>
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