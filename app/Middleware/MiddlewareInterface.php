<?php

namespace App\Middleware;


use App\Providers\Request;

interface MiddlewareInterface
{
    public function validate(Request $request);
}