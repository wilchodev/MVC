<?php

namespace App\Providers;


class Session
{
    public static function start()
    {
        session_start();
    }

    public static function get($key)
    {
        return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : null;
    }

    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function all()
    {
        return $_SESSION;
    }

    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public static function destroy()
    {
        session_unset();

        session_destroy();
    }
}