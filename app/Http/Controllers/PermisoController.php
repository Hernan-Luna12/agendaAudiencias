<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use Spatie\Permission\Models\Role;

use App\Models\Permission;
use App\Models\CategoryPermission;
use App\Models\User;

class PermisoController extends Controller
{
    public function __construct() {
        $this->middleware(['permission:Permisos']);
    }

    public function index(){
        if (Auth::check()) {
            return View::make('administracion.permisos.index');
        } else {
            return redirect()->to('/');
        }
    }

    public function tabla(){
        if (Auth::check()) {
            $permisions = Permission::with('category_permission')->groupBy('permissions.category_id', 'permissions.id')->orderBy('name', 'asc')->get();
            return View::make('administracion.permisos.tabla', compact('permisions'));
        } else {
            return redirect()->to('/');
        }
    }

    public function create(){
        if (Auth::check()) {
            $categoriaspermisos = CategoryPermission::where('activo', true)->orderBy('name', 'asc')->get();
            return View::make('administracion.permisos.create', compact('categoriaspermisos'));
        } else {
            return redirect()->to('/');
        }
    }

    public function store(Request $request){
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                $this->validate($request, ['c_permission' => 'required', 'c_category' => 'required']);

                if(Permission::where('name', $request->input('c_permission'))->exists()){
                    return response()->json([
                        'idnotificacion' => 2,
                        'mensaje' => 'El Permiso ya existe'
                    ]);
                }
                
                Permission::create(['name' => $request->input('c_permission'), 'guard_name' => 'web',
                    'category_id' => $request->input('c_category')]);

                DB::commit();

                return response()->json([
                    'idnotificacion' => 1,
                    'mensaje' => 'Permiso creado correctamente'
                ]);
            } catch (QueryException $ex) {
                DB::rollback();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al guardar el Permiso. Intente de nuevo',
                    'error' => $ex->getLine().' -> '.$ex->getMessage()
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function edit($id){
        if (Auth::check()) {
            $permission = Permission::findOrFail($id);
            $categoriaspermisos = CategoryPermission::where('activo', true)->orderBy('name', 'asc')->get();
            return View::make('administracion.permisos.edit', compact('permission', 'categoriaspermisos'));
        } else {
            return redirect()->to('/');
        }
    }

    public function update(Request $request){
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                $this->validate($request, ['e_permission' => 'required', 'e_category' => 'required']);

                $permission = Permission::findOrFail($request->input('id'));
                $permission->name = $request->input('e_permission');
                $permission->category_id = $request->input('e_category');
                $permission->update();

                DB::commit();

                return response()->json([
                    'idnotificacion' => 1,
                    'mensaje' => 'Permiso actualizado correctamente'
                ]);
            } catch (QueryException $ex) {
                DB::rollback();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al actualizar el Permiso. Intente de nuevo',
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
                
                $permission = Permission::findOrFail($id);
                $permission->activo = false;
                $permission->update();

                DB::commit();

                return response()->json([
                    'idnotificacion' => 1,
                    'mensaje' => 'Permiso eliminado correctamente'
                ]);
            } catch (QueryException $ex) {
                DB::rollback();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al eliminar el Permiso. Intente de nuevo',
                    'error' => $ex->getLine().' -> '.$ex->getMessage()
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }
}
