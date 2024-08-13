<?php

namespace App\Helpers;

session_start();

class Session {

    public static function set(string $type = '', $message): void
    {
        $_SESSION[$type] = $message;
    }

    public static function has(string $key): bool
    {
        if( isset($_SESSION[$key]) ){
            return true;
        }

        return false;
    }

    public static function get(string $key)
    {
        if( static::has($key) ){
            return $_SESSION[$key];
        }
    }

    public static function delete(string $key): void
    {
        unset($_SESSION[$key]);
    }

}