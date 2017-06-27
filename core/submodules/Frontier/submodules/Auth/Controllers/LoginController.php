<?php

namespace Auth\Controllers;

use Pluma\Controllers\Controller;
use Pluma\Support\Auth\Traits\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Redirect path.
     *
     * @var string
     */
    protected $redirectPath = '/admin/login';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Logout path.
     *
     * @var string
     */
    protected $logoutPath = '/admin/logout';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth.guest', ['except' => 'logout']);

        $this->logoutPath = config('admin.slug.logout', $this->logoutPath);

        $this->redirectPath = config('admin.slug.login', $this->redirectPath);

        $this->redirectTo = config('admin.slug.dashboard', $this->redirectTo);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('Auth::auth.login');
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        return $this->redirectPath;
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect($this->logoutPath);
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
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        if ($this->guard()->attempt(
            ['username' => $request->account, 'password' => $request->password], $request->has('remember')
        )) {
            return true;
        }

        if ($this->guard()->attempt(
            ['email' => $request->account, 'password' => $request->password], $request->has('remember')
        )) {
            return true;
        }

        return false;
    }
}
