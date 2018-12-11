<?php

namespace App\Http\Controllers;

use App\User;
use App\Session;
use App\Handler\Web\UpdateUserHandler;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request $request
     * @return JsonResponse
     */
    protected function create(Request $request)
    {
        $data = $request->all();
        $userExist = User::query()->where('email', $data['email'])->first();

        if ($userExist) {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'El Usuario ya existe']);
        }

        $user = new User();
        $user->name = $data['name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return new JsonResponse(['res' => 1, 'msg' => 'Usuario creado', 'data' => $user->email]);
    }

    /**
     * Create a new user by rol.
     *
     * @param  Request $request
     * @return JsonResponse
     */
    protected function createByRol(Request $request)
    {
        $data = $request->all();
        $userExist = User::query()->where('email', $data['email'])->first();

        if ($userExist) {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'El Usuario ya existe']);
        }

        $user = new User();
        $user->name = $data['name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->rol_id = $data['rol_id'];
        $user->save();

        return new JsonResponse(['res' => 1, 'msg' => 'Usuario creado', 'data' => $user->email]);
    }

    /**
     * Create a new session instance after a valid login.
     *
     * @param  Request $request
     * @return JsonResponse
     */

    protected function login(Request $request)
    {
        $data = $request->all();
        
        $userExist = User::query()->where('email', $data['email'])->first();

        if (! $userExist) {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'El Usuario no existe']);
        }
        
        $userPassword = $userExist->password;

        if (! Hash::check($data['password'], $userPassword))
        {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'La contraseña es incorrecta']);
        }
        
        $sessionExist = Session::query()->where('user_id', $userExist['id'])->delete();

        $clientIp = $request->ip();
        $minutes = config('oauth2.time_expire');
        $token = base64_encode(Hash::make($userExist['id'] . md5('Castro_Proyect') . $clientIp));

        $session = new Session();
        $session->user_id = $userExist['id'];
        $session->token = $token;
        $session->remember_me = false;
        $session->expired_at = new \DateTime("+{$minutes} minutes");
        $session->save();

        return new JsonResponse(['res' => 1, 'msg' => 'Loggin Exitoso', 'data' => $session->token]);
    }

    /**
     * Busca los datos de un usuario.
     *
     * @param  $id
     * @return JsonResponse
     */
    protected function find($id)
    {
        $userExist = User::find($id);
        if(!$userExist){
            return new JsonResponse(['res' => 0, 'msg' => 'No existe el usuario', 'data' => []]);
        }
        unset($userExist['password']);
        return new JsonResponse(['res' => 1, 'msg' => 'Datos del usuario', 'data' => $userExist]);
    }

    /**
     * Busca los datos de un usuario.
     *
     * @param Request $request
     * @param  $id
     * @return JsonResponse
     */
    protected function update(Request $request,$user_id)
    {
        $data = $request->all();
        $data['user_id'] = $user_id;

        $handler = new UpdateUserHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

}
