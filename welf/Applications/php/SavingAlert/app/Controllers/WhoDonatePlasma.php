<?php

namespace App\Controllers;

class WhoDonatePlasma extends BaseController
{   
    public function __construct(){
        helper("shuja");
    }

    public function index()
    {
        echo view('header');
        echo view('who_can_donate_plasma');
        echo view('footer');
        echo view('scripts/login_jax');        


    }
}
