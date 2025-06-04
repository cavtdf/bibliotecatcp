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

//  Route::get('/', function () {
//     return view('auth.login');
 //});

/* Auth::routes();*/

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//Route::get('/home', 'HomeController@index')->name('home');


// Ruta principal del sistema acceso de Administrador

Route::get('/', 'InicioController@index')->name('inicio')->middleware('auth');

// Ruta principal del sistema acceso del Usuario
// Route::get('/usuario/index', 'UsuarioController@index')->name('usuario.index'); // Comentada para evitar conflicto

// rutas de las editoriales
Route::resource('editorial', 'EditorialController');
Route::post('editorial/update', 'EditorialController@update')->name('editorial.update');

// rutas de las categorias
Route::resource('categoria', 'CategoriaController');
Route::post('categoria/update', 'CategoriaController@update')->name('categoria.update');

// rutas de autores
Route::resource('autor', 'AutorController');
Route::post('autor/update', 'AutorController@update')->name('autor.update');

// rutas de estados
Route::resource('estado', 'EstadoController');
Route::post('estado/update', 'EstadoController@update')->name('estado.update');

//rutas de tipos
Route::resource('tipo', 'TipoController');
Route::post('tipo/update', 'TipoController@update')->name('tipo.update');

// rutas de limite de prestamos
Route::resource('prestamo', 'PrestamoController');
/*Route::post('prestamo/update', 'PrestamoController@update')->name('prestamo.update');*/

// rutas de politica
Route::resource('politica', 'PoliticaController');
Route::post('politica/update', 'PoliticaController@update')->name('politica.update');

// rutas de limite de horario
Route::resource('horario', 'HorarioController');
Route::post('horario/update', 'HorarioController@update')->name('horario.update');

// rutas de material
Route::get('material/getEstados', 'MaterialController@getEstados')->name('material.getEstados');
Route::resource('material', 'MaterialController');
Route::post('material/update', 'MaterialController@update')->name('material.update');


// rutas de limite de prestamos
Route::resource('limite', 'LimiteController');
Route::post('limite/update', 'LimiteController@update')->name('limite.update');

// rutas de prestamos solicitados
Route::resource('solicitado', 'SolicitadoController');
Route::post('solicitado/update', 'SolicitadoController@update')->name('solicitado.update');
Route::get('prestado', 'PrestadoController@index')->name('prestado.index');

// rutas de bibliografía
Route::resource('bibliografia', 'BibliografiaController');

// rutas de situacion de la bibliografia
Route::resource('situacion', 'SituacionController');

// rutas de tipos de movimientos
Route::resource('movimiento', 'MovimientoController');
Route::post('movimiento/update', 'MovimientoController@update')->name('movimiento.update');

// rutas de Ubicaciones
Route::get('ubicacion/getEstados', 'UbicacionController@getEstados')->name('ubicacion.obtenerestados');
Route::resource('ubicacion', 'UbicacionController');
Route::post('ubicacion/update', 'UbicacionController@update')->name('ubicacion.update');

// rutas de vencidos
Route::resource('vencido', 'VencidoController');
Route::post('vencido/update', 'VencidoController@update')->name('vencido.update');


// rutas de devoluciones
Route::resource('devolucion', 'DevolucionController');
Route::post('devolucion/update', 'DevolucionController@update')->name('devolucion.update');

// Usuarios
Route::resource('usuario', 'UserController');
// Route::post('usuario/update', 'UsuarioController@update')->name('usuario.update');

// Rutas para la gestión de Roles (CRUD)
Route::resource('rol', 'RolController');


// Libros solicitados por el usuario
Route::resource('libro', 'LibroController');


// Para verificar los archivos de logs a traves del navegador
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAsRead');

Route::post('/mark-as-read', 'PostController@markNotification')->name('markNotification');

Route::resource('export', 'ExportController');
