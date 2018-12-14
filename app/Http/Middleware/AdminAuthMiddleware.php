<?php

namespace App\Http\Middleware;

use App\Session;
use Closure;
use Illuminate\Http\JsonResponse;

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
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'Acceso Restringido'], 403);
        }

        return $next($request);
    }
}
