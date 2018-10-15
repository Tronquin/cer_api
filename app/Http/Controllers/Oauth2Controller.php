<?php

namespace App\Http\Controllers;

use App\OAuth2Client;
use App\Oauth2Token;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Oauth2Controller extends Controller
{
    /**
     * Genera un nuevo token por 10 minutos
     *
     */
    public function token($clientId, $secretId)
    {
        $oauth2Client = OAuth2Client::query()->where('client_id', $clientId)->where('secret_id', $secretId)->first();

        if (! $oauth2Client) {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'Client not found']);
        }

        $minutes = config('oauth2.time_expire');

        $token = new Oauth2Token();
        $token->token = md5(uniqid());
        $token->oauth2_client_id = $oauth2Client->id;
        $token->expired_at = new \DateTime("+{$minutes} minutes");
        $token->save();

        return new JsonResponse(['res' => 1, 'msg' => 'Token generated', 'data' => $token->token]);
    }
}
