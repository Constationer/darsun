<?php

return [
    'midtrans' => [
        'serverKey'     => env('MIDTRANS_SERVERKEY'),
        'clientKey'     => env('MIDTRANS_CLIENTKEY'),
        'isProduction'  => env('MIDTRANS_IS_PRODUCTION', false),
        'isSanitized'   => env('MIDTRANS_IS_SANITIZED', true),
        'is3ds'         => env('MIDTRANS_IS_3DS', true),
    ]
];
