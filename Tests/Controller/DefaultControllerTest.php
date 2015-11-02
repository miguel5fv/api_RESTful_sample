<?php

namespace Restful\SampleBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $apiResponse    = $client->request('GET', '/hello/Fabien');
        $jsonExpected   = json_encode(array(
            'name'      => 'Fabian',
            '_self'     => $apiResponse->getUri()
        ));
        $this->assertEquals(
            Response::HTTP_CREATED,
            $apiResponse->getResponse()->getStatusCode(),
            'Expects to recieved a 200 ok status code'
        );
        $this->assertEquals(
            $jsonExpected,
            $apiResponse->getResponse()->getContent(),
            'Expects the exact Json encoded array content'
        );
    }

    public function testIndexWithoutParameters()
    {
        $client = static::createClient();

        $apiResponse = $client->request('GET', '/hello/');

        $this->assertEquals(
            Response::HTTP_NOT_FOUND,
            $apiResponse->getResponse()->getStatusCode(),
            'Expects 404 not found status code'
        );
        $this->assertEmpty(
            $apiResponse->getResponse()->getContent(),
            'Expects empty content'
        );
    }

    public function testIndexWithWrongMethod()
    {
        $client = static::createClient();

        $apiResponse = $client->request('DELETE', '/hello/fabian');

        $this->assertEquals(
            Response::HTTP_NOT_IMPLEMENTED,
            $apiResponse->getResponse()->getStatusCode(),
            'Expects a 501 method not implemented status code because delete is not implemented');
        $this->assertEmpty($apiResponse->getResponse()->getContent());
    }
}
