<?php

namespace App\Http\Controllers\BackOffice;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function UserList()
    {
       
        $users = User::all();
        return view('BackOffice.admin.listUser',  compact('users'));
    }

    public function UserAdd()
    {
$roles = Role::all();
        return view('BackOffice.admin.createUser', ['roles' => $roles]);
    }

    public function userStore(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'last_name' => 'required',
            'gender' => 'required',
            'roles' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'

        ]);

        if ($validatedData->fails()) {
            Toastr::error('Les champs email, last name et image peuvent pas etre vide !', 'Verify', ["positionClass" => "toast-top-right"]);
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        try {
            $data = new User();
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->address = $request->address;
            $data->gender = $request->gender;
            $data->phone = $request->phone;
            $data->about = $request->about;
            $data->post_description = $request->post_description;
            
            if ($request->image) {
                $file = $request->image;
                // @unlink(public_path('upload/user_images/' . $data->image));
                // $filename = date('YmdHi') .'_'. $file->getClientOriginalName();
                $filename = date('YmdHi') .'_'. $request->first_name.$request->last_name.'.'.$file->extension();
                $file->move(public_path('upload/user_images'), $filename);
                $data->profile_photo_path = $filename; 
            }

            $data->save();
       
            $data->roles()->sync($request->roles);
            Toastr::success('Successfully !!!', 'Registration', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info('Faild!', 'Registration', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->back();
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('BackOffice.admin.editUser', compact('user','roles'));
    }

    public function showUser($id)
    {
        $user = User::find($id);

        return view('BackOffice.admin.showUser', compact('user'));
    }


    public function UpdateUser(Request $request, $id)
    {

        $validatedData = Validator::make($request->all(), [
            'email' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'roles' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'

        ]);

        if ($validatedData->fails()) {
            Toastr::error('Les champs email, last name et image peuvent pas etre vide !', 'Verify', ["positionClass" => "toast-top-right"]);
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }


        try {
            $data = User::find($id);
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->gender = $request->gender;
            $data->post_description = $request->post_description;
            $data->profile_photo_path = $request->profile_photo_path;
            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/user_images/' . $data->image));
                $filename = date('YmdHi') .'_'. $request->first_name.$request->last_name.'.'.$file->extension();
                $file->move(public_path('upload/user_images'), $filename);
                $data->profile_photo_path = $filename; 
            }
            $data->roles()->sync($request->roles);
            $data->update();
            // dd($request->role2);
            Toastr::success('Successfully !!!', 'Modification', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info('Failed!', 'Modification', ["positionClass" => "toast-top-right"]);
        }

        return redirect()->route('user.list');
    }

    public function DeleteUser($id)
    {
        try {

            $user = User::find($id);
            $user->roles()->detach();
            $user->delete();
            Toastr::success('Successfully !!!', 'Deletion', ["positionClass" => "toast-top-right"]);
        } catch (Exception $e) {
            Toastr::info('Failed!', 'Deletion', ["positionClass" => "toast-top-right"]);
        }

        return back();

    }

    public function ProfileView()
    {

        $id = Auth::user()->id;

        $userProfile = User::find($id);
        return view('BackOffice.admin.profileUser', compact('userProfile'));
    }


    public function ProfileEdit()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);

        return view('BackOffice.admin.editProfile', compact('editData'));
    }



}
