<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mail Driver
    |--------------------------------------------------------------------------
    |
    | Laravel supports both SMTP and PHP's "mail" function as drivers for the
    | sending of e-mail. You may specify which one you're using throughout
    | your application here. By default, Laravel is setup for SMTP mail.
    |
    | Supported: "smtp", "mail", "sendmail", "mailgun", "mandrill",
    |            "ses", "sparkpost", "log"
    |
    */

    'windows_path' => env('PHANTOMJS_WNDOWS_PATH', 'PhantomJS\Builds\phantomjs-2.1.1.exe'),
    'linux_path' => env('PHANTOMJS_LINUX_PATH', 'PhantomJS/Builds/phantomjs-2.1.1'),
];
