<?php

namespace App\Providers;


class Request
{
    public $method;

    public $uri;

    public $request;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->request = new Input($_REQUEST);
    }

    public function route()
    {
        $route = explode('/', $this->uri)[3];

        return $route;
    }
}