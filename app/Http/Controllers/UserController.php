<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:users-list|users-create|users-edit|users-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:users-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:users-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$ip = request()->ip();
        //dd($ip);

        $users = User::get();
        return view('users.index', compact('users'));

        // $data = User::orderBy('id','DESC')->paginate(5);
        // return view('users.index',compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all(); // Obtén todos los roles como una colección de objetos
        return view('users.create', compact('roles'));
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
            'avatar' => 'nullable|image',
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        // Manejo del avatar si se sube
        if ($request->hasFile('avatar')) {
            // Validar que la imagen sea cuadrada
            $imagePath = $request->file('avatar')->getRealPath();
            list($width, $height) = getimagesize($imagePath);

            if ($width !== $height) {
                return redirect()->back()
                    ->withErrors(['avatar' => 'La imagen debe ser cuadrada; las dimensiones de ancho y alto deben ser iguales.'])
                    ->withInput();
            }

            $nombre = $request->cedula . ".jpg";
            $ruta = storage_path('app/public/usuarios/') . $nombre;

            // Guardar la imagen redimensionada
            Image::make($request->file('avatar'))
                ->resize(200, 200)
                ->save($ruta);

            $input['avatar'] = $nombre;
        } else {
            // Asignar imagen por defecto si no se sube avatar
            $input['avatar'] = 'EM_LOGO.jpg';
        }

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::get();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
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
        // Validar los datos de entrada
        $this->validate($request, [
            'avatar' => 'nullable|image',
            'name' => 'nullable',
            'lastname' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|same:confirm-password',
            'roles' => 'required',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            // Validar que la imagen sea cuadrada
            $imagePath = $request->file('avatar')->getRealPath();
            list($width, $height) = getimagesize($imagePath);

            if ($width !== $height) {
                return redirect()->back()
                    ->withErrors(['avatar' => 'La imagen debe ser cuadrada; las dimensiones de ancho y alto deben ser iguales.'])
                    ->withInput();
            }

            $nombre = $request->cedula . ".jpg";
            $ruta = storage_path('app/public/usuarios/') . $nombre;

            // Guardar la imagen redimensionada
            Image::make($request->file('avatar'))
                ->resize(200, 200)
                ->save($ruta);

            $user->avatar = $nombre;
        }

        // Manejo de la contraseña solo si se envía una nueva
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        // Actualizar los datos principales del usuario
        $user->update($request->only('name', 'lastname', 'cedula', 'telefono', 'email'));

        // Actualizar roles
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $path = 'public/usuarios/';
        $image1 = $users->avatar;
        $users = Storage::delete($path . $image1);

        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function subir()
    {
        return view('users.subir');
    }

    public function import(Request $request)
    {
        if ($request->hasFile('users_file')) {

            try {

                Excel::import(new UsersImport, $request->file('users_file'));
                return redirect()->route('users.subir')->with('success', 'Subido los usuarios exitosamente.');

            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('users.subir')
                    ->with(['error' => $e->getMessage()]);
            }
        } else {
            return redirect()->route('users.subir')->with('error', 'Debe cargar el archivo CSv.');
        }

    }
}