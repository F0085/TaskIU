<?php

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
header("Access-Control-Allow-Origin: *");

Route::get('/', function () {
    return redirect('login');
});

Route::get('Calendario', function () {
    return view('Calendario.Calendario');
});


//######################GESTIÓN ADMINISTRATIVA#######################

	Route::get('/Administracion', 'GestionAdministrativaController@index')->name('Administracion');

	//REGISTRO DE AREAS
	Route::resource('Area', 'AreasController');

	//REGISTRO DE ROLES
    Route::resource('Roles', 'RolesController');

	//REGISTRO DE AREAS ROLES
    Route::get('DibujarOrganigrama', 'OrganigramaController@DibujarOrganigrama');
//######################FIN GESTIÓN ADMINISTRATIVA#######################


//VISTA DE REGISTRO DEL ADMINISTRADOR
Route::get('/registro', 'UsuarioController@RegistroAdmin');

//VISTA REGISTRO DEL USUARIO NORMAL
Route::get('/register', 'UsuarioController@RegistroUserNormal');

Route::resource('Usuarios', 'UsuarioController');

Route::get('/PrepararUsuario/{cedula}', 'UsuarioController@PrepararUsuario');



// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/Usuarios/{id}', 'AreasController@ListaUsuarios')->name('Usuarios');


Route::resource('Tareas',  'TareasController');
Route::resource('Reunion',  'ReunionController');

route::get('RolesPorSubArea/{subarea}', 'RolesController@RolesPorSubArea');

 Route::get('/MisTareas/{estado}',  'TareasController@TareasPorEstado');
Route::get('/TareasEstado/{estado}',  'TareasController@TareasEstado');
route::get('TareasPorTipo/{estado}/{tipo}','TareasController@TareasPorTipo');

route::POST('GuardarSeguimientoTarea/','TareasController@GuardarSeguimientoTarea');

route::get('MisTareasResponsables/{Id_Usuario}/{estado}', 'TareasController@MisTareasResponsables');
route::get('MisTareasParticipantes/{Id_Usuario}/{estado}', 'TareasController@MisTareasParticipantes');
route::get('MisTareasObservadores/{Id_Usuario}/{estado}', 'TareasController@MisTareasObservadores');


Route::get('/login', 'LoginSController@index');
Route::get('/logout', 'LoginSController@Logout');
Route::post('/iniciar', 'LoginSController@Login')->name('iniciar');



Route::get('/RolesAreaID/{idArea}', 'RolesController@ListaRolesPorAreas');


Route::get('/Organigrama', 'OrganigramaController@index');

	


Route::get('UserRoles/{area}/{rol}', 'OrganigramaController@UserRoles');



//SUBAREAS
route::resource('SubArea', 'SubAreaController');
route::get('AreaSubArea', 'GestionAdministrativaController@AreaSubArea');
route::get('SubAreaPorArea/{area}', 'RolesController@SubAreaPorArea');


Route::get('/diagra', function () {
    return view('pruebaDiagrama');
});

//PERFIL DE USUARIO
route::get('Perfil', 'UsuarioController@Perfil');
route::PUT('ActPerfil/{id}', 'UsuarioController@ActPerfil');
route::put('CambiarClave', 'UsuarioController@CambiarClave');

route::resource('Observacion', 'ObservacionController');



