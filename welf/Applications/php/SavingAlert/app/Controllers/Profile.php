<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function __construct()
    {
        helper('shuja');
    }

    /**
     * Load profile page
     */
    public function index()
    {
        if (!is_user_logged()) {
            return redirect()->to('/login');
        }

        return view('header')
            . view('profile_page')
            . view('footer')
            . view('scripts/submit_jax')
            . view('scripts/profile_page_script');
    }

    /**
     * AJAX: Send OTP to verify phone number
     */
    public function verify_phone()
    {
        if (!is_user_logged()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized access'
            ]);
        }

        $postData = $this->request->getPost();
        $phone    = $postData['phone_number'] ?? '';

        if (empty($phone) || strlen($phone) !== 10) {
            return $this->response->setJSON([
                'success' => 'invalid',
                'message' => 'Invalid phone number'
            ]);
        }

        // Already verified
        if (user_phone_verified() && get_phone_number() === $phone) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'This phone number is already verified'
            ]);
        }

        $db = \Config\Database::connect();

        // Check if phone number already exists (non-dynamic users)
        $exists = $db->table('front_users')
            ->where('phone_number', $phone)
            ->where('dynamic_login', 'N')
            ->get()
            ->getNumRows();

        if ($exists > 0) {
            // Prevent conflict with existing account
            $db->table('front_users')
                ->where('id', front_user_id())
                ->update(['dynamic_login' => 'N']);

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Phone number already in use'
            ]);
        }

        // Send OTP
        send_mobile_otp($phone);

        return $this->response->setJSON([
            'success' => 'otp',
            'message' => 'OTP sent to ' . $phone
        ]);
    }

    /**
     * AJAX: Confirm OTP
     */
    public function confirm_otp()
    {
        if (!is_user_logged()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
        }

        $postData = $this->request->getPost();
        $otp      = $postData['ot_otp_ot'] ?? '';
        $phone    = $postData['phone_number'] ?? '';

        if (empty($otp) || empty($phone)) {
            return $this->response->setJSON(['success' => false]);
        }

        if (session()->get('mobile_otp') !== $otp) {
            return $this->response->setJSON(['success' => false]);
        }

        $db = \Config\Database::connect();

        $db->table('front_users')
            ->where('id', front_user_id())
            ->update([
                'phone_number'  => $phone,
                'phone_verified'=> 'Y'
            ]);

        return $this->response->setJSON(['success' => true]);
    }

    /**
     * AJAX: Save personal profile details
     */
    public function save_name_s()
    {
        if (!is_user_logged()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
        }

        $postData = $this->request->getPost();

        $requiredFields = ['my_name_is', 'nic', 'dob', 'weight', 'height'];
        foreach ($requiredFields as $field) {
            if (empty($postData[$field])) {
                return $this->response->setJSON(['success' => false]);
            }
        }

        $db = \Config\Database::connect();

        $db->table('front_users')
            ->where('id', front_user_id())
            ->update([
                'name'        => $postData['my_name_is'],
                'nic'         => $postData['nic'],
                'dob'         => $postData['dob'],
                'gender'      => $postData['gender'] ?? null,
                'blood_group' => $postData['blood_type'] ?? null,
                'weight'      => $postData['weight'],
                'height'      => $postData['height']
            ]);

        return $this->response->setJSON(['success' => true]);
    }
}
