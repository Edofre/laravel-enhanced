<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    // auth.register
    'register' => [
        'register'         => 'Registreer',
        'name'             => 'Naam',
        'email_address'    => 'E-Mail adres',
        'password'         => 'Wachtwoord',
        'confirm_password' => 'Bevestig wachtwoord',
    ],

    // auth.login
    'login'    => [
        'login'                => 'Login',
        'email_address'        => 'E-Mail adres',
        'password'             => 'Wachtwoord',
        'remember_me'          => 'Herinner mij',
        'forgot_your_password' => 'Wachtwoord vergeten?',
    ],

    // auth.passwords.email
    'email'    => [
        'reset_password'           => 'Reset wachtwoord',
        'email_address'            => 'E-Mail adres',
        'send_password_reset_link' => 'Stuur wachtwoord resetlink',
    ],

    // auth.passwords.reset
    'reset'    => [
        'reset_password'   => 'Reset wachtwoord',
        'email_address'    => 'E-Mail adres',
        'password'         => 'Wachtwoord',
        'confirm_password' => 'Bevestig wachtwoord',
    ],

    // General
    'general'  => [
        'login'             => 'Login',
        'register'          => 'Registreer',
        'logout'            => 'Logout',
        'you_are_logged_in' => 'U bent ingelogd!',
    ],

    // Error messages
    'failed'   => 'Deze gegevens komen niet overeen met onze data.',
    'throttle' => 'Te veel inlog pogingen. Probeer het na :seconds seconden weer.',

];
