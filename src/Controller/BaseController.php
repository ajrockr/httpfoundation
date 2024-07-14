<?php

namespace Ajrockr\HttpFoundation\Controller;

use Ajrockr\HttpFoundation\Http\Response;
use Ajrockr\HttpFoundation\Http\UrlHelper;

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