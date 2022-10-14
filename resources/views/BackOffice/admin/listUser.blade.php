@extends('BackOffice.layout.default')


@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Users</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">User Table</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.user') }}" class="btn btn-primary">Add User</a>
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
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Address</th>
                                <th>Position held</th>
                                <th>Roles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }} </td>
                                <td>{{ $user->gender}} </td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->phone}}</td>
                                <td>{{ $user->address}} </td>
                                <td>{{ $user->post_description}} </td>
                                <td >
                                @foreach($user->roles as $role)
                                {{ $role->name }}<br>
                                @endforeach
                                </td>
                              
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Address</th>
                                <th>Position held</th>
                                <th>Roles</th>
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
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Phone number</th>
                        <th>Roles</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }} </td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->phone}}</td>
                        <td >
                                @foreach($user->roles as $role)
                                {{ $role->name }}<br>
                                @endforeach
                                </td>
                        <td>
                            <a href="{{ route('show.user', $user->id ) }}" class="btn btn-success">Show</a>
                            <a href="{{ route('user.edited', $user->id ) }}" class="btn btn-primary">Edit</a>
                            <input type="submit" class="btn btn-danger" value='Delete' @if( Auth::user()->last_name == 'Nodem' ) disabled @endif>
             
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