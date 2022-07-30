<?php

namespace App\Http\Controllers;

use App\accesoUsuarios;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;

class AccesoUsuariosController extends Controller
{
    public function GetAccesoUsuario(){
        try {
            $get = accesoUsuarios::all();
            return $get;
        } catch (\Throwable $th) {
            log::info($th);
        }
    }

    public function PostAccesoUsuarios(Request $request){
        try {
            accesoUsuarios::create($request->all());
            return true;
        } catch (\Throwable $th) {
            log::info($th);
        }
    }

    public function PutAccesoUsuarios(Request $request){
        try {
            accesoUsuarios::where('id',$request->id)
            ->update(['descripcionAccesoUsuarios'=>$request->descripcionAccesoUsuarios]);
            return true;
        } catch (\Throwable $th) {
            log::info($th);
        }
    }
}
