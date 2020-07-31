<?php

use App\Category;
use App\Product;
use App\Image;
use App\User;
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
    return view('welcome');

});

Route::get('/prueba', function () {
    
    $productos=App\Product::with('category','images')->orderBy('id','desc')->get();
    return $productos;

});
// Route::get('/api', function () {
//     //return view('welcome');
//     $prod=Product::find(2)->category;
//     $cat=Category::find(1)->products;
//     return $cat;
// });

// Route::get('/bienvenido', function () {
//     return "Hola como estas";
// });

// Route::get('fotos/{id}',function($id_foto){
//     return 'ests en la galeria de fotos '.$id_foto;
// });

// Route::get('/ejemplo/{nombre?}', function ($nombre=null) {
//     return 'usuario->'.$nombre;

// });

// Route::get('user/{id}', 'Admin\AdminUserController@index')->name('nombredelaruta');

Route::get('/hombre','Controller@hombre_catagolo');

// Route::get('/ejemplo', function () {
//     return view('/tienda/plantilla-categoria');
// });

/* ------RUTAS QUE YA VAN A QUEDARSE-------- */

/* ----Manejo de usuarios------- */

// Route::get('/admin/usuarios', function () {
//     return view('admin.user.index');
// });

Route::get('/admin/usuarios', 'Admin\AdminUserController@index');

//para obtener todas las rutas del usuario
Route::resource('admin/user','Admin\AdminUserController')->names('admin.user');

/* ----Admin Categoria----- */


Route::get('/admin', function () {
    return view('admin.system.admin_home');
})->name('admin');

Route::get('/admin/acerca_de', function () {
    return view('admin.system.acerca_de');
});


Route::resource('admin/category', 'Admin\AdminCategoryController')->names('admin.category');



/* ---Admin Producto----- */
Route::resource('admin/product', 'Admin\AdminProductController')->names('admin.product');

// Route::get('/admin', function () {
//     return view('plantilla.admin');
// });

Route::get('cancelar/{ruta}', function ($ruta) {
    return redirect()->route($ruta)->with('cancelar','Accion cancelada');
})->name('cancelar');

/* ----TiendaCategorias----*/
// Route::get('/categoria/{slug}', function ($slug) {
//     return view('/tienda/plantilla_categoria')->name('categoria.hombre');
// });

Route::resource('categoria/{slug}', 'Tienda\TiendaController')->names('tienda.categoria.index');

// Route::get('/tienda', function () {
//     return view('tienda.usuario.perfil');
// });