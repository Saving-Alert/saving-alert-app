<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Location extends BaseController
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

        echo view('header');
        echo view('location_page');
        echo view('footer');
        echo view('scripts/submit_jax.php');
        echo view('scripts/location_script.php');
    }

    public function submit_location()
    {
        if (!is_user_logged()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $postData = $this->request->getPost();
        $lat      = $postData['loc_lat'] ?? null;
        $long     = $postData['loc_long'] ?? null;

        if (empty($lat) || empty($long)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid coordinates']);
        }

        // Currently just echoing values (original behavior)
        echo $lat . ' -- ' . $long;
    }

    public function verify_phone()
    {
        if (!is_user_logged()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $postData = $this->request->getPost();
        $phone    = $postData['phone_number'] ?? null;

        if (empty($phone) || strlen($phone) !== 10) {
            return $this->response->setJSON([
                'success' => 'invalid',
                'message' => 'Invalid Number'
            ]);
        }

        if (user_phone_verified() && get_phone_number() === $phone) {
            return $this->response->setJSON([
                'success' => 'true',
                'message' => 'This Phone Number Is Already Verified'
            ]);
        }

        // Check if phone exists for non-dynamic login users
        $db      = \Config\Database::connect();
        $builder = $db->table('front_users');
        $builder->where([
            'phone_number'  => $phone,
            'dynamic_login' => 'N'
        ]);

        if ($builder->countAllResults() > 0) {
            $db->table('front_users')
               ->where('id', front_user_id())
               ->update(['dynamic_login' => 'N']);

            return $this->response->setJSON(['success' => true, 'message' => 'Phone already in use']);
        }

        send_mobile_otp($phone);

        return $this->response->setJSON([
            'success' => 'otp',
            'message' => 'OTP Sent To: ' . $phone
        ]);
    }

    public function confirm_otp()
    {
        if (!is_user_logged()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $postData = $this->request->getPost();
        $otp      = $postData['ot_otp_ot'] ?? null;
        $phone    = $postData['phone_number'] ?? null;

        if (empty($otp)) {
            return $this->response->setJSON(['success' => false, 'message' => 'OTP missing']);
        }

        if (session()->get('mobile_otp') !== $otp) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid OTP']);
        }

        $db = \Config\Database::connect();
        $db->table('front_users')
           ->where('id', front_user_id())
           ->update([
               'phone_number'   => $phone,
               'phone_verified' => 'Y'
           ]);

        return $this->response->setJSON(['success' => true]);
    }

    public function save_name_s()
    {
        if (!is_user_logged()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $postData = $this->request->getPost();
        $name     = $postData['my_name_is'] ?? null;

        if (empty($name)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Name missing']);
        }

        $db = \Config\Database::connect();
        $db->table('front_users')
           ->where('id', front_user_id())
           ->update(['name' => $name]);

        return $this->response->setJSON(['success' => true]);
    }
}
