<?php

namespace App\Http\Middleware;

use App\Session;
use App\OAuth2Client;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Http\Middleware\Oauth2Middleware;
use App\Http\Middleware\SessionAuthMiddleware;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //DB::enableQueryLog();
       
        $rol = Session::where('token','=',$request->headers->get('session'))->first()->user->rol->name;

        //$queries = DB::getQueryLog();
        if ($rol !== 'Admin') {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'Acceso Restringido']);
        }

        return $next($request);
    }
}
