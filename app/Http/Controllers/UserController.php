<?php

namespace App\Http\Controllers;

use App\OAuth2Client;
use App\Service\EmailService;
use App\User;
use App\Rol;
use App\Session;
use App\Reservation;
use App\Handler\Web\UpdateUserHandler;
use App\Handler\Web\SendResetPasswordEmailHandler;
use App\Handler\Web\UpdatePasswordHandler;
use App\Handler\SendResetPasswordEmailAdminHandler;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;
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
        $users = User::orderBy('id', 'desc')->with(['roles'])->get();

        return new JsonResponse([
            'res' => count($users),
            'data' => $users,
            'msg' => 'Lista de usuarios'
        ]);
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
            if($userExist->hasRole('Admin')){
                $role_user = Rol::where('name', 'User')->first();
                $userExist->roles()->attach($role_user);

                return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'El Admin ya es Usuario']);
            }

            return new JsonResponse(['res' => 0, 'data' => [], 'msg' => 'El Usuario ya existe']);
        }

        $user = new User();
        $user->name = $data['name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->password = Hash::make($data['password']);
        $user->save();
        $role_user = Rol::where('name', 'User')->first();
        $user->roles()->attach($role_user);

        $clientIp = $request->ip();
        $minutes = config('oauth2.time_expire');
        $token = base64_encode(Hash::make($user['id'] . md5('Castro_Proyect') . $clientIp));

        $session = new Session();
        $session->user_id = $user->id;
        $session->token = $token;
        $session->remember_me = false;
        $session->expired_at = new \DateTime("+{$minutes} minutes");
        $session->save();
        
        $tempPassword = $request->password;
        $iso = $data['iso'];

        EmailService::send('email.registerUser',  CTrans::trans('email.subject.registerUser', $iso), [$user->email], compact('user', 'iso', 'tempPassword'));

        return new JsonResponse(['res' => 1, 'msg' => 'Usuario creado', 'data' => [
            'token' => [
                'session' => $token,
                'name' => $user->name . ' ' . $user->last_name
            ]
        ]]);
    }

    protected function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach($user->roles);
        
        $session = Session::query()->where('user_id',$user->id)->first();
        
        if($session)
        $session->delete();
        
        $reservation = Reservation::query()->where('user_id',$user->id)->first();

        if($reservation)
        return ['res' => 'Error. El usuario tiene una reserva registrada y no se ha podido eliminar'];

        $user->delete();
        return ['res' => 'Usuario Eliminado'];
    }

    protected function store(Request $request)
    {
        $data['name'] = $request->name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        /* $data['rol_id'] = $request->type; */
        $data['password'] = hash::make($request->password);
        $user = User::create($data);

        $user_roles = [];
        foreach($request->type as $rol){
            $user_roles[] = $rol['id'];
        }
        $user->roles()->sync($user_roles);
        return $user;
    }

    public function updateAdmin(Request $request, $userId)
    {
        $user = User::query()->where('id',$userId)->with('roles')->first();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        /* $user->rol_id = $request->type; */

        if ($request->has('password') && ! empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user_roles = [];
        foreach($request->type as $rol){
            $user_roles[] = $rol['id'];
        }

        $user->roles()->sync($user_roles);
        $user->save();

        return [
            'res' => 1,
            'msg' => 'Usuario actualizado',
            'data' => $user
        ];
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
        /* $user->roles()->attach($data['role_id']); */
        /* $user->rol_id = $data['role_id']; */
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
            ($client->deviceType->isAdmin() && ! $userExist->hasRole('Admin')) ||
            ($client->deviceType->isWeb() && ! $userExist->hasRole('User'))
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

    protected function updatePassword(Request $request, $iso, $user_id, $new_password)
    {
        $data = $request->all();
        $data['lang'] = $iso;
        $data['user_id'] = $user_id;
        $data['new_password'] = $new_password;

        $handler = new UpdatePasswordHandler($data);
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

    protected function checkToken($token)
    {
        $expToken = false;
        $secret = env('SECRET');
        $decoded = JWT::decode($token, $secret, array('HS256'));
        $date = new \DateTime();
        $expiredTime = (new \DateTime())->setTimestamp($decoded->timestamp)->modify('+15 minutes');
    
        if($date > $expiredTime){
            $expToken = true;
            return new JsonResponse(['res' => 0, 'msg' => 'Token Expired!!', 'tokenStatus' => $expToken]);
        }
    
        return new JsonResponse(['res' => 1, 'msg' => 'Valid Token!!', 'tokenStatus' => $expToken]);
    }
}
