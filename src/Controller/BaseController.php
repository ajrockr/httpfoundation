<?php

namespace Ajrockr\Httpfoundation\Controller;

use Ajrockr\Httpfoundation\Http\Response;
use Ajrockr\Httpfoundation\Http\UrlHelper;

class BaseController
{
    public function redirect(string $url, int $statusCode = 302): void
    {
        UrlHelper::redirect($url, $statusCode);
    }

    public function response(string $content, int $status = 200): Response
    {
        return new Response($content, $status);
    }
}