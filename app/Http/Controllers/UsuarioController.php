<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\Persona;
use App\Models\User;
use App\Models\CtgRolesPersona;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Usuarios']); //$this->middleware(['permission:name_permiso']);
    }

    public function index(){
        if (Auth::check()) {
            return View::make('administracion.usuarios.index');
        } else {
            return redirect()->to('/');
        }
    }

    public function tabla(){
        if (Auth::check()) {
            $usuarios = User::with(['persona', 'ctg_centro_trabajo', 'ctg_centro_trabajo.ctg_distrito', 'roles'])->orderBy('name', 'asc')->get()
                ->filter(
                    fn ($user) => $user->roles->whereNotIn('id', 1)->toArray()
                );
            return View::make('administracion.usuarios.tabla', compact('usuarios'));
        } else {
            return redirect()->to('/');
        }
    }

    public function create(){
        if (Auth::check()) {
            $roles_persona = CtgRolesPersona::where('activo', true)->orderBy('name', 'asc')->get();
            $distritos = Controller::getDistritos();
            $centros_trabajo = [];
            $roles = Role::where('id', '!=', 1)->where('activo', true)->orderBy('name', 'asc')->get();
            return View::make('administracion.usuarios.create', compact('roles_persona', 'distritos', 'centros_trabajo', 'roles'));
        } else {
            return redirect()->to('/');
        }
    }

    public function store(Request $request){
        if (Auth::check()) {
            $request->validate([
                'c_username' => 'required|string|max:255|unique:users,name',
                'c_perfil' => 'required|int|max:255',
            ]);
            
            try {
                DB::beginTransaction();

                $persona = new Persona();
                $persona->nombre = Str::upper($request->input('c_nombre'));
                $persona->primerapellido = Str::upper($request->input('c_primerapellido'));
                $persona->segundoapellido = Str::upper($request->input('c_segundoapellido'));
                $persona->tipo_persona_id = 3; // 3 = Usuario de sistema ctg_tipos_persona
                $persona->rol_persona_id = $request->input('c_rol');
                $persona->save();

                $usuario = new User();
                $usuario->id = $persona->id;
                $usuario->name = Str::upper($request->input('c_username'));
                $usuario->email = $request->input('c_username').'@pjeveracrux.gob.mx';
                $usuario->password = bcrypt('DOCS2024');
                $usuario->centro_trabajo_id = $request->input('c_centro_trabajo');
                $usuario->save();

                $usuario->assignRole(intval($request->input('c_perfil')));

                DB::commit();

                return response()->json([
                    'idnotificacion' => 1,
                    'mensaje' => 'Usuario creado correctamente'
                ]);
            } catch (QueryException $ex){
                DB::rollBack();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al crear Usuario. Intente de nuevo',
                    'error' => $ex->getLine().' -> '.$ex->getMessage()
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function edit($id){
        if (Auth::check()) {
            $roles_persona = CtgRolesPersona::where('activo', true)->orderBy('name', 'asc')->get();
            $usuario = User::with(['persona', 'ctg_centro_trabajo:id,id_distrito'])->where('id', $id)->first();
            $userrole = $usuario->roles->pluck('id')->first();
            $roles = Role::where('id', '!=', 1)->where('activo', true)->orderBy('name', 'asc')->get();
            $distritos = Controller::getDistritos();
            if ($usuario->id_centro_trabajo != null) {
                $centros_trabajo = Controller::getCentrosTrabajo($usuario->ctg_centro_trabajo->id_distrito);
            } else {
                $centros_trabajo = [];
            }
            return View::make('administracion.usuarios.edit', compact('roles_persona', 'usuario', 'roles', 'distritos', 
                'centros_trabajo', 'userrole'));
        } else {
            return redirect()->to('/');
        }
    }

    public function update(Request $request){
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                $persona = Persona::findOrFail($request->input('id'));
                $persona->nombre = Str::upper($request->input('e_nombre'));
                $persona->primerapellido = Str::upper($request->input('e_primerapellido'));
                $persona->segundoapellido = Str::upper($request->input('e_segundoapellido'));
                $persona->id_rol_persona = $request->input('e_rol');
                $persona->update();

                $usuario = User::findOrFail($persona->id);
                $usuario->id_centro_trabajo = $request->input('e_centro_trabajo');
                $usuario->update();

                DB::table('model_has_roles')->where('model_id', $usuario->id)->delete();

                $usuario->assignRole(intval($request->input('e_perfil')));

                DB::commit();

                return response()->json([
                    'idnotificacion' => 1,
                    'mensaje' => 'Usuario actualizado correctamente'
                ]);
            } catch (QueryException $ex){
                DB::rollBack();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al actualizar Usuario. Intente de nuevo',
                    'error' => $ex->getLine().' -> '.$ex->getMessage()
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function destroy($id){
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                $usuario = User::findOrFail($id);
                $usuario->activo = false;
                $usuario->update();

                DB::commit();

                return response()->json([
                    'idnotificacion' => 1,
                    'mensaje' => 'Usuario desactivado correctamente'
                ]);
            } catch (QueryException $ex){
                DB::rollBack();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al desactivar Usuario. Intente de nuevo',
                    'error' => $ex->getLine().' -> '.$ex->getMessage()
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function activate($id){
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                $usuario = User::findOrFail($id);
                $usuario->activo = true;
                $usuario->update();

                DB::commit();

                return response()->json([
                    'idnotificacion' => 1,
                    'mensaje' => 'Usuario activado correctamente'
                ]);
            } catch (QueryException $ex){
                DB::rollBack();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al activar Usuario. Intente de nuevo',
                    'error' => $ex->getLine().' -> '.$ex->getMessage()
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function resetpassword($id){
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                $usuario = User::findOrFail($id);
                $usuario->password = bcrypt('DOCS2024');
                $usuario->update();

                DB::commit();

                return response()->json([
                    'idnotificacion' => 1,
                    'mensaje' => 'Contraseña restablecida correctamente'
                ]);
            } catch (QueryException $ex){
                DB::rollBack();
                return response()->json([
                    'idnotificacion' => 3,
                    'mensaje' => 'Error al restablecer contraseña. Intente de nuevo',
                    'error' => $ex->getLine().' -> '.$ex->getMessage()
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }
}
