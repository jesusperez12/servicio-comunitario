<?php

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.delete');
  
  Route::get('get-Estado',[App\Http\Controllers\UserController::class,'getEstado'])->name('get-Estado');

    Route::get('get-Parroquias',[App\Http\Controllers\UserController::class,'getParroquias'])->name('get-Parroquias');


    Route::get('get-Municipios',[App\Http\Controllers\UserController::class,'getMunicipios'])->name('get-Municipios');



    Route::resource('posts', App\Http\Controllers\PostController::class);

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
   Route::resource('roles', App\Http\Controllers\RoleController::class);

 
   Route::resource('Periodo', App\Http\Controllers\PeriodosController::class);

    Route::resource('proyect', App\Http\Controllers\ProyectoController::class);


      Route::get('Asignar/Proyecto',[App\Http\Controllers\ProyectoController::class,'asignarproyect'])->name('asignarproyect');
     Route::put('/Asignar/Update/{id}', [App\Http\Controllers\ProyectoController::class, 'UpdateAsignar'])->name('asignarproyect.update');

     Route::delete('/Asignar/delete/{id}', [App\Http\Controllers\ProyectoController::class, 'destroyAsignar'])->name('asignarproyect.destroy');

   
     Route::POST('Proyecto/Asignar/store', [App\Http\Controllers\ProyectoController::class,'AsignarProyecStore'])->name('asignarStore');
    
     Route::get('Asignar/edit/{id}', [App\Http\Controllers\ProyectoController::class, 'editAsignaProyect'])->name('proyects.editAsignarProyect');
    
    Route::resource('asesorcomunity', App\Http\Controllers\AsesorComunidadController::class);
    Route::get('Estado',[App\Http\Controllers\AsesorComunidadController::class,'getEstado'])->name('Estado');

    Route::get('Parroquia',[App\Http\Controllers\AsesorComunidadController::class,'getParroquias'])->name('Parroquias');


    Route::get('Municipios',[App\Http\Controllers\AsesorComunidadController::class,'getMunicipios'])->name('Municipios');
     

    Route::resource('Prestadores', App\Http\Controllers\PrestadoresController::class);

    Route::get('getPrestador',[App\Http\Controllers\PrestadoresController::class,'getPrestadorByCi'])->name('getPrestador');

    Route::get('/search',[App\Http\Controllers\PrestadoresController::class,'search'])->name('prestador.search');
       Route::get('especialidad',[App\Http\Controllers\PrestadoresController::class,'getespecialidad'])->name('especialidad');
       // Route::get('prestadores',[App\Http\Controllers\PrestadoresController::class,'estudianteGET'])->name('prestadores_get');
   // Route::get('/prestadores{id}',[App\Http\Controllers\PrestadoresController::class,'Asignarprestador']);
   

       Route::resource('Actividades', App\Http\Controllers\ActividadesController::class);
       Route::get('get-prestadores',[App\Http\Controllers\ActividadesController::class,'getPrestadores'])->name('get-prestadores');

    Route::resource('Autoridades', App\Http\Controllers\AutoridadesRegisterController::class);

     Route::resource('Certificados', App\Http\Controllers\validarCertificadoController::class);
     Route::get('validarcertificado',[App\Http\Controllers\validarCertificadoController::class,'validarcertificado'])->name('validarcertificado');

});






Route::prefix('Estudiantes')->group(function(){ 


   Route::get('/login', [App\Http\Controllers\Auth\EstudiantesLoginController::class, 'showLoginForm'])->name('Estudiantes.login');

   Route::get('/listas', [App\Http\Controllers\Auth\EstudiantesLoginController::class, 'viewlistasOfertas'])->name('Estudiantes.lista');

    Route::post('/login', [App\Http\Controllers\Auth\EstudiantesLoginController::class, 'login'])->name('Estudiantes.login.submit');

    Route::get('/register/email', [App\Http\Controllers\Auth\EstudiantesLoginController::class, 'showemail'])->name('Estudiantes.email');
    Route::post('/close', [App\Http\Controllers\Auth\EstudiantesLoginController::class, 'close'])->name('close');

      Route::get('/register', [App\Http\Controllers\Auth\EstudiantesRegisterController::class, 'showRegistrationForm'])->name('Estudiantes.registrar');

      Route::post('/register', [App\Http\Controllers\Auth\EstudiantesRegisterController::class, 'register'])->name('Estudiantes.registrar');

      Route::get('/register/verify/{code}', [App\Http\Controllers\Auth\EstudiantesRegisterController::class, 'verify']);
 
      Route::get('/register/validate', [App\Http\Controllers\Auth\EstudiantesRegisterController::class, 'validatee'])->name('Estudiantes.validate');


      Route::post('/password/email', [App\Http\Controllers\Auth\EstudiantesForgotPasswordController::class, 'sendResetLinkEmail'])->name('Estudiantes.password.email');

      Route::get('/password/reset', [App\Http\Controllers\Auth\EstudiantesForgotPasswordController::class, 'showLinkRequestForm'])->name('Estudiantes.password.request');
  

       Route::post('/password/reset', [App\Http\Controllers\Auth\EstudiantesResetPasswordController::class, 'reset'])->name('Estudiantes.password.request');
        Route::get('/password/reset', [App\Http\Controllers\Auth\EstudiantesResetPasswordController::class, 'showResetForm'])->name('Estudiantes.password.reset');
  
 
        Route::resource('Estudiante', App\Http\Controllers\ReportePrestadoresController::class);
        Route::get('/certificate',[App\Http\Controllers\ReportePrestadoresController::class,'getCertificate'])->name('Estudiante.certificate');


        


  });



