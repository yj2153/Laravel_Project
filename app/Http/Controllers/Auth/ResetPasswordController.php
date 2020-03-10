<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Member;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    
    public function showResetForm(Request $request){
        $token = $request->token;
        $email = $request->email;
        return view('auth/passwords/reset',['initData'=>$request->data
                                            ,'token' =>$token
                                            ,'email' =>$email]);
    }
    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $label = $request['data'][1]['label'];
        $messages = ['email.required' => $label->login[0]->login_error_email_blank
                    ,'email.string'=>$label->login[0]->login_error_email_string
                    ,'email.email'=>$label->login[0]->login_error_email_not
                    ,'email.unique'=>$label->login[0]->login_error_email_unique
                    ,'password.required' => $label->login[0]->login_error_password_blank
                    ,'password.string'=>$label->login[0]->login_error_password_string
                    ,'password.min'=>$label->login[0]->login_error_password_min
                    ,'password.confirmed'=>$label->login[0]->login_error_password_confirm];
        $validateRule=Validator::make($request->all(), Member::$resetRules, $messages);

         //未選択の場合、エラー
        if($validateRule->fails()){
            return redirect()->back()
            ->withInput()
            ->withErrors($validateRule);
        }

        // These two lines below allow you to bypass the default validation.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );
    
        if($response == Password::PASSWORD_RESET)
        {
            //means password reset was successful
            return redirect()->route('login');
        }else{
            //means reset failed
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans($response)]);
        }
    }
}
