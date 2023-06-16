<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        //return $request->all();
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt(array('email'=>$request->email,'password'=>$request->password)))
        {
            if(Auth::user()->is_admin == 1){
                $notifation = array('message' => 'You are Logged In!',
                             'alert-type' => 'success',       
                        );
                return redirect()->route('admin.dashboard')->with($notifation);
            }
            else{
                $notifation = array('message' => 'You are Logged In!',
                             'alert-type' => 'success',       
                        );
                return redirect()->route('admin.login')->with($notifation); 
            }
        }
        else{
            return back()->with('error','Invalid Email or Password');
        }
    }
    public function admin_login()
    {
        return view('auth.admin.login');
    }
}
