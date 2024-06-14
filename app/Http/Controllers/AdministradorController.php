<?php

namespace App\Http\Controllers;

use Gate;
use App\Models\Sede;
use App\Models\Cargo;
use App\Models\State;
use App\Models\Province;
use App\Models\Authority;
use App\Models\Prestador;
use App\Models\Localidad;
use App\Models\Estudiante;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreProvidersRequest;
use App\Http\Requests\UpdateProvidersRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use DateTime;
use Auth;
use Validator;

class AdministradorController extends Controller
{
    /**
     * Show the application dashboard for administrador and coordinador.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        if(Auth::user()->hasRole() == 'profesor') {
            return redirect('/admin/profesor/service/projects');
        }else if(Auth::user()->hasRole() == 'coordinador'){
            return redirect('/admin/users');
        }else{
            return redirect('/admin/users');
        }
        return view('admin.home');
    }

    /**
     * LISTADO DE USUARIOS
     * Request type GET
     * @return View
     */
    public function users(Request $request)
    {
        // GET AREA CODES
        $area_codes = DB::table('codes')->get(); 
        // GET STATES
        $states = State::orderBy('state', 'ASC')->get();
        // ESPECIALIDADES
        $especialidades = DB::table('especialidades')
        ->select(['cod', DB::raw('nombre as nombre')])
        ->get();
        // GET ROLES
        //$roles = \App\Models\Role::where('sede_id', Auth::user()->sede_id)->get();
        // GET SEDES
        $sedes = DB::table('Institutos')
        ->orderBy('id', 'ASC')->get();

        return view('users.index', [
            'link_active' => url()->current(),
            'localities' => [],
            'states' => $states,
            'area_codes' => $area_codes,
            'especialidades' => $especialidades,
           // 'roles' => $roles,
            'sedes' => $sedes,
        ]);
    }

    public function getProvinceByLocality($locality)
    {
        // GET PROVINCES 
        $localities = DB::table('localities as p')
        ->select(['p.id', 'p.province_id', DB::raw('p.locality as locality')])
        ->where('p.province_id', '=', DB::raw($locality))
        ->orderBy('locality', 'ASC')
        ->get();
        $localities_formated = [];
        foreach($localities as $locality) {
            array_push($localities_formated, ['id' => $locality->locality, 'text' => $locality->locality]);
        }
        
        return response()->json(['data' => $localities_formated]);        
    }

    public function getProvinces($state) 
    {
        $provinces = Province::where('state_id', $state)->orderBy('province', 'ASC')->get();
        $province_formated = [];
        foreach($provinces as $province) {
            array_push($province_formated, ['id' => $province->province, 'text' => $province->province, 'dataId' => $province->id]);
        }

        return response()->json(['data' => $province_formated]);
    }

    public function getLocalities($province) 
    {
        $localities = Localidad::where('province_id', $province)->orderBy('locality', 'ASC')->get();
        $localities_formated = [];
        foreach($localities as $locality) {
            array_push($localities_formated, ['id' => $locality->locality, 'text' => $locality->locality]);
        }

        return response()->json(['data' => $localities_formated]);
    }

    /**
     * GET ALL USERS
     * Request type GET
     * @return Response JSON
     */
    public function getUsers()
    {
        // User Authenticated
        $user = Auth::user();
        // Get users for user authenticated
        if($user->isAdmin()) {
            $users = \App\User::with('role', 'sede', 'phones.code')->where('sede_id', $user->sede_id)->get();

            foreach($users as $user) {
                $especialidad = \App\Especialidad::find($user->especialidad_cod);

                // Set especialidad to user
                if(!is_null($especialidad)) {
                    $user->especialidad = $especialidad->nombre;
                }
            }
        }else{
            $users = \App\User::with('role','sede','phones.code')->where('parent', $user->id)->get();
            foreach($users as $user) {
                $especialidad = \App\Especialidad::find($user->especialidad_cod);

                // Set especialidad to user
                if(!is_null($especialidad)) {
                    $user->especialidad = $especialidad->nombre;
                }
            }
        }

        return response()->json(['data' => $users]);
    }
    
    public function getUsersHistory()
    {
        // User Authenticated
        $user = Auth::user();
        // Get users for user authenticated
        if($user->isAdmin()) {
            $users = \App\User::with('role', 'sede', 'phones.code')->where('sede_id', $user->sede_id)->get();

            foreach($users as $user) {
                $especialidad = \App\Especialidad::find($user->especialidad_cod);

                // Set especialidad to user
                if(!is_null($especialidad)) {
                    $user->especialidad = $especialidad->nombre;
                }
            }
        }else{
            $users = \App\User::onlyTrashed()->where('parent', $user->id)->get()->load('role','sede','phones.code');
            foreach($users as $user) {
                $especialidad = \App\Especialidad::find($user->especialidad_cod);

                // Set especialidad to user
                if(!is_null($especialidad)) {
                    $user->especialidad = $especialidad->nombre;
                }
            }
        }

        return response()->json(['data' => $users]);
    }

    public function getUserById($id)
    {
        $user = \App\User::where('id', $id)->where('sede_id', Auth::user()->sede_id)->first();
        if (!empty($user)) {
            // Especialidad
            $especialidad = \App\Especialidad::find($user->especialidad_cod);
            if(!is_null($especialidad)) {
                $user->especialidad = $especialidad->nombre;
            }
        } else {
            $user = \App\User::where('id', $id)->where('sede_id', Auth::user()->sede_id)->onlyTrashed()->first();
            // Especialidad
            $especialidad = \App\Especialidad::find($user->especialidad_cod);
            if(!is_null($especialidad)) {
                $user->especialidad = $especialidad->nombre;
            }
        }

        // SET PROYECTOS A USUARIO
        $user->proyectos;

        return response()->json(['data' => $user]);
    }

    public function editUser($id)
    {
        $user = \App\User::where('id',$id)->where('sede_id', Auth::user()->sede_id)->first()->load('phones.code');
        return response()->json([
            'data' => $user
        ]);
    }

    public function updateUser(Request $request) 
    {
        $user_logged = Auth::user(); 
        $data = $request->all();
        // VALIDATION DATA
        if ($user_logged->isAdmin()) {
            if ($user_logged->getRoleById($data['role_id']) == 'coordinador') {
                $validator = Validator::make($data, [
                    'role_id' => 'bail|required|numeric|unique:users,role_id,'. $data['user_id'] .',id,sede_id,' . $user_logged->sede_id,
                    'ci' => 'bail|required|numeric|unique:users,ci,'. $data['user_id'],
                    'email' => 'bail|required|string||unique:users,email,'. $data['user_id'],
                ], [
                    'ci.unique' => 'La cédula de identidad ya se encuentra en uso.<br><br>',
                    'role_id.unique' => 'Sólo puede haber un coordinador por sede.<br><br>',
                    'email.unique' => 'El email ya se encuentra registrado.<br><br>',
                ]);
            } else {
                // dd($data);
                $validator = Validator::make($data, [
                    'ci' => 'bail|required|numeric|unique:users,ci,'. $data['user_id'],
                    'email' => 'bail|required|string||unique:users,email,'. $data['user_id'],
                ], [
                    'ci.unique' => 'La cédula de identidad ya se encuentra en uso.<br><br>',
                    'email.unique' => 'El email ya se encuentra registrado.<br><br>',
                ]);
            }
        } else {
            // dd($data);
            $validator = Validator::make($data, [
                'ci' => 'bail|required|numeric|unique:users,ci,'. $data['user_id'],
                'email' => 'bail|required|string||unique:users,email,'. $data['user_id'],
            ], [
                'ci.unique' => 'La cédula de identidad ya se encuentra en uso.<br><br>',
                'email.unique' => 'El email ya se encuentra registrado.<br><br>',
            ]);
        }

        if ($validator->fails()) {
            // RETURN
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if($user_logged->isAdmin()) {
            $user = \App\User::where('id', $request->input('user_id'))/*->where('sede_id', $user_logged->sede_id)*/->first();
           // dd($user);
            // UPDATE USER
            if($request->input('date_birth') != '') {
                $date_birth = date_format(new DateTime(str_replace("/", "-", $request->input('date_birth'))), "Y-m-d");
            }
            $user->sede_id = $request->input('sede_id');
            $user->role_id = $request->input('role_id');
            $user->ci = $request->input('ci');
            $user->firstname = $request->input('firstname');
            $user->middlename = ($request->input('middlename') != '') ? $request->input('middlename') : null;
            $user->primary_lastname = $request->input('primary_lastname');
            $user->second_lastname = ($request->input('second_lastname') != '') ? $request->input('second_lastname') : null;
            $user->gender = $request->input('gender');
            $user->address = $request->input('address');
            $user->locality = $request->input('locality');
            $user->province = $request->input('province');
            $user->state = $request->input('state');
            $user->date_birth = (isset($date_birth)) ? $date_birth : null;
            $user->email = strtolower($request->input('email'));
            $user->especialidad_cod = ($request->input('speciality') != '') ? $request->input('speciality') : null;
            if($request->input('password') != '') {
                $user->password = bcrypt($request->input('password'));
            }
            $user->status = $request->input('status');
            $user->updated_at = date("Y-m-d H:i:s");
        } else {
            $user = \App\User::where('id', $request->input('user_id'))->where('sede_id', $user_logged->sede_id)->first();
            // UPDATE USER
            if($request->input('date_birth') != '') {
                $date_birth = date_format(new DateTime(str_replace("/", "-", $request->input('date_birth'))), "Y-m-d");
            }
            $user->ci = $request->input('ci');
            $user->firstname = $request->input('firstname');
            $user->middlename = ($request->input('middlename') != '') ? $request->input('middlename') : null;
            $user->primary_lastname = $request->input('primary_lastname');
            $user->second_lastname = ($request->input('second_lastname') != '') ? $request->input('second_lastname') : null;
            $user->gender = $request->input('gender');
            $user->address = $request->input('address');
            $user->locality = $request->input('locality');
            $user->province = $request->input('province');
            $user->state = $request->input('state');
            $user->date_birth = (isset($date_birth)) ? $date_birth : null;
            $user->email = strtolower($request->input('email'));
            $user->especialidad_cod = ($request->input('speciality') != '') ? $request->input('speciality') : null;
            if($request->input('password') != '') {
                $user->password = bcrypt($request->input('password'));
            }
            $user->status = $request->input('status');
            $user->parent = $user_logged->id;
            $user->updated_at = date("Y-m-d H:i:s");
        }

        // Save phones
        $data = $request->only(['phones_id', 'codes', 'phones']);
        $counter_phones = count($data['codes']); // CANTIDAD DE TELEFONOS
        if($counter_phones)
        {   
            $phones = [];
            for ($i = 0; $i < $counter_phones; $i++) { 
                $phone = [
                    'id' => $data['phones_id'][$i],
                    'user_id' => $request->input('user_id'),
                    'sc_asesor_id' => null,
                    'code_id' => $data['codes'][$i],
                    'number' => $data['phones'][$i]
                ];

                // AGREGAR A LA LISTA
                array_push($phones, $phone);
            }
            
            // SINCRONIZANDO PHONES
            foreach($phones as $the_phone) {
                if($the_phone['id'] != '') {
                    \App\Phone::where('id', $the_phone['id'])->update([
                        'user_id' => $the_phone['user_id'],
                        'code_id' => $the_phone['code_id'],
                        'number' => $the_phone['number'],
                    ]);
                }else{
                    $newPhone = new \App\Phone;
                    $newPhone->user_id = $the_phone['user_id'];
                    $newPhone->code_id = $the_phone['code_id'];
                    $newPhone->number = $the_phone['number'];

                    $newPhone->save();
                }
            }
        }

        if($user->save()) {
            return response()->json(['response' => 'ok']);
        }else{
            return response()->json(['response' => 'error']);
        }
    }

    public function deleteUserPhone($id) 
    {
        if($id) {
            $phone = \App\Phone::find($id);
            if($phone->delete()) {
                return response()->json(['response' => 'ok']);
            }else{
                return response()->json(['response' => 'error']);
            }
        }
    }

    public function deleteUser($id)
    {
        if($id) {
            
            $user = \App\User::where('id', $id)->where('sede_id', Auth::user()->sede_id)->first();

            if (count($user->proyectos) == 0) {
                if($user->forceDelete()) {
                    return response()->json(['response' => 'ok']);
                }else{
                    return response()->json(['error' => [
                        'message' => 'Ha ocurrido un fallo al intentar eliminar el usuario.'
                    ]], 422);
                }
            } else {
                // RETURN
                return response()->json(['error' => [
                    'message' => '<b>Disculpe!</b> el usuario que intenta eliminar posee registros de servicio comunitario.'
                ]], 422);
            }
        }
    }

    public function suspendUser($id)
    {
        if($id) {
            $user = \App\User::where('id', $id)->where('sede_id', Auth::user()->sede_id)->first();
            if($user->update(['status'=> 2])) {
                return response()->json(['response' => 'ok']);
            }else{
                return response()->json(['response' => 'error']);
            }
        }
    }

    public function archiveUser($id)
    {
        if($id) {
            $user = \App\User::where('id', $id)->where('sede_id', Auth::user()->sede_id)->first();
            if($user->delete()) {
                return response()->json(['response' => 'ok']);
            }else{
                return response()->json(['response' => 'error']);
            }
        }
    }

    public function activeUser($id)
    {
        if($id) {
            $user = \App\User::where('id', $id)->where('sede_id', Auth::user()->sede_id)->first();
            if($user->update(['status'=> 0])) {
                return response()->json(['response' => 'ok']);
            }else{
                return response()->json(['response' => 'error']);
            }
        }
    }

    public function restoreUser($id)
    {
        if($id) {
            $user = \App\User::onlyTrashed()->where('id', $id)->where('sede_id', Auth::user()->sede_id)->first();
            if($user->restore()) {
                return response()->json(['response' => 'ok']);
            }else{
                return response()->json(['response' => 'error']);
            }
        }
    }

    /**
     * SHOW FORM ADD USERS
     *
     * @return view
     */
    public function showRegisterForm()
    {
        // GET AREA CODES
        $area_codes = DB::table('codes')->get();
        // GET STATES
        $states = State::orderBy('state', 'ASC')->get();
        // GET ROLES
        $roles = DB::table('roles')
        ->select(['id', DB::raw('role as role'), 'role_slug', 'description'])
        ->where('sede_id', Auth::user()->sede_id)
        ->get();
        // GET SEDES
         $sedes = DB::table('Institutos')
            ->orderBy('id', 'ASC')->get();
        
        //$sedes = Sede::orderBy('cod_sede', 'ASC')->get();
        // ESPECIALIDADES
        $especialidades = DB::table('especialidades')->get();

        return view('admin.users.add', [
            "states" => $states,
            "roles" => $roles,
            "sedes" => $sedes,
            "area_codes" => $area_codes,
            "especialidades" => $especialidades,
            "link_active" => url()->current()
        ]);
    }

    public function getAuthorities()
    {
        $cargos = Cargo::with(['autoridad' => function ($q0) {
            $q0->where('sede_id', Auth::user()->sede_id);
        }])->get();

        return view('admin.authorities.index', [
            'link_active' => url()->current(),
            'cargos' => $cargos
        ]);
    }

    public function saveAuthority(Request $request) 
    {
        $data = $request->all();

        $this->validate($request, [
            'nombre_autoridad' => 'bail|required|string'
        ]);

        if ($data['autoridad_id'] != "") {
            $autoridad = Authority::where('id',$data['autoridad_id'])->where('sede_id', Auth::user()->sede_id)->first();
            $autoridad->autoridad = $data['nombre_autoridad'];
            if ($autoridad->save()) {
                return response()->json(['response' => 'ok', 'authority' => $autoridad]);
            }
        } else {
            try {
                $autoridad = Authority::create([
                    'sede_id' => Auth::user()->sede_id,
                    'cargo_id' => $data['cargo_id'],
                    'autoridad' => $data['nombre_autoridad'],
                ]);

                return response()->json(['response' => 'ok', 'authority' => $autoridad]);

            } catch (\Exception $e) {

                return response()->json(['errors' => ['message' => $e]]);

            }
        }
    }

    public function showCertificateValidate()
    {
        return view('admin.validate.validate', [
            'link_active' => url()->current()
        ]);
    }

    public function certificateValidate(Request $request)
    {
        $data = $request->all();
        $prestador = Prestador::where('ci', $data['ci'])->first();
        // VERIFICANDO
        if (!empty($prestador)) {
            $code = $data['certificate_code'];
            // BUILDING CODE
            $codeRetail = 'SC120-' . $prestador->sede->cod_sede . $prestador->grupo->grupo . $prestador->id . $prestador->periodo->corte;
            $prestador->proyecto = $prestador->proyecto()->with('bundlePivot')->first();
            $prestador->code = $codeRetail;
            // COMPARE
            if ($code == $codeRetail) {
                // RETURN
                return response()->json(['response' => 'ok', 'data' => $prestador]);
            } else {
                // RETURN
                return response()->json(['error' => [
                    'message1' => "El código <b>$code</b> no coincide con nuestros registros. Por favor, verifíquelo.",
                    'message2' => "Es prestador <b>$prestador->firstname $prestador->primary_lastname</b> no posee un certificado con Nº de registro: <b>$code</b>.",
                ]], 422);
            }
        } else {
            // RETURN
            return response()->json(['error' => [
                'message2' => "Es prestador de servicio no existe.",
            ]], 422);
        }
    }
}
