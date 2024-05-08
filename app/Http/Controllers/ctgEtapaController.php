<?php

namespace App\Http\Controllers;

use App\Models\CtgEtapa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\User;
use Exception;

class ctgEtapaController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $etapas = CtgEtapa::all();
            return View::make('administracion.CtgEtapa.index', compact('etapas'));
        } else {
            return redirect()->to('/');
        }
    }

    public function create(){
        if (Auth::check()) {
            return View::make('administracion.CtgEtapa.create-Etapa');
        } else {
            return redirect()->to('/');
        }
    }

    public function guardarEtapa(Request $request){
        if(Auth::check())
        {
            try
            {
                // dd($request->all());
                $etapa = new CtgEtapa();
                $etapa->nombreEtapa = $request->input('etapa');
                $etapa->activo = 1;
                $etapa->save();

                DB::commit();
                return response()->json([
                    'mensaje' => 'Etapa Guardada con éxito',
                    'idnotificacion' => 1
                ]);
            }catch(Exception $e){
                DB::rollBack();
                return response()->json([
                    'mensaje' => 'Error al guardar',
                    'idnotificacion' => 3
                ]);
            } 
        }else {
            return redirect()->to('/');
        }
    }
}
