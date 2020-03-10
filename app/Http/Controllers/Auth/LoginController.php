<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Member;

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

    public function showLoginForm(Request $request){
        return view('auth/login',['initData'=>$request->data]);
    }

    public function login(Request $request) {
        $password = $request->password;
        $id = $request->email;

        $messages = ['email.required' => $request->data[1]['label']->login[0]->login_error_email_blank
                    ,'password.required' => $request->data[1]['label']->login[0]->login_error_password_blank];
        $validateRule = Validator::make($request->all(), Member::$rules, $messages);
        
        if($validateRule->fails()){
            return redirect()->route('login')
            ->withInput()
            ->withErrors($validateRule);
        }

        $login = Auth::attempt([ 'email' => $id, 'password' => $password ]);
        if($login){
            return redirect()->route('index');
        }else{
            return redirect()->route('login')
                ->withInput()
                ->withErrors(['loginError'=>$request->data[1]['label']->login[0]->login_error_email_failed]);
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('index');
      }
}
