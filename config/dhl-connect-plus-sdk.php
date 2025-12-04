<?php

return [
    'url' => env('DHL_CONNECT_PLUS_SDK_BASE_URL', 'https://external.dhl.es/cimapi/api/v1/customer'),
    'auth' => [
        'username' => env('DHL_CONNECT_PLUS_SDK_USERNAME', 'Username2025'),
        'password' => env('DHL_CONNECT_PLUS_SDK_PASSWORD', 'Password312'),
        'customer_id' => env('DHL_CONNECT_PLUS_SDK_CUSTOMER_ID', '00-111000'),
    ],
];
