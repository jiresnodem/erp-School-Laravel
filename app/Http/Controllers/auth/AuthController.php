<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            if (Auth::check()) {
                $request->session()->regenerate();
                Toastr::success('Successfull !!!', 'Connection', ["positionClass" => "toast-top-right"]);
                return redirect()->intended('/admin');
            }
        } else {
            return back()->withErrors([
                'email' => 'Invalid or wrong email.',
                'password' => 'Invalid or wrong password.',
            ])->onlyInput('email');
        }
    }
    
    public function PasswordView()
    {


        return view('auth.resetPassword');
    }

    public function PasswordUpdate(Request $request)
    {

        $validatedData = $request->validate([

            'oldpassword' => 'required',
            'password' => 'required|confirmed',

        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
