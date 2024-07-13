<?php

namespace Ajrockr\Httpfoundation\Routing;

use Ajrockr\Httpfoundation\Http\Response;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use ReflectionClass;
use ReflectionException;
use function FastRoute\simpleDispatcher;

class Router
{
    private array $routes = [];

    private Dispatcher $dispatcher;

    /**
     * @throws ReflectionException
     */
    public function __construct(array $controllers)
    {
        foreach ($controllers as $controller) {
            $this->addRoutesFromController($controller);
        }

        foreach ($this->routes as $route) {
            echo "Registered Route: Method - {$route['method']}, Path - {$route['path']}, Handler - " . implode('::', $route['handler']) . PHP_EOL;
        }

        $this->dispatcher = simpleDispatcher(function(RouteCollector $r) {
            foreach ($this->routes as $route) {
                $r->addRoute($route['method'], $route['path'], $route['handler']);
            }
        });
    }

    /**
     * @throws ReflectionException
     */
    private function addRoutesFromController(string $controller): void
    {
        try {
            $reflectionClass = new ReflectionClass($controller); // this is failing to call my Tests/Router/TestControllers/TestController

            foreach ($reflectionClass->getMethods() as $method) {
                $attributes = $reflectionClass->getAttributes(Route::class);
                foreach ($attributes as $attribute) {
                    // var Route $route
                    $route = $attribute->newInstance();
                    $this->routes[] = [
                        'method' => $route->method,
                        'path' => $route->path,
                        'handler' => [$controller, $method->getName()]
                    ];
                }
            }
        } catch (ReflectionException $e) {
            throw new ReflectionException($e->getMessage());
        }
    }

    public function dispatch(string $httpMethod, string $uri): void
    {
        $routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);

        ob_start();

        $response = match ($routeInfo[0]) {
            Dispatcher::NOT_FOUND => $this->handleNotFound(),
            Dispatcher::FOUND => $this->handleFound($routeInfo[1], $routeInfo[2]),
            Dispatcher::METHOD_NOT_ALLOWED => $this->handleMethodNotAllowed(),
        };

        $output = ob_get_clean();

        if ($response instanceof Response) {
            $response->setContent($response->getContent() . $output);
            $response->send();
        } else {
            echo $output;
        }
    }

    private function handleFound(string $handler, array $vars): Response
    {
//        [$class, $method] = explode('::', $handler);
        [$class, $method] = $handler;
        $controller = new $class();
        return call_user_func_array([$controller, $method], $vars);
    }

    private function handleNotFound(): Response
    {
        return new Response('404 Not Found', 404);
    }

    private function handleMethodNotAllowed(): Response
    {
        return new Response('405 Method Not Allowed', 405);
    }
}