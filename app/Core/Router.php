<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, callable $callback): void
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $methodRoutes = $this->routes[$method] ?? [];

        foreach ($methodRoutes as $route => $callback) {
            $pattern = preg_replace('#\{[a-zA-Z_][a-zA-Z0-9_]*\}#', '([a-zA-Z0-9_-]+)', $route);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); 
                echo json_encode(call_user_func_array($callback, $matches));
                return;
            }
        }

        http_response_code(404);
        echo json_encode(["error" => "Not Found"]);
    }
}
