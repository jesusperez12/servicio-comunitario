<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\UsuariosAspi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Alert;
use DB;
use Mail;
class AspiranteRegisterController extends Controller
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

    public function redirectTo(){

        alert()->success('Bienvenido ', 'Tu registro se a guardado correctamente,
         debe verificar su correo para activar la cuenta')
       //alert()->info('Bienvenido', 'El registro se guardo correctamente,')
       ->persistent('Cerrar');
         //session()->flash('success','Tu registro se a guardado correctamente.');
           
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


      public function showRegistrationForm()
    {
        alert()->info('OBLIGATORIO','Bienvenido..!! Ingrese su correo electrónico Gmail, recuerde colocar la dirección exacta de lo contrario no podrá acceder al sistema')->persistent('Cerrar');
        return view('authAspirante.register');

       // return view('errors.403');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
    
        
    $correo=$data['email'];

 $correovalidat=$data['email_confirmation'];
    // dd($correo,$correovalidat);

        return Validator::make($data, [
            'name' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:UsuariosAspi',
            'cedula' => 'required|numeric|unique:UsuariosAspi|digits_between:7,8',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \SistemaAdmision\User
     */
   /* protected function create(array $data)
    {
        return UsuariosAspi::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }*/
    
    protected function create(array $data)
    {
       // dd($data);
        $data['confirmation_code'] = str_random(25);
          $valor="1";
        $per= DB::table('Periodo')
        ->where('Periodo.Vigente', '=',$valor)->first();
       $idperiodo=$per->id; 

        $user = UsuariosAspi::create([
            
            'name' => $data['name'],
            'email' => $data['email'],
            'cedula' => $data['cedula'],
            'password' => bcrypt($data['password']),
            'confirmation_code' => $data['confirmation_code'],
            'Periodo_id' => $idperiodo
            
        ]);
 //dd($user);
         Mail::send('emails.confirmation_code', $data, function($message) use ($data) {
        $message->to($data['email'], $data['name'])->subject('Por favor confirma tu correo');
         });

        return $user;


    }

    protected function validatee(Request $request)
    {
      //  dd($request->email);
       
       $email = $request->email;
      //dd($email);
       $usuario = DB::table('UsuariosAspi')->where('UsuariosAspi.email','=', $email)
       ->first();
       //dd($usuario);
       $nam = $usuario->name;
       
       $data = []; 
       
       $data['name'] = $nam;
       $data['confirmation_code'] = str_random(25);
       $data['email'] = $email;
      // dd($data);
        $user = UsuariosAspi::where('UsuariosAspi.email','=',$request->email)
        ->exists();

        if ( $user ) {
            Mail::send('emails.confirmation_code', $data, function($message) use ($data) {
                $message->to($data['email'], $data['name'] )->subject('Por favor confirma tu correo');
                 });
                 alert()->error('','Enviado')->persistent('Cerrar');
                 return redirect('Aspirante/login');
        }
        else {
            alert()->error('','El correo ingresado no fue registrado')->persistent('Cerrar');
            return view('authAspirante.reenviarEmail');
        }
        
       
         

        return $user;


    }



    public function verify($code)
{
    $user = UsuariosAspi::where('confirmation_code', $code)->first();

    if (! $user)
        return redirect('/');

    $user->confirmed = true;
    $user->confirmation_code = true;
    $user->save();

     alert()->info(' ', 'Has confirmado correctamente tu correo!')->autoclose(3000);

    return redirect('Aspirante/login');//->session()->flash('notification', 'Has confirmado correctamente tu correo!');
}


}
