<?php

namespace Core;

class Hash
{
    public static function make(string $value): string
    {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    public static function check(string $value, string $hashedValue): bool
    {
        return password_verify($value, $hashedValue);
    }
}
