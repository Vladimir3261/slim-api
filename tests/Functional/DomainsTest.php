<?php

namespace Tests\Functional;

/**
 * Class DomainsTest
 * @package Tests\Functional
 */
class DomainsTest extends BaseTestCase
{
    /**
     * @throws \Slim\Exception\MethodNotAllowedException
     * @throws \Slim\Exception\NotFoundException
     */
    public function testGetUsersList()
    {
        $response = $this->runApp('GET', '/user');
        $this->isOk($response)->isCorrectJson($response);

        $data = $this->decodeResponse($response);

        $this->assertEmpty($data);
    }
}