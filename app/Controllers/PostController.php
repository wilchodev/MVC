<?php


namespace App\Controllers;


use App\Providers\Session;

class PostController
{
    public function index()
    {
        dd(Session::all());
        echo 'Posts';
    }
}