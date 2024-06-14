<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PivotUserProject;
use DB;
use Auth;
use App\Models\Asesor;
use App\Models\Comunidad;
use App\Models\State;
use App\Models\User;
use App\Models\Proyecto;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
       $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.NombInstituto')
        ->first();
        $sedeprincipal =  $institutosExtensiones->NombInstituto;


    if (@Auth::user()->hasRole('Profesor')) {
      
          $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.NombInstituto')
        ->first();
        $sedeprincipal =  $institutosExtensiones->NombInstituto;

        $asesorcomunita = Asesor::
        leftJoin('sc_comunidades', 'sc_comunidades.asesor_id', '=', 'sc_asesores.id')
        ->where('sc_asesores.sede_id', Auth::user()->sede_id)
        ->leftJoin('proyectos', 'sc_comunidades.proyecto_id', '=', 'proyectos.id')
        ->leftJoin('referencias', 'referencias.proyecto_id', '=', 'proyectos.id')
        ->leftJoin('localities', 'sc_comunidades.localidad', '=', 'localities.id')
        ->leftJoin('provinces', 'sc_comunidades.provincia', '=', 'provinces.id')
        ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
        ->select('sc_asesores.id','sc_asesores.ci','sc_asesores.firstname','sc_asesores.primary_lastname','sc_asesores.middlename','sc_asesores.second_lastname','sc_comunidades.nombre',
    'sc_comunidades.sector','proyectos.nombre_proyecto','sc_comunidades.direccion','sc_comunidades.lugar_prestadores',
        'sc_comunidades.id as comunID','sc_comunidades.created_at','referencias.referencia','sc_comunidades.direccion_lugar','localities.locality','provinces.province','states.state')
       ->paginate(5);
   //dd($asesorcomunita);
       $area_codes = DB::table('codes')->get();
        // GET STATES
        $states = State::orderBy('state', 'ASC')->get();


        return view('asesorComunity.index', compact('asesorcomunita','states','area_codes','sedeprincipal'));
    }

         $especialidades = DB::table('especialidades')
      ->orderBy('cod', 'ASC')->pluck('nombre', 'cod');
      $users = User::where('role_id', '=', 3)->where('sede_id', Auth::user()->sede_id)->get();
        
        $posts = Proyecto::
        leftJoin('referencias', 'referencias.proyecto_id', '=', 'proyectos.id')
        //->where('proyectos.sede_id', Auth::user()->sede_id)
       -> leftJoin('especialidades', 'proyectos.especialidad_cod', '=', 'especialidades.cod')
        ->select('proyectos.id','proyectos.nombre_proyecto','proyectos.linea_accion','proyectos.descripcion','proyectos.autor','proyectos.fundamentacion',
        'proyectos.proposito','proyectos.competencia','proyectos.metodologia','proyectos.created_at',
        'referencias.referencia','referencias.id as idrefe','especialidades.nombre')
        ->orderBy('proyectos.id')
        ->distinct()
        ->paginate(10);

       //dd($posts);
 $PivotUserProject = PivotUserProject::
       where('sc_user_proyecto.sede_id', Auth::user()->sede_id)
       ->leftJoin('Institutos', 'sc_user_proyecto.sede_id', '=', 'Institutos.id')
       ->leftJoin('users', 'sc_user_proyecto.user_id', '=', 'users.id')
       ->leftJoin('proyectos', 'sc_user_proyecto.proyecto_id', '=', 'proyectos.id')
       ->leftJoin('sc_periodos', 'sc_user_proyecto.periodo_id', '=', 'sc_periodos.id')
       ->select('sc_user_proyecto.id','sc_user_proyecto.total_hours','sc_user_proyecto.finalized_at','Institutos.NombInstituto','users.firstname','users.primary_lastname','proyectos.nombre_proyecto','sc_periodos.corte','sc_user_proyecto.created_at','sc_user_proyecto.proyecto_id')
       ->orderBy('sc_user_proyecto.id', 'ASC')
       ->first();
     //dd($PivotUserProject);
        return view('projects.index', compact('posts','especialidades','users','PivotUserProject','sedeprincipal'))->with('i', ($request->input('page', 1) - 1) * 5);
   


}
}