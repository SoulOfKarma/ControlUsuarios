<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/Login/Salir', 'LoginController@salir');
Route::post('/Login/GetUsers', 'LoginController@getUsuarios');
Route::post('/Login/getpr', 'LoginController@adminPr');
Route::post('/auth/login','LoginController@login');
Route::post('/auth/RefreshToken','AuthJWT@handle');

Route::group(['middleware' => ['jwt.verify']], function() {
    //Gets
    Route::get('/Sistema/GetSistema', ['middleware' => 'cors', 'uses' => 'SistemasController@GetSistemas']);
    Route::get('/AccesoUsuario/GetAccesoUsuario', ['middleware' => 'cors', 'uses' => 'AccesoUsuariosController@GetAccesoUsuario']);
    Route::get('/Servicios/GetServicios', ['middleware' => 'cors', 'uses' => 'ServiciosController@GetServicios']);
    Route::get('/Usuarios/GetUsers', ['middleware' => 'cors', 'uses' => 'LoginController@GetUsers']);
    //Posts 
    Route::post('/Sistema/PostSistema', ['middleware' => 'cors', 'uses' => 'SistemasController@PostSistemas']);
    Route::post('/AccesoUsuario/PostAccesoUsuarios', ['middleware' => 'cors', 'uses' => 'AccesoUsuariosController@PostAccesoUsuarios']);
    Route::post('/Servicios/PostServicios', ['middleware' => 'cors', 'uses' => 'ServiciosController@PostServicios']);
    //Post Como Get
   
    //Post Como Put
    Route::post('/Sistema/PutSistema', ['middleware' => 'cors', 'uses' => 'SistemasController@PutSistemas']);
    Route::post('/AccesoUsuario/PutAccesoUsuarios', ['middleware' => 'cors', 'uses' => 'AccesoUsuariosController@PutAccesoUsuarios']);
    Route::post('/Servicios/PutServicio', ['middleware' => 'cors', 'uses' => 'ServiciosController@PutServicio']);
    //Post como Delete
    

    //Post Documentos
    
    
});

//Generar PDF
Route::get('/Recepcion/RecepcionPDF/{NUMINT}', ['middleware' => 'cors', 'uses' => 'RecepcionesController@GenerarImpresion']);
Route::get('/Despacho/DespachoPDF/{NUMINT}', ['middleware' => 'cors', 'uses' => 'DespachosController@GenerarImpresion']);
Route::get('/OrdenCompra/OrdenCompraPDF/{NUMINT}', ['middleware' => 'cors', 'uses' => 'OrdenComprasController@GenerarImpresion']);

