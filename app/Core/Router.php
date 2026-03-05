<?php

declare(strict_types=1);

/**
 * Router minimalista con soporte para rutas estaticas y parametros dinamicos.
 */

namespace App\Core;

class Router
{
    /** @var array<int, array<string, mixed>> */
    private array $routes = [];
    private string $basePath = '';

    public function setBasePath(string $basePath): void
    {
        $this->basePath = rtrim($basePath, '/');
    }

    public function get(string $path, array $handler, array $middlewares = []): void
    {
        $this->addRoute('GET', $path, $handler, $middlewares);
    }

    public function post(string $path, array $handler, array $middlewares = []): void
    {
        $this->addRoute('POST', $path, $handler, $middlewares);
    }

    private function addRoute(string $method, string $path, array $handler, array $middlewares = []): void
    {
        $normalizedPath = $this->basePath . '/' . ltrim($path, '/');
        $pattern = $this->convertPathToRegex($normalizedPath);

        $this->routes[] = [
            'method' => strtoupper($method),
            'pattern' => $pattern,
            'handler' => $handler,
            'middlewares' => $middlewares,
        ];
    }

    private function convertPathToRegex(string $path): string
    {
        $pattern = preg_quote($path, '#');
        $pattern = preg_replace('/\\\{([a-zA-Z_][a-zA-Z0-9_]*)\\\}/', '(?P<$1>[^/]+)', $pattern);
        return '#^' . $pattern . '$#';
    }

    public function match(string $method, string $uri): ?array
    {
        $method = strtoupper($method);
        $path = $this->cleanUri($uri);

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if (!preg_match($route['pattern'], $path, $matches)) {
                continue;
            }

            $params = [];
            foreach ($matches as $key => $value) {
                if (is_string($key)) {
                    $params[$key] = $value;
                }
            }

            return [
                'handler' => $route['handler'],
                'params' => $params,
                'middlewares' => $route['middlewares'],
            ];
        }

        return null;
    }

    private function cleanUri(string $uri): string
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        $path = '/' . trim($path, '/');

        if ($this->basePath && strpos($path, $this->basePath) === 0) {
            $path = substr($path, strlen($this->basePath));
            $path = '/' . trim((string) $path, '/');
        }

        return $path === '/' ? '/' : rtrim($path, '/');
    }
}
