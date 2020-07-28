<?php

use App\Category;
use App\Product;
use App\Image;
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

//pruebas con imagenes
Route::get('/prueba', function () {
 
    // MEJOR productos create many
    $imagen=[];
    $imagen[]['url']='images/tienda/avatar2.png';
    $imagen[]['url']='images/tienda/avatar1.png';

    $producto=App\Product::find(2);
    $producto->images()->createMany($imagen);
    return $producto->images;
});


// Mostrar imagenes
Route::get('/resultados', function () {
    $image=App\Image::orderBy('id','Desc')->get();
    return $image;
});

/* Mostrar que imagen pertence a x usuario
    $usuario=App\User::find(1);
    return $usuario->image;
    return $usuario->image->url; accede solo ala url
*/

// Route::get('/', function () {
//     return view('welcome');

// });
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

Route::get('user/{id}', 'UserController@index')->name('nombredelaruta');

Route::get('/hombre','Controller@hombre_catagolo');

// Route::get('/ejemplo', function () {
//     return view('/tienda/plantilla-categoria');
// });