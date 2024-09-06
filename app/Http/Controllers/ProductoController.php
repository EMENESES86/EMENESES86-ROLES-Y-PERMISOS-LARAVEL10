<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:producto-list|producto-create|producto-edit|producto-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:producto-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:producto-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:producto-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pro = Producto::get();
        return view('productos.index', compact('pro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pro = Producto::get();
        $cat = Categoria::get();
        return view('productos.create', compact('pro','cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('pro_avatar')) {
            $pro = new Producto();
            $image = $request->pro_name;
            $image1 = $image . ".jpg";
            $filename = $image1;
            $pro->pro_avatar = $image1;
            $request->pro_avatar->storeAs('public/productos', $filename);
            // $filename=$request->imagen->storeAs('public/productos',$filename);


            $pro->pro_name = $request->input('pro_name');
            $pro->pro_descripcion = $request->input('pro_descripcion');
            $pro->id_cat = $request->input('id_cat');
            $pro->pro_link = $request->input('pro_link');
            $pro->save();
            return redirect()->route('productos.index')
                ->with(['success' => 'Guardado exitosamente']);
        } else {
            $pro = new Producto();
            $pro->pro_name = $request->input('pro_name');
            $pro->pro_descripcion = $request->input('pro_descripcion');
            $pro->id_cat = $request->input('id_cat');
            $pro->pro_link = $request->input('pro_link');
            $pro->save();
            return redirect()->route('productos.index')
                ->with(['success' => 'Guardado exitosamente']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pro = Producto::find($id);
        $cat = Categoria::get();
        return view('productos.edit', compact('pro','cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'pro_avatar'=>'image|max:5000|mimes:jpg,png,jpeg,gif,svg',
            'pro_name' => 'required',
            'id_cat' => 'required',
            'pro_descripcion' => 'required|max:150',
        ]);

        $pro = Producto::find($id);
        $fecha = date('dmYHis');
        if ($request->hasFile('cat_avatar')) {
            $image = $request->pro_name;
            $image1 = $image . ".jpg";
            $filename = $image1;
            $pro->pro_avatar = $image1;
            $request->pro_avatar->storeAs('public/productos', $filename);

            // $image1 = $pro->cat_avatar;
            // $image1=$request->cat_avatar->storeAs('public/productos',$image1);

            $pro->update($request->only('pro_name', 'pro_descripcion', 'pro_link','id_cat'));
            return redirect()->route('productos.index')
                ->with(['success' => 'Guardado exitosamente']);
        } else {
            $pro->update($request->only('pro_name', 'pro_descripcion', 'pro_link','id_cat'));
            return redirect()->route('productos.index')
                ->with(['success' => 'Guardado exitosamente']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $pro = Producto::find($id);
            $path = 'public/productos/';
            $image1 = $pro->pro_avatar;
            $pro = Storage::delete($path . $image1);

            $pro = Producto::find($id)->delete();

            return back()->with(['success' => 'Eliminado exitosamente']);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('productos.index')
            ->with(['error' => 'No se puede eliminar ya que tiene datos anidados.']);
        }
    }
}
