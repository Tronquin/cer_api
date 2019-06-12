<?php

namespace App\Http\Controllers;

use App\OAuth2Client;
use App\Service\EmailService;
use App\User;
use App\Session;
use App\Handler\Web\UpdateUserHandler;
use App\Handler\Web\SendResetPasswordEmailHandler;
use App\Handler\Web\UpdateUserPasswordHandler;
use App\Handler\SendResetPasswordEmailAdminHandler;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use CTrans;

class UserController extends Controller
{

    /**
     * Indica si una session esta activa
     *
     * @param string $token
     * @return JsonResponse
     */
    public function isAuth($token)
    {
        $now = new \DateTime();
        $session = Session::query()
            ->where('token', $token)
            ->where('expired_at', '>', $now)
            ->with(['user'])
            ->first();

        return new JsonResponse([
            'res' => $session ? 1 : 0,
            'msg' => $session ? 'Usuario autenticado' : 'Session not found',
            'data' => [
                'isAuth' => !is_null($session),
                'token' => $token,
                'email' => $session ? $session->user->email : null
            ]
        ]);
    }

    protected function index(Request $request)
    {
        return User::orderBy('id', 'desc')->paginate(15);
    }

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
        $user->phone = $data['phone'];
        $user->password = Hash::make($data['password']);
        $user->save();

        $clientIp = $request->ip();
        $minutes = config('oauth2.time_expire');
        $token = base64_encode(Hash::make($user['id'] . md5('Castro_Proyect') . $clientIp));

        $session = new Session();
        $session->user_id = $user->id;
        $session->token = $token;
        $session->remember_me = false;
        $session->expired_at = new \DateTime("+{$minutes} minutes");
        $session->save();
        $iso = $data['iso'];

        EmailService::send('email.registerUser',  CTrans::trans('email.subject.registerUser', $iso), [$user->email], compact('user', 'iso'));

        return new JsonResponse(['res' => 1, 'msg' => 'Usuario creado', 'data' => ['session' => $token]]);
    }

    protected function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return ['res' => 'Usuario Eliminado'];
    }

    protected function store(Request $request, $name, $last_name, $email, $type, $password)
    {
        $data['name'] = $name;
        $data['last_name'] = $last_name;
        $data['email'] = $email;
        $data['type'] = $type;
        $data['password'] = hash::make($password);
        return User::create($data);
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

        if (!$userExist) {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'El Usuario no existe']);
        }

        $token = $request->headers->get('token');
        $client = OAuth2Client::query()->with(['deviceType'])->where('token', $token)->first();

        if (
            ($client->deviceType->isAdmin() && ! $userExist->isAdmin()) ||
            ($client->deviceType->isWeb() && ! $userExist->isClient())
        ) {
            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'Tipo de usuario invalido']);
        }

        $userPassword = $userExist->password;

        if (!Hash::check($data['password'], $userPassword)) {
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

        return new JsonResponse(['res' => 1, 'msg' => 'Loggin Exitoso', 'data' => [
            'session' => $session->token,
            'name' => $userExist->name . ' ' . $userExist->last_name
        ]]);
    }

    /**
     * Cierra la sesion
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function logout(Request $request)
    {
        $token = $request->headers->get('session');
        Session::query()->where('token', $token)->delete();

        return new JsonResponse(['res' => 1, 'msg' => 'Logout Exitoso', 'data' => ['session' => $token]]);
    }

    /**
     * Busca los datos de un usuario.
     *
     * @param string $email
     * @return JsonResponse
     */
    protected function find($email)
    {
        $userExist = User::where('email', $email)->first();
        if (!$userExist) {
            return new JsonResponse(['res' => 0, 'msg' => 'No existe el usuario', 'data' => []]);
        }
        unset($userExist['password']);
        return new JsonResponse(['res' => 1, 'msg' => 'Datos del usuario', 'data' => $userExist]);
    }

    /**
     * Busca los datos de un usuario.
     *
     * @param Request $request
     * @param  $user_id
     * @return JsonResponse
     */
    protected function update(Request $request, $user_id)
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

    protected function updatePassword(Request $request, $user_id, $new_password)
    {
        $data = $request->all();
        $data['user_id'] = $user_id;
        $data['new_password'] = $new_password;

        $handler = new UpdateUserPasswordHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    protected function sendResetPasswordEmail(Request $request, $iso, $user_id)
    {
        $data = $request->all();
        $data['iso'] = $iso;
        $data['user_id'] = $user_id;

        $handler = new SendResetPasswordEmailHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    protected function sendResetPasswordEmailAdmin(Request $request, $user_id)
    {
        $data = $request->all();
        $data['user_id'] = $user_id;

        $handler = new SendResetPasswordEmailAdminHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
