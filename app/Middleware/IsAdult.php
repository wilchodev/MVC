<?php

namespace App\Middleware;


use App\Providers\Request;

class IsAdult implements MiddlewareInterface
{
    public function validate(Request $request)
    {
        if(19 < 18) {
            dd('Not adult..');
        }
    }
}