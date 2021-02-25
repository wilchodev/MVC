<?php

namespace App\Controllers;


use App\Models\User;

class TestController
{
    public function index()
    {
        $users = User::all();
        
        dd($users);
    }

    public function show($id)
    {

    }
}