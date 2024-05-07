<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\CtgDistrito;
use App\Models\CtgCentrosTrabajo;
use App\Models\CtgArea;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getDistritos($id = 0){
        if ($id == 0) {
            $distritos = CtgDistrito::where('activo', true)->orderBy('name', 'asc')->get();
        } else {
            $distritos = CtgDistrito::where('activo', true)->where('id', $id)->orderBy('name', 'asc')->get();
        }
        return $distritos;
    }

    public function getCentrosTrabajo($id = 0){
        if ($id == 0) {
            $centros_trabajo = CtgCentrosTrabajo::where('activo', true)->orderBy('name', 'asc')->get();
        } else {
            $centros_trabajo = CtgCentrosTrabajo::where('activo', true)->where('id_distrito', $id)->whereNotNull('siglasfolio_genera')
                ->whereNotNull('lugarfirma_genera')->orderBy('name', 'asc')->get();
        }
        return $centros_trabajo;
    }

    public function checkUsername($username = ''){
        $usuario = User::where('name', strtoupper($username))->first();
        if ($usuario) {
            return response()->json(['notificacion' => 2, 'mensaje' => 'El nombre de usuario ya existe.']);
        } else {
            return response()->json(['notificacion' => 1, 'mensaje' => 'El nombre de usuario está disponible.']);
        }
    }
}
