<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Member;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request){
        return view('auth/register',['initData'=>$request->data]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $request)
    {
        $label = $request['data'][1]['label'];
        $messages = ['email.required' => $label->login[0]->login_error_email_blank
                    ,'email.string'=>$label->login[0]->login_error_email_string
                    ,'email.email'=>$label->login[0]->login_error_email_not
                    ,'email.unique'=>$label->login[0]->login_error_email_unique
                    ,'password.required' => $label->login[0]->login_error_password_blank
                    ,'password.string'=>$label->login[0]->login_error_password_string
                    ,'password.min'=>$label->login[0]->login_error_password_min
                    ,'password.confirmed'=>$label->login[0]->login_error_password_confirm
                    ,'name.required' => $label->login[0]->login_error_name_blank
                    ,'name.string'=>$label->login[0]->login_error_name_string
                    ,'name.max'=>$label->login[0]->login_error_name_max];
        return Validator::make($request, Member::$registRules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Member::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'created'=> date('Y-m-d'),
        ]);
    }

    // registered Override
    protected function registered(Request $request, $user) {
        //session
        Auth::attempt([
            'id' => $request->input('id'),
            'password' => $request->input('password')
            ]);
    
        return response(null, 204);
    }
}
