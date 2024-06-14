<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AsesorComunityRequest;
use App\Models\Asesor;
use App\Models\Comunidad;
use Illuminate\Support\Facades\Gate;
use DB;
use App\Models\State;
use App\Models\Province;
use App\Models\Authority;
use App\Models\Localidad;
use App\Models\Phone;
use Auth;
use Alert;
class AsesorComunidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function getEstado(Request $request){

        $estado = Estado::where('Pais_id',$request->valor)->get();
       
        //dd($Municipio);
           //$estado = Estado::find($request->valor);
          // $parroquia= Parroquias::has('parroquia')->get();
           return response()->json($states);
       }
   
       
       public function getMunicipios(Request $request){
   
        $Municipio = Province::where('state_id',$request->valor)->get();
        //dd($Municipio);
           //$estado = Estado::find($request->valor);
          // $parroquia= Parroquias::has('parroquia')->get();
           return response()->json($Municipio);
       }
   
       
       public function getParroquias(Request $request){
       $parroquias = Localidad::where('province_id',$request->valor)->get();
           
   
           return response()->json($parroquias);
       
   
       }


    public function index()
    {

         abort_if(Gate::denies('asesorcomunita_index'), 403);


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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('asesorcomunita_create'), 403);
         $area_codes = DB::table('codes')->get();
        // GET STATES
        $states = State::orderBy('state', 'ASC')->get();
       return view('asesorComunity.create', compact('states','area_codes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AsesorComunityRequest $request)
    {
       // $data = $request->all();
       $proyecto = DB::table('sc_user_proyecto')
       ->select('proyecto_id','periodo_id','user_id')
       ->where('user_id', Auth::user()->id)
       ->first();
     //
    //dd($proyecto);

if ($proyecto == null ) {
   Alert::error(session('error', 'usuario sin proyecto asignado!'));
    return redirect()->route('asesorcomunity.index');
}

          
           // dd($data);

            // INSERT COMUNIDAD
            try {

                $Datos= new Asesor(request()->all());
                $Datos->sede_id = Auth::user()->sede_id;
               $Datos->ci =   $request->input('ci');
                $Datos->firstname =  $request->input('firstname');
                $Datos->middlename =  ($request->input('middlename') != '') ? $request->input('middlename') : null;
                $Datos->primary_lastname =  $request->input('primary_lastname');
                $Datos->second_lastname =   ($request->input('second_lastname') != '') ? $request->input('second_lastname') : null;
                //dd($Datos);
                $Datos->save();


                $comunity= new Comunidad(request()->all());
                $comunity->sede_id = Auth::user()->sede_id;
                $comunity->sc_user_proyecto_id =  $proyecto->user_id;
                $comunity->user_id =   Auth::id();
                $comunity->asesor_id =   $Datos->id;
                $comunity->proyecto_id =   $proyecto->proyecto_id;
                $comunity->sc_periodo_id =  $proyecto->periodo_id;
                $comunity->direccion = $request->input('direccion');
                $comunity->nombre =  $request->input('comunidad');
                $comunity->sector = ($request->input('sector') != '') ? $request->input('sector') : null;
                $comunity->localidad = $request->input('locality');
                $comunity->provincia = $request->input('province');
                $comunity->state = $request->input('state');
                $comunity->lugar_prestadores = ($request->input('lugar_prestadores') != '') ? $request->input('lugar_prestadores') : null;
                $comunity->direccion_lugar = ($request->input('direccion_lugar') != '') ? $request->input('direccion_lugar') : null;
                $comunity->save();




                // ARRAY PHONES
                $counter_phones = count($request->input('codes')); // CANTIDAD DE TELEFONOS
                if($counter_phones)
                {   
                    $phones = [];
                    for ($i = 0; $i < $counter_phones; $i++) { 
                        $phone = [
                            'user_id' => null,
                            'sc_asesor_id' => $Datos->id,
                            'code_id' => $request->input('codes')[$i],
                            'number' => $request->input('phones')[$i]
                        ];

                        // AGREGAR A LA LISTA
                        array_push($phones, $phone);
                    }
                    // INSERT DATA PHONES
                    DB::table('phones')->insert($phones);
                }
                Alert::success(session('success', 'Creado con éxito!'));
                  return redirect()->route('asesorcomunity.index');

            } catch (Exception $e) {
                return response()->json(['error' => $e]);
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
        abort_if(Gate::denies('asesorcomunita_show'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       abort_if(Gate::denies('asesorcomunita_edit'), 403);

       $asesor = Asesor::findOrFail($id);


       $comunidad = Comunidad::where('sc_comunidades.asesor_id','=',$id);
 
       $comunityy = Comunidad::where('sc_comunidades.asesor_id', '=', $id)
      // ->leftJoin('states', 'sc_comunidades.state', '=', 'states.id')
       ->leftJoin('localities', 'sc_comunidades.localidad', '=', 'localities.id')
        ->leftJoin('provinces', 'sc_comunidades.provincia', '=', 'provinces.id')
       ->first();
 //dd($comunityy);

       $EstadoID=$comunityy->state;
       $muniID=$comunityy->provincia;
//dd($muniID);
       $states = State::orderBy('id', 'ASC')->get();

       $municipio =DB::table('sc_comunidades')
         ->leftJoin('provinces', 'sc_comunidades.provincia', '=', 'provinces.id')
         ->where('provinces.state_id', '=', $EstadoID)
         ->where('sc_comunidades.asesor_id', '=', $id)
         ->orderBy('province','ASC')->pluck('province','provinces.id'); 

          $parroquia =DB::table('sc_comunidades')
         ->leftJoin('localities', 'sc_comunidades.localidad', '=', 'localities.id')
         ->where('localities.province_id', '=', $muniID)
         ->where('sc_comunidades.asesor_id', '=', $id)
         ->orderBy('locality','ASC')->pluck('locality','localities.id'); 

       //dd($municipio);

        return view('asesorComunity.edit', compact('asesor','states','comunityy','municipio','parroquia'));
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
        $proyecto = DB::table('sc_user_proyecto')
       ->select('proyecto_id','periodo_id','user_id')
       ->where('user_id', Auth::user()->id)
       ->first();
    //dd($proyecto);



          
           // dd($data);

            // INSERT COMUNIDAD
            try {


                $Datos= Asesor::findOrFail($id);
                $Datos->sede_id = Auth::user()->sede_id;
               $Datos->ci =   $request->input('ci');
                $Datos->firstname =  $request->input('firstname');
                $Datos->middlename =  ($request->input('middlename') != '') ? $request->input('middlename') : null;
                $Datos->primary_lastname =  $request->input('primary_lastname');
                $Datos->second_lastname =   ($request->input('second_lastname') != '') ? $request->input('second_lastname') : null;
             //   dd($Datos);
                $Datos->update();




         $comunity= Comunidad::where('asesor_id', $Datos->id)->first();
                $comunity->sede_id = Auth::user()->sede_id;
               $comunity->sc_user_proyecto_id =  $proyecto->user_id;
               $comunity->user_id =   Auth::id();
                $comunity->proyecto_id =   $proyecto->proyecto_id;
                $comunity->sc_periodo_id =  $proyecto->periodo_id;
                $comunity->direccion = $request->input('direccion');
                $comunity->nombre =  $request->input('comunidad');
                $comunity->sector = ($request->input('sector') != '') ? $request->input('sector') : null;
                $comunity->localidad = ($request->input('locality') != '') ? $request->input('locality') : null;
                $comunity->provincia =  ($request->input('province') != '') ? $request->input('province') : null;
                $comunity->state = $request->input('state');
                $comunity->lugar_prestadores = ($request->input('lugar_prestadores') != '') ? $request->input('lugar_prestadores') : null;
                $comunity->direccion_lugar = ($request->input('direccion_lugar') != '') ? $request->input('direccion_lugar') : null;
                $comunity->update();




                /*   $phone= Phone::where('sc_asesor_id', $Datos->id)->first();
                $phone->sc_asesor_id = $Datos->id;
               $phone->code_id =   $request->input('codes');
                $phone->number =   $request->input('phones');
              
                $phone->update();
*/
          
                Alert::success(session('success', 'actualizado con éxito!'));
                return redirect()->route('asesorcomunity.index');

            } catch (Exception $e) {
                return response()->json(['error' => $e]);
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
       abort_if(Gate::denies('asesorcomunita_destroy'), 403);
    }
}
