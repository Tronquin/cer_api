<?php

namespace App\Http\Middleware;

use App\OAuth2Client;
use Closure;
use Illuminate\Http\JsonResponse;

class Oauth2Middleware
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
        if (! $request->has('token')) {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'token is required']);
        }

        $token = OAuth2Client::query()->where('token', $request->get('token'))->first();

        if (! $token) {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'token not found']);
        }

        return $next($request);
    }
}
