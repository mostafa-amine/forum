<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Validator;

$container = new Container();

$container->bind(Database::class, function () {
    return new Database(config('database'));
});

App::setContainer($container);
