<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;

class AdminHomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    function dashboard()
    {
        return view('admin.dashboard');
    }
    function logout()
    {
        Auth::logout();
        $notifation = array('message' => 'You are Logged Out!',
                             'alert-type' => 'info',       
                        );
        return redirect()->route('admin.login')->with($notifation);
    }
    //forget password
    function changepassword(){
        return view('admin.profile.changepassword');
    }
    //password update
    function password_update(Request $request)
    {
        
        $request->validate([
            'c_password'=>'required',
            'password'=>'required|min:6|confirmed',
        ]);
        $current_pass = Auth::user()->password;
        if(Hash::check($request->c_password,$current_pass))
        {
            $user = User::findOrfail(Auth::id())->update([
                'password' => Hash::make($request->password),
            ]);
            $message = array('message' => 'Your Password Changed',
            'alert-type' => 'success',       
                );
            Auth::logout();
            return redirect()->route('admin.login')->with($message);
        }
        else{
            $message = array('message' => 'Old Password Doesnot Match',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }

        
    }
}
