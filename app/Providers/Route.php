<?php

namespace App\Providers;


use InvalidArgumentException;

class Route
{
    private static $routes = [];

    private static $middleware;

    public static function __callStatic($name, $arguments)
    {
        if ( ! in_array($name, ['get', 'post'])) {
            throw new \Exception('Invalid method');
        }

        $httpMethod = $name;

        list($route, $controller) = $arguments;

        self::$routes[$route] = [
            'controller' => $controller,
            'method' => $httpMethod,
            'middleware' => (array)self::$middleware
        ];
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function middleware($list, $callback)
    {
        if ( ! is_callable($callback)) {
            throw new InvalidArgumentException('Expecting callback argument to be callable');
        }

        self::$middleware = $list;

        call_user_func($callback);

        self::$middleware = null;
    }
}