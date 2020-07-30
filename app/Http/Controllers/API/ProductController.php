<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Image;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    
    public function index(){
        return Product::all();
    }

    public function show($slug){
        if(Product::where('slug',$slug)->first()){
            return 'Slug ya existe';
        }else{
            return 'Slug Disponible';
        }
    }

    public function eliminarimagen($id){
        $image=Image::find($id);
        $archivo=substr($image->url,1);
        $eliminar=File::delete($archivo);
        $image->delete();
        return "eliminado id:".$id.''.$eliminar;
    }
}
