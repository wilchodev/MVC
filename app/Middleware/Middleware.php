<?php /** @noinspection ALL */


namespace App\Middleware;

use App\Providers\Request;
use App\Providers\Route;


class Middleware
{
    protected $request;

    protected $middlewareList = [
        'auth' => Authenticate::class,
        'is_adult' => IsAdult::class
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate()
    {
        $routes = Route::getRoutes();
        $requestedRouteMiddlewareList = $routes[$this->request->route()]['middleware'];

        $this->validateEach($requestedRouteMiddlewareList);
    }

    private function isMiddlewareExist($middleware)
    {
        if ( ! array_key_exists($middleware, $this->middlewareList)) {
            throw new \Exception("Invalid middleware");
        }

        return true;
    }

    private function validateEach($middlewareList)
    {
       foreach ($middlewareList as $middleware) {
           $this->isMiddlewareExist($middleware) ?: $this->getInstanceOf($middleware)->validate($this->request);
       }
    }

    private function getInstanceOf($middleware)
    {
        return (new $this->middlewareList[$middleware]);
    }
}