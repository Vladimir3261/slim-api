<?php

namespace Tests\Functional;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 */
class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Use middleware when running application?
     *
     * @var bool
     */
    protected $withMiddleware = true;

    /**
     * Process application requests
     *
     * @param $requestMethod
     * @param $requestUri
     * @param null $requestData
     * @return \Psr\Http\Message\ResponseInterface|Response
     * @throws \Slim\Exception\MethodNotAllowedException
     * @throws \Slim\Exception\NotFoundException
     */
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        $env = new \Symfony\Component\Dotenv\Dotenv();
        $env->load(__DIR__ . '/../../.env-test');

        // Create a mock environment for testing with
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        // Set up a response object
        $response = new Response();

        // Use the application settings
        $settings = require __DIR__ . '/../../src/settings.php';

        // Instantiate the application
        $app = new App($settings);

        // Set up dependencies
        require __DIR__ . '/../../src/dependencies.php';

        // Register middleware
        if ($this->withMiddleware) {
            require __DIR__ . '/../../src/middleware.php';
        }

        // Register routes
        require __DIR__ . '/../../src/routes.php';

        // Process the application
        $response = $app->process($request, $response);

        // Return the response
        return $response;
    }

    /**
     * Check if response return's correct json data
     * @param Response $response
     */
    protected function isCorrectJson(Response $response)
    {
        $this->assertEquals('application/json;charset=utf-8', $response->getHeaderLine('Content-type'));
        $this->assertJson((string)$response->getBody());
    }

    /**
     * Decode response json
     * @param Response $response
     * @return mixed
     */
    protected function decodeResponse(Response $response)
    {
        $data = json_decode((string)$response->getBody(), true);
        $this->assertNotNull($data);
        return $data;
    }

    /**
     * Http status code is 200
     * @param Response $response
     * @return $this
     */
    protected function isOk(Response $response)
    {
        $this->assertEquals(200, $response->getStatusCode());
        return $this;
    }

    /**
     * Http status code is 200
     * @param Response $response
     * @return $this
     */
    protected function isCreated(Response $response)
    {
        $this->assertEquals(201, $response->getStatusCode());
        return $this;
    }

    /**
     * Http status code is 200
     * @param Response $response
     * @return $this
     */
    protected function isDeleted(Response $response)
    {
        $this->assertEquals(204, $response->getStatusCode());
        return $this;
    }

    /**
     * Http status code is 400
     * @param Response $response
     * @return $this
     */
    protected function isBadRequest(Response $response)
    {
        $this->assertEquals(400, $response->getStatusCode());
        return $this;
    }

    /**
     * Http status code is 404
     * @param Response $response
     * @return $this
     */
    protected function isNotFound(Response $response)
    {
        $this->assertEquals(404, $response->getStatusCode());
        return $this;
    }

    /**
     * Http status code is 403
     * @param Response $response
     * @return $this
     */
    protected function isAccessDenied(Response $response)
    {
        $this->assertEquals(403, $response->getStatusCode());
        return $this;
    }

    /**
     * Http status code is 405
     * @param Response $response
     * @return $this
     */
    protected function isMethodNotAllowed(Response $response)
    {
        $this->assertEquals(405, $response->getStatusCode());
        return $this;
    }

    /**
     *  Internal server error. This method shouldn't be called
     * because 500 error isn't the normal state of application.
     * Http status code is 500
     *
     * @param Response $response
     * @return $this
     */
    protected function isServerError(Response $response)
    {
        $this->assertEquals(500, $response->getStatusCode());
        return $this;
    }

    /**
     * Empty method for skip warnings
     */
    public function test()
    {
    }
}
