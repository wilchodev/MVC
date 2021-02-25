<?php

namespace App\Providers;


use App\Middleware\Middleware;

class Router
{
    public function handle(Request $request)
    {
        $namespace = 'App\Controllers\\';

        if ( ! array_key_exists($request->route(), Route::getRoutes())) {
            throw new \Exception('Route not found');
        }

        if ($request->method !== mb_strtoupper(Route::getRoutes()[$request->route()]['method'])) {
            throw new \Exception('Invalid HTTP Method for this route');
        }

        list($controller, $method) = explode('@', Route::getRoutes()[$request->route()]['controller']);

        $controller = $namespace . $controller;

        if ( ! class_exists($controller)) {
            throw new \Exception("Controller [{$controller}] does not exists");
        }

        if ( ! method_exists($controller, $method)) {
            throw new \Exception("Method [{$method}] does not exists");
        }

        $middleware = new Middleware($request);

        $middleware->validate();

        (new $controller)->$method();
    }
}