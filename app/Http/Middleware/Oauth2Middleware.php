<?php

namespace App\Http\Middleware;

use App\Oauth2Token;
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

        $token = Oauth2Token::query()->where('token', $request->get('token'))->first();

        if (! $token) {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'token not found']);
        }

        $now = new \DateTime();
        $expiredAt = $token->expired_at;

        if ($now > $expiredAt) {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'token expired']);
        }

        $minutes = config('oauth2.time_expire');
        $now->modify("+{$minutes} minutes");

        $token->expired_at = $now;
        $token->save();

        return $next($request);
    }
}
