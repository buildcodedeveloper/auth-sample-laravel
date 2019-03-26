<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Usuario;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    protected function validateLogin(Request $request){
        $this->validate($request, [
            $this->username() => 'required',
      'senha' => 'required',
        ]);
    }
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'senha');
    }

    public function login(Request $request)
{
    $this->validate($request, [
        'email'    => 'required',
        'senha' => 'required',
    ]);

    $login_type = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL )
        ? 'email'
        : 'username';

    $request->merge([
        $login_type => $request->input('email')
    ]);

    if (Auth::attempt(['email'=>$request->input('email'), 'senha' =>$request->input('senha')]))
    {
        return redirect()->intended('home');
    }
    else
    {
         return redirect()->intended('login')->with('status', 'Invalid Login Credentials !');
    }


    return redirect()->back()
        ->withInput()
        ->withErrors([
            'login' => 'These credentials do not match our records.',
        ]);
    }
}