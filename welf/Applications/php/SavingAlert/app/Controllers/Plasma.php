<?php

namespace App\Controllers;

class Plasma extends BaseController
{   
    public function __construct(){
        helper("shuja");
    }

    public function index()
    {
        echo view('header');
        echo view('what_is_plasma');
        echo view('footer');
        echo view('scripts/login_jax');        


    }
}
