<?php
return [
    'settings' => [
        'version' => '1.0.0',
        'displayErrorDetails' => getenv('mode') === 'dev' ? true : false, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        // Database connection config
        'db' => [
            'driver' => 'mysql',
            'host' => getenv('db_host'),
            'database' => getenv('db_name'),
            'username' => getenv('db_user'),
            'password' => getenv('db_password'),
            'charset' => getenv('db_encoding'),
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ],
    ],
];