<?php

namespace Ajrockr\Httpfoundation\Tests\Router\TestControllers;

use Ajrockr\Httpfoundation\Controller\BaseController;
use Ajrockr\Httpfoundation\Http\Response;
use Ajrockr\Httpfoundation\Routing\Route;

class TestController extends BaseController
{
    #[Route(method: 'GET', path: '/hello')]
    public function hello(): Response
    {
        return $this->response('Hello, World!');
    }
}