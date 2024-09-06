<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:administracion-list|administracion-create|administracion-edit|administracion-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:administracion-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:administracion-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:administracion-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Admin::first();
        // dd($admin);
        return view('administracion.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin=Admin::find($id);
        return view('administracion.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin=Admin::find($id);
        if ($request->hasFile('logo') and $request->hasFile('favicon')) {
            dd("Si tiene logo/favicon");
        }else{
            if ($request->hasFile('favicon')) {
                dd("Si tiene favicon");
            }else {
                if($request->hasFile('logo')){
                    dd("Si tiene logo");
                }else{
                    dd("sin imagenes");
                }
            }
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
