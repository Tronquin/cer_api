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
        $session = Session::where('token','=',$request->headers->get('session'))
            ->with([
                'user',
                'user.rol'
            ])
            ->first();

        if (! $session || $session->user->rol->name !== 'Admin') {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'Acceso Restringido']);
        }

        return $next($request);
    }
}
