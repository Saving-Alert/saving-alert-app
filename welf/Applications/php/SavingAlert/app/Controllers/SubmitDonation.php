<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SubmitDonation extends BaseController
{
    public function __construct()
    {
        helper('shuja');
    }

    /**
     * Load blood request page
     */
    public function index()
    {
        if (!is_user_logged()) {
            return redirect()->to('/login');
        }

        if (!user_phone_verified() || !is_user_dynamic(front_user_id())) {
            return redirect()->to('/Profile');
        }

        echo view('header');
        echo view('submit_donation');   // blood request form view
        echo view('footer');
        echo view('scripts/submit_jax'); // JS loader (NO .php)
    }

    /**
     * AJAX: Submit blood request
     */
    public function submit_donation()
    {
        // ❗ Block direct access
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        if (!is_user_logged() || !is_user_dynamic(front_user_id())) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized access'
            ]);
        }

        // Get POST data safely
        $postData = $this->request->getPost();

        $location2 = 'empty_image/empty.jpg';

        // File upload (optional)
        if (isset($postData['badu_have']) && $postData['badu_have'] !== 'false') {

            $file = $this->request->getFile('file');

            if ($file && $file->isValid() && !$file->
