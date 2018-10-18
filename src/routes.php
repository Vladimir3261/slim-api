<?php
// Index page
$app->get('/', '\Application\Controllers\IndexController:index');
// Secure route
$app->get('/api', function (\Slim\Http\Request $request, \Slim\Http\Response $response) {
    return $response->withJson(['user' => \Application\Base\Authentication::user()]);
});

// Example users endpoint
$app->post('/user', '\Application\Controllers\UserController:create');
$app->get('/user', '\Application\Controllers\UserController:get');
$app->put('/user/{id}', '\Application\Controllers\UserController:update');
$app->delete('/user/{id}', '\Application\Controllers\UserController:delete');