<?php

namespace Ajrockr\Httpfoundation\Http;

class Response
{
    public function __construct(
        private string $content = '',
        private int $status = 200
    ) {}

    public function send(): void
    {
        http_response_code($this->status);
        echo $this->content;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}