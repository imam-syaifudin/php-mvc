<?php

use App\Core\Router;
use App\Helpers\Session;

function route(string $name, array $params = null): string
{
    $route = Router::getRoutes()->get($name);

    if (!$route) throw new Exception("Route $name not found");

    $pattern = '/\{([a-zA-Z0-9_]+)\}/';

    $result = preg_replace_callback($pattern, function ($matches) use ($params) {
        $key = $matches[1];
        return $params[$key] ?? null;
    }, $route->getPath());

    return $result;
}

function dd(mixed $data, bool $die = true): void
{
    if ($die) die();
}

function sessionHas(string $key)
{
    if( Session::has($key) ) return true;
    return false;
}

function session(string $key)
{
    if (Session::has($key)) {
        $session = Session::get($key);
        Session::delete($key);
        return $session;
    }

    return false;
}
