<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 4/17/17
 * Time: 3:10 PM
 */
namespace Application\Controllers;

use Application\Base\ControllerBase;
use Application\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class AppController
 * @package Application\Controllers
 */
class UserController extends ControllerBase
{
    /**
     * @param $request Request
     * @param $response Response
     * @return mixed
     */
    public function get($request, $response)
    {
        return $response->withJson(User::all(), static::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return User|Response
     * @throws \Exception
     */
    public function create(Request $request, Response $response)
    {
        $user = new User();

        $user->fill($request->getParsedBody());

        $user->token = md5(bin2hex(random_bytes(10)));

        if ($user->save()) {
            return $response->withJson($user, static::HTTP_CREATED);
        } else {
            return $response->withJson(['message' => 'Something went wrong'], static::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return User|Response
     */
    public function update(Request $request, Response $response)
    {
        $user = User::find(['id' => (int)$request->getAttribute('id')])->first();

        $user->fill($request->getParsedBody());

        if ($user->save()) {
            return $response->withJson($user, static::HTTP_OK);
        } else {
            return $response->withJson(['message' => 'Something went wrong'], static::HTTP_FORBIDDEN);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return User|Response
     */
    public function delete(Request $request, Response $response)
    {
        $user = User::find(['id' => (int)$request->getAttribute('id')])->first();

        if ($user && $user->delete()) {
            return $response->withStatus(204);
        } else {
            return $response->withJson(['message' => 'You cant remove this user'], static::HTTP_FORBIDDEN);
        }
    }
}