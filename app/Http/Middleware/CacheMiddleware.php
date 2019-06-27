<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
use App\OAuth2Client;

class CacheMiddleware
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
        if ($request->headers->has('token')){
            $token = OAuth2Client::query()->where('token', $request->headers->get('token'))->first();
            if($token && $token->isAdmin() && !$request->isMethod('get')){
                Cache::flush();
            }
        }

        return $next($request);
    }
}
