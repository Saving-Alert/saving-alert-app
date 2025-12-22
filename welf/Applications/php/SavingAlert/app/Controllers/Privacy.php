<?php

namespace App\Controllers;

class Privacy extends BaseController
{
    public function index()
    {
        return view('header')
            . view('privacy_policy')
            . view('footer')
            . view('scripts/login_jax');
    }
}
