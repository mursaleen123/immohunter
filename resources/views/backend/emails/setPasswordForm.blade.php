<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->




</head>

<body width="100%"
    style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly;font-family: Arial, sans-serif, 'Open Sans'; font-size: 13px;color: #000;">
    <center style="width: 100%; background-color: #fff;">
        <div
            style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <div style="max-width: 900px; margin: 0 auto;background-size: cover;background-position: center center;background-repeat: no-repeat;"
            class="email-container">
            <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                style="margin:0 auto;font-size: 15px;">
                <tbody>
                    <tr>
                        <td style="background-color: #3b5574; padding: 20px 30px; margin:0 auto; font-size: 30px; font-family: sans-serif;"
                            align="center" valign="middle">
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="background-color: #3b5574; color: #fff; padding: 0px 30px 25px; font-size: 30px; font-family: sans-serif;">
                            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0"
                                width="100%" style="margin:0 auto;font-size: 15px;">
                                <tbody>
                                    <tr>
                                        <td valign="middle"
                                            style="display: inline-block; max-width: 450px; width: 100%; margin: 0 0 20px">
                                            <a href="" style="display: inline-block; max-width: 300px">
                                                <img src="http://127.0.0.1:8000/backend_assets/images/logos/logo-img.png"
                                                    alt="IMMOHUNTER"
                                                    style="max-width: 100%; height: auto; display: block;"
                                                    align="center" valign="middle">
                                            </a>
                                        </td>
                                        <td valign="middle"
                                            style="display: inline-block; max-width: 300px; width: 100%;">
                                            <p style="margin: 0 0 10px;">
                                                <span
                                                    style="width:18px;display: inline-block;vertical-align: middle;margin:-4px 10px 0 0;"><img
                                                        src="https://portal.irccollective.com/admin/images/people.svg"
                                                        alt="" style="width: 100%; display: block"></span>
                                                Immo Hunter
                                            </p>
                                            <p style="margin: 0 0 10px;">
                                                <span
                                                    style="width:15px;display: inline-block;vertical-align: middle;margin:-4px 14px 0 0;"><img
                                                        src="https://portal.irccollective.com/admin/images/mail.svg"
                                                        alt="" style="width: 100%; display: block"></span>
                                                <a href=""
                                                    style="color: #fff; text-decoration: none">chris@irccollective.com</a>
                                            </p>
                                            <p style="margin: 0 0 10px;">
                                                <span
                                                    style="width:8px;display: inline-block;vertical-align: middle;margin:-4px 22px 0 0;"><img
                                                        src="https://portal.irccollective.com/admin/images/phone.svg"
                                                        alt="" style="width: 100%; display: block"></span>
                                                780-686-0037
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #3b5574; color: #fff; padding: 0 30px 10px; font-size: 40px; font-family: sans-serif;"
                            align="right" valign="middle">
                            Account Registration
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #fff;  font-family: sans-serif;" valign="middle">
                            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0"
                                width="100%" style="margin:0 auto;font-size: 15px;">
                                <tbody>
                                    <tr>
                                        <td style="padding: 25px 30px 5px; font-size: 16px; font-weight: bold; font-family: sans-serif;"
                                            align="right" valign="middle">
                                            {{ Carbon\Carbon::now()->format('d F Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0px 30px 25px; font-size: 16px; font-family: sans-serif;"
                                            align="left" valign="middle">
                                            Dear Employe,
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style=" padding: 0px 30px 25px; font-size: 16px; font-family: sans-serif;"
                                            align="left" valign="middle">
                                            <p style="margin: 0; line-height: 25px">Admin has registered your account on
                                                our website. Please set your password to login
                                            </p>
                                        </td>
                                    </tr>
                                    <form action="{{ route('savePassword') }}" method="GET">
                                        @csrf
                                        <tr>
                                            <td style="padding: 0px 30px 25px; font-size: 16px; font-family: sans-serif;"
                                                align="left" valign="middle">
                                                <p style="margin: 0; line-height: 25px">
                                                    <b>
                                                        <label for="username">Username: </label>
                                                        <input type="text" id="username" name="username"
                                                            required><br>
                                                        <input type="hidden" id="email" name="email"
                                                            value="{{ $email }}" readonly><br>
                                                    </b>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px 30px 25px; font-size: 16px; font-family: sans-serif;"
                                                align="left" valign="middle">
                                                <p style="margin: 0; line-height: 25px">
                                                    <b>
                                                        <label for="password">Password: </label>
                                                        <input type="password" id="password" name="password"
                                                            required><br>
                                                    </b>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0px 30px 25px; font-size: 16px; font-family: sans-serif;"
                                                align="left" valign="middle">
                                                <p style="margin: 0; line-height: 25px">
                                                    <b>
                                                        <input type="submit" value="Set Password">
                                                    </b>
                                                </p>
                                            </td>
                                        </tr>
                                    </form>
                                    <tr>
                                        <td style=" padding: 0px 30px 20px; font-size: 16px; font-family: sans-serif;"
                                            align="left" valign="middle">
                                            <p style="margin: 0; font-size: 14px; line-height: 25px;">
                                                Please contact Mursaleen Umar, Head of Operations, if you require
                                                assistance.
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style=" padding: 0px 30px 20px; font-size: 16px; font-weight: bold; font-family: sans-serif;"
                                            align="left" valign="middle">
                                            <p style="margin: 0; line-height: 25px;">Mursaleen Umar</p>
                                            <p style="margin: 0; line-height: 25px;"><a href=""
                                                    style="color: #000">mursaleen@noreply.com</a></p>
                                            <p style="margin: 0; line-height: 25px;">780-686-0037</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #3b5574; padding: 20px 30px; margin:0 auto; font-size: 30px; font-family: sans-serif;"
                            align="center" valign="middle">
                            <a href=""
                                style="display: inline-block; vertical-align: middle; width: 30px; margin: 0 5px 0 0;"><img
                                    src="https://portal.irccollective.com/email-images/web.svg" alt=""
                                    style="width: 100%; display: block;"></a>
                            <a href=""
                                style="display: inline-block; vertical-align: middle; width: 30px; margin: 0 5px 0 0;"><img
                                    src="https://portal.irccollective.com/email-images/twiter.svg" alt=""
                                    style="width: 100%; display: block;"></a>
                            <a href=""
                                style="display: inline-block; vertical-align: middle; width: 30px; margin: 0 5px 0 0;"><img
                                    src="https://portal.irccollective.com/email-images/insta.svg" alt=""
                                    style="width: 100%; display: block;"></a>
                            <a href=""
                                style="display: inline-block; vertical-align: middle; width: 30px; margin: 0 5px 0 0;"><img
                                    src="https://portal.irccollective.com/email-images/linkdin.svg" alt=""
                                    style="width: 100%; display: block;"></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </center>
</body>

</html>
