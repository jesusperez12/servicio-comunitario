<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Password;
use Auth;
use Alert;

class EstudiantesResetPasswordController extends Controller
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
     public function redirectTo(){

        Alert::message('', '¡Tu contraseña ha sido restablecida!!');
         
           
           return 'Aspirante/login';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
    {
        $this->middleware('guest:sc_prestadores');
    }


     protected function guard()
    {
        return Auth::guard('UsuariosAspi');
    }

     protected function broker()
    {
        return Password::broker('UsuariosAspi');
    }   

        public function showResetForm(Request $request, $token = null)
    {
        return view('authAspirante.passwords.reset')->with(
            ['token'=> $token, 'email' => $request->email]
        );
    }

    protected function resetPassword($user, $password)

    {

        $user->forceFill([

            'password' => bcrypt($password),

            'remember_token' => Str::random(60),

        ])->save();



        $this->guard();

    }



}
