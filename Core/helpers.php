<?php

use Core\Response;

function dd(mixed $value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function urlIs(string $url)
{
    return $_SERVER['REQUEST_URI'] === $url;
}

function abort(int $code = 404)
{
    http_response_code($code);

    require "views/error/{$code}.view.php";

    die();
}

function config(string $key): array
{
    $config = require(basePath('Core/config.php'));

    if (!array_key_exists($key, $config)) {
        return [];
    }

    return $config[$key];
}

function authorise(bool $condition, string $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function basePath(string $path)
{
    return BASE_PATH . $path;
}

function view(string $view, array $data = [])
{
    $extractedViewPath = explode('.', $view);
    $path = implode('/', $extractedViewPath);
    extract($data);
    require(basePath('views/' . $path . '.view.php'));
}
