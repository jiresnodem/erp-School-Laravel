@extends('BackOffice.layout.default')


@section('content')

<div class="page-content">

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h6 class="mb-0 text-uppercase">User</h6>
            <hr />
            <div class="card border-top border-0 border-4 border-info">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                            </div>
                            <h5 class="mb-0 text-info">User Registration</h5>
                        </div>
                        <hr />
                        <form action="{{ isset($user->id)? route('update.user', [$user->id]) : route('user.created') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputFirstName" class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="first_name" class="form-control" id="inputFirstName" placeholder="Jhon" value="{{ isset($user->first_name) ? $user->first_name :'' }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputFirstName" class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="last_name" class="form-control" id="inputFirstName" placeholder="Doe" value="{{ isset($user->last_name) ? $user->last_name : ''}}">
                                    @error('last_name')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputFirstName" class="col-sm-3 col-form-label">Gender</label>
                                <div class="col-sm-9 mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="radio1" value='male' @if($user->gender == 'male') checked @endif>
                                        <label class="form-check-label" for="radio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="radio2" value='feminine'  @if($user->gender == 'feminine') checked @endif>
                                        <label class="form-check-label" for="radio2">Feminine</label>
                                    </div>
                                    @error('gender')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPhoneNo" class="col-sm-3 col-form-label">Roles</label>
                                <div class="col-sm-9">

                                    <div>

                                        @foreach($roles as $role)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="{{ $role->id }}" @foreach( $user->roles as $userRole ) @if($userRole->id === $role->id) checked @endif @endforeach>
                                            <label class="form-check-label" for="{{ $role->id }}">{{ $role->name  }}</label>
                                        </div>
                                        @endforeach
                                
                                        @error('role1')
                                        <p class="text mt-1 text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Phone No</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" class="form-control" id="inputPhoneNo2" placeholder="Phone No" value="{{ isset($user->phone) ? $user->phone : '' }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Email Address</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" id="inputEmailAddress2" placeholder="Email Address" value="{{ isset($user->email)  ? $user->email : '' }}">
                                    @error('email')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmailAddress" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" name="address" class="form-control" id="inputEmailAddress" placeholder="Bonamoussadi" value="{{ isset($user->address) ? $user->address :'' }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmailAddre" class="col-sm-3 col-form-label">Position held</label>
                                <div class="col-sm-9">
                                    <input type="text" name="post_description" class="form-control" id="inputEmailAddre" placeholder="web developper" value="{{ isset($user->post_description ) ? $user->post_description :''}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputAddress4" class="col-sm-3 col-form-label">About</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="about" id="inputAddress4" rows="3" placeholder="About me">{{ isset($user->about)? $user->about :'' }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="projectinput7" class="col-sm-3 col-form-label">Profile image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control-file" id="projectinput7" name="image" value='{{isset($user->profile_photo_path)? $user->profile_photo_path :""}}' accept=".png, .jpg, .jpeg">
                                    @error('image')
                                    <p class="text mt-1 text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Choose Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputChoosePassword2" placeholder="Choose Password">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <input type="submit" class="btn btn-info" value='{{ isset($user->id)?"Edit":"Save"}}'>
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