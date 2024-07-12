<?php

namespace Ajrockr\Httpfoundation\Tests\Request;

use Ajrockr\Httpfoundation\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testRequest()
    {
        $request = new Request('POST', '/test', ['key' => 'value']);

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/test', $request->getUri());
        $this->assertEquals(['key' => 'value'], $request->getParams());
    }
}
