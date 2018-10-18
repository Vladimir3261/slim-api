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
class IndexController extends ControllerBase
{
    /**
     * @param $request Request
     * @param $response Response
     * @return mixed
     */
    public function index($request, $response)
    {
        return $this->view->render($response,'index.phtml', [
            'docs' => 'https://gist.github.com/Vladimir3261/7d99366a1df21ec96cd02d66646af7cd.js'
        ]);
    }
}