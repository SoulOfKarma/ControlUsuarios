<?php

namespace App\Http\Controllers;

use App\servicios;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;

class ServiciosController extends Controller
{
    public function GetServicios(){
        try {
            $get = Servicios::all();
            return $get;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    public function PostServicios(Request $request){
        try {
            Servicios::create($request->all());
            return true;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    public function PutServicio(Request $request){
        try {
            Servicios::where('id',$request->id)
            ->update(['descripcionServicio' => $request->descripcionServicio]);
            return true;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }
}
