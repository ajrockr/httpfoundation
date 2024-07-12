<?php

namespace Ajrockr\Httpfoundation\Tests\Helpers;

use Ajrockr\Httpfoundation\Http\UrlHelper;
use PHPUnit\Framework\TestCase;

class UrlHelperTest extends TestCase
{
    public function testUrlHelper() {
        $_SERVER['HTTPS'] = 'on';
        $_SERVER['HTTP_HOST'] = 'example.com';
        $_SERVER['REQUEST_URI'] = '/test';

        $this->assertEquals('https://example.com/test', UrlHelper::currentUrl());
        $this->assertEquals('https://example.com', UrlHelper::baseUrl());
        $this->assertEquals('https://example.com/path', UrlHelper::url('/path'));
    }
}
