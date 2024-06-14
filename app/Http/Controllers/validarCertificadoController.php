<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValiCertificadoRequest;
use DB;
use Carbon\Carbon;
use App\Models\numcertificados;
class validarCertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.NombInstituto')
        ->first();
        $sedeprincipal =  $institutosExtensiones->NombInstituto;


        $userCertificado = DB::table('numcertificados')
        ->where('numcertificados.sede_id', '=',\Auth::user()->sede_id)
        ->leftJoin('Institutos', 'numcertificados.sede_id', '=', 'Institutos.id')
        ->leftJoin('sc_prestadores', 'numcertificados.prestador_id', '=', 'sc_prestadores.id')
         ->leftJoin('especialidades', 'sc_prestadores.especialidad_cod', '=', 'especialidades.cod')
         ->leftJoin('proyectos', 'sc_prestadores.proyecto_id', '=', 'proyectos.id')
        ->select('numcertificados.id','numcertificados.Aprobado','numcertificados.created_at','sc_prestadores.ci','numcertificados.certificados','Institutos.NombInstituto','sc_prestadores.firstname',
            'sc_prestadores.middlename','sc_prestadores.primary_lastname','sc_prestadores.second_lastname',
        'especialidades.nombre','proyectos.nombre_proyecto')
        ->get();
      // dd($userCertificado);
        return view('certificados.create',compact('userCertificado','sedeprincipal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validarcertificado(Request $request)
    {
         $NotiUpdate = numcertificados::findOrFail($request->id); 


    if($request->Aprobado == 0)  {
        

  $NotiUpdate->Aprobado = "0";
 
    $NotiUpdate->update();
     $newStatus ='<td>  <label class="badge badge-danger">En_Espera</label></td>';
    }else{

 
        $NotiUpdate->Aprobado = "1";
 
    $NotiUpdate->update();
    $newStatus ='<td>  <label class="badge badge-success">Aprobado</label></td>';
    }


//Alert::success('Aprobado con Exito')->autoclose(3500);
    return response()->json(['var'=>''.$newStatus.'']);
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
