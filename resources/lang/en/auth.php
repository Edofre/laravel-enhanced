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
        'register'         => 'Register',
        'name'             => 'Name',
        'email_address'    => 'E-Mail address',
        'password'         => 'Password',
        'confirm_password' => 'Confirm password',
    ],

    // auth.login
    'login'    => [
        'login'                => 'Login',
        'email_address'        => 'E-Mail address',
        'password'             => 'Password',
        'remember_me'          => 'Remember me',
        'forgot_your_password' => 'Forgot your password?',
    ],

    // auth.passwords.email
    'email'    => [
        'reset_password'           => 'Reset password',
        'email_address'            => 'E-Mail address',
        'send_password_reset_link' => 'Send password reset link',
    ],

    // auth.passwords.reset
    'reset'    => [
        'reset_password'   => 'Reset password',
        'email_address'    => 'E-Mail address',
        'password'         => 'Password',
        'confirm_password' => 'Confirm password',
    ],

    // General
    'general'  => [
        'login'             => 'Login',
        'register'          => 'Register',
        'logout'            => 'Logout',
        'you_are_logged_in' => 'You are logged in!',
    ],

    // Error messages
    'failed'   => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
];
