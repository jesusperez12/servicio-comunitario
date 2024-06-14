<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Gate;
use Auth;
use Session;
use Redirect;
use Alert;
use App\Models\User;
use App\Models\Proyecto;
use App\Models\Prestador;
use App\Models\Actividad;
use App\Models\Comunidad;
use App\Models\Authority;
use Carbon\Carbon;
use App\Models\numcertificados;
class ReportePrestadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   const HOURS_SERVICE = 120;

       public function __construct(){

        $this->middleware('auth:sc_prestadores');
    }

    public function index()
    {

        $prestador = Auth::guard('sc_prestadores')->user();
//dd($prestador);
        $pup_relations = DB::table('sc_user_proyecto')->where(
            'sc_user_proyecto.user_id', $prestador->sc_user_proyecto_id
        )->first();

     //  dd($pup_relations);

        $activida=DB::table('sc_prestador_sc_actividad')
         ->leftJoin('sc_actividades', 'sc_prestador_sc_actividad.sc_actividad_id', '=', 'sc_actividades.id')
         ->where('sc_prestador_sc_actividad.sc_prestador_id', '=', $prestador->id)
        ->where('sc_actividades.sc_user_proyecto_id', '=', $prestador->sc_user_proyecto_id)
        ->select('sc_actividades.hrs')
        ->get();  
       // dd($activida);
 $suma=0;
    foreach ($activida as $solicitud) {
          
          $suma+=$solicitud->hrs;


    }
     $pr=$prestador->sede_id;
        $codgru=$prestador->grupo_id;
        $idperiodo=$prestador->sc_periodo_id;
        $sedes = DB::table('Institutos')->where('id', '=',$pr)
        ->select('Institutos.NombInstituto','Institutos.CodSede')
       ->first();
       view()->share('sedes',$sedes);

      /*  $gruposeccion = DB::table('sc_grupos')->where('id', '=',$codgru)
        ->select('sc_grupos.grupo')
       ->first();*/

         $periodo = DB::table('sc_periodos')->where('id', '=',$idperiodo)
        ->select('sc_periodos.corte')
       ->first();

$code = 'SC120-'. $sedes->CodSede . $prestador->grupo_id . $prestador->id . $periodo->corte;
     //

     $userCertificado = DB::table('numcertificados')->where(
            'certificados', '=',$code)
     ->doesntExist();
//dd($userCertificado);
        if ($userCertificado == true || $suma == 120) {
           

            $Datos= new numcertificados(request()->all()); 
              $Datos->certificados = $code;
                $Datos->sede_id = $prestador->sede_id;
                $Datos->prestador_id = $prestador->id;
              $Datos->save();
                Alert::success(session('success', 'Felicidades has cumplido las horas asignadas,
                    ahora toca esperar la validación del certificado.!'));
        }
       
        //dd($suma);
           $userCertificado = DB::table('numcertificados')
           ->where('certificados', '=',$code)
           ->where('prestador_id', '=',$prestador->id)
     ->first();
//  dd($userCertificado);



       /* $comunidad = $prestador->proyecto->comunidades()->where(
            'sc_user_proyecto_id', $prestador->sc_user_proyecto_id
        )->first();
       // dd($comunidad);
        $asesor = DB::table('sc_asesores')->where(
            'sc_comunidad_id', $comunidad->id
        )->first();

        $telf_asesor = DB::table('phones')->select(
            'phones.*',
            'codes.*'
        )->join('codes', function ($join) {
            $join->on('codes.id', '=','phones.code_id');
        })->where(
            'sc_asesor_id', $asesor->id
        )->get();*/
      
        return view('prestadores.home', [
            'prestador' => $prestador,
            'proyecto' => $prestador->proyecto,
            'actividades' => $prestador->actividades()->orderBy('id', 'DESC')->get(),
            'count_actividades' => count($prestador->actividades),
            'horas_restantes' => (self::HOURS_SERVICE - $pup_relations->total_hours),
            'pup_relations' => $pup_relations,
           // 'comunidad' => $comunidad,
            //'asesor' => $asesor,
            //'tlfs_asesores' => $telf_asesor,
            'activida'=>$activida,
            'suma'=>$suma,
             'userCertificado'=>$userCertificado
        ]);
    }



     public function getCertificate()
    {  
         // GET DATE
        $dt = Carbon::now('America/Caracas');

        $fecha = Carbon::now();
      $fechas= $fecha->format('d/m/Y h:i:s A');
      view()->share('fechas',$fechas);
        // PRESTADOR DE SERVICIO
        $prestador = Auth::guard('sc_prestadores') ->user();

    //dd($fechas);
        $pr=$prestador->sede_id;
        $codgru=$prestador->grupo_id;
        $idperiodo=$prestador->sc_periodo_id;
        $sedes = DB::table('Institutos')->where('id', '=',$pr)
        ->select('Institutos.NombInstituto','Institutos.CodSede')
       ->first();
       view()->share('sedes',$sedes);



        $gruposeccion = DB::table('sc_grupos')->where('id', '=',$codgru)
        ->select('sc_grupos.grupo')
       ->first();

         $periodo = DB::table('sc_periodos')->where('id', '=',$idperiodo)
        ->select('sc_periodos.corte')
       ->first();

     /*   $autoridades = DB::table('authorities')->where('sede_id', '=',$pr)
        ->leftJoin('cargos', 'authorities.cargo_id', '=', 'cargos.id')
        ->select('authorities.autoridad','cargos.cargo')
       ->first();*/
       
      // $usersede=\Auth::user()->ci;
       //$prestador =prestador::get();
       // ->leftJoin('Institutos', 'sc_prestadores.Institutos_id', '=', 'Institutos.id')
       // ->select('Institutos.NombInstituto')
       
     // dd($sedes);
        // GET PUP_RELATIONS
        $pup_relations = DB::table('sc_user_proyecto')->where('user_id', $prestador->sc_user_proyecto_id)->first();
       //    dd($pup_relations);
        // AUTORIDADES
        $autoridades = Authority::where(
            'sede_id', $prestador->sede_id
        )->get()->load('cargo');
       // dd($autoridades);
        $coordinacionArea = null;
        $secretariaArea = null;
        $controlEstudioArea = null;

        foreach ($autoridades as $autoridad) {
            if ($autoridad->cargo->alias == 'coordinacion-sc') {
                $coordinacionArea = $autoridad->autoridad;
            } else if ($autoridad->cargo->alias == 'secretaria') {
                $secretariaArea = $autoridad->autoridad;
            } else if ($autoridad->cargo->alias == 'control-estudio') {
                $controlEstudioArea = $autoridad->autoridad;
            }
        }

        // CERTIFICATE CODE
        $code = 'SC120-'. $sedes->CodSede . $prestador->grupo_id . $prestador->id . $periodo->corte;
        view()->share('code',$code);

           $userCertificado = DB::table('numcertificados')
           ->where('certificados', '=',$code)
           ->where('prestador_id', '=',$prestador->id)
     ->first();
      view()->share('userCertificado',$userCertificado);
        //dd($code);
        // COMPROBAR CUMPLIMIENTO DE SERVICIO COMUNITARIO
        if ($pup_relations->status == 0 && $prestador->hrs_comunitarias == self::HOURS_SERVICE) {
            // GET ESPECIALIDAD 
            $especialidad = DB::table('especialidades')->select(
                'nombre'
            )->where(
                'cod', $prestador->especialidad_cod
            )->first();

           //   view()->share('especialidad',$especialidad);
            // GET PROYECTO
            $proyecto = Proyecto::find($prestador->proyecto_id);
            // GET COMUNIDAD
            $comunidad = Comunidad::where(
                'sc_user_proyecto_id', $prestador->sc_user_proyecto_id
            )->first();
          //  dd($comunidad);
            $data = [
                'nombre_sede' => $sedes->NombInstituto,
                'nombre' => $prestador->firstname . ' ' . $prestador->middlename . ' ' . $prestador->primary_lastname . ' ' . $prestador->second_lastname,
                'especialidad' => $especialidad,
                'proyecto' => $proyecto,
                'comunidad' => $comunidad,
                'pup_relations' => $pup_relations,
                'dt' => $dt,
                'ci' => $prestador->ci,
                'coordinacionArea' => $coordinacionArea,
                'secretariaArea' => $secretariaArea,
                'controlEstudioArea' => $controlEstudioArea,
                'code' => $code,
            ];
         
          //  dd($data);

          /*  $pdf = Pdf::loadView('pdfs.certificado', $data);
            return $pdf->download('invoice.pdf');*/
        
            $pdf = PDF::loadView('pdfs.certificado',$data);
          // $pdf = PDF::loadView('pdfs.certificado', ['data' => $data]);
          // $pdf->getDomPDF()->get_option('enable_html5_parser');
            return $pdf->download($code.'.pdf');

        } else {

            abort(403);
            
        }
      

  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
    public function destroy($id)
    {
        //
    }
}
