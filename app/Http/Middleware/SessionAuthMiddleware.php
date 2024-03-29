<?php

namespace App\Http\Middleware;

use App\Session;
use App\OAuth2Client;
use Closure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class SessionAuthMiddleware
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
        $type = OAuth2Client::query()->where('token', $request->headers->get('token'))->first();

        if ($type->deviceType->code === 'machine') {
            return $next($request);
        }

        if (! $request->headers->has('session')) {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'session is required'], 403);
        }

        $session = Session::query()->where('token', $request->headers->get('session'))->first();

        if (! $session) {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'session not found'], 403);
        }

        $now = new \DateTime();
        $expiredAt = $session->expired_at;

        if ($now > $expiredAt) {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'session expired'], 403);
        }

        $clientIp = $request->ip();
        $minutes = config('oauth2.time_expire');
        
        $sessionToken = base64_decode($session->token);
        $tokenSend = $session->user_id . md5('Castro_Proyect') . $clientIp;

        if (! Hash::check($tokenSend, $sessionToken))
        {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'Session Invalida']);
        }

        $now->modify("+{$minutes} minutes");

        $session->expired_at = $now;
        $session->save();

        return $next($request);
    }
}
