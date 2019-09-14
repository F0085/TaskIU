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

//######################GESTIÓN ADMINISTRATIVA#######################

	Route::get('/Administracion', 'GestionAdministrativaController@index')->name('Administracion');

	//REGISTRO DE AREAS
	Route::resource('Area', 'AreasController');

	//REGISTRO DE ROLES
    Route::resource('Roles', 'RolesController');

	//REGISTRO DE AREAS ROLES
    Route::resource('AreasRoles', 'AreasRolesController');

//######################FIN GESTIÓN ADMINISTRATIVA#######################


//VISTA DE REGISTRO DEL ADMINISTRADOR
Route::get('/registro', 'UsuarioController@RegistroAdmin');

//VISTA REGISTRO DEL USUARIO NORMAL
Route::get('/register', 'UsuarioController@RegistroUserNormal');

Route::resource('Usuarios', 'UsuarioController');


// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/Usuarios/{id}', 'AreasController@ListaUsuarios')->name('Usuarios');


Route::resource('Tareas',  'TareasController');

 Route::get('/MisTareas/{estado}',  'TareasController@TareasPorEstado');
Route::get('/TareasEstado/{estado}',  'TareasController@TareasEstado');



Route::get('/login', 'LoginSController@index');
Route::get('/logout', 'LoginSController@Logout');
Route::post('/iniciar', 'LoginSController@Login')->name('iniciar');



Route::get('/RolesAreaID/{idArea}', 'RolesController@ListaRolesPorAreas');


Route::get('/Organigrama', 'OrganigramaController@index');

	


Route::get('UserRoles/{area}/{rol}', 'OrganigramaController@UserRoles');


Route::get('/DistintAreas', 'OrganigramaController@DistintAreas');



