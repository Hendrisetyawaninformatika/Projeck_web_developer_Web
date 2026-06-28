<?php

return [
    'default' => env('FIREBASE_PROJECT', 'app'),
    
    'projects' => [
        'app' => [
            'project_id' => env('FIREBASE_PROJECT_ID'),
            'private_key_id' => env('FIREBASE_PRIVATE_KEY_ID', null),
            'private_key' => env('FIREBASE_PRIVATE_KEY', null),
            'client_email' => env('FIREBASE_CLIENT_EMAIL', null),
            'client_id' => env('FIREBASE_CLIENT_ID', null),
            'client_x509_cert_url' => env('FIREBASE_CLIENT_X509_CERT_URL', null),
            'credentials' => env('FIREBASE_CREDENTIALS'),
            'database' => [
                'url' => env('FIREBASE_DATABASE_URL'),
            ],
            'storage' => [
                'bucket' => env('FIREBASE_STORAGE_BUCKET'),
            ],
        ],
    ],
];