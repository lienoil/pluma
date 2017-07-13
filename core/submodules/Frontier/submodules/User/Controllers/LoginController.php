<?php

namespace User\Controllers;

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
     * Redirect path upon successful login.
     *
     * @var string
     */
    protected $redirectPath = '/admin/dashboard';

    /**
     * Where to redirect users on failed login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/login';

    /**
     * Redirect path upon successful logout.
     *
     * @var string
     */
    protected $logoutPath = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth.guest', ['except' => 'logout']);

        $this->logoutPath = config('admin.slug.logout', $this->logoutPath);

        $this->redirectPath = config('admin.slug.dashboard', $this->redirectPath);

        $this->redirectTo = config('admin.slug.login', $this->redirectTo);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('User::auth.login.login');
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
            [$this->username() => $request->username, 'password' => $request->password], $request->has('remember')
        )) {
            return true;
        }

        if ($this->guard()->attempt(
            ['username' => $request->username, 'password' => $request->password], $request->has('remember')
        )) {
            return true;
        }

        if ($this->guard()->attempt(
            ['email' => $request->username, 'password' => $request->password], $request->has('remember')
        )) {
            return true;
        }

        return false;
    }
}
