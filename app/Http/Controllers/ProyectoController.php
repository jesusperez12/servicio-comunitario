<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProyectoRequest;
use App\Http\Requests\ProyectCreateRequest;
use DB;
use Auth;
use Alert;
use App\Models\User;
use App\Models\Periodo;
use App\Models\Proyecto;
use App\Models\Referencia;
use App\Models\Prestador;
use App\Models\PivotUserProject;
use App\Models\Especialidad;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       // $id_user=\Auth::user()->id;

       // dd($id_user); "id" => 11
 
     abort_if(Gate::denies('proyecto_index'), 403);

        $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.NombInstituto')
        ->first();
        $sedeprincipal =  $institutosExtensiones->NombInstituto;


          if (@Auth::user()->hasRole('SuperAdmin') || @Auth::user()->hasRole('Coordinador_Nacional')) {

             $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.NombInstituto')
        ->first();
        $sedeprincipal =  $institutosExtensiones->NombInstituto;


            $especialidades = DB::table('especialidades')
      ->orderBy('cod', 'ASC')->pluck('nombre', 'cod');


      $users = User::where('role_id', '=', 3)->where('sede_id', Auth::user()->sede_id)->get();
        
        $posts = Proyecto::
        leftJoin('referencias', 'referencias.proyecto_id', '=', 'proyectos.id')
       // ->where('sede_id', Auth::user()->sede_id)
        ->leftJoin('especialidades', 'proyectos.especialidad_cod', '=', 'especialidades.cod')
        ->select('proyectos.id','proyectos.nombre_proyecto','proyectos.linea_accion','proyectos.descripcion','proyectos.autor','proyectos.fundamentacion',
        'proyectos.proposito','proyectos.competencia','proyectos.metodologia','proyectos.created_at',
        'referencias.referencia','referencias.id as idrefe','especialidades.nombre')
        ->orderBy('proyectos.id')
        ->distinct()
        ->paginate(10);

       //dd($posts);
 $PivotUserProject = PivotUserProject::
     //  where('sc_user_proyecto.sede_id', Auth::user()->sede_id)
      leftJoin('Institutos', 'sc_user_proyecto.sede_id', '=', 'Institutos.id')
       ->leftJoin('users', 'sc_user_proyecto.user_id', '=', 'users.id')
       ->leftJoin('proyectos', 'sc_user_proyecto.proyecto_id', '=', 'proyectos.id')
       ->leftJoin('sc_periodos', 'sc_user_proyecto.periodo_id', '=', 'sc_periodos.id')
       ->select('sc_user_proyecto.id','sc_user_proyecto.total_hours','sc_user_proyecto.finalized_at','Institutos.NombInstituto','users.firstname','users.primary_lastname','proyectos.nombre_proyecto','sc_periodos.corte','sc_user_proyecto.created_at','sc_user_proyecto.proyecto_id')
       ->orderBy('sc_user_proyecto.id', 'ASC')
       ->first();
     //dd($PivotUserProject);
        return view('projects.index', compact('posts','especialidades','users','PivotUserProject','sedeprincipal'))->with('i', ($request->input('page', 1) - 1) * 5);
          # code...
        }


      $especialidades = DB::table('especialidades')
      ->orderBy('cod', 'ASC')->pluck('nombre', 'cod');
      $users = User::where('role_id', '=', 3)->where('sede_id', Auth::user()->sede_id)->get();
        
        $posts = Proyecto::
        leftJoin('referencias', 'referencias.proyecto_id', '=', 'proyectos.id')
       // ->where('sede_id', Auth::user()->sede_id)
        ->leftJoin('especialidades', 'proyectos.especialidad_cod', '=', 'especialidades.cod')
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  


    public function create()
    {
        $especialidades = DB::table('especialidades')
        ->orderBy('cod', 'ASC')->pluck('nombre', 'cod');
       // $pr=Auth::user()->hasRole('Profesor');
        $users = User::where('role_id', '=', 3)->where('sede_id', Auth::user()->sede_id)->get();
    //  dd($users);

         $sedes = DB::table('sede')

        // ->whereIn('id',  [97,98])
        ->orderBy('id_sede', 'ASC')->pluck('sede.NombSede','sede.id_sede');
//dd($sedes);
        return view('projects.add', [
            'especialidades' => $especialidades,
            'users' => $users,
            'sedes'=>$sedes,
            'link_active' => url()->current()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProyectCreateRequest $request)
    {
         $data = $request->all();
         
    // dd($data);
        try {
            // CREATE NEW PROYECTO TRANSACTION
            DB::transaction(function() use ($data) {
                 $id_user=\Auth::user()->id;
                // INSERT DATA

               //  foreach ($data['especialidad'] as $key => $especialidades) {
                  // dd($especialidades);
              
                $Datos= new Proyecto(request()->all());
               // $Datos->sede_id = $data['sede_id']; 
               $Datos->user_id =  $id_user;
              // $Datos->autor =  $data['autor'];
              //  $Datos->especialidad_cod =  $especialidades;
           //  dd($Datos);
               
                $Datos->save();

                  $refe= new   Referencia(request()->all());
                   $refe->proyecto_id = $Datos->id;
                   $refe->referencia = $data['referencias'];
                  $refe->save();
  //}
            /*    $proyectoId = DB::table('proyectos')->insertGetId([ // GET INSERT ID FOR USER
                    'sede_id' => Auth::user()->sede_id,
                    'user_id' =>  $id_user,
                    'autor' =>  $data['autor'],
                    'nombre_proyecto' => $data['nombre_proyecto'],
                    'descripcion' => $data['descripcion'],
                    'linea_accion' => $data['linea_accion'],
                    'especialidad_cod' => $data['especialidad'],
                    'fundamentacion' => $data['fundamentacion'],
                    'proposito' => $data['proposito'],
                    'competencia' => $data['competencia'],
                    'metodologia' => $data['metodologia']
                ]);*/

            
                
            });
             Alert::success(session('success', 'Creado con éxito!'));
            return redirect()->route('proyect.index');

        } catch (Exception $e) {
            return response('Error: ' . $e->getMessage());
        }
    }


    public function getProjects()
    {
        $projects = Proyecto::where('sede_id', Auth::user()->sede_id)->get()->load('referencias','users','user');
        foreach($projects as $project) {
            foreach($project->users as $user) {
                $speciality = \App\Especialidad::find($user->especialidad_cod);
                if(!is_null($speciality)) {
                    $user->especialidad = $speciality->nombre;
                }
            }
        }
        
        return response()->json(['data' => $projects]);
    }

    public function getProjectById($id)
    {
        $project = Proyecto::findOrFail($id)->load('referencias', 'users');
        return response()->json(['data' => $project]);
    }

    public function assignmentUser($project)
    {
        $users = User::where('role_id', Auth::user()->getRoleIdBySlug('profesor'))->where('parent', Auth::user()->id)->where('sede_id', Auth::user()->sede_id)->get();

         $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.sede_id')
        ->first();
        $sedeprincipal =  $institutosExtensiones->sede_id;


        $cortes = Periodo::where('sede_id', Auth::user()->sedeprincipal)->orderBy('corte', 'DESC')->get();
        
        return view('admin.projects.asign_user', ['users' => $users, 'project' => $project, 'cortes' => $cortes]);
    }

    public function getAssignmentUser($project_id)
    {
        // GET ULTIMO PERIODO
        $periodo = null;
        $periodos = Periodo::where('sede_id', Auth::user()->sede_id)->get();
        foreach($periodos as $periodo) {
            // DETERMINAR PERIODO ACTIVO
            $inicio = Carbon::createFromFormat('Y-m-d', $periodo->inicio);
            $fin = Carbon::createFromFormat('Y-m-d', $periodo->fin);
            if (Carbon::now()->between($inicio, $fin)) {
                $periodo = $periodo;
                break;
            }
        }

        if(!is_null($periodo)) {
            // GET USUARIOS ASIGNADOS AL PROYECTO EN EL PERIODO
            $users = $periodo->users()->wherePivot('proyecto_id', $project_id)->get();
        }else{
            $users = [];
        }
        return response()->json(['users' => $users, 'periodo' => $periodo]);
    }

    public function getAssignmentUserByPeriodo($project_id, $periodo_id)
    {
        // GET USUARIOS ASIGNADOS AL PROYECTO EN EL PERIODO
        $periodo = Periodo::find($periodo_id);
        $users = [];
        if (!empty($periodo)) {
            $users = $periodo->users()->wherePivot('proyecto_id', $project_id)->get();
        }
        
        return response()->json(['users' => $users]);
    }

   /* public function assignmentUserToProject(Request $request) {
        try {
            $data = $request->all();
            // dd($data);
            $project = Proyecto::find($data['project_id']);
            $corte = $data['corte_id'];
            $user_ids = [];
            // COMPLEMENTO
            $periodo_id = ['sede_id' => Auth::user()->sede_id,'periodo_id' => $corte, 'status' => 1];
            if (isset($data['usuarios'])) {
                foreach($data['usuarios'] as $key => $user) {
                    array_push($user_ids, $user);
                }
            }
            $values = array_fill_keys($user_ids, $periodo_id);
            
            if($project->users()->syncWithoutDetaching($values)) {
                return response()->json(['response' => 'ok']);
            }else{
                return response()->json(['error' => [
                    'message' => 'Los datos no pudieron ser guardados.'
                ]], 422);
            }
        } catch (\Exception $e) {
            // RETURN
            return response()->json(['error' => [
                'message' => $e->getMessage()
            ]], 422);
        }
    }*/

    public function unassignmentUserToProject($user, $project, $pivot, $periodo) {  

        try{
            
            $proyecto = Proyecto::find($project);
            $actividades = $proyecto->actividades()->where('sc_periodo_id', $periodo)->where('user_id', $user)->get();
            
            if(count($actividades) > 0) {
               return response()->json([
                   'error' => [
                       'message' => '<b>¡Disculpe!</b> Este usuario posee registro de actividades. <br><br><span style="color:#333;font-size:12px;">Comuníquese con el administrador para dicha acción.</span><br><br>'
                    ]
                ], 403);
            }

            DB::table('sc_user_proyecto')->where('id', $pivot)->delete();

            return response()->json(['response' => 'ok'], 200);

        }catch(Exception $e) {

            return response()->json(['response' => $e]);

        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function AsignarProyecStore(Request $request)
    { 
      $id_user=Auth::user()->id;

      try {
            $data = $request->all();
               
      // dd($data);
            
              // foreach($pryect as  $idproyect) {
//
                  foreach($data['Proyecto'] as $key => $idproyect) {

                    foreach ($data['especialidad_cod'] as $key => $value) {
                      # code...
                // dd($data['Proyecto'],$value);

                 $Datos= new PivotUserProject;
                 $Datos->proyecto_id =  $idproyect;
                $Datos->user_id =  $data['usuarios'];
                $Datos->sede_id = Auth::user()->sede_id;
               $Datos->periodo_id =  $data['corte_id'];
               $Datos->total_hours = '120';
               $Datos->finalized_at = $data['finalized_at'];
                $Datos->status =  '0';
                 $Datos->user_asignador_id =  $id_user;
                  $Datos->especialidad_cod = $value;
                 
              // dd($Datos);
                $Datos->save();
              }
                };
          //  };
            
                   Alert::success(session('success', 'Creado con éxito!'));
                return back();
        /*    $corte = $data['corte_id'];
            $user_ids = [];
            // COMPLEMENTO
            $periodo_id = ['sede_id' => Auth::user()->sede_id,'periodo_id' => $corte, 'status' => 1];
            if (isset($data['usuarios'])) {
                foreach($data['usuarios'] as $key => $user) {
                    array_push($user_ids, $user);
                }
            }
            $values = array_fill_keys($user_ids, $periodo_id);
            
            if($project->users()->syncWithoutDetaching($values)) {
              Alert::success(session('success', 'Creado con éxito!'));
                return back();
            }else{
                return response()->json(['error' => [
                    'message' => 'Los datos no pudieron ser guardados.'
                ]], 422);
            }*/
        } catch (\Exception $e) {
            // RETURN
            return response()->json(['error' => [
                'message' => $e->getMessage()
            ]], 422);
        }
    
       
    }


    public function asignarproyect(Request $request)
    {
      $users = User::where('role_id', '=', 3)
      ->where('users.instituto_id_creador', Auth::user()->sede_id)
      ->get();



      $userol=@Auth::user()->hasRole('Profesor');
      //dd($users);

        $sede = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.sede_id')
        ->first();
        $sedeprincipal =  $sede->sede_id;


       $cortes = Periodo::where('sede_id', '=', $sedeprincipal)
       ->orderBy('corte', 'DESC')
       ->where('sc_periodos.estatus', '=', 'Activo')
       ->get();

        $Proyecto = Proyecto::
        orderBy('id', 'ASC')
        ->get();
       // dd($Proyecto);

         $especialidades = DB::table('especialidades')
        ->orderBy('cod', 'ASC')->get();
//dd($especialidades);
         $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.NombInstituto')
        ->first();
        $sedeprincipal =  $institutosExtensiones->NombInstituto;


if ($userol=='Profesor') {
 $PivotUserProject = PivotUserProject::
       where('sc_user_proyecto.sede_id', Auth::user()->sede_id)
->where('sc_user_proyecto.user_asignador_id', Auth::user()->id)
       ->leftJoin('Institutos', 'sc_user_proyecto.sede_id', '=', 'Institutos.id')
       ->leftJoin('users', 'sc_user_proyecto.user_id', '=', 'users.id')
       ->leftJoin('proyectos', 'sc_user_proyecto.proyecto_id', '=', 'proyectos.id')
       ->leftJoin('sc_periodos', 'sc_user_proyecto.periodo_id', '=', 'sc_periodos.id')
       ->leftJoin('especialidades', 'sc_user_proyecto.especialidad_cod', '=', 'especialidades.cod')
       ->select('sc_user_proyecto.id','sc_user_proyecto.total_hours','sc_user_proyecto.finalized_at','Institutos.NombInstituto','users.firstname','users.primary_lastname','proyectos.nombre_proyecto','sc_periodos.corte','sc_user_proyecto.created_at','sc_user_proyecto.proyecto_id','especialidades.nombre')
       ->orderBy('sc_user_proyecto.id', 'ASC')
       ->get();
   //dd($PivotUserProject);

           $prestadores = Prestador::
       where('sc_prestadores.sede_id', Auth::user()->sede_id)
       ->where('sc_prestadores.sc_user_proyecto_id', Auth::user()->id)
       ->leftJoin('proyectos', 'sc_prestadores.proyecto_id', '=', 'proyectos.id')
       ->leftJoin('sc_periodos', 'sc_prestadores.sc_periodo_id', '=', 'sc_periodos.id')
       ->select('proyectos.nombre_proyecto','sc_periodos.corte','sc_prestadores.proyecto_id')
       ->orderBy('sc_prestadores.id', 'ASC')
       ->get();



        $fecha = Carbon::now();
      $fechas= $fecha->format('Y-m-d h:i:s');
//dd($prestadores,$PivotUserProject,$fechas);
       //dd($cortes);
        return view('projects.AsignarProyect', compact('cortes','users','Proyecto','PivotUserProject','fechas','sedeprincipal'))->with('i', ($request->input('page', 1) - 1) * 5);
}
         $PivotUserProject = PivotUserProject::
       where('sc_user_proyecto.sede_id', Auth::user()->sede_id)
//->where('sc_user_proyecto.user_asignador_id', Auth::user()->id)
       ->leftJoin('Institutos', 'sc_user_proyecto.sede_id', '=', 'Institutos.id')
       ->leftJoin('users', 'sc_user_proyecto.user_id', '=', 'users.id')
       ->leftJoin('proyectos', 'sc_user_proyecto.proyecto_id', '=', 'proyectos.id')
       ->leftJoin('sc_periodos', 'sc_user_proyecto.periodo_id', '=', 'sc_periodos.id')
       ->leftJoin('especialidades', 'sc_user_proyecto.especialidad_cod', '=', 'especialidades.cod')
       ->select('sc_user_proyecto.id','sc_user_proyecto.total_hours','sc_user_proyecto.finalized_at','Institutos.NombInstituto','users.firstname','users.primary_lastname','proyectos.nombre_proyecto','sc_periodos.corte','sc_user_proyecto.created_at','sc_user_proyecto.proyecto_id','especialidades.nombre')
       ->orderBy('sc_user_proyecto.id', 'ASC')
       ->get();
 //  dd($PivotUserProject);

           $prestadores = Prestador::
       where('sc_prestadores.sede_id', Auth::user()->sede_id)
       ->where('sc_prestadores.sc_user_proyecto_id', Auth::user()->id)
       ->leftJoin('proyectos', 'sc_prestadores.proyecto_id', '=', 'proyectos.id')
       ->leftJoin('sc_periodos', 'sc_prestadores.sc_periodo_id', '=', 'sc_periodos.id')
       ->select('proyectos.nombre_proyecto','sc_periodos.corte','sc_prestadores.proyecto_id')
       ->orderBy('sc_prestadores.id', 'ASC')
       ->get();



        $fecha = Carbon::now();
      $fechas= $fecha->format('Y-m-d h:i:s');
//dd($prestadores,$PivotUserProject,$fechas);
       //dd($cortes);
        return view('projects.AsignarProyect', compact('cortes','users','Proyecto','PivotUserProject','fechas','sedeprincipal','especialidades'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function Show($id)
    {
      // $proyect = Proyecto::findOrFail($id);
         $posts = Proyecto::where('proyectos.id', '=', $id)
        ->leftJoin('referencias', 'referencias.proyecto_id', '=', 'proyectos.id')
       -> leftJoin('especialidades', 'proyectos.especialidad_cod', '=', 'especialidades.cod')
        ->select('proyectos.id','proyectos.nombre_proyecto','proyectos.linea_accion','proyectos.descripcion','proyectos.autor','proyectos.fundamentacion',
        'proyectos.proposito','proyectos.competencia','proyectos.metodologia','proyectos.created_at',
        'referencias.referencia','referencias.id as idrefe','especialidades.nombre')
        ->orderBy('proyectos.id')
        ->distinct()
        ->first();
      //  dd($posts);
         return view('projects.ModalShow', compact('posts'));
    }

    public function edit($id)
    {
       $proyect = Proyecto::findOrFail($id);
      $refe=$proyect->referencias->first();
    //  $especiali=$proyect->especialidad->first();
      // dd($especiali);
        $especialidades = Especialidad::orderBy('cod', 'ASC')->pluck('nombre', 'cod');

       $users = User::where('role_id', '=', 3)->where('sede_id', Auth::user()->sede_id)->get();

        return view('projects.editproyect', compact('proyect','especialidades','users','refe'));
    }

  public function editAsignaProyect($id)
    {
        abort_if(Gate::denies('Asignarproyect_edit'), 403);
        $asignar = PivotUserProject::findOrFail($id);
       // dd($asignar);
        //$cortes = Periodo::where('sede_id', Auth::user()->sede_id)->orderBy('corte', 'DESC')->get();
        //$sedes= DB::table('Institutos')->orderby('id','ASC')->pluck('NombInstituto','id');

        //$sed = DB::table('sede')->orderby('NombSede','ASC')->pluck('NombSede','id_sede');
            $Proyecto = Proyecto::orderBy('id', 'ASC')->pluck('nombre_proyecto', 'id');


           $especialidades = DB::table('especialidades')
      ->orderBy('cod', 'ASC')->pluck('nombre', 'cod');


      $users = User::where('role_id', '=', 3)->where('sede_id', Auth::user()->sede_id)
      ->pluck('firstname', 'id');

     // dd($users);
       
        $cortes= DB::table('sc_periodos')->where('sede_id', Auth::user()->sede_id)
        //->leftJoin('sede', 'sc_periodos.sede_id', '=', 'sede.id_sede')
        
        ->orderBy('id', 'DESC')
        ->pluck('corte', 'id');
       

      //  dd($cortes);

        //$users = DB::table('users')->orderBy('firstname', 'DESC')->pluck('firstname','user_id');
     //   $proyecto = DB::table('proyectos')->orderBy('nombre_proyecto', 'DESC')->pluck('nombre_proyecto','sede_id');
        
        return view('projects.editAsignarProyect', compact('asignar','cortes','users','Proyecto'));
    }

     public function UpdateAsignar(Request $request, $id)
    {


      try {
            $data = $request->all();

         $id_user=Auth::user()->id;
               
     // dd($id_user);
            
              // foreach($pryect as  $idproyect) {
//
                  /* foreach($data['proyecto_id'] as $key => $idproyect) {

                $Datos=PivotUserProject::findOrFail($id);
                 $Datos->proyecto_id =  $idproyect;
                $Datos->user_id =  $data['user_id'];
                $Datos->sede_id = Auth::user()->sede_id;
               $Datos->periodo_id =  $data['corte_id'];
               $Datos->total_hours = '120';
               $Datos->finalized_at = $data['finalized_at'];
                $Datos->status =  '1';
                  $Datos->user_asignador_id =  $id_user;
           //  dd($Datos);
                $Datos->update();
             
                };*/
          //  };

                $Datos=PivotUserProject::findOrFail($id);
                 $Datos->proyecto_id =  $data['proyecto_id'];
                $Datos->user_id =  $data['user_id'];
                $Datos->sede_id = Auth::user()->sede_id;
               $Datos->periodo_id =  $data['periodo_id'];
               $Datos->total_hours = '120';
               $Datos->finalized_at = $data['finalized_at'];
                $Datos->status =  '1';
                  $Datos->user_asignador_id =  $id_user;
           //  dd($Datos);
                $Datos->update();
             
          
            
                    Alert::success(session('success', 'Actualizado con éxito!'));
               return redirect()->route('asignarproyect');
        
      
        } catch (\Exception $e) {
            // RETURN
            return response()->json(['error' => [
                'message' => $e->getMessage()
            ]], 422);
        }


    
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
        $data = $request->all();
        //$user = $request->user();
    // dd($data);
          
               // CREATE NEW PROYECTO TRANSACTION
            
                    $id_user=\Auth::user()->id;
                    
                   // INSERT DATA
                   $Datos=Proyecto::findOrFail($id);
                 //  $Datos->sede_id = Auth::user()->sede_id;
                 // $Datos->user_id =  $id_user;
                 // $Datos->autor =  $data['autor'];
                   //$Datos->especialidad_cod =  $data['especialidad_cod'];
                   $Datos->nombre_proyecto = $data['nombre_proyecto'];
                   $Datos->descripcion = $data['descripcion'];
                   $Datos-> linea_accion = $data['linea_accion'];
                       $Datos->fundamentacion = $data['fundamentacion'];
                       $Datos->proposito = $data['proposito'];
                       $Datos->competencia = $data['competencia'];
                       $Datos->metodologia = $data['metodologia'];
                   //dd($Datos);
                   $Datos->update();
   
               /*    $proyectoId = DB::table('proyectos')->insertGetId([ // GET INSERT ID FOR USER
                       'sede_id' => Auth::user()->sede_id,
                       'user_id' =>  $id_user,
                       'autor' =>  $data['autor'],
                       'nombre_proyecto' => $data['nombre_proyecto'],
                       'descripcion' => $data['descripcion'],
                       'linea_accion' => $data['linea_accion'],
                       'especialidad_cod' => $data['especialidad'],
                       'fundamentacion' => $data['fundamentacion'],
                       'proposito' => $data['proposito'],
                       'competencia' => $data['competencia'],
                       'metodologia' => $data['metodologia']
                   ]);*/
                   $referencia=Referencia::firstOrNew(['proyecto_id' => $id]);
                  // where('proyecto_id', '=', $id);
                   $referencia->referencia = $data['referencia'];
                   $referencia->update();
                   // ARRAY REFERENCIAS
                  // $counter_referencias = count($data['referencias']); // CANTIDAD DE TELEFONOS
                 //  dd($counter_referencias);

                /*   if($counter_referencias)
                   {   
                       $referencias = [];
                       for ($i = 0; $i < $counter_referencias; $i++) {
                           $referencia = [
                               'proyecto_id' => $Datos->id,
                               'referencia' => $data['referencias'][$i]
                           ];
   
                           // AGREGAR A LA LISTA
                           array_push($referencias, $referencia);
                       }
                       // INSERT DATA REFERENCIAS
                       DB::table('referencias')->insert($referencias);
                   }*/
                   
           
               if($Datos->update()) {
                Alert::success(session('success', 'Actualizado con éxito!'));
                return redirect()->route('proyect.index');
            }else{
                Alert::success(session('error', 'No se pudo continuar con el proceso de registro!'));
                return redirect()->route('proyect.index');
            }
                
   
         
       }
   
   



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
      abort_if(Gate::denies('proyecto_delete'), 403);

      $Datos=PivotUserProject::where('sc_user_proyecto.proyecto_id','=', $id)
      ->exists(); 

      if ($Datos == true) {
         Alert::error(session('error', 'El proyecto ya se encuentra asignado!'));
        return redirect()->route('proyect.index');
      }
     // dd($Datos);

        $proyect=Proyecto::findOrFail($id);
        // dd($id);
        $proyect->delete();
          Alert::success(session('success', 'Eliminado con éxito!'));
        return redirect()->route('proyect.index');


    }



   public function destroyAsignar($id)
    {

       // abort_if(Gate::denies('post_delete'), 403);
         $Datos=PivotUserProject::findOrFail($id);
       //  dd($Datos);
        $Datos->delete();
          Alert::success(session('success', 'Eliminado con éxito!'));
        return redirect()->route('asignarproyect');
    }




}
