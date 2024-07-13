<?php

namespace Ajrockr\Httpfoundation\Http;

class Response
{
    private string $content;
    private int $statusCode;
    private array $headers;
    public function __construct(string $content = '', int $statusCode = 200, array $headers = [])
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

//    public function send(): void
//    {
//        while(ob_get_level()) {
//            ob_end_clean();
//        }
//
//        ob_start();
//
//        http_response_code($this->status);
//
//        foreach ($this->headers as $name => $value) {
//            header("$name: $value");
//        }
//
//        echo $this->content;
//
//        ob_end_flush();
//    }

    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function send(): void
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        echo $this->content;
    }
}