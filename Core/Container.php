<?php

namespace Core;

class Container
{
    public array $bindings = [];

    public function bind(string $key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    public function make(string $key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception('No Binding Found For ' . $key);
        }
        return call_user_func($this->bindings[$key]);
    }
}
