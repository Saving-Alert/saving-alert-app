<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Contact extends BaseController
{
    public function __construct()
    {
        helper('shuja'); // your custom helper for mail_me() etc.
    }

    /**
     * Display the Contact page
     */
    public function index()
    {
        // Show the contact page
        echo view('header');
        echo view('contact_us');          // The view we just updated
        echo view('footer');
        echo view('scripts/login_jax');   // Optional JS if needed
    }

    /**
     * Handle contact form submission via AJAX
     */
    public function contact_xyz()
    {
        // ❗ Only allow POST requests
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request method.'
            ]);
        }

        $postData = $this->request->getPost();

        // Validate required fields
        $requiredFields = ['form_name', 'form_email', 'form_phone', 'form_subject', 'form_message'];

        foreach ($requiredFields as $field) {
            if (empty($postData[$field])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => "The field '{$field}' is required."
                ]);
            }
        }

        // Send email using your helper function
        $mailSuccess = mail_me(
            'welfarearo@gmail.com',
            $postData['form_subject'],
            "Name: {$postData['form_name']}<br>" .
            "Email: {$postData['form_email']}<br>" .
            "Phone: {$postData['form_phone']}<br>" .
            "Message: {$postData['form_message']}"
        );

        if ($mailSuccess) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Message sent successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to send message. Please try again later.'
            ]);
        }
    }
}
