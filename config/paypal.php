<?php
return [
  'client_id' => env('PAYPAL_CLIENT', '') ,
  'secret' => env('PAYPAL_SECRET', '') ,
    'settings' => [
        'mode' => env('PAYPAL_MODE', ''),
        'http.ConnectionTimeOut' => 30,
        'log.FileName' => storage_path(). '/logs/paypal.log',
        'log.LogLevel' => 'DEBUG'
    ]
];