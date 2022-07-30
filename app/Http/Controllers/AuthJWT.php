<?php

namespace App\Http\Controllers;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthJWT extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate($request->token);
            //$user = JWTAuth::parseToken()->authenticate();
            log::info($user);
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                $refreshed = JWTAuth::refresh(JWTAuth::getToken());
                $user = $refreshed;
                return  $user;
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                log::info(response()->json(['success'=> false,'status' => 'Token is Invalid'],401));
                return false;
            }else{
                log::info(response()->json(['success'=> false,'status' => 'Authorization Token not found'],401));
                return false;
            }
        }
    }
}
