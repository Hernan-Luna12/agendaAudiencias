<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use App\Models\CategoryPermission;
use App\Models\User;

class CategoriaPermisoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Categorias']);
    }

    public function index(){
        if (Auth::check()) {
            return View::make('administracion.categoriaspermisos.index');
        } else {
            return redirect()->to('/');
        }
    }

    public function tabla(){
        if (Auth::check()) {
            $categoriaspermisos = CategoryPermission::with('permissions')->where('activo', true)->orderBy('name', 'asc')->get();
            return View::make('administracion.categoriaspermisos.tabla', compact('categoriaspermisos'));
        } else {
            return redirect()->to('/');
        }
    }

    public function create(){
        if (Auth::check()) {
            return View::make('administracion.categoriaspermisos.create');
        } else {
            return redirect()->to('/');
        }
    }

    public function store(Request $request){
        if (Auth::check()) {
            try {
                DB::beginTransaction();
                $this->validate($request, ['c_category' => 'required']);

                if(CategoryPermission::where('name', $request->input('c_category'))->exists()){
                    return response()->json([
                        'idnotificacion' => 2,
                        'mensaje' => 'La Categoría de Permiso ya existe'
                    ]);
                }
                
                CategoryPermission::create(['name' => $request->input('c_category')]);

                DB::commit();

                return response()->json([
                    'idnotificacion' => 1,
                    'mensaje' => 'Categoría de Permiso creada correctamente',
                    'redirect' => route('categoriaspermisos')
                ]);
            } catch(QueryException $ex){
                DB::rollback();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al procesar la petición. Intente de nuevo',
                    'error' => $ex->getLine().' -> '.$ex->getMessage()
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function edit($id){
        if (Auth::check()) {
            $categoriapermiso = CategoryPermission::findOrFail($id);
            return View::make('administracion.categoriaspermisos.edit', compact('categoriapermiso'));
        } else {
            return redirect()->to('/');
        }
    }

    public function update(Request $request){
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                $this->validate($request, ['e_category' => 'required']);

                $categoriapermiso = CategoryPermission::findOrFail($request->input('id'));
                $categoriapermiso->name = $request->input('e_category');
                $categoriapermiso->update();

                DB::commit();

                return response()->json([
                    'idnotificacion' => 1,
                    'mensaje' => 'Categoría de Permiso actualizada correctamente',
                    'redirect' => route('categoriaspermisos')
                ]);
            } catch(QueryException $ex){
                DB::rollback();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al procesar la petición. Intente de nuevo',
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

                $categoriapermiso = CategoryPermission::findOrFail($id);
                $categoriapermiso->activo = false;
                $categoriapermiso->update();

                DB::commit();

                return response()->json([
                    'idnotificacion' => 1,
                    'mensaje' => 'Categoría de Permiso eliminada correctamente',
                    'redirect' => route('categoriaspermisos')
                ]);
            } catch(QueryException $ex){
                DB::rollback();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al procesar la petición. Intente de nuevo',
                    'error' => $ex->getLine().' -> '.$ex->getMessage()
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }
}
