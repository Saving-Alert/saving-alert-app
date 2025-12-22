<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class RequestDonation extends BaseController
{
    /**
     * Load blood request form
     */
    public function index()
    {
        if (!is_user_logged()) {
            return redirect()->to('/');
        }

        if (!user_phone_verified()) {
            return redirect()->back()->with('error', 'Phone number not verified');
        }

        if (!is_user_dynamic(front_user_id())) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        $user = get_user_info(front_user_id());

        // Only registered organizations can request blood
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

    /**
     * AJAX: Submit blood request
     */
    public function request_donation()
    {
        // Block non-AJAX access
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        if (!is_user_logged()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
        }

        $postData = $this->request->getPost();

        if (empty($postData)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid data'
            ]);
        }

        // Default image for blood requests
        $imagePath = 'empty_image/empty.jpg';
        $frontUserId = front_user_id();

        // Delegate business logic to model
        $model = model('App\Models\Account\DonationRequest');
        $result = $model->request_donation(
            $postData,
            $imagePath,
            $frontUserId
        );

        return $this->response->setJSON($result);
    }
}
