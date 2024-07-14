<?php

namespace Tests\Controller;

use Ajrockr\HttpFoundation\Controller\BaseController;
use Ajrockr\HttpFoundation\Http\Response;
use Ajrockr\HttpFoundation\Routing\Route;

class TestController extends BaseController
{
    #[Route(method: 'GET', path: '/hello')]
    public function hello(): Response
    {
        return $this->response('Hello, World!');
    }
}