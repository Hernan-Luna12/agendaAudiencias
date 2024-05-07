<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\CategoryPermission;
use App\Models\User;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Perfiles']); //$this->middleware(['permission:name_permiso']);
    }

    public function index(){
        if (Auth::check()) {
            return View::make('administracion.perfiles.index');
        } else {
            return redirect()->to('/');
        }
    }

    public function tabla(){
        if (Auth::check()) {
            $roles = Role::where('activo', true)->orderBy('name', 'asc')->get();
            return View::make('administracion.perfiles.tabla', compact('roles'));
        } else {
            return redirect()->to('/');
        }
    }

    public function create(){
        if (Auth::check()) {
            $categoriaspermiso = CategoryPermission::with('permissions')->where('activo', true)->orderBy('name', 'asc')->get();
            return View::make('administracion.perfiles.create', compact('categoriaspermiso'));
        } else {
            return redirect()->to('/');
        }
    }

    public function store(Request $request){
        if (Auth::check()) {
            $request->validate([
                'c_perfil' => 'required|string|max:255|unique:roles,name',
                'permission' => 'required|array|min:1',
            ]);

            try {
                DB::beginTransaction();

                $role = Role::create([
                    'name' => $request->input('c_perfil')
                ]);

                // Utiliza array_map para aplicar una función personalizada a cada valor del array
                $permissions = array_map(function($valor) {
                    return intval($valor);
                }, $request->input('permission'));

                $role->syncPermissions($permissions);

                DB::commit();

                return response()->json([
                    'idnotificacion' => 1,
                    'mensaje' => 'Perfil creado correctamente'
                ]);
            } catch(QueryException $ex){
                DB::rollBack();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al guardar el Perfil. Intente de nuevo',
                    'error' => $ex->getLine().' -> '.$ex->getMessage()
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function edit($id){
        if (Auth::check()) {
            $role = Role::with('permissions')->findOrFail($id);
            $categoriaspermiso = CategoryPermission::with('permissions')->where('activo', true)->orderBy('name', 'asc')->get();
            $array_permissions = $role->permissions->pluck('id')->toArray();
            return View::make('administracion.perfiles.edit', compact('role', 'categoriaspermiso', 'array_permissions'));
        } else {
            return redirect()->to('/');
        }
    }

    public function update(Request $request){
        if (Auth::check()) {
            $id = $request->input('id');
            $request->validate([
                'e_perfil' => 'required|string|max:255|unique:roles,name,'.$id,
                'permission' => 'required|array|min:1',
            ]);
            
            try {
                DB::beginTransaction();

                $role = Role::findOrFail($id);
                $role->name = $request->input('e_perfil');
                $role->update();

                // Utiliza array_map para aplicar una función personalizada a cada valor del array
                $permissions = array_map(function($valor) {
                    return intval($valor);
                }, $request->input('permission'));

                $role->syncPermissions($permissions);

                DB::commit();

                return response()->json([
                    'idnotificacion' => 1,
                    'mensaje' => 'Perfil actualizado correctamente'
                ]);
            } catch(QueryException $ex){
                DB::rollBack();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al actualizar el Perfil. Intente de nuevo',
                    'error' => $ex->getLine().' -> '.$ex->getMessage()
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function delete($id){
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                $perfil = Role::findOrFail($id);

                if ($perfil->permissions->isNotEmpty()) {
                    // El rol tiene al menos un permiso asociado
                    DB::rollback();
                    return response()->json([
                        'idnotificacion' => 2,
                        'mensaje' => 'El perfil tiene permisos asociados',
                        'error' => 'El perfil tiene permisos asociados'
                    ]);
                } else {
                    // El rol no tiene permisos asociados
                    $perfil->activo = false;
                    $perfil->update();

                    DB::commit();

                    return response()->json([
                        'idnotificacion' => 1,
                        'mensaje' => 'Perfil eliminado correctamente'
                    ]);
                }

            } catch(QueryException $ex){
                DB::rollBack();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al eliminar el Perfil. Intente de nuevo',
                    'error' => $ex->getLine().' -> '.$ex->getMessage()
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }
}
