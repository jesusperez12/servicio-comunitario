<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PrestadoresRequest;
use Auth;
use Alert;
use DB;
use Illuminate\Support\Facedes\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Prestador;
use App\Models\ipcEstudiante;
use App\Models\ipbEstudiante;
use App\Models\ipmarEstudiante;
use App\Models\ipmEstudiante;
use App\Models\sisoEstudiante;
use App\Models\ipmejoramientoEstudiante;
use App\Models\iprubioEstudiante;
use App\Models\ipmacaroEstudiante;
use App\Models\Grupo;
use App\Models\Proyecto;
use App\Models\PivotUserProject;
use Illuminate\Support\Facades\Gate;
class PrestadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('prestadores_index'), 403);  ///niega el acceso a los usuarios que no tienen permiso
         $pre=@Auth::user()->hasRole('SuperAdmin');

           $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.NombInstituto')
        ->first();
        $sedeprincipal =  $institutosExtensiones->NombInstituto;

        // dd($pre);
       /* $especialidades = DB::table('especialidades')
        ->orderBy('cod', 'ASC')->pluck('nombre', 'cod');*/
          
         $data = Prestador::
         leftJoin('proyectos', 'sc_prestadores.proyecto_id', '=', 'proyectos.id')
        // ->leftJoin('sc_grupos', 'sc_prestadores.grupo_id', '=', 'sc_grupos.id')
         ->leftJoin('sc_periodos', 'sc_prestadores.grupo_id', '=', 'sc_periodos.id')
         ->leftJoin('especialidades', 'sc_prestadores.especialidad_cod', '=', 'especialidades.cod')
         ->where('sc_prestadores.user_id', '=', \Auth::user()->id)
         
         ->select('sc_prestadores.ci','sc_prestadores.firstname','sc_prestadores.middlename','sc_prestadores.primary_lastname'
            ,'sc_prestadores.second_lastname','sc_prestadores.grupo_id','proyectos.nombre_proyecto','especialidades.nombre','sc_prestadores.id')
         ->get();
     //  dd($data);
        return view('prestadores.index',compact('data','sedeprincipal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('prestadores_create'), 403);
        $proyecto = PivotUserProject::where('sc_user_proyecto.user_id', Auth::user()->id)
         ->leftJoin('proyectos', 'sc_user_proyecto.proyecto_id', '=', 'proyectos.id')
         ->select('proyectos.nombre_proyecto', 'proyectos.id')
         ->groupBy('proyectos.nombre_proyecto', 'proyectos.id')
         ->get();
        //dd($proyecto);
        $especialidades = DB::table('especialidades')->get();
        return view('prestadores.añadirPrestadores',compact('especialidades','proyecto'));
    }

    public function search(Request $request)
{
  
  if (@Auth::user()->hasRole('SuperAdmin') or @Auth::user()->hasRole('Profesor') ) {
      # code...
  
   $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.sede_id')
        ->first();
        $sedeprincipal =  $institutosExtensiones->sede_id;

        switch ($sedeprincipal) {
            case '1':
                  return  \App\Models\ipcEstudiante::where("cedula","like","%{$request->term}%")
        ->select("id","cedula","primer_nombre","primer_apellido")
        ->limit(10)
        ->get();

                break;
            
             case '3':
                 return  \App\Models\ipbEstudiante::where("cedula","like","%{$request->term}%")
        ->select("id","cedula","primer_nombre","primer_apellido")
        ->limit(10)
        ->get();
                break;


                  case '13':
                 return  \App\Models\ipmarEstudiante::where("cedula","like","%{$request->term}%")
        ->select("id","cedula","primer_nombre","primer_apellido")
        ->limit(10)
        ->get();
                break;

                  case '16':
                 return  \App\Models\ipmEstudiante::where("cedula","like","%{$request->term}%")
        ->select("id","cedula","primer_nombre","primer_apellido")
        ->limit(10)
        ->get();
                break;

                  case '18':
                 return  \App\Models\sisoEstudiante::where("cedula","like","%{$request->term}%")
                // ->leftJoin('espe_estud', 'espe_estud.estudiante_id', '=', 'estudiante.id') 
        ->select("id","cedula","primer_nombre","primer_apellido")
        ->limit(10)
        ->get();
                break;

                  case '22':
                return  \App\Models\ipmejoramientoEstudiante::where("cedula","like","%{$request->term}%")
        ->select("id","cedula","primer_nombre","primer_apellido")
        ->limit(10)
        ->get();
                break;

                  case '78':
               return  \App\Models\iprubioEstudiante::where("cedula","like","%{$request->term}%")
        ->select("id","cedula","primer_nombre","primer_apellido")
        ->limit(10)
        ->get();
                break;

                  case '81':
                 return  \App\Models\ipmacaroEstudiante::where("cedula","like","%{$request->term}%")
        ->select("id","cedula","primer_nombre","primer_apellido")
        ->limit(10)
        ->get();
                break;
        }


}

    /* return  \App\Models\Prestador::where("ci","like","%{$request->term}%")
        ->select("id","ci","firstname","middlename","primary_lastname","second_lastname")
        ->limit(10)
        ->get();*/
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrestadoresRequest $request)
    {
        
        $ci = $request->input('ci');

   $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.sede_id')
        ->first();
        $sedeprincipal =  $institutosExtensiones->sede_id;
$userID=\Auth::user()->id;
//dd($userID);


          switch ($sedeprincipal) {
              case '1':
                    
             
               foreach ($ci as $key => $value) {
                   # code...
              
               
                          $estudiante = ipcEstudiante::
                          where('cedula', $value)->first();
                         // dd($estudiante);

                   
                $pup_id = $userID;
                $proyecto = DB::table('sc_user_proyecto')
                ->select('proyecto_id','periodo_id')
                ->where('user_id', $pup_id)
                ->first();
                //dd($proyecto);
                // VERIFICAR SI EXISTE GRUPO EN OTRO USUARIO Y PERIODO
               /* $grupo = Grupo::where('sc_periodo_id', $proyecto->periodo_id)
                ->where('user_id', '!=', Auth::id())
                ->where('grupo', $request->input('grupo'))
                ->first();

                //dd($grupo);

                if(!is_null($grupo)) {

                 Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer este grupo ya fue asignado a otro usuario.<br><br><p class="sugerencia_error">Verifíquelo e intente nuevamente.'));
                    return back();
                    
                }*/

               

                // VERIFICAR SI LO TENGO REGISTRADO
               /* $grupo = Grupo::where(
                    'sc_periodo_id', $proyecto->periodo_id
                )->where(
                    'user_id', Auth::id()
                )->where('grupo', $request->input('grupo'))->first();


                if(is_null($grupo)) {
                    $grupo_id = DB::table('sc_grupos')->insertGetId([
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $proyecto->proyecto_id,
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'grupo' => $request->input('grupo')
                    ]);
                }else{
                    $grupo_id = $grupo->id;
                }*/

                //$ci = $request->input('ci');
                $firstname = $estudiante->primer_nombre;
                $middlename = $estudiante->segundo_nombre;
                $primary_lastname = $estudiante->primer_apellido;
                $second_lastname = $estudiante->segundo_apellido;
                 $pasworcedula = $estudiante->cedula;

                    $prestad = DB::table('sc_prestadores')
                ->where('ci', $pasworcedula)
                ->exists();
                if ($prestad == true) {
                    Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer un estudiante ya se encuentra registrado en servicio comunitario.'));
                    return back();
                }
                $providers = [];
               
                    $provider = [
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $request->input('proyecto_id'),
                        'sc_periodo_id' => $proyecto->periodo_id,
                       'grupo_id' => $request->input('grupo'),
                        'ci' => $pasworcedula,
                        'firstname' => $firstname,
                        'middlename' => ($middlename != '') ? $middlename : null,
                        'primary_lastname' => $primary_lastname,
                        'second_lastname' => ($second_lastname != '') ? $second_lastname : null,
                        'password' => bcrypt($pasworcedula),
                        'hrs_comunitarias' => "72",
                        'inasistencias' => "0",
                        'especialidad_cod' => $request->input('especialidad')
                    ];

                    array_push($providers, $provider);
                

                DB::table('sc_prestadores')->insert($providers);
                  }
                  

      
                Alert::success(session('success', 'Creado con éxito!'));
                return back();
               
           
                  break;
              
               case '3':

                  foreach ($ci as $key => $value) {
                   # code...
              
               
                          $estudiante = ipbEstudiante::
                          where('cedula', $value)->first();
                         // dd($estudiante);

                   
                $pup_id = $userID;
                $proyecto = DB::table('sc_user_proyecto')
                ->select('proyecto_id','periodo_id')
                ->where('user_id', $pup_id)
                ->first();
                //dd($proyecto);
                // VERIFICAR SI EXISTE GRUPO EN OTRO USUARIO Y PERIODO
                $grupo = Grupo::
                where('sc_periodo_id', $proyecto->periodo_id)
                ->where('user_id', '!=', Auth::id())
                ->where('grupo', $request->input('grupo'))
                ->first();

                //dd($grupo);

                if(!is_null($grupo)) {

                 Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer este grupo ya fue asignado a otro usuario.<br><br><p class="sugerencia_error">Verifíquelo e intente nuevamente.'));
                    return back();
                    
                }

               

                // VERIFICAR SI LO TENGO REGISTRADO
                $grupo = Grupo::where(
                    'sc_periodo_id', $proyecto->periodo_id
                )->where(
                    'user_id', Auth::id()
                )->where('grupo', $request->input('grupo'))->first();


                if(is_null($grupo)) {
                    $grupo_id = DB::table('sc_grupos')->insertGetId([
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $proyecto->proyecto_id,
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'sc_prestadores_id' => $proyecto->periodo_id, 
                        'grupo' => $request->input('grupo')
                    ]);
                }else{
                    $grupo_id = $grupo->id;
                }

                //$ci = $request->input('ci');
                $firstname = $estudiante->primer_nombre;
                $middlename = $estudiante->segundo_nombre;
                $primary_lastname = $estudiante->primer_apellido;
                $second_lastname = $estudiante->segundo_apellido;
                 $pasworcedula = $estudiante->cedula;

                    $prestad = DB::table('sc_prestadores')
                ->where('ci', $pasworcedula)
                ->exists();
                if ($prestad == true) {
                    Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer un estudiante ya se encuentra registrado en servicio comunitario.'));
                    return back();
                }
                $providers = [];
               
                    $provider = [
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $request->input('proyecto_id'),
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'grupo_id' => $grupo_id,
                        'ci' => $pasworcedula,
                        'firstname' => $firstname,
                        'middlename' => ($middlename != '') ? $middlename : null,
                        'primary_lastname' => $primary_lastname,
                        'second_lastname' => ($second_lastname != '') ? $second_lastname : null,
                        'password' => bcrypt($pasworcedula),
                        'hrs_comunitarias' => "72",
                        'inasistencias' => "0",
                        'especialidad_cod' => $request->input('especialidad')
                    ];

                    array_push($providers, $provider);
                

                DB::table('sc_prestadores')->insert($providers);
                  }
                Alert::success(session('success', 'Creado con éxito!'));
                return back();
                  break;

                   case '13':
                  foreach ($ci as $key => $value) {
                   # code...
              
               
                          $estudiante = ipmarEstudiante::
                          where('cedula', $value)->first();
                         // dd($estudiante);

                   
                $pup_id = $userID;
                $proyecto = DB::table('sc_user_proyecto')
                ->select('proyecto_id','periodo_id')
                ->where('user_id', $pup_id)
                ->first();
                //dd($proyecto);
                // VERIFICAR SI EXISTE GRUPO EN OTRO USUARIO Y PERIODO
                $grupo = Grupo::
                where('sc_periodo_id', $proyecto->periodo_id)
                ->where('user_id', '!=', Auth::id())
                ->where('grupo', $request->input('grupo'))
                ->first();

                //dd($grupo);

                if(!is_null($grupo)) {

                 Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer este grupo ya fue asignado a otro usuario.<br><br><p class="sugerencia_error">Verifíquelo e intente nuevamente.'));
                    return back();
                    
                }

               

                // VERIFICAR SI LO TENGO REGISTRADO
                $grupo = Grupo::where(
                    'sc_periodo_id', $proyecto->periodo_id
                )->where(
                    'user_id', Auth::id()
                )->where('grupo', $request->input('grupo'))->first();


                if(is_null($grupo)) {
                    $grupo_id = DB::table('sc_grupos')->insertGetId([
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $proyecto->proyecto_id,
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'sc_prestadores_id' => $proyecto->periodo_id, 
                        'grupo' => $request->input('grupo')
                    ]);
                }else{
                    $grupo_id = $grupo->id;
                }

                //$ci = $request->input('ci');
                $firstname = $estudiante->primer_nombre;
                $middlename = $estudiante->segundo_nombre;
                $primary_lastname = $estudiante->primer_apellido;
                $second_lastname = $estudiante->segundo_apellido;
                 $pasworcedula = $estudiante->cedula;

                    $prestad = DB::table('sc_prestadores')
                ->where('ci', $pasworcedula)
                ->exists();
                if ($prestad == true) {
                    Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer un estudiante ya se encuentra registrado en servicio comunitario.'));
                    return back();
                }
                $providers = [];
               
                    $provider = [
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $request->input('proyecto_id'),
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'grupo_id' => $grupo_id,
                        'ci' => $pasworcedula,
                        'firstname' => $firstname,
                        'middlename' => ($middlename != '') ? $middlename : null,
                        'primary_lastname' => $primary_lastname,
                        'second_lastname' => ($second_lastname != '') ? $second_lastname : null,
                        'password' => bcrypt($pasworcedula),
                        'hrs_comunitarias' => "72",
                        'inasistencias' => "0",
                        'especialidad_cod' => $request->input('especialidad')
                    ];

                    array_push($providers, $provider);
                

                DB::table('sc_prestadores')->insert($providers);
                  }
                Alert::success(session('success', 'Creado con éxito!'));
                return back();
                  break;

                   case '16':
                   foreach ($ci as $key => $value) {
                   # code...
              
               
                          $estudiante = ipmEstudiante::
                          where('cedula', $value)->first();
                         // dd($estudiante);

                   
                $pup_id = $userID;
                $proyecto = DB::table('sc_user_proyecto')
                ->select('proyecto_id','periodo_id')
                ->where('user_id', $pup_id)
                ->first();
                //dd($proyecto);
                // VERIFICAR SI EXISTE GRUPO EN OTRO USUARIO Y PERIODO
                $grupo = Grupo::
                where('sc_periodo_id', $proyecto->periodo_id)
                ->where('user_id', '!=', Auth::id())
                ->where('grupo', $request->input('grupo'))
                ->first();

                //dd($grupo);

                if(!is_null($grupo)) {

                 Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer este grupo ya fue asignado a otro usuario.<br><br><p class="sugerencia_error">Verifíquelo e intente nuevamente.'));
                    return back();
                    
                }

               

                // VERIFICAR SI LO TENGO REGISTRADO
                $grupo = Grupo::where(
                    'sc_periodo_id', $proyecto->periodo_id
                )->where(
                    'user_id', Auth::id()
                )->where('grupo', $request->input('grupo'))->first();


                if(is_null($grupo)) {
                    $grupo_id = DB::table('sc_grupos')->insertGetId([
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $proyecto->proyecto_id,
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'sc_prestadores_id' => $proyecto->periodo_id, 
                        'grupo' => $request->input('grupo')
                    ]);
                }else{
                    $grupo_id = $grupo->id;
                }

                //$ci = $request->input('ci');
                $firstname = $estudiante->primer_nombre;
                $middlename = $estudiante->segundo_nombre;
                $primary_lastname = $estudiante->primer_apellido;
                $second_lastname = $estudiante->segundo_apellido;
                 $pasworcedula = $estudiante->cedula;

                    $prestad = DB::table('sc_prestadores')
                ->where('ci', $pasworcedula)
                ->exists();
                if ($prestad == true) {
                    Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer un estudiante ya se encuentra registrado en servicio comunitario.'));
                    return back();
                }
                $providers = [];
               
                    $provider = [
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $request->input('proyecto_id'),
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'grupo_id' => $grupo_id,
                        'ci' => $pasworcedula,
                        'firstname' => $firstname,
                        'middlename' => ($middlename != '') ? $middlename : null,
                        'primary_lastname' => $primary_lastname,
                        'second_lastname' => ($second_lastname != '') ? $second_lastname : null,
                        'password' => bcrypt($pasworcedula),
                        'hrs_comunitarias' => "72",
                        'inasistencias' => "0",
                        'especialidad_cod' => $request->input('especialidad')
                    ];

                    array_push($providers, $provider);
                

                DB::table('sc_prestadores')->insert($providers);
                  }
                Alert::success(session('success', 'Creado con éxito!'));
                return back();
                  break;



                   case '18':
                  foreach ($ci as $key => $value) {
                   # code...
              
               
                          $estudiante = sisoEstudiante::
                          where('cedula', $value)->first();
                         // dd($estudiante);

                   
                $pup_id = $userID;
                $proyecto = DB::table('sc_user_proyecto')
                ->select('proyecto_id','periodo_id')
                ->where('user_id', $pup_id)
                ->first();
                //dd($proyecto);
                // VERIFICAR SI EXISTE GRUPO EN OTRO USUARIO Y PERIODO
                $grupo = Grupo::
                where('sc_periodo_id', $proyecto->periodo_id)
                ->where('user_id', '!=', Auth::id())
                ->where('grupo', $request->input('grupo'))
                ->first();

                //dd($grupo);

                if(!is_null($grupo)) {

                 Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer este grupo ya fue asignado a otro usuario.<br><br><p class="sugerencia_error">Verifíquelo e intente nuevamente.'));
                    return back();
                    
                }

               

                // VERIFICAR SI LO TENGO REGISTRADO
                $grupo = Grupo::where(
                    'sc_periodo_id', $proyecto->periodo_id
                )->where(
                    'user_id', Auth::id()
                )->where('grupo', $request->input('grupo'))->first();


                if(is_null($grupo)) {
                    $grupo_id = DB::table('sc_grupos')->insertGetId([
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $proyecto->proyecto_id,
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'sc_prestadores_id' => $proyecto->periodo_id, 
                        'grupo' => $request->input('grupo')
                    ]);
                }else{
                    $grupo_id = $grupo->id;
                }

                //$ci = $request->input('ci');
                $firstname = $estudiante->primer_nombre;
                $middlename = $estudiante->segundo_nombre;
                $primary_lastname = $estudiante->primer_apellido;
                $second_lastname = $estudiante->segundo_apellido;
                 $pasworcedula = $estudiante->cedula;

                    $prestad = DB::table('sc_prestadores')
                ->where('ci', $pasworcedula)
                ->exists();
                if ($prestad == true) {
                    Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer un estudiante ya se encuentra registrado en servicio comunitario.'));
                    return back();
                }
                $providers = [];
               
                    $provider = [
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $request->input('proyecto_id'),
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'grupo_id' => $grupo_id,
                        'ci' => $pasworcedula,
                        'firstname' => $firstname,
                        'middlename' => ($middlename != '') ? $middlename : null,
                        'primary_lastname' => $primary_lastname,
                        'second_lastname' => ($second_lastname != '') ? $second_lastname : null,
                        'password' => bcrypt($pasworcedula),
                        'hrs_comunitarias' => "72",
                        'inasistencias' => "0",
                        'especialidad_cod' => $request->input('especialidad')
                    ];

                    array_push($providers, $provider);
                

                DB::table('sc_prestadores')->insert($providers);
                  }
                Alert::success(session('success', 'Creado con éxito!'));
                return back();
                  break;



                   case '22':
                   foreach ($ci as $key => $value) {
                   # code...
              
               
                          $estudiante = ipmejoramientoEstudiante::
                          where('cedula', $value)->first();
                         // dd($estudiante);

                   
                $pup_id = $userID;
                $proyecto = DB::table('sc_user_proyecto')
                ->select('proyecto_id','periodo_id')
                ->where('user_id', $pup_id)
                ->first();
                //dd($proyecto);
                // VERIFICAR SI EXISTE GRUPO EN OTRO USUARIO Y PERIODO
                $grupo = Grupo::
                where('sc_periodo_id', $proyecto->periodo_id)
                ->where('user_id', '!=', Auth::id())
                ->where('grupo', $request->input('grupo'))
                ->first();

                //dd($grupo);

                if(!is_null($grupo)) {

                 Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer este grupo ya fue asignado a otro usuario.<br><br><p class="sugerencia_error">Verifíquelo e intente nuevamente.'));
                    return back();
                    
                }

               

                // VERIFICAR SI LO TENGO REGISTRADO
                $grupo = Grupo::where(
                    'sc_periodo_id', $proyecto->periodo_id
                )->where(
                    'user_id', Auth::id()
                )->where('grupo', $request->input('grupo'))->first();


                if(is_null($grupo)) {
                    $grupo_id = DB::table('sc_grupos')->insertGetId([
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $proyecto->proyecto_id,
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'sc_prestadores_id' => $proyecto->periodo_id, 
                        'grupo' => $request->input('grupo')
                    ]);
                }else{
                    $grupo_id = $grupo->id;
                }

                //$ci = $request->input('ci');
                $firstname = $estudiante->primer_nombre;
                $middlename = $estudiante->segundo_nombre;
                $primary_lastname = $estudiante->primer_apellido;
                $second_lastname = $estudiante->segundo_apellido;
                 $pasworcedula = $estudiante->cedula;

                    $prestad = DB::table('sc_prestadores')
                ->where('ci', $pasworcedula)
                ->exists();
                if ($prestad == true) {
                    Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer un estudiante ya se encuentra registrado en servicio comunitario.'));
                    return back();
                }
                $providers = [];
               
                    $provider = [
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $request->input('proyecto_id'),
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'grupo_id' => $grupo_id,
                        'ci' => $pasworcedula,
                        'firstname' => $firstname,
                        'middlename' => ($middlename != '') ? $middlename : null,
                        'primary_lastname' => $primary_lastname,
                        'second_lastname' => ($second_lastname != '') ? $second_lastname : null,
                        'password' => bcrypt($pasworcedula),
                        'hrs_comunitarias' => "72",
                        'inasistencias' => "0",
                        'especialidad_cod' => $request->input('especialidad')
                    ];

                    array_push($providers, $provider);
                

                DB::table('sc_prestadores')->insert($providers);
                  }
                Alert::success(session('success', 'Creado con éxito!'));
                return back();
                  break;


                   case '78':
                  foreach ($ci as $key => $value) {
                   # code...
              
               
                          $estudiante = iprubioEstudiante::
                          where('cedula', $value)->first();
                         // dd($estudiante);

                   
                $pup_id = $userID;
                $proyecto = DB::table('sc_user_proyecto')
                ->select('proyecto_id','periodo_id')
                ->where('user_id', $pup_id)
                ->first();
                //dd($proyecto);
                // VERIFICAR SI EXISTE GRUPO EN OTRO USUARIO Y PERIODO
                $grupo = Grupo::
                where('sc_periodo_id', $proyecto->periodo_id)
                ->where('user_id', '!=', Auth::id())
                ->where('grupo', $request->input('grupo'))
                ->first();

                //dd($grupo);

                if(!is_null($grupo)) {

                 Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer este grupo ya fue asignado a otro usuario.<br><br><p class="sugerencia_error">Verifíquelo e intente nuevamente.'));
                    return back();
                    
                }

               

                // VERIFICAR SI LO TENGO REGISTRADO
                $grupo = Grupo::where(
                    'sc_periodo_id', $proyecto->periodo_id
                )->where(
                    'user_id', Auth::id()
                )->where('grupo', $request->input('grupo'))->first();


                if(is_null($grupo)) {
                    $grupo_id = DB::table('sc_grupos')->insertGetId([
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $proyecto->proyecto_id,
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'sc_prestadores_id' => $proyecto->periodo_id, 
                        'grupo' => $request->input('grupo')
                    ]);
                }else{
                    $grupo_id = $grupo->id;
                }

                //$ci = $request->input('ci');
                $firstname = $estudiante->primer_nombre;
                $middlename = $estudiante->segundo_nombre;
                $primary_lastname = $estudiante->primer_apellido;
                $second_lastname = $estudiante->segundo_apellido;
                 $pasworcedula = $estudiante->cedula;

                    $prestad = DB::table('sc_prestadores')
                ->where('ci', $pasworcedula)
                ->exists();
                if ($prestad == true) {
                    Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer un estudiante ya se encuentra registrado en servicio comunitario.'));
                    return back();
                }
                $providers = [];
               
                    $provider = [
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $request->input('proyecto_id'),
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'grupo_id' => $grupo_id,
                        'ci' => $pasworcedula,
                        'firstname' => $firstname,
                        'middlename' => ($middlename != '') ? $middlename : null,
                        'primary_lastname' => $primary_lastname,
                        'second_lastname' => ($second_lastname != '') ? $second_lastname : null,
                        'password' => bcrypt($pasworcedula),
                        'hrs_comunitarias' => "72",
                        'inasistencias' => "0",
                        'especialidad_cod' => $request->input('especialidad')
                    ];

                    array_push($providers, $provider);
                

                DB::table('sc_prestadores')->insert($providers);
                  }
                Alert::success(session('success', 'Creado con éxito!'));
                return back();
                  break;


                   case '81':
                    foreach ($ci as $key => $value) {
                   # code...
              
               
                          $estudiante = ipmacaroEstudiante::
                          where('cedula', $value)->first();
                         // dd($estudiante);

                   
                $pup_id = $userID;
                $proyecto = DB::table('sc_user_proyecto')
                ->select('proyecto_id','periodo_id')
                ->where('user_id', $pup_id)
                ->first();
                //dd($proyecto);
                // VERIFICAR SI EXISTE GRUPO EN OTRO USUARIO Y PERIODO
                $grupo = Grupo::
                where('sc_periodo_id', $proyecto->periodo_id)
                ->where('user_id', '!=', Auth::id())
                ->where('grupo', $request->input('grupo'))
                ->first();

                //dd($grupo);

                if(!is_null($grupo)) {

                 Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer este grupo ya fue asignado a otro usuario.<br><br><p class="sugerencia_error">Verifíquelo e intente nuevamente.'));
                    return back();
                    
                }

               

                // VERIFICAR SI LO TENGO REGISTRADO
                $grupo = Grupo::where(
                    'sc_periodo_id', $proyecto->periodo_id
                )->where(
                    'user_id', Auth::id()
                )->where('grupo', $request->input('grupo'))->first();


                if(is_null($grupo)) {
                    $grupo_id = DB::table('sc_grupos')->insertGetId([
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $proyecto->proyecto_id,
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'sc_prestadores_id' => $proyecto->periodo_id, 
                        'grupo' => $request->input('grupo')
                    ]);
                }else{
                    $grupo_id = $grupo->id;
                }

                //$ci = $request->input('ci');
                $firstname = $estudiante->primer_nombre;
                $middlename = $estudiante->segundo_nombre;
                $primary_lastname = $estudiante->primer_apellido;
                $second_lastname = $estudiante->segundo_apellido;
                 $pasworcedula = $estudiante->cedula;

                    $prestad = DB::table('sc_prestadores')
                ->where('ci', $pasworcedula)
                ->exists();
                if ($prestad == true) {
                    Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer un estudiante ya se encuentra registrado en servicio comunitario.'));
                    return back();
                }
                $providers = [];
               
                    $provider = [
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $request->input('proyecto_id'),
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'grupo_id' => $grupo_id,
                        'ci' => $pasworcedula,
                        'firstname' => $firstname,
                        'middlename' => ($middlename != '') ? $middlename : null,
                        'primary_lastname' => $primary_lastname,
                        'second_lastname' => ($second_lastname != '') ? $second_lastname : null,
                        'password' => bcrypt($pasworcedula),
                        'hrs_comunitarias' => "72",
                        'inasistencias' => "0",
                        'especialidad_cod' => $request->input('especialidad')
                    ];

                    array_push($providers, $provider);
                

                DB::table('sc_prestadores')->insert($providers);
                  }
                Alert::success(session('success', 'Creado con éxito!'));
                return back();
                  break;
          }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function getespecialidad(Request $request){



     $states = PivotUserProject::
     where('sc_user_proyecto.proyecto_id', '=', $request->valor)
      ->leftJoin('especialidades', 'sc_user_proyecto.especialidad_cod', '=', 'especialidades.cod')
      ->select('especialidades.nombre','especialidades.cod')
     ->get();
    
    //dd($states);
        //$estado = Estado::find($request->valor);
       // $parroquia= Parroquias::has('parroquia')->get();
        return response()->json($states);
    }

    /* public function estudianteGET(Request $request){


       $SIGElapso = DB::connection('bdestipc')->table('espe_estud')
        ->where('espe_estud.codigo', '=', $request->especialy)
        ->select('espe_estud.id')
        ->first(); 

        $idespeciality=$SIGElapso->id;


     $states = Proyecto::
     where('proyectos.id',$idespeciality)
      ->leftJoin('especialidades', 'proyectos.especialidad_cod', '=', 'especialidades.cod')
      ->select('especialidades.nombre','especialidades.cod')
     ->get();
    
     //dd($Municipio);
        //$estado = Estado::find($request->valor);
       // $parroquia= Parroquias::has('parroquia')->get();
        return response()->json($states);
    }*/




    public function edit($id)
    {
      // dd($id);
        $user = Prestador::findOrFail($id);
        $proyecto = PivotUserProject::where('sc_user_proyecto.user_id','=', Auth::user()->id)
        ->leftJoin('proyectos', 'sc_user_proyecto.proyecto_id', '=', 'proyectos.id')
        ->get();

     //dd($proyecto);



         $comunityy = Prestador::where('sc_prestadores.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->leftJoin('especialidades', 'sc_prestadores.especialidad_cod', '=', 'especialidades.cod')
       ->first();

       $especialCOD=$comunityy->especialidad_cod;


      

        $especialidades = DB::table('especialidades')
        ->where('especialidades.cod','=', $especialCOD)
          ->orderBy('cod', 'ASC')->pluck('nombre', 'cod');
       // dd($especialidades);
        return view('prestadores.edit',compact('proyecto','especialidades','user','comunityy')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $iduserSede=\Auth::user()->sede_id;

     /* $prestad=Prestador::where('id',$id)->first();

         
      $grupo=Grupo::findOrFail($prestad->id);
      $grupo->grupo = $request->get ('grupo_id');
      $grupo->proyecto_id = $request->get ('proyecto_id');*/
 //dd($grupo);
          $user=Prestador::findOrFail($id);
       $user->update($request->all());
        Alert::success(session('success', 'Actualizado con éxito!'));
                return redirect()->route('Prestadores.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $user  = Prestador::find($id);
           
      $user->delete(); 
       Alert::success(session('success', 'Eliminado con éxito!'));
                return redirect()->route('Prestadores.index');
    }

    public function getPrestadorByCi (StoreProviderRequest $request) 
    {   

    //      dd($request->input('users'));

        if ($ci != '') {

            $estudiante = ipcEstudiante::where(
                'cedula', $ci
            )->first();

            if (is_null($estudiante)) {
                return response()->json(['error' => [
                        "messages" => '<p>El prestador de servicio no fue encontrado.</p><span style="color:#333;font-size:12px;">Esto ocurre cuando el estudiante no se ha inscrito en servicio comunitario.</span><br><br>'
                    ]
                ], 404);
            }

            return response()->json(['response' => 'ok', 'student' => $estudiante]);
            
        }

        //dd($request->input('ci'));
        //$usersede=\Auth::user()->sede_id;
        $ci=$request->input('ci');
        $userID=\Auth::user()->id;
     $sedes = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.sede_id')
        ->first();
        $extensiones=$sedes->sede_id;

        switch ($extensiones) {
            case '1':
                   if ($ci != '') {

            $estudiante = ipcEstudiante::where(
                'cedula', $ci
            )->first();
//dd($estudiante);
            if (is_null($estudiante)) {

                Alert::error(session('error', 'El prestador de servicio no fue encontrado!'));
                return back();
               
            }
            else {

                $pup_id = $userID;



                $proyecto = DB::table('sc_user_proyecto')


                ->select('proyecto_id','periodo_id')
                ->where('user_id', $pup_id)
                ->first();


                //dd($proyecto);
                // VERIFICAR SI EXISTE GRUPO EN OTRO USUARIO Y PERIODO
                $grupo = Grupo::
                where('sc_periodo_id', $proyecto->periodo_id)
                ->where('user_id', '!=', Auth::id())
                ->where('grupo', $request->input('grupo'))
                ->first();

                //dd($grupo);

                if(!is_null($grupo)) {

                 Alert::error(session('error', '<b>¡Disculpe!</b> Al parecer este grupo ya fue asignado a otro usuario.<br><br><p class="sugerencia_error">Verifíquelo e intente nuevamente.'));
                    return back();
                    
                }

                // VERIFICAR SI LO TENGO REGISTRADO
                $grupo = Grupo::where(
                    'sc_periodo_id', $proyecto->periodo_id
                )->where(
                    'user_id', Auth::id()
                )->where('grupo', $request->input('grupo'))->first();


                if(is_null($grupo)) {
                    $grupo_id = DB::table('sc_grupos')->insertGetId([
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $proyecto->proyecto_id,
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'sc_prestadores_id' => $proyecto->periodo_id, 
                        'grupo' => $request->input('grupo')
                    ]);
                }else{
                    $grupo_id = $grupo->id;
                }

                $ci = $request->input('ci');
                $firstname = $estudiante->primer_nombre;
                $middlename = $estudiante->segundo_nombre;
                $primary_lastname = $estudiante->primer_apellido;
                $second_lastname = $estudiante->segundo_apellido;
                $providers = [];
               
                    $provider = [
                        'sede_id' => Auth::user()->sede_id,
                        'sc_user_proyecto_id' => $pup_id,
                        'user_id' => Auth::id(),
                        'proyecto_id' => $proyecto->proyecto_id,
                        'sc_periodo_id' => $proyecto->periodo_id,
                        'grupo_id' => $grupo_id,
                        'ci' => $ci,
                        'firstname' => $firstname,
                        'middlename' => ($middlename != '') ? $middlename : null,
                        'primary_lastname' => $primary_lastname,
                        'second_lastname' => ($second_lastname != '') ? $second_lastname : null,
                        'password' => bcrypt($ci),
                        'especialidad_cod' => $request->input('especialidad')
                    ];

                    array_push($providers, $provider);
                

                DB::table('sc_prestadores')->insert($providers);
                
                Alert::success(session('success', 'Creado con éxito!'));
                return back();

           


           }

            return response()->json(['response' => 'ok', 'student' => $estudiante]);
            
        }
                break;

                 case '1':
                # code...
                break;

                 case '3':
                # code...
                break;

                 case '13':
                # code...
                break;

                 case '16':
                # code...
                break;

                 case '18':
                # code...
                break;

                 case '22':
                # code...
                break;

                 case '78':
                # code...
                break;

                 case '81':
                # code...
                break;

        }

    
    
    }











}
