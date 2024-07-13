<?php

namespace Ajrockr\Httpfoundation\Tests\Router;

use Ajrockr\Httpfoundation\Http\Request;
use Ajrockr\Httpfoundation\Routing\Router;
use Ajrockr\Httpfoundation\Tests\Router\TestControllers\TestController;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testRouting()
    {
        $router = new Router([TestController::class]);
        $request = new Request('GET', '/hello');

        $this->expectOutputString('Hello, World!');
        $router->dispatch($request->getMethod(), $request->getUri());
    }
}
