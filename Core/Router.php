<?php

namespace Core;

class Router
{
    private static $routes = [];

    public static function get(string $path, array $options)
    {
        self::$routes['GET'][$path] = $options;
    }

    public static function post(string $path, array $options)
    {
        self::$routes['POST'][$path] = $options;
    }

    public static function dispatch()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes[$requestMethod] as $path => $options) {
            if ($path === $requestUri) {
                $controller = new $options[0]();
                $method = $options[1];
                return $controller->$method();
            }
        }
        abort();
    }
}
