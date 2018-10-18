<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
// Now default parameter is 'Bearer' in authorization header.
$app->add(new \Slim\Middleware\TokenAuthentication([
    'path' =>   '/api',
    'authenticator' => $authenticator,
    'secure' => false, // This param should be true only when SSL enabled
]));