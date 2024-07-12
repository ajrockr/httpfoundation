<?php

namespace Ajrockr\Httpfoundation\Tests\Router\TestControllers;

use Ajrockr\Httpfoundation\Controller\BaseController;
use Ajrockr\Httpfoundation\Http\Response;

class TestController extends BaseController
{
    public function hello()
    {
        $response = new Response('Hello, World!');
        $response->send();
    }
}