<?php

namespace App;

class Route
{
    protected static array $routes = [];

    public static function get(string $uri, callable $handler): void
    {
        self::$routes[$uri] = $handler;
    }

    public static function all(): array
    {
        return self::$routes;
    }

    public static function dispatch(): mixed
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if ($uri && $uri !== '/') {
            $uri = rtrim($uri, '/');
        }

        if (isset(self::$routes[$uri])) {
            return call_user_func(self::$routes[$uri]);
        }

        return null;
    }
}
