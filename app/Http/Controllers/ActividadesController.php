<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\PivotUserProject;
use App\Models\Prestador;
use App\Models\Comunidad;
use App\Models\Actividad;
use App\Models\Periodo;
use App\Models\Grupo;
use App\Models\Recurso;
use App\Models\Beneficiario;
use App\Models\prestadoresActividades;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ActividadRequest;
use Auth;
use Alert;
use DB;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
class ActividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPrestadores(Request $request){
    $parroquias = Prestador::where('grupo_id',$request->valor)->get();
        

        return response()->json($parroquias);
    

    }

    public function index()
    {

          abort_if(Gate::denies('actividades_index'), 403);

           $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.NombInstituto')
        ->first();
        $sedeprincipal =  $institutosExtensiones->NombInstituto;
           
     $data = prestadoresActividades::
          leftJoin('sc_actividades', 'sc_prestador_sc_actividad.sc_actividad_id', '=', 'sc_actividades.id')
         ->leftJoin('proyectos', 'sc_actividades.proyecto_id', '=', 'proyectos.id')
         ->leftJoin('sc_periodos', 'sc_actividades.sc_periodo_id', '=', 'sc_periodos.id')
         ->leftJoin('Institutos', 'sc_actividades.sede_id', '=', 'Institutos.id')
          ->leftJoin('sc_prestadores', 'sc_prestador_sc_actividad.sc_prestador_id', '=', 'sc_prestadores.id')
         ->where('sc_actividades.sc_user_proyecto_id', '=', \Auth::user()->id)
          //->where('sc_periodos.sede_id', '=', \Auth::user()->sede_id)
         ->orderBy('fecha','DESC')
         ->select('Institutos.NombInstituto','sc_actividades.fecha','sc_actividades.actividad',
            'sc_actividades.hrs','sc_periodos.corte','sc_actividades.id','sc_prestadores.firstname')
         ->get();
     //  dd($data);
        return view('actividades.index',compact('data','sedeprincipal'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         abort_if(Gate::denies('actividades_create'), 403);
         $proyectos = Prestador::where('sc_prestadores.sc_user_proyecto_id', Auth::user()->id)
          ->leftJoin('proyectos', 'sc_prestadores.proyecto_id', '=', 'proyectos.id')
          ->select('proyectos.nombre_proyecto', 'proyectos.id')
         ->groupBy('proyectos.nombre_proyecto', 'proyectos.id')
         ->get();



         $seccion = Prestador::where('sc_user_proyecto_id', Auth::user()->id)
       
         ->select('sc_prestadores.grupo_id')
          ->groupBy('sc_prestadores.grupo_id')
           // ->orderBy('id','DESC')
         ->get();
//         dd($seccion);
         return view('actividades.create',compact('proyectos','seccion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActividadRequest $request)
    {
        $data = $request->all();
 //dd($data);
        $user = Auth::user();

        $proyectoname = Proyecto::where('id', $request->input('proyecto'))->first();


        // $periodo = Periodo::where('sede_id', Auth::user()->sede_id )->first();
      

       $proyecto = PivotUserProject::where('sc_user_proyecto.user_id', Auth::user()->id)
         ->leftJoin('proyectos', 'sc_user_proyecto.proyecto_id', '=', 'proyectos.id')
         ->select('proyectos.nombre_proyecto', 'proyectos.id','sc_user_proyecto.periodo_id')
         ->groupBy('proyectos.nombre_proyecto', 'proyectos.id','sc_user_proyecto.periodo_id')
         ->first();
//// dd($proyecto);

$periodo = $proyecto->periodo_id;
         $proyecto = Prestador::where('proyecto_id', $data['proyecto'])
         ->doesntExist();

         if ($proyecto == true) {
            Alert::error(session('error', '<b>¡Disculpe!</b>  El proyecto: <b>"'.$proyectoname->nombre_proyecto.'" no posee prestadores de servicio.<br><br><p style="color:#333;font-size:12px;">Por favor, registre un grupo de prestadores de servicio a este proyecto.</p><br><br>'));
                    return back();
         }

        /* $proyectocomunidad = Comunidad::where('proyecto_id', $data['proyecto'])
         ->doesntExist();

            if ($proyectocomunidad == true) {
            Alert::error(session('error', '<b>¡Disculpe!</b> El proyecto: <b>"'.$proyectoname->nombre_proyecto.'"</b> debe tener una comunidad con asesor comunitario registrada.<br><br><p style="color:#333;font-size:12px;">Por favor, registre una comunidad y su asesor comunitario a este proyecto.</p><br><br>'));
                    return back();
         }*/



        try {

            $actividad = Actividad::create([
                'sede_id' => Auth::user()->sede_id,
                'sc_user_proyecto_id' => Auth::user()->id,
                'user_id' => $user->id,
                'proyecto_id' => $data['proyecto'],
                'sc_periodo_id' => $periodo,
                'fecha' => date_format(new DateTime(str_replace("/", "-", $data['fecha'])), "Y-m-d"),
                'actividad' => $data['actividad'],
                'detalle' => $data['detalle'],
                'direccion' => $data['direccion'],
                'hrs' => $data['duracion'],
                'impacto_gen' => $data['impacto'],
            ]);

            // ARRAY RECURSOS
            $recursosCount = count($data['recursos']); // CANTIDAD DE RECURSOS
            if($recursosCount)
            {   
                for ($i = 0; $i < $recursosCount; $i++) { 
                    $recurso = [
                        'sc_actividad_id' => $actividad->id,
                        'recurso' => $data['recursos'][$i],
                        'tipo' => $data['tipo_recurso'][$i]
                    ];
                    // INSERT DATA RECURSO
                    Recurso::create($recurso);
                }
            }
            // ARRAY BENEFICIARIOS
            $beneficiariosCount = count($data['beneficiarios']); // CANTIDAD DE BENEFICIARIOS
            if($beneficiariosCount)
            {   
                for ($i = 0; $i < $beneficiariosCount; $i++) { 
                    $beneficiario = [
                        'sc_actividad_id' => $actividad->id,
                        'num_beneficiarios' => $data['beneficiarios'][$i],
                        'genero' => $data['tipo_beneficiario'][$i]
                    ];
                    // INSERT DATA RECURSO
                    Beneficiario::create($beneficiario);
                }
            }

            foreach ($data['prestadores'] as $key => $value) {
                # code...
            
             $Datos= new prestadoresActividades(request()->all());
              $Datos->sc_prestador_id = $value  ;
               $Datos->sc_actividad_id =$actividad->id;
               $Datos->grupo_id = $data['grupo_id'];

              $Datos->save();

                }



              Alert::success(session('success', 'Creado con éxito!'));
               return redirect()->route('Actividades.index');
        
        } catch (Exception $e) {

            return response()->json(['response' => 'error', 'error' => $e]);

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
        abort_if(Gate::denies('actividades_show'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

         abort_if(Gate::denies('actividades_edit'), 403);   

          $user = Actividad::findOrFail($id);
          //dd($user);
       $proyectos = Proyecto::where('autor', Auth::user()->id)->get();
        $seccion = Grupo::where('sc_user_proyecto_id', Auth::user()->id)
         ->orderBy('id','DESC')->get();

       
        return view('actividades.edit',compact('user','proyectos','seccion','id')); 

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        abort_if(Gate::denies('actividades_destroye'), 403);
         $prestadores = prestadoresActividades::where('sc_actividad_id', $id)->exists();  

         if ($prestadores == true) {
             Alert::error(session('error', 'Existen prestadores registrados en esta actividad, imposible elimanar!'));
                return back();
         }

        $actividad = Actividad::find($id);
         $beneficiario = Beneficiario::where('sc_actividad_id', $id)->delete();    
      $actividad->delete(); 


       Alert::success(session('success', 'Eliminado con éxito!'));
                return redirect()->route('Actividades.index');

    }
}
