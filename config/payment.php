<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default PAYMENT Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default hash driver that will be used to hash
    | passwords for your application. By default, the bcrypt algorithm is
    | used; however, you remain free to modify this option if you wish.
    |
    | Supported: "bcrypt", "argon", "argon2id"
    |
    */

    'key' => env('APP_STRIPE_KEY', 'key'),

];
