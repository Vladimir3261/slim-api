<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 5/30/18
 * Time: 10:23 PM
 */

namespace Application\Base;

use Slim\Middleware\TokenAuthentication\UnauthorizedExceptionInterface;
use Exception;

/**
 * Class UnauthorizedException
 * @package Application\Base
 */
class UnauthorizedException extends Exception implements UnauthorizedExceptionInterface
{

}