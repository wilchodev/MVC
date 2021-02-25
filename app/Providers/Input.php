<?php

namespace App\Providers;


class Input
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function get($key)
    {
        return array_key_exists($key, $this->request) ? $this->request[$key] : null;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->request) ? true : false;
    }

}