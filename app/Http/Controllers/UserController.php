<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
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
            'name1' => 'required',
            'name2' => 'required',
            'lastname1' => 'required',
            'lastname2' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
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
        $this->validate($request, [
            'avatar' => 'image|max:5000',
            'name1' => 'required',
            'name2' => 'required',
            'lastname1' => 'required',
            'lastname2' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);

        $users = User::findOrFail($id);
        if ($request->hasFile('avatar')) {
            $nombre = ($request->cedula) . ".jpg";

            $users->avatar = $nombre;
            $filename = $nombre;
            $request->avatar->storeAs('public/usuarios', $filename);

            if ($request->password != "") {
                $users->password = Hash::make($request->password);
            }

            $users->update($request->only('name1', 'name2', 'lastname1', 'lastname2', 'cedula', 'telefono', 'email'));
            return redirect()->route('users.index')
                ->with('success', 'User updated successfully');
        } else {

            $input = $request->all();
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, array('password'));
            }

            $user = User::find($id);

            $user->update($input);

            DB::table('model_has_roles')->where('model_id', $id)->delete();

            $user->assignRole($request->input('roles'));

            return redirect()->route('users.index')
                ->with('success', 'User updated successfully');
        }
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