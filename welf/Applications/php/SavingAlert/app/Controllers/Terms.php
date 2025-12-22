<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Terms extends BaseController
{
    public function index()
    {
        return view('header')
            . view('terms_and_cond')
            . view('footer')
            . view('scripts/login_jax');
    }
}
