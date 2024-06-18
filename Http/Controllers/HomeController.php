<?php

namespace Http\Controllers;

class HomeController
{
    public function index()
    {
        return view('home.index', [
            'heading' => 'Home Page'
        ]);
    }

    public function view(int $id)
    {
        return $id;
    }
}
