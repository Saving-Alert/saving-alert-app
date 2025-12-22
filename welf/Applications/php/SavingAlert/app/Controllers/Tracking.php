<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Tracking extends BaseController
{
    public function __construct()
    {
        helper('shuja');
    }

    public function index()
    {
        if (!is_user_logged()) {
            return redirect()->to('/login');
        }

        return view('header')
            . view('tracking_page')
            . view('footer')
            . view('scripts/tracking_script');
    }
}
