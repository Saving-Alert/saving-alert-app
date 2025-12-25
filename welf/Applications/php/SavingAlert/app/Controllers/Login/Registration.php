<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Register extends BaseController
{
    public function index()
    {
        helper(['form', 'url']);

        if($this->request->getMethod() == 'post'){
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email|is_unique[front_users.email]',
                'password' => 'required|min_length[6]'
            ];

            if($this->validate($rules)){
                $model = model('App\Models\Login\FrontLoginModel');

                $data = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
                ];

                $model->insert_user($data);

                return redirect()->to(base_url('login'));
            }else{
                return view('register', ['validation' => $this->validator]);
            }
        }

        return view('register');
    }
}
