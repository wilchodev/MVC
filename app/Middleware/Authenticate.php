<?php


namespace App\Middleware;


use App\Providers\Request;
use App\Providers\Session;

class Authenticate implements MiddlewareInterface
{
    public function validate(Request $request)
    {
        if ( ! Session::get('is_logged')) {
            dd('You are not logged in');
        }

    }
}