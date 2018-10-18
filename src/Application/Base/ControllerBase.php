<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 4/17/17
 * Time: 3:20 PM
 */
namespace Application\Base;
use Monolog\Logger;
use Slim\Views\PhpRenderer;

/**
 * Parent controller class for all controllers in this system
 * Class ControllerBase
 * @package Application\Base
 */
class ControllerBase
{
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_SERVER_ERROR = 500;

    /**
     * Log errors and debug data
     * @var Logger
     */
    protected $logger;

    /**
     * @var $view PhpRenderer
     */
    protected $view;

    /**
     * DI setter
     * ControllerBase constructor.
     * @param $logger Logger
     * @param $renderer PhpRenderer
     */
    public function __construct(Logger $logger, PhpRenderer $renderer)
    {
        $this->logger = $logger;
        $this->view = $renderer;
    }
}