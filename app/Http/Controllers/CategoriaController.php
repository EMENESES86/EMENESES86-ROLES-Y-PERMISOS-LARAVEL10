<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto;



class CategoriaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:categoria-list|categoria-create|categoria-edit|categoria-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:categoria-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:categoria-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:categoria-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Categoria::get();
        $pro = Producto::get();
        return view('categorias.index', compact('cat','pro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Categoria::get();
        return view('categorias.create', compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'avatar'=>'image|max:5000|mimes:jpg,png,jpeg,gif,svg',
            'cat_name' => 'required',
            'cat_color' => 'required',
            'cat_descripcion' => 'required|max:150',
        ]);



        if ($request->hasFile('cat_avatar')) {
            $cat = new Categoria();
            $image = $request->cat_name;
            $image1 = $image . ".jpg";
            $filename = $image1;
            $cat->cat_avatar = $image1;
            $request->cat_avatar->storeAs('public/categorias', $filename);
            // $filename=$request->imagen->storeAs('public/categorias',$filename);


            $cat->cat_name = $request->input('cat_name');
            $cat->cat_descripcion = $request->input('cat_descripcion');
            $cat->cat_color = $request->input('cat_color');
            $cat->save();
            return redirect()->route('categorias.index')
                ->with(['success' => 'Guardado exitosamente']);
        } else {
            $cat = new Categoria();
            $cat->cat_name = $request->input('cat_name');
            $cat->cat_descripcion = $request->input('cat_descripcion');
            $cat->cat_color = $request->input('cat_color');
            $cat->save();
            return redirect()->route('categorias.index')
                ->with(['success' => 'Guardado exitosamente']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Categoria::find($id);
        return view('categorias.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cat_avatar'=>'image|max:5000|mimes:jpg,png,jpeg,gif,svg',
            'cat_name' => 'required',
            'cat_color' => 'required',
            'cat_descripcion' => 'required|max:150',
        ]);

        $cat = Categoria::find($id);
        $fecha = date('dmYHis');
        if ($request->hasFile('cat_avatar')) {
            $image = $request->cat_name;
            $image1 = $image . ".jpg";
            $filename = $image1;
            $cat->cat_avatar = $image1;
            $request->cat_avatar->storeAs('public/categorias', $filename);

            // $image1 = $cat->cat_avatar;
            // $image1=$request->cat_avatar->storeAs('public/categorias',$image1);

            $cat->update($request->only('cat_name', 'cat_descripcion', 'cat_color'));
            return redirect()->route('categorias.index')
                ->with(['success' => 'Guardado exitosamente']);
        } else {
            $cat->update($request->only('cat_name', 'cat_descripcion', 'cat_color'));
            return redirect()->route('categorias.index')
                ->with(['success' => 'Guardado exitosamente']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $cat = Categoria::find($id);
            $path = 'public/categorias/';
            $image1 = $cat->cat_avatar;
            $cat = Storage::delete($path . $image1);

            $cat = Categoria::find($id)->delete();

            return back()->with(['success' => 'Eliminado exitosamente']);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('categorias.index')
            ->with(['error' => 'No se puede eliminar ya que tiene datos anidados.']);
        }
    }
}
