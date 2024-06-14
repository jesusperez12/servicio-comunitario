<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;


class EstudiantesRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
    {
        $this->middleware('guest:sc_prestadores');
    }


      protected function broker()
    {
        return Password::broker('UsuariosAspi');
    }

    

    public function showLinkRequestForm()
    {
        return view('authAspirante.passwords.email');
    }


}
