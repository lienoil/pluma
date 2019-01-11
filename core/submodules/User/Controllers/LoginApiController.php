<?php

namespace User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Pluma\Controllers\ApiController;
use Pluma\Support\Auth\Traits\AuthenticatesUsers;
use Pluma\Support\Validation\Traits\ValidatesRequests;
use User\Models\User;
use User\Resources\User as UserResource;

class LoginApiController extends ApiController
{
    use AuthenticatesUsers, ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.guest', ['except' => 'logout']);
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
        $this->guard()->user()->rollApiToken();

        $user = new UserResource($this->guard()->user());

        $credentials = [
            'success' => 1,
            'user' => $user,
            'token' => $user->token,
            'remember_token' => $user->remember_token,
        ];

        return $this->authenticated($request, $user)
                ?: response()->json($credentials);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->has('remember')
        );
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
