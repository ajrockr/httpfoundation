<?php

namespace Tests\Router;

use Ajrockr\HttpFoundation\Http\Request;
use Ajrockr\HttpFoundation\Routing\Router;
use PHPUnit\Framework\TestCase;
use Tests\Controller\TestController;

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
