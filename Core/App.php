<?php

namespace Core;

class App
{
    public static $container;

    public static function setContainer($container)
    {
        self::$container = $container;
    }

    public static function make(string $key)
    {
        return self::$container->make($key);
    }
}
