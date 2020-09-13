<?php

return [
    'routes' => [
        // site common
        '/' => [
            'method' => 'GET',
        ],
        
        // auth
        '/auth/register-form' => [
            'method' => 'GET',
        ],
        '/auth/register' => [
            'method' => 'POST',
        ],
        '/auth/activate' => [
            'method' => 'GET', // TODO: POST
        ],
        '/auth/login-form' => [
            'method' => 'GET',
        ],
        '/auth/login' => [
            'method' => 'POST',
        ],
        '/auth/forgot-password-form' => [
            'method' => 'GET',
        ],
        '/auth/send-reset-password-email' => [
            'method' => 'POST',
        ],
        '/auth/reset-password-form' => [
            'method' => 'GET',
        ],
        '/auth/reset-password' => [
            'method' => 'POST',
        ],
        '/auth/logout' => [
            'method' => 'GET', // TODO: POST
        ],
        
        // admin
        '/admin/dashboard' => [
            'method' => 'GET',
        ],
        '/admin/profile' => [
            'method' => 'GET',
        ],
        '/admin/profile-update' => [
            'method' => 'POST',
        ],
    ],
];
