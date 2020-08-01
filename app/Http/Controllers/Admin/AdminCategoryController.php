<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\GeneralCategory;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     /*
    public function __construct() {
        $this->middleware('auth');
    }
    */
    public function index(Request $request)
    {
       $nombre = $request->get('nombre');
        $categorias = Category::where('nombre','like',"%$nombre%")->orderBy('nombre')->paginate(8);        
        return view('admin.category.index',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $principales=GeneralCategory::get();
        return view('admin.category.create',compact('principales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //return $request;
         $request->validate([
            'nombre' => 'required|max:50|unique:categories,nombre',
            'slug' => 'required|max:50|unique:categories,slug',
        ]);

    
         Category::create($request->except('_token'));
        return redirect()->route('admin.category.index')->with('datos','Registro creado correctamente!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $cat= Category::where('slug',$slug)->firstOrFail();
        $editar = 'Si';
        
        return view('admin.category.show',compact('cat','editar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $cat= Category::where('slug',$slug)->firstOrFail();
        $editar = 'Si';
        $principales=GeneralCategory::get();
        return view('admin.category.edit',compact('cat','editar','principales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cat= Category::findOrFail($id);
        $request->validate([
            'nombre' => 'required|max:50|unique:categories,nombre,'.$cat->id,
            'slug' => 'required|max:50|unique:categories,slug,'.$cat->id,

        ]);
      
        $cat->fill($request->all())->save();
       //return $request;
       return redirect()->route('admin.category.index')->with('datos','Registro actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat= Category::findOrFail($id);
        $cat->delete();
        return redirect()->route('admin.category.index')->with('datos','Registro eliminado correctamente!');


    }



}