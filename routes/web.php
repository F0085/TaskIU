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

Route::group([
    'middleware' => 'admin',
    // 'prefix' => 'admin',
    // 'namespace' => 'Admin'
], function () {
    Route::get('/Administracion', 'GestionAdministrativaController@index')->name('Admin');
    //REGISTRO DE AREAS
	Route::resource('Area', 'AreasController');
	//REGISTRO DE ROLES
	Route::resource('Roles', 'RolesController');
	//VISTA DE REGISTRO DEL ADMINISTRADOR
    Route::get('/registro', 'UsuarioController@RegistroAdmin');
    ///REPORTES
	route::get('Reportes', 'ReportesController@Reportes');
	route::get('GenerarReporte/{idtarea}', 'ReportesController@GenerarReporte');
	route::get('ReportesEstado/{estado}', 'ReportesController@ReportesEstado');
	//ADMINISTRADOR
	route::get('TareasAdministrador/{estado}', 'TareasController@TareasAdministrador');
	route::get('TareasEstadoAdministrador/{estado}', 'TareasController@TareasEstadoAdministrador');
	//PARA LA ESTADIDISTICA DEL ADMINISTRADOR
	route::get('EfectividadLaboral/{Id_Usuario}/{Anio}/{Mes}', 'EstadisticaAdminController@EfectividadLaboral');
	route::get('EfectividadPersonal/{Id_Usuario}/{Anio}/{Mes}', 'EstadisticaAdminController@EfectividadPersonal');

	route::resource('EstadisticaAdmin', 'EstadisticaAdminController');

	//para mostrar el total general como va la empresa
	route::get('TotalEstadisticaAdmin', 'EstadisticaAdminController@TotalEstadisticaAdmin');

	//PARA MOSTRAR EL ESTADO GENERAL POR EL USUARIO SIN MESES NI AÑO
	route::get('TotalEstadisticaUsuario/{Id_Usuario}', 'EstadisticaAdminController@TotalEstadisticaUsuario');


});
route::get('GenerarReporte/{idtarea}', 'ReportesController@GenerarReporte');
route::get('GenerarReporteReunion/{idtarea}', 'ReporteReunionController@GenerarReporte');



//######################GESTIÓN ADMINISTRATIVA#######################

	// Route::get('/Administracion', 'GestionAdministrativaController@index')->name('Administracion');

	

	
   

//REGISTRO DE AREAS ROLES
    Route::get('DibujarOrganigrama', 'OrganigramaController@DibujarOrganigrama');
//######################FIN GESTIÓN ADMINISTRATIVA#######################




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
route::get('TareasPorTipoPendiente/{estado}/{tipo}','TareasController@TareasPorTipoPendiente');

route::POST('GuardarSeguimientoTarea/','TareasController@GuardarSeguimientoTarea');

route::get('MisTareasResponsables/{Id_Usuario}/{estado}', 'TareasController@MisTareasResponsables');
route::get('MisTareasParticipantes/{Id_Usuario}/{estado}', 'TareasController@MisTareasParticipantes');
route::get('MisTareasObservadores/{Id_Usuario}/{estado}', 'TareasController@MisTareasObservadores');
route::get('HoraFechaSistema', 'TareasController@HoraFechaSistema');
route::POST('validarFechas', 'TareasController@validarFechas');



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
route::resource('Documentos', 'DocumentoController');
route::POST('GuardarArchivos', 'DocumentoController@GuardarArchivos');









//REUNIONES
route::get('ReunionPorEstado_User/{estado}', 'ReunionController@ReunionPorEstado_User');
route::get('MisReunionesResponsables/{estado}', 'ReunionController@MisReunionesResponsables');
route::get('MisReunionesParticipantes/{estado}', 'ReunionController@MisReunionesParticipantes');

route::PUT('ModificarReunion/{id}', 'ReunionController@ModificarReunion');


route::PUT('Asistencia/{id}/{Id_Usuario}', 'ReunionController@Asistencia');

//PARA TRAER LAS OBSERVACIONES DE REUNIONES
route::resource('ObservacionesReuniones', 'ObservacionReunionController');



route::get('ComprobarTareaFecha/{idtareas}/{FechaFin}/{HoraFin}', 'TareasController@ComprobarTareaFecha');

route::get('ListaTareas', 'TareasController@ListaTareas');
route::get('tareasCPM/{estado}','TareasController@tareasCPM');




//DASHBOARD
route::get('TotalTareasResponsables', 'TareasController@TotalTareasResponsables');


//VALIDAR FECHA INICIO
route::get('validarinicioTarea/{FechaIn}/{HoraIn}', 'TareasController@validarinicioTarea');




route::get('EfectividadPorMeses/{Anio}/{Mes}', 'DashboardController@EfectividadPorMeses');
route::get('EfectividadPorMesesPersonales/{Anio}/{Mes}', 'DashboardController@EfectividadPorMesesPersonales');
route::get('TotalTareasResponsablesLaboral/{Anio}/{Mes}', 'DashboardController@TotalTareasResponsablesLaboral');
route::get('TotalTareasResponsablesPersonal/{Anio}/{Mes}', 'DashboardController@TotalTareasResponsablesPersonal');

route::get('TotalTareasResponsablesLaboralAdmin/{Id_Usuario}/{Anio}/{Mes}', 'EstadisticaAdminController@TotalTareasResponsablesLaboralAdmin');
route::get('TotalTareasResponsablesPersonalAdmin/{Id_Usuario}/{Anio}/{Mes}', 'EstadisticaAdminController@TotalTareasResponsablesPersonalAdmin');

route::get('ConfirmAsistencia/{Id_Reunion}/{Id_Usuario}/{tipo}', 'AsistenciaController@ConfirmAsistencia');

route::POST('Motivo/{Id_Reunion}/{Id_Usuario}', 'AsistenciaController@GuardarMotivo');

route::get('CalcularEdad/{Fecha_Nacimiento}', 'UsuarioController@CalcularEdad');

route::resource('Notificaciones', 'NotificacionController');
route::get('ContarNotificaciones', 'NotificacionController@ContarNotificaciones');
route::get('Task/{IdTtar_Reu}/{tipoRol}/{idNotificacion}', 'NotificacionController@Task');
route::get('ReunionN/{IdTtar_Reu}/{tipoRol}/{idNotificacion}', 'NotificacionController@ReunionN');
route::get('EstadoVencimiento/{Fecha}', 'ReunionController@EstadoVencimiento');
route::get('ReunionAdmin/{estado}', 'ReunionController@ReunionAdmin');















