<?php

namespace App\Controllers\Login;
use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        // If already logged in → go home
        if ($this->session->get('front_logged_in')) {
            return redirect()->to('/');
        }

        helper(['form', 'url']);

        // POST: handle email submit
        if ($this->request->getMethod() === 'post') {

            $rules = [
                'user_email' => 'required|valid_email'
            ];

            if (!$this->validate($rules)) {
                return view('login/login', [
                    'validation' => $this->validator
                ]);
            }

            $email = $this->request->getPost('user_email');

            $loginData = model('App\Models\Login\FrontLoginModel')
                            ->login_validate($email);

            if ($loginData['valid']) {

                $this->session->set([
                    'front_valid'          => true,
                    'front_id'             => $loginData['id'],
                    'front_email'          => $loginData['email'],
                    'front_active'         => $loginData['active'],
                    'front_dynamic_login'  => $loginData['dyanmic'],
                    'front_logged_in'      => false
                ]);

                // ✅ Redirect to OTP verify page
                return redirect()->to(base_url('login/verify'));
            }
        }

        // GET: show login page
        return view('login/login');
    }
}
