<?php

namespace Ajrockr\Httpfoundation\Tests\Router;

use Ajrockr\Httpfoundation\Http\Request;
use Ajrockr\Httpfoundation\Routing\Router;
use Ajrockr\Httpfoundation\Tests\Router\TestControllers\TestController;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    public function testRouting()
    {
        $router = new Router([TestController::class]);
        $request = new Request('GET', '/hello');

        ob_start();
        $router->dispatch($request->getMethod(), $request->getUri());
        $output = ob_end_clean();

        $this->assertEquals('Hello, World!', $output);
    }
}
