<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

// config/auth.php

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'personas',
        'hash' => false, 
    ],
],
// ... (El resto del archivo debe seguir como lo tenías)

'providers' => [
    'personas' => [
        'driver' => 'eloquent',
        'model' => App\Models\Persona::class, // DEBE apuntar al modelo Persona
    ],
],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
