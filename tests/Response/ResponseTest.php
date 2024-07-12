<?php

namespace Ajrockr\Httpfoundation\Tests\Response;

use Ajrockr\Httpfoundation\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testResponse()
    {
        $response = new Response('Test content', 200);

        $this->expectOutputString('Test content');
        $response->send();

        $this->assertEquals(200, http_response_code());
    }
}
