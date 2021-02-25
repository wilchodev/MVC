<?php


namespace App\Core;


use App\Providers\Request;
use App\Providers\Session;

class Bootstrap
{
    public function runApplication()
    {
        require '../app/routes/routes.php';

        Session::start();

        $router = new \App\Providers\Router();
        $request = new Request();

        $router->handle($request);
    }
}