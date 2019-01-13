<?php

namespace User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Pluma\Controllers\ApiController;
use Pluma\Support\Auth\Traits\AuthenticatesUsers;
use Pluma\Support\Validation\Traits\ValidatesRequests;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use User\Models\User;
use User\Resources\User as UserResource;

class LoginApiController extends ApiController
{
    use AuthenticatesUsers, ValidatesRequests;

    /**
     * The JWT value of the current user.
     *
     * @var string
     */
    protected $token;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.guest', ['except' => 'logout']);

        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);
        // $this->guard()->user()->rollApiToken();

        $user = new UserResource($this->guard()->user());

        $credentials = [
            'success' => 1,
            'user' => $user,
            'token' => JWTAuth::getToken(),
            'remember_token' => $user->remember_token,
        ];

        return response()->json($credentials);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function login(Request $request)
    {
        if (! $token = JWTAuth::attempt($this->credentials($request))) {
            return response()->json([
                'error' => 'invalid_credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->sendLoginResponseWithToken($token);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponseWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'success' => 1,
            'user' => $user = new UserResource($this->guard()->user()),
            'token_type' => 'bearer',
        ]);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            'success' => 0,
            $this->username() => [Lang::get('auth.failed')]
        ], 422);
    }
}
