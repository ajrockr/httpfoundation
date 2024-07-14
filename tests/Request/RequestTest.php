<?php

namespace Tests\Request;

use Ajrockr\HttpFoundation\Http\Request;
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
