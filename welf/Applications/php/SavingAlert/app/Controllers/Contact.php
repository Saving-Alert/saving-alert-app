<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Contact extends BaseController
{
    public function __construct()
    {
        helper('shuja');
    }

    public function index()
    {
        echo view('header');
        echo view('contact_us');
        echo view('footer');
        echo view('scripts/login_jax');
        echo view('scripts/contact_page_script');
    }

    public function contact_xyz()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON(['success' => false]);
        }

        $postData = $this->request->getPost();

        $requiredFields = [
            'form_name',
            'form_phone',
            'form_subject',
            'form_message',
            'form_email'
        ];

        foreach ($requiredFields as $field) {
            if (empty($postData[$field])) {
                return $this->response->setJSON(['success' => false]);
            }
        }

        mail_me(
            'welfarearo@gmail.com',
            $postData['form_subject'],
            $postData['form_email'] . '<br>' .
            $postData['form_name'] . '<br>' .
            $postData['form_message'] . '<br>' .
            $postData['form_phone']
        );

        return $this->response->setJSON(['success' => true]);
    }
}
