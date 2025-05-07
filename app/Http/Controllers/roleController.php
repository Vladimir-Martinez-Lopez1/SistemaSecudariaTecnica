<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller; // Ensure the correct Controller class is imported
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


use function PHPSTORM_META\type;

class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:ver-role|crear-role|editar-role|mostrar-role',['only'=>['index']]);
        $this->middleware('permission:crear-role', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-role', ['only' => ['destroy']]);
    }
    public function index()
    {
        $roles = Role::all();
        //dd($roles);
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permisos = Permission::all();
        return view('role.create', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);
        //dd($request->all());
        //detectar algun error
        try {
            DB::beginTransaction();
            //crear el rol
            $rol = Role::create(['name' => $request->name]);
            //agregar los permisos al rol
            $rol->syncPermissions($request->permission);
            //Hacer el commit
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }

        return redirect()->route('roles.index')->with('success', 'Rol registrado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permisos = Permission::all();
        return view('role.edit', compact('role', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permission' => 'required'
        ]);
        try {
            DB::beginTransaction();

            //Actualizar el rol
            Role::where('id', $role->id)->update(['name' => $request->name]);

            //Actualizar los permisos del rol
            $role->syncPermissions($request->permission);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
        return redirect()->route('roles.index')->with('success', 'Rol actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::where('id', $id)->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado.');
    }
}
