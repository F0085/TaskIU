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



//VISTA DE REGISTRO DEL ADMINISTRADOR
Route::get('/registro', 'UsuarioController@vista');

//VISTA REGISTRO DEL USUARIO NORMAL
Route::get('/register', 'UsuarioController@RegistroUser');

Route::resource('Usuarios', 'UsuarioController');


// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/Usuarios/{id}', 'AreasController@ListaUsuarios')->name('Usuarios');


//REGISTRO DE AREAS
Route::get('/Administracion', 'AreasController@index2')->name('Administracion');
Route::resource('Area', 'AreasController');

//REGISTRO DE ROLES
Route::resource('Roles', 'RolesController');
Route::get('/RolesAreas', 'AreasController@ListaRolesAreas');




Route::get('/login', 'LoginSController@index');
Route::get('/logout', 'LoginSController@Logout');
Route::post('/iniciar', 'LoginSController@Login')->name('iniciar');





Route::post('/AreaACT', 'AreasController@update')->name('AreaACT');
Route::get('/roles', 'AreasController@ListaArea')->name('roles');

Route::post('/rolesUser', 'Roles_UsuarioController@store')->name('rolesUser');
Route::get('/rolesUser', 'Roles_UsuarioController@index')->name('rolesUser');

//Route::post('/login1', 'AreasController@Login')->name('login1');

Route::get('/sesion', 'AreasController@sesion');


Route::get('/RolesAreaID/{idArea}', 'RolesController@ListaRolesPorAreas');


Route::get('/Organigrama', 'OrganigramaController@index');
Route::get('UserRoles/{area}/{rol}', 'OrganigramaController@UserRoles');


Route::get('/DistintAreas', 'AreasController@DistintAreas');
Route::resource('AreasRoles', 'AreasRolesController');


