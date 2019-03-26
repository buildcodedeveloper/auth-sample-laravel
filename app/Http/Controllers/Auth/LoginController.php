<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Usuario;
class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/home';


    public function username(){
        return 'email';
    }
   

    public function password(){
        return 'senha';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function validateLogin(Request $request){
        $this->validate($request, [
            $this->username() => 'required',
      $this->password() => 'required',
        ]);
    }
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), $this->password());
    }

}