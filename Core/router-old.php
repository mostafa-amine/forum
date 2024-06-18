<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

function route(string $uri, array $routes)
{
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
        die();
    } else {
        abort();
    }
}

route($uri, require(basePath('routes.php')));
