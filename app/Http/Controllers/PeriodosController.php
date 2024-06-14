<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination;
use Illuminate\Support\Facades\Redirect;
use Alert;
use Carbon\Carbon;
use App\Models\Periodo;
use DateTime;
use Illuminate\Support\Facades\Auth;
class PeriodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.NombInstituto')
        ->first();
        $sedeprincipal =  $institutosExtensiones->NombInstituto;


         $consultas= DB::table('sc_periodos')-> orderby('id','DESC')
         ->where('sc_periodos.sede_id', '=', \Auth::user()->sede_id)
         ->leftJoin('Institutos', 'sc_periodos.sede_id', '=', 'Institutos.id')
    ->select('Institutos.NombInstituto','sc_periodos.corte','sc_periodos.inicio',
    'sc_periodos.id','sc_periodos.fin','sc_periodos.estatus','sc_periodos.sede_id')
    ->paginate(5);

     if (@Auth::user()->hasRole('SuperAdmin') ) {

      $consultas= DB::table('sc_periodos')-> orderby('id','DESC')
         //->where('sc_periodos.user_id', '=', \Auth::user()->id)
         ->leftJoin('Institutos', 'sc_periodos.sede_id', '=', 'Institutos.id')
    ->select('Institutos.NombInstituto','sc_periodos.corte','sc_periodos.inicio',
    'sc_periodos.id','sc_periodos.fin','sc_periodos.estatus','sc_periodos.sede_id')
    ->paginate(5);

     }
     if (@Auth::user()->hasRole('Coordinador_Nacional')) {
         $consultas= DB::table('sc_periodos')-> orderby('id','DESC')
         ->where('sc_periodos.user_id', '=', \Auth::user()->id)
         ->leftJoin('Institutos', 'sc_periodos.sede_id', '=', 'Institutos.id')
    ->select('Institutos.NombInstituto','sc_periodos.corte','sc_periodos.inicio',
    'sc_periodos.id','sc_periodos.fin','sc_periodos.estatus','sc_periodos.sede_id')
    ->paginate(5);
     }

   
    return view('Periodo.index',compact('consultas','sedeprincipal'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.sede_id')
        ->first();
        $sedeprincipal =  $institutosExtensiones->sede_id;

        //dd($sedeprincipal);
       switch ($sedeprincipal) {
           case '1':
             if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {


               $periodos = DB::connection('bdestipc')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');


                      $sedes = DB::table('Institutos')
                ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');

                 return view('Periodo.create',compact('periodos','sedes'));


             }
                    $periodos = DB::connection('bdestipc')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');

                    return view('Periodo.create',compact('periodos'));
               break;

               case '3':

               if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {


                 $periodos = DB::connection('bdestipb')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');

                     $sedes = DB::table('Institutos')
                ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');

                 return view('Periodo.create',compact('periodos','sedes'));
               }
                
             // dd($sedes);
                $periodos = DB::connection('bdestipb')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');
                    // dd($periodos);

                    return view('Periodo.create',compact('periodos'));

                    
                
                break;


                  case '13':
                  if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {

                  $periodos = DB::connection('bdestipmar')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');


                         $sedes = DB::table('Institutos')
                       //->where('Institutos.sede_id','=', \Auth::user()->sede_id)
                    ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');

                     return view('Periodo.create',compact('periodos','sedes'));

                  }

               
                
                    $periodos = DB::connection('bdestipmar')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');

                     
                    return view('Periodo.create',compact('periodos'));
                break;

                  case '16':
                      if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {

                         $periodos = DB::connection('bdestipm6')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');

                         $sedes = DB::table('Institutos')
                       //->where('Institutos.sede_id','=', \Auth::user()->sede_id)
                    ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');

                     return view('Periodo.create',compact('periodos','sedes'));

                      }  



                    $periodos = DB::connection('bdestipm6')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');



                    return view('Periodo.create',compact('periodos'));
                break;

                  case '18':
                    
                      if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {

                          $periodos = DB::connection('bdestsiso')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');

                          $sedes = DB::table('Institutos')
                       //->where('Institutos.sede_id','=', \Auth::user()->sede_id)
                    ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');

                     return view('Periodo.create',compact('periodos','sedes'));

                      }

                       $periodos = DB::connection('bdestsiso')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');
                     
                    // dd($periodos);
                    return view('Periodo.create',compact('periodos'));
                break;

                  case '22':

                  if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {

                    $periodos = DB::connection('bdestmejoramiento')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');

                     $sedes = DB::table('Institutos')
                       //->where('Institutos.sede_id','=', \Auth::user()->sede_id)
                    ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');

                     return view('Periodo.create',compact('periodos','sedes'));

                  }
                      $periodos = DB::connection('bdestmejoramiento')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');

                    return view('Periodo.create',compact('periodos'));
                break;

                  case '78':

                  if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {

                     $periodos = DB::connection('bdestrubio')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');

                       $sedes = DB::table('Institutos')
                       //->where('Institutos.sede_id','=', \Auth::user()->sede_id)
                    ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');

                     return view('Periodo.create',compact('periodos','sedes'));

                  }


                      $periodos = DB::connection('bdestrubio')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');

                    return view('Periodo.create',compact('periodos'));
                break;

                  case '81':

                   if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {

                     $periodos = DB::connection('bdestmacaro')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');

                     $sedes = DB::table('Institutos')
                       //->where('Institutos.sede_id','=', \Auth::user()->sede_id)
                    ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');

                     return view('Periodo.create',compact('periodos','sedes'));

                   }


                          $periodos = DB::connection('bdestmacaro')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->orderBy('id', 'ASC')->pluck('lapso.codigo', 'lapso.codigo');

                    return view('Periodo.create',compact('periodos'));
                break;


           
           default:
               # code...
               break;
       }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $usersede= \Auth::user()->sede_id;

         $id_user=\Auth::user()->id;

          if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {
         
         $rules = [

          'corte' => 'required',
          'sede_id' => 'required',
          'inicio' => 'required',
          'fin' => 'required',
          'estatus' => 'required',
          
      ];

      $messages = [
       'corte.required' => 'Este campo es requerido.',
       'sede_id.required' => 'Este campo es requerido.',
       'inicio.required' => 'Este campo es requerido.',
       'fin.required' => 'Este campo es Obligatorio.',
       'estatus.required' => 'Este campo es requerido.',

      ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
           return back()
                ->withErrors($validator)->withInput();
        }

}//fin de IF

      $rules = [

          'corte' => 'required',
          //'sede_id' => 'required',
          'inicio' => 'required',
          'fin' => 'required',
          'estatus' => 'required',
          
      ];

      $messages = [
       'corte.required' => 'Este campo es requerido.',
       //'sede_id.required' => 'Este campo es requerido.',
       'inicio.required' => 'Este campo es requerido.',
       'fin.required' => 'Este campo es Obligatorio.',
       'estatus.required' => 'Este campo es requerido.',

      ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
           return back()
                ->withErrors($validator)->withInput();
        }

        $i="Activo";
        $mytime = Carbon::now();
        $fecha= $mytime->format('Y');
      //  dd($fecha);
    /* if ($request->input('estatus') == 'Activo') {

        // dd($request);

         $resultado=DB::table('sc_periodos')->where('estatus', '=', $i)->exists();
         
        
              if($resultado == true){      
           Alert::error('Error ya se encuentra un período activo')->autoclose(3500);
           return redirect()->route('Periodo.create')->withInput();
        }
         # code...
     }*/

       

    
        
     /*elseif ($fecha != $request->input('NombrePeriodo')) {
        Alert::error('Error al intentar superar el año actual')->autoclose(3500);
           return redirect()->route('Periodo.create')->withInput();
     }*/

   /* $lapsoinput=$request->input('Lapso');



 $lapso=DB::table('Periodo')->where('lapso', '=', $lapsoinput)->exists();
//dd($lapso);

  if($lapso){      
           Alert::error('Error de periodo !¡ ya existe ¡!')->autoclose(3500);
           return redirect()->route('Periodo.create')->withInput();
        }*/

     /*   Periodo::where('id', $data['periodo_id'])->update([
                    'sede_id' => Auth::user()->sede_id,
                    'corte' => $data['corte'],
                    'estatus' => $data['estatus'],
                    'inicio' => date_format(new DateTime(str_replace("/", "-", $data['inicio'])), 'Y-m-d'),
                    'fin' => date_format(new DateTime(str_replace("/", "-", $data['fin'])), 'Y-m-d'),
                ]);*/

                   $Datos=Periodo::where('sc_periodos.corte','=', $request->corte)
                   ->where('sc_periodos.sede_id','=', $request->input('sede_id'))
      ->exists(); 
//dd($Datos, $request->input('sede_id'));
      if ($Datos == true) {
       Alert::error('Período ya fue creado')->autoclose(3500);

         
          return back()
                ->withErrors($validator)->withInput();

      }


           
          // dd($request->corte);
             $datosSocio = new Periodo;

           // $datosSocio->sede_id = $request->sede_id;
            //$datosSocio->sede_id  = $request->input('sede_id');
            $datosSocio->user_id  = $id_user;
            $datosSocio->corte    = $request->corte;
             $datosSocio->estatus = $request->estatus;
            $datosSocio->inicio   = date_format(new DateTime(str_replace("/", "-", $request['inicio'])), 'Y-m-d');
             $datosSocio->fin     = date_format(new DateTime(str_replace("/", "-", $request['fin'])), 'Y-m-d');
         // dd($datosSocio);
                if ($request->sede_id == true) {
               $datosSocio->sede_id  = $request->input('sede_id');
             }else{


            $datosSocio->sede_id  = $usersede;

             }
            $datosSocio->save();
        
           
    Alert::success('Periodo creado con éxito')->autoclose(3500);

        return redirect()->route('Periodo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       

         $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.sede_id')
        ->first();
        $sedeprincipal =  $institutosExtensiones->sede_id;

        //dd($sedeprincipal);
       switch ($sedeprincipal) {
           case '1':
             $periodos=Periodo::find($id);
       // $period=Periodo::first($id);
        //$fechabd=$periodos->inicio;

        $newDate = date("d-m-Y", strtotime($periodos["inicio"]));


              $comunityy = Periodo::where('sc_periodos.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->first();



                $lapso = DB::connection('bdestipc')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->get();

                     return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy'));
               break;

               case '3':
                if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {
                 $periodos=Periodo::find($id);
        $newDate = date("d-m-Y", strtotime($periodos["inicio"]));

        $comunityy = Periodo::where('sc_periodos.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->first();

       $sedes = DB::table('Institutos')
       ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');

                $lapso = DB::connection('bdestipb')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->get();
                   //  dd($periodos);

                     return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy','sedes'));

                    }
                

                    $periodos=Periodo::find($id);
          $newDate = date("d-m-Y", strtotime($periodos["inicio"]));
           $comunityy = Periodo::where('sc_periodos.id', '=', $id)
        // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
         ->first();
       
       
                      $lapso = DB::connection('bdestipb')->table('lapso')
                     // ->where('lapso.sede_id', '=', $sedeprincipal)
                      ->select('lapso.id','lapso.codigo')
                       ->get();
  
                      return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy'));
                
                break;






                  case '13':
                    if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {

                  $periodos=Periodo::find($id);
        $newDate = date("d-m-Y", strtotime($periodos["inicio"]));
         $comunityy = Periodo::where('sc_periodos.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->first();
       $sedes = DB::table('Institutos')
       //->where('Institutos.sede_id','=', \Auth::user()->sede_id)
    ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');

     
                    $lapso = DB::connection('bdestipmar')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->get();

                    return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy','sedes'));
                  }
                

                  $periodos=Periodo::find($id);
        $newDate = date("d-m-Y", strtotime($periodos["inicio"]));
         $comunityy = Periodo::where('sc_periodos.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->first();
     
     
                    $lapso = DB::connection('bdestipmar')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->get();

                    return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy'));
                    break;





                  case '16':
                    if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {
                  $periodos=Periodo::find($id);
        $newDate = date("d-m-Y", strtotime($periodos["inicio"]));

         $comunityy = Periodo::where('sc_periodos.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->first();

                    $lapso = DB::connection('bdestipm6')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                   ->get();

                    return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy'));
               
                  }
                

                  $periodos=Periodo::find($id);
        $newDate = date("d-m-Y", strtotime($periodos["inicio"]));
         $comunityy = Periodo::where('sc_periodos.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->first();
     
     
                    $lapso = DB::connection('bdestipm6')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->get();

                    return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy'));
                    break;



                  case '18':
                    if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {
                  $periodos=Periodo::find($id);
        $newDate = date("d-m-Y", strtotime($periodos["inicio"]));

         $comunityy = Periodo::where('sc_periodos.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->first();

                      $lapso = DB::connection('bdestsiso')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->get();

                 return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy'));
                }
                

                $periodos=Periodo::find($id);
      $newDate = date("d-m-Y", strtotime($periodos["inicio"]));
       $comunityy = Periodo::where('sc_periodos.id', '=', $id)
    // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
     ->first();
   
   
                  $lapso = DB::connection('bdestsiso')->table('lapso')
                 // ->where('lapso.sede_id', '=', $sedeprincipal)
                  ->select('lapso.id','lapso.codigo')
                   ->get();

                  return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy'));
               
                 break;




                  case '22':
                    if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {
                  $periodos=Periodo::find($id);
        $newDate = date("d-m-Y", strtotime($periodos["inicio"]));

         $comunityy = Periodo::where('sc_periodos.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->first();

                      $lapso = DB::connection('bdestmejoramiento')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->get();

                    return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy'));
                  }
                

                  $periodos=Periodo::find($id);
        $newDate = date("d-m-Y", strtotime($periodos["inicio"]));
         $comunityy = Periodo::where('sc_periodos.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->first();
     
     
                    $lapso = DB::connection('bdestmejoramiento')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->get();

                    return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy'));
             
                    break;



                  case '78':
                    if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {
                  $periodos=Periodo::find($id);
        $newDate = date("d-m-Y", strtotime($periodos["inicio"]));

        $comunityy = Periodo::where('sc_periodos.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->first();


                      $lapso = DB::connection('bdestrubio')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                    ->get();

                    return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy'));
                  }
                

                  $periodos=Periodo::find($id);
        $newDate = date("d-m-Y", strtotime($periodos["inicio"]));
         $comunityy = Periodo::where('sc_periodos.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->first();
     
     
                    $lapso = DB::connection('bdestrubio')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->get();

                    return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy'));
              
                    break;


                  case '81':
                    if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {
                  $periodos=Periodo::find($id);
        $newDate = date("d-m-Y", strtotime($periodos["inicio"]));

         $comunityy = Periodo::where('sc_periodos.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->first();


                          $lapso = DB::connection('bdestmacaro')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->get();

                    return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy'));
                  }
                

                  $periodos=Periodo::find($id);
        $newDate = date("d-m-Y", strtotime($periodos["inicio"]));
         $comunityy = Periodo::where('sc_periodos.id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->first();
     
     
                    $lapso = DB::connection('bdestmacaro')->table('lapso')
                   // ->where('lapso.sede_id', '=', $sedeprincipal)
                    ->select('lapso.id','lapso.codigo')
                     ->get();

                    return view('Periodo.edit', compact('periodos','newDate','lapso','comunityy'));
               
                    break;


           
           default:
               # code...
               break;
       }


//dd($periodos);

  
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
      $usersede= \Auth::user()->sede_id;
        $rules = [

            'corte' => 'required',
            //'sede_id' => 'required',
            'inicio' => 'required',
            'fin' => 'required',
            'estatus' => 'required',
            
        ];

        $messages = [
         'corte.required' => 'Este campo es requerido.',
        //'sede_id.required' => 'Este campo es requerido.',
        'inicio.required' => 'Este campo es requerido.',
        'fin.required' => 'Este campo es Obligatorio.',
           'estatus.required' => 'Este campo es requerido.',

        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            return redirect()->action('App\Http\Controllers\PeriodosController@edit',$id)
                ->withErrors($validator)->withInput();
        }
 $i="1";
        $mytime = Carbon::now();
        $fecha= $mytime->format('Y');
       // dd($fecha);
        if ($i == $request->input('Vigente')) {
        $resultado=DB::table('Periodo')->where('Vigente', '=', $i)->exists();
          //  dd($resultado);
        
              if($resultado){      
           Alert::error('Error ya se encuentra un periodo activo')->autoclose(3500);
           return redirect()->route('Periodo.edit',$id)->withInput();
        }
        
     }

        $periodos =Periodo::findOrFail($id);
       // $periodos->sede_id = $request->input('sede_id');
        $periodos->corte=$request->corte;
        $periodos->inicio=$request->inicio;
        $periodos->fin=$request->get('fin');
        $periodos->estatus=$request->estatus;
//dd($periodos);
         if ($request->sede_id === true) {
               $periodos->sede_id  = $request->input('sede_id');
             }else{

                
            $periodos->sede_id  = $usersede;

             }
        $periodos->update();
     
       Alert::success( 'Periodo actualizado con éxito')->autoclose(3500);
        return redirect()->route('Periodo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         
        $periodos  = Periodo::find($id);
           
        $periodos->delete(); 
    
     Alert::success('Periodo Eliminado con éxito')->autoclose(3500);

     return redirect()->route('Periodo.index');
    }
}
