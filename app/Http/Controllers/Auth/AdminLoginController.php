<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("guest:admin", ['except' => ['logout']]);
    }
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }
    public function login(Request $request){

        // validation the form data;

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Attempt to login the user in

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password'=>$request->password], $request->remember)){

            return redirect(route('admin.dashboard'));
        }

        //if unsuccessful, then redirect to back to the login with the form data.

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
