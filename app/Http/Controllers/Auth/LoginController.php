<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
    public function showLoginForm(){
        if(Auth::user()){
            return redirect('member/dashboard');
        }else if(Auth::guard('admin')->user()){

            return redirect('admin/dashboard');
        }else{
            return view('auth.login');
        }
    }
    public function login(Request $request)
    {
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $auth = Auth::guard('admin')->attempt([
                'email'      => $request->username,
                'password'  => $request->password
            ]);
            if ($auth) {  
                return Redirect()->to('admin/dashboard');
            } else {
                return redirect()->back()
                ->with('alertlogin',TRUE);
            }
        } else {
            $auth = Auth::attempt([
                'userid'      => $request->username,
                'password'  => $request->password
            ]);
            if ($auth) {  
                return Redirect()->to('member/dashboard');
            } else {
                return redirect()->back()
                ->with('alertlogin',TRUE);
            }
        }
          
    }
    public function logoutall()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
