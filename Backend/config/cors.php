<?php

return [
    'paths' => ['api/*', 'login-by-google', 'login-by-form'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost'],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
