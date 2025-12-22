<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Logout extends BaseController
{
    public function __construct()
    {
        helper('shuja');
    }

    public function index()
    {
        if (!is_user_logged()) {
            return redirect()->to(base_url());
        }

        session_destroy();
        return redirect()->to(base_url());
    }
}
