<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ __('New Course Request') }}</title>
    <style type="text/css">
        body { margin: 0; padding: 0; min-width: 100%!important; }
        img { height: auto; }
        .content {width: 100%; max-width: 700px;}
        .innerpadding {padding: 50px; box-shadow: 0 1px 3px rgba(0,0,0,.2),0 1px 1px rgba(0,0,0,.14),0 2px 1px -1px rgba(0,0,0,.12)!important;}
        .borderbottom {border-bottom: 1px solid #f2eeed;}
        .subhead {font-size: 15px; color: #ffffff; font-family: sans-serif; letter-spacing: 10px;}
        .h1, .h2, .bodycopy {color: #153643; font-family: sans-serif;}
        .h1 {font-size: 33px; line-height: 38px; font-weight: bold;}
        .h2 {padding: 0 0 15px 0; font-size: 24px; line-height: 28px; font-weight: bold;}
        .bodycopy {font-size: 16px; line-height: 22px;}
        .button {text-align: center; font-size: 14px; font-family: sans-serif; text-transform: uppercase; font-weight: bold; padding: 0 30px 0 30px; box-shadow: 0 1px 3px rgba(0,0,0,.2),0 1px 1px rgba(0,0,0,.14),0 2px 1px -1px rgba(0,0,0,.12)!important;}
        .button a {color: #ffffff; text-decoration: none;}
        .footer {padding: 40px 0 80px 0;}
        .footercopy {font-family: sans-serif; font-size: 14px; color: #ffffff;}
        .footercopy a {color: #ffffff; text-decoration: underline;}

        @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
            body[yahoo] .hide {display: none!important;}
            body[yahoo] .buttonwrapper {background-color: transparent!important;}
            body[yahoo] .button {padding: 0px!important;}
            body[yahoo] .button a {background-color: #fdbe3c; padding: 15px 15px 13px!important;}
            body[yahoo] .unsubscribe {display: block; margin-top: 20px; padding: 10px 50px; background: #2f3942; border-radius: 5px; text-decoration: none!important; font-weight: bold;}
        }

        /*@media only screen and (min-device-width: 601px) {
        .content {width: 600px !important;}
        .col425 {width: 425px!important;}
        .col380 {width: 380px!important;}
        }*/

        table .border {
            border-collapse: collapse;
            border: 1px solid black;
        }

        table.table-content {
            table-layout: auto;
            width: 100%;
        }
  </style>
</head>

<body yahoo bgcolor="#ecf0f5">
    <table width="100%" bgcolor="#ecf0f5" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <!--[if (gte mso 9)|(IE)]>
                <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td>
                <![endif]-->
                <table class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td class="header">
                            <table align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding: 40px 0 30px 0; font-family: Open Sans, sans-serif;">
                                        <img src="{{ $message->embed(public_path('logo.png')) }}" alt="{{ settings('site_title') }}" width="80" style="display: block;" />
                                        <h1 style="font-weight: 400; color: #424242; font-size: 23px; font-family: Open Sans, sans-serif;">{{ settings('site_title') }}</h1>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="innerpadding borderbottom" bgcolor="#ffffff" style="border-radius: 3px;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="100%">
                                        <h1 style="font-weight: 400; color: #424242; font-size: 23px; font-family: Open Sans, sans-serif;">{{ __('New Course Request') }}</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding: 50px 0; font-family: Montserrat, sans-serif; margin: 0; color: #636262; font-size: 14px; font-weight: 500;">
                                        <!-- For security reasons, please help us by verifying your email address. <br> Verify within 28 days of first signing up to avoid the deactivation of <br> your account. -->

                                        <h2>{{ __("Hi, {$student->fullname}") }}!</h2>
                                        <p style="font-size: 17px;">
                                            {{ __('There is a pending request from a student for the following course') }}:</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-family: Montserrat, sans-serif; margin: 0; color: #636262; font-size: 14px; font-weight: 500;">
                                        <table class="table-content">
                                            <tbody>
                                                <tr align="left">
                                                    <th width="150px" style="font-size: 16px; padding-bottom: 10px;">
                                                        {{ __('Course Name') }}:
                                                    </th>
                                                    <td style="font-size: 16px; padding-left: 30px; padding-bottom: 10px;">
                                                        Solve Problems and Make Decisions at Supervisory Level
                                                    </td>
                                                </tr>
                                                <tr align="left">
                                                    <th width="150px" style="font-size: 16px; padding-bottom: 10px;">
                                                        {{ __('Requested by') }}:
                                                    </th>
                                                    <td style="padding-left: 30px; font-size: 16px; padding-bottom: 10px;">
                                                        {{ $student->fullname }}
                                                    </td>
                                                </tr>
                                                <tr align="left">
                                                    <th width="150px" style="font-size: 16px; padding-bottom: 10px;">
                                                        Date Request:
                                                    </th>
                                                    <td style="padding-left: 30px; font-size: 16px; padding-bottom: 10px;">
                                                        {{ $dateRequested }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding: 90px 0 20px 0;">
                                        <a
                                            href=""
                                            style="text-align: center;
                                            font-size: 15px;
                                            font-family: sans-serif;
                                            text-transform: uppercase;
                                            font-weight: bold;
                                            padding: 0 30px 0 30px;
                                            box-shadow: none !important;
                                            text-decoration: none;
                                            padding-left: 24px !important;
                                            color: #fdbe3c;
                                            height: 44px;
                                            border: 1px solid #fdbe3c;
                                            background: transparent!important;
                                            padding: 10px 20px;
                                            border-radius: 28px;"
                                            >
                                            Enroll Student
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <td class="footer">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center" class="footercopy" style="font-size: 12px; padding: 20px 0 0 0; color: #636262; font-family: Open Sans, sans-serif;">
                                    &copy; 2018 Rippl3s<br/>
                                    SSA Academy Pte Ltd
                                </td>
                            </tr>
                        </table>
                    </td>
                </table>
                <!--[if (gte mso 9)|(IE)]>
                      </td>
                    </tr>
                </table>
                <![endif]-->
            </td>
        </tr>
    </table>
</body>
</html>
