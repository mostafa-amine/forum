<?php

namespace Core;

class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function set(string $key, mixed $value): self
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    public function get(string $key)
    {
        if (!$this->has($key)) {
            return null;
        }
        return $_SESSION[$key];
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function remove(string $key)
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function clear()
    {
        session_unset();
    }
}
