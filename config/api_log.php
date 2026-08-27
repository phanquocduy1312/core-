<?php

return [
    'enabled' => (bool) env('API_LOG_ENABLED', true),

    'body_limit' => (int) env('API_LOG_BODY_LIMIT', 4096),

    'ignored_routes' => [
        'up',
        'api.docs',
    ],

    'extra_redacted_fields' => [
        'vnp_securehash',
        'signature',
    ],
];
