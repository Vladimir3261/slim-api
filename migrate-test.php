<?php
$env = new \Symfony\Component\Dotenv\Dotenv();
$env->load(__DIR__.'/.env-test');

return [
    'paths' => [
        'migrations' => 'migrations'
    ],
    'migration_base_class' => '\Application\Migration\Migration',
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => getenv('db_name'),
        getenv('db_name') => [
            'adapter' => 'mysql',
            'host' => getenv('db_host'),
            'name' => getenv('db_name'),
            'user' => getenv('db_user'),
            'pass' => getenv('db_password'),
            'port' => getenv('db_port')
        ]
    ]

];