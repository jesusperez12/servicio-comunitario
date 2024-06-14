<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Datosaspirante;
use Auth;
use DB;
use Alert;
use Redirect;
class EstudiantesLoginController extends Controller
{
    
	 public function __construct()
    {
        $this->middleware('guest:sc_prestadores');
    }

   public function showLoginForm()
   
   {
     return view('authAspirante.login');
   // return view('errors.403');
   }


   public function showemail()
   
   {
    
    return view('authAspirante.reenviarEmail');
   }




     public function viewlistasOfertas()
   {
         
   }

   

   	public function login(Request $request)
   	{
   	


   		$this->validate($request,[
         'ci' => 'required|numeric|digits_between:7,8',
   		//	'ci' => 'required|ci',
   			'password' => 'required|digits_between:7,8'

   		]);

       if (Auth::guard('sc_prestadores')->attempt(['ci'=> $request->ci, 'password' => $request->password /*'confirmed' => 1*/], $request->remenber))
       {
   			return redirect()->intended(route('Estudiante.index'));
   		}
   
        // alert()->error(' ', 'Debe Registrarse / contraseña incorrecta')->persistent('Close');
        alert()->error('La cédula ingresada', 'no se encuentra registrado')->persistent('Cerrar');
   			return redirect()->back()->withInput($request->only('ci','remenber'));
   	
	
}

 public function close(Request $request)
    {
        Auth::guard('sc_prestadores');

        $request->session()->invalidate();
dd($request);
        $request->session()->regenerateToken();

        return redirect()->route('Estudiantes.login');
    }

}
