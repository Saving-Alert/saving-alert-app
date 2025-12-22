<?php

namespace App\Controllers;

class RequestDonation extends BaseController
{
    public function index()
    {
        if (!is_user_logged()) {
            return redirect()->to('/');
        }

        if (!user_phone_verified()) {
            return redirect()->back()->with('error', 'Phone not verified');
        }

        if (!is_user_dynamic(front_user_id())) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        $user = get_user_info(front_user_id());
        if (!$user || $user->reciver !== 'Y') {
            return redirect()->back()->with(
                'error',
                'You must be a registered charitable organization'
            );
        }

        return view('header')
            . view('request_blood')
            . view('footer')
            . view('scripts/request_jax');
    }

    public function request_donation()
    {
        if (!is_user_logged()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
        }

        $postData = $this->request->getPost();
        if (!$postData) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid data'
            ]);
        }

        $image = 'empty_image/empty.jpg';
        $frontUserId = front_user_id();

        $model = model('App\Models\Account\DonationRequest');
        $result = $model->request_donation($postData, $image, $frontUserId);

        return $this->response->setJSON($result);
    }
}
