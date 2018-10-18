<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

// Parse .env file
$env = new \Symfony\Component\Dotenv\Dotenv();
$env->load(__DIR__.'/../.env');

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

try {
// Run app
    $app->run();
} catch (\Exception $e) {
    header('Content-type: application/json');
    echo json_encode([
        'error' => 'Something went wrong on processing request',
        'message' => $e->getMessage()
    ]);
}