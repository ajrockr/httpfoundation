<?php

namespace Ajrockr\HttpFoundation\Http;

class Request
{
    public function __construct(
        private readonly string $method = 'GET',
        private readonly string $uri = '/',
        private readonly array $params = []
    ) {}

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}