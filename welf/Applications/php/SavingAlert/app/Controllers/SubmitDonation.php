<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SubmitDonation extends BaseController
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

        if (!user_phone_verified() || !is_user_dynamic(front_user_id())) {
            return redirect()->to('/Profile');
        }

        return view('header')
            . view('submit_donation')
            . view('footer')
            . view('scripts/submit_jax'); // JS loader
    }

    public function submit_donation()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        if (!is_user_logged() || !is_user_dynamic(front_user_id())) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $postData = $this->request->getPost();
        $image = 'empty_image/empty.jpg';
        $frontUserId = front_user_id();

        $model = model('App\Models\Account\DonationRequest');
        $result = $model->request_donation($postData, $image, $frontUserId);

        return $this->response->setJSON($result);
    }
}
