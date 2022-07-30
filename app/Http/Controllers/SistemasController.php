<?php

namespace App\Http\Controllers;

use App\sistemas;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;


class SistemasController extends Controller
{
    public function GetSistemas(){
        try {
            $get = sistemas::all();
            return $get;
        } catch (\Throwable $th) {
           log::info($th);
        }
    }

    public function PostSistemas(Request $request){
        try {
            sistemas::create($request->all());
            return true;
        } catch (\Throwable $th) {
            log::info($th);
        }
    }

    public function PutSistemas(Request $request){
        try {
            sistemas::where('id',$request->id)
            ->update(['descripcionSistema'=>$request->descripcionSistema]);
            return true;
        } catch (\Throwable $th) {
            log::info($th);
        }
    }
}
