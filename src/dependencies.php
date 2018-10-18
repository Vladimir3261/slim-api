<?php
// DIC configuration

$container = $app->getContainer();
/**
 * view renderer
 * @param $c \Slim\Container
 * @return \Slim\Views\PhpRenderer
 */
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

/**
 * Monolog logger settings
 * @param $c \Slim\Container
 * @return \Monolog\Logger
 */
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

/**
 * @param $request \Slim\Http\Request
 * @param \Slim\Middleware\TokenAuthentication $tokenAuth
 */
$authenticator = function ($request, \Slim\Middleware\TokenAuthentication $tokenAuth) use ($container) {
    /**
     * Trying to find authorization token via header, parameters, cookie or attribute
     * If token not found, return response with status 401 (unauthorized)
     */
    $token = $tokenAuth->findToken($request);

    /**
     * Call authentication logic class
     */
    $auth = new \Application\Base\Authentication();

    /**
     * Verify if token is valid on database
     * If token isn't valid, must throw an UnauthorizedExceptionInterface
     */
    $auth->auth($token);
};

// Create Eloquent instance and load settings
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

//Create controllers
$container['\Application\Controllers\UserController'] = function ($c) {
    /**@var $c \Slim\Container */
    return new \Application\Controllers\UserController($c->get('logger'), $c->get('renderer'));
};

$container['\Application\Controllers\IndexController'] = function ($c) {
    /**@var $c \Slim\Container */
    return new \Application\Controllers\IndexController($c->get('logger'), $c->get('renderer'));
};