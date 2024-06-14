<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use App\Models\Sede;
use App\Models\Cargo;
use App\Models\State;
use App\Models\Province;
use App\Models\Authority;
use App\Models\Prestador;
use App\Models\Localidad;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use DB;
use DateTime;
use Auth;
use Alert;
class UserController extends Controller
{

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
       $id_user=\Auth::user()->id;
       $pre=@Auth::user()->hasRole('SuperAdmin');

          $institutosExtensiones = DB::table('Institutos')->where('id', '=', \Auth::user()->sede_id)
         ->select('Institutos.NombInstituto')
        ->first();
        $sedeprincipal =  $institutosExtensiones->NombInstituto;
//dd($pre);
       
         if(@Auth::user()->hasRole('SuperAdmin')) {
            abort_if(Gate::denies('user_index'), 403);
        $users = User::paginate(5);
        return view('users.index', compact('users','sedeprincipal'));
        }
        elseif(@Auth::user()->hasRole('Coordinador_Institucional')){
            abort_if(Gate::denies('user_index'), 403);
            
        $users = User::where('instituto_id_creador', '=',\Auth::user()->sede_id    )->paginate(5);
        return view('users.index', compact('users','sedeprincipal'));
        }elseif(@Auth::user()->hasRole('Coordinador_Nacional')){
        
        $users = User::paginate(5);
        return view('users.index', compact('users','sedeprincipal'));
        }
        
       
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), 403);

        if (@Auth::user()->hasRole('Coordinador_Institucional')) {
            $roles = Role::all()
           ->where('id', '=', 3)
            ->pluck('name', 'id');


         $states = State::orderBy('state', 'ASC')->get();
         $area_codes = DB::table('codes')->get(); 

          $sedes = DB::table('Institutos')
          ->where('Institutos.sede_id', '=', \Auth::user()->sede_id)
        ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');

   


        $especialidades = DB::table('especialidades')
        ->orderBy('cod', 'ASC')->pluck('nombre', 'cod');
       /* $especialidades = DB::table('especialidades')
        ->select(['cod', DB::raw('nombre as nombre')])
        ->get();*/
        return view('users.create', compact('roles','states','area_codes','sedes','especialidades'));
        }

        $roles = Role::all()->pluck('name', 'id');
         $states = State::orderBy('state', 'ASC')->get();
         $area_codes = DB::table('codes')->get(); 

          $sedes = DB::table('Institutos')
        ->orderBy('id', 'ASC')->pluck('NombInstituto', 'id');

   


        $especialidades = DB::table('especialidades')
        ->orderBy('cod', 'ASC')->pluck('nombre', 'cod');
       /* $especialidades = DB::table('especialidades')
        ->select(['cod', DB::raw('nombre as nombre')])
        ->get();*/
        return view('users.create', compact('roles','states','area_codes','sedes','especialidades'));
    }



    public function store(UserCreateRequest $request)
    {
        // $request->validate([
        //     'name' => 'required|min:3|max:5',
        //     'username' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required'
        // ]);

        // REQUEST DATA
        $data = $request->all();
        $user = $request->user();


//dd($data);
        // VALIDATION DATA
      /*  if ($user->isAdmin()) {
            if ($user->getRoleById($data['role_id']) == 'coordinador') {
                $validator = Validator::make($data, [
                    'role_id' => 'bail|required|numeric|unique:users,role_id,NULL,id,sede_id,' . $data->sede_id,
                    'ci' => 'bail|required|numeric|unique:users,ci',
                    'email' => 'bail|required|string||unique:users,email',
                    'phones.*' => 'bail|required|numeric|digits:7|unique:phones,number'
                ], [
                    'ci.unique' => 'La cédula de identidad ya se encuentra en uso.<br><br>',
                    'role_id.unique' => 'Sólo puede haber un coordinador por sede.<br><br>',
                    'email.unique' => 'El email ya se encuentra registrado.<br><br>',
                    'phones.*.unique' => 'El/los teléfono(s) ya se encuentra registrado.<br><br>'
                ]);
            } else {
                $validator = Validator::make($data, [
                    'ci' => 'bail|required|numeric|unique:users,ci',
                    'email' => 'bail|required|string||unique:users,email',
                    'phones.*' => 'bail|required|numeric|digits:7|unique:phones,number'
                ], [
                    'ci.unique' => 'La cédula de identidad ya se encuentra en uso.<br><br>',
                    'email.unique' => 'El email ya se encuentra registrado.<br><br>',
                    'phones.*.unique' => 'El/los teléfono(s) ya se encuentra registrado.<br><br>'
                ]);
            }
        } else {
            $validator = Validator::make($data, [
                'ci' => 'bail|required|numeric|unique:users,ci',
                'email' => 'bail|required|string||unique:users,email',
                'phones.*' => 'bail|required|numeric|digits:7|unique:phones,number'
            ], [
                'ci.unique' => 'La cédula de identidad ya se encuentra en uso.<br><br>',
                'email.unique' => 'El email ya se encuentra registrado.<br><br>',
                'phones.*.unique' => 'El/los teléfono(s) ya se encuentra registrado.<br><br>'
            ]);
        }

        if ($validator->fails()) {
            // RETURN
            return response()->json(['errors' => $validator->errors()], 422);
        }*/

    
                   if($data['date_birth'] != '') {
                    $date_birth = date_format(new DateTime(str_replace("/", "-", $data['date_birth'])), "Y-m-d");
                }
                             $Datos= new User(request()->all());
                             $Datos->sede_id = $data['sede_id'];
                             $Datos->role_id = $data['role_id'];
                             $Datos->ci = $data['ci'];
                             $Datos->firstname = $data['firstname'];
                             $Datos->middlename = ($data['middlename'] != '') ? $data['middlename'] : null;
                             $Datos->primary_lastname = $data['primary_lastname'];
                             $Datos->second_lastname = ($data['second_lastname'] != '') ? $data['second_lastname'] : null;
                             $Datos->gender = $data['gender'];
                             $Datos->address = $data['address'];
                             $Datos->locality = $data['locality'];
                             $Datos->province = $data['province'];
                             $Datos ->state = $data['state'];
                             $Datos->date_birth = (isset($date_birth)) ? $date_birth : null;
                             $Datos->email = strtolower($data['email']);
                            // $Datos->especialidad_cod = ($data['speciality'] != '') ? $data['speciality'] : null;
                             $Datos->password = bcrypt($data['password']);
                             $Datos->status = $data['status'];
                             $Datos->parent = 0;
                              $Datos->suspender = 1;
                             $Datos->instituto_id_creador = \Auth::user()->sede_id;
                              $Datos->save();
                              //dd($Datos);

                               $roles = $data['role_id'];
                              // dd($roles);
                            $Datos->syncRoles($roles);

                      // $Datos->roles()->sync($data['roles']);

             //  $userId->syncRoles($data['role_id']);
                // ARRAY PHONES
                $counter_phones = count($data['codes']); // CANTIDAD DE TELEFONOS
                if($counter_phones)
                {   
                    $phones = [];
                    for ($i = 0; $i < $counter_phones; $i++) { 
                        $phone = [
                            'user_id' => $Datos->id,
                            'sc_asesor_id' => null,
                            'code_id' => $data['codes'][$i],
                            'number' => $data['phones'][$i]
                        ];

                        // AGREGAR A LA LISTA
                        array_push($phones, $phone);
                    }
                    // INSERT DATA PHONES
                    DB::table('phones')->insert($phones);
                }
         

            // RETURN
            Alert::success(session('success', 'Creado con éxito!'));
            return redirect()->route('users.index');

    }
       /* $user = User::create($request->only('name', 'username', 'email')
            + [
                'password' => bcrypt($request->input('password')),
            ]);

        $roles = $request->input('roles', []);
        $user->syncRoles($roles);*/
    

    public function show(User $user)
    {
         $idusershow=$user->id;
        abort_if(Gate::denies('user_show'), 403);
         $user = User::leftJoin('Institutos', 'users.sede_id', '=', 'Institutos.id')
       ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
       ->where('users.id', '=',$idusershow)
      ->select('Institutos.NombInstituto','roles.name','users.firstname','users.firstname','users.middlename','users.date_birth','users.id'
        ,'users.email','users.created_at','users.ci','users.address','users.primary_lastname'
        ,'users.second_lastname','users.second_lastname','users.especialidad_cod','users.gender')
      ->first();
     //dd($user);
    
      $especialidadCOD=$user->especialidad_cod;
     $espec = Especialidad::where('cod', $especialidadCOD)
     ->first();

      $iphone = DB::table('phones')->where('user_id', $idusershow)
       ->leftJoin('codes', 'phones.code_id', '=', 'codes.id')
     ->first();
       // $user->load('roles','sede');
      //  dd($espec);
        return view('users.show', compact('user','espec','iphone'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), 403);
        $roles = Role::all()->pluck('name', 'id');
        $user->load('roles');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserEditRequest $request, User $user)
    {
        // $user=User::findOrFail($id);
        $data = $request->only('firstname', 'username', 'email');
        $password=$request->input('password');
        if($password)
            $data['password'] = bcrypt($password);
        // if(trim($request->password)=='')
        // {
        //     $data=$request->except('password');
        // }
        // else{
        //     $data=$request->all();
        //     $data['password']=bcrypt($request->password);
        // }

        $user->update($data);

        $roles = $request->input('roles', []);
        $user->syncRoles($roles);
        return redirect()->route('users.index', $user->id)->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_destroy'), 403);

        if (auth()->user()->id == $user->id) {
            return redirect()->route('users.index');
        }

        $user->delete();
        return back()->with('succes', 'Usuario eliminado correctamente');
    }
}
