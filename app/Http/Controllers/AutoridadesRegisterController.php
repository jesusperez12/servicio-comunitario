<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Authority;
use Auth;
use Alert;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\AutoridadesRequest;
class AutoridadesRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         abort_if(Gate::denies('autoridades_index'), 403);

           $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.NombInstituto')
        ->first();
        $sedeprincipal =  $institutosExtensiones->NombInstituto;

         $autoidades = Authority::
         leftJoin('cargos', 'authorities.cargo_id', '=', 'cargos.id')
         ->leftJoin('Institutos', 'authorities.sede_id', '=', 'Institutos.id')
          ->select('authorities.id','Institutos.NombInstituto','cargos.cargo','authorities.autoridad')
         ->get();
        // dd($autoidades);
        return view('autoridades.index',compact('autoidades','sedeprincipal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         abort_if(Gate::denies('autoridades_create'), 403);
        $cargo = Cargo::orderBy('id', 'ASC')->pluck('cargo', 'id');
       $sedes = DB::table('Institutos')
        ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');
        return view('autoridades.create',compact('cargo','sedes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AutoridadesRequest $request)
    {

        $exiteperiodo=Authority::where('sede_id')
        ->where('cargo_id', '=', $request->input('cargo_id'))
->exists();
//dd($exiteperiodo);
if ($exiteperiodo==true) {
 Alert::error(session('error', 'Ya existe este cargo para esta sede!'));
                 return back();
                 }

         $Datos= new Authority(request()->all());
          $Datos->sede_id = $request->input('sede_id');
          $Datos->cargo_id = $request->input('cargo_id');
          $Datos->autoridad = $request->input('autoridad');
          $Datos->save();

             Alert::success(session('success', 'creado con éxito!'));
                return redirect()->route('Autoridades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('autoridades_show'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // dd($id);
         //abort_if(Gate::denies('autoidades_edit'), 403);
        $user = Authority::findOrFail($id);

        $cargo = Cargo::orderBy('id', 'ASC')->pluck('cargo', 'id');
         $sedes = DB::table('Institutos')
        ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');
         return view('autoridades.edit',compact('user','cargo','sedes')); 
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
       $user=Authority::findOrFail($id);
       $user->update($request->all());
     
        Alert::success(session('success', 'Actualizado con éxito!'));
                return redirect()->route('Autoridades.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         abort_if(Gate::denies('autoridades_destroy'), 403);
         $user  = Authority::find($id);
           
      $user->delete(); 
       Alert::success(session('success', 'Eliminado con éxito!'));
                return redirect()->route('Autoridades.index');
    
  
    }
}
