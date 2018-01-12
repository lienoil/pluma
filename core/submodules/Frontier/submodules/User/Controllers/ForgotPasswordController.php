<?php

namespace User\Controllers;

use Pluma\Controllers\Controller;
use Pluma\Support\Auth\Password\Traits\SendsPasswordResetEmailsTrait;

class ForgotPasswordController extends Controller
{
   /**
    *---------------------------------------------------------------------------
    * Password Reset Controller
    *---------------------------------------------------------------------------
    *
    * This controller is responsible for handling password reset emails and
    * includes a trait which assists in sending these notifications from
    * your application to your users.
    *
    */

    use SendsPasswordResetEmailsTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('Theme::passwords.forgot');
    }
}
