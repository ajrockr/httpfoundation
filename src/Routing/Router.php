<?php

namespace Ajrockr\Httpfoundation\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router
{
    private array $routes = [];

    private $dispatcher;

    public function __construct(array $controllers)
    {
        foreach ($controllers as $controller) {
            $this->addRoutesFromController($controller);
        }

        $this->dispatcher = simpleDispatcher(function(RouteCollector $r) {
            foreach ($this->routes as $route) {
                $r->addRoute($route['method'], $route['path'], $route['handler']);
            }
        });
    }

    private function addRoutesFromController(string $controller): void
    {
        try {
            $reflectionClass = new \ReflectionClass($controller);
            foreach ($reflectionClass->getMethods() as $method) {
                $attributes = $reflectionClass->getAttributes(Route::class);
                foreach ($attributes as $attribute) {
                    $route = $attribute->newInstance();
                    $this->routes[] = [
                        'method' => $route->method,
                        'path' => $route->path,
                        'handler' => [$controller, $method->getName()]
                    ];
                }
            }
        } catch (\ReflectionException $e) {

        }
    }

    public function dispatch(string $httpMethod, string $uri): void
    {
        $routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);
        match ($routeInfo[0]) {
            Dispatcher::NOT_FOUND => http_response_code(404),
            Dispatcher::METHOD_NOT_ALLOWED => http_response_code(405),
            Dispatcher::FOUND => $this->handleFound($routeInfo[1], $routeInfo[2]),
        };
    }

    public function handleFound(string $handler, array $vars): void
    {
        [$class, $method] = explode('::', $handler);
        $controller = new $class();
        call_user_func_array([$controller, $method], $vars);
    }
}