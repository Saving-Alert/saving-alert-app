<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Requests extends BaseController
{
    /**
     * Load blood requests page
     */
    public function index()
    {
        return view('header')
            . view('requests')
            . view('footer')
            . view('scripts/login_jax')
            . view('scripts/request_page_script');
    }

    /**
     * AJAX: Show single blood request details
     */
    public function show_req()
    {
        // Allow only AJAX requests
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        if (!is_user_logged()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not logged in'
            ]);
        }

        // donation_have = donation ID
        $donationId = $this->request->getPost('donation_have');

        if (!$donationId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $donation = get_donation_data((int) $donationId);
        if (!$donation) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Donation not found'
            ]);
        }

        $user = get_user_info($donation->front_user_id);
        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not found'
            ]);
        }

        // Display name fallback
        $username = empty($user->name)
            ? 'User-00' . $user->id
            : $user->name;

        return $this->response->setJSON([
            'success'     => true,
            'pub_phone'   => $donation->public_phone,
            'title'       => $donation->title,
            'blood_group' => $donation->blood_group,
            'desc'        => $donation->description,
            'district'    => $donation->area_1,
            'city'        => $donation->area_2,
            'uname'       => $username,
            'date_r'      => $donation->rdate,
            'time_r'      => $donation->rtime
        ]);
    }

    /**
     * AJAX: Accept blood request
     */
    public function accept_blood()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        if (!is_user_logged()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not logged in'
            ]);
        }

        if (!user_phone_verified()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Phone not verified'
            ]);
        }

        $donationId = $this->request->getPost('donation_have');

        if (!$donationId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        /**
         * Acceptance logic can be added here later
         * (claims table / notifications)
         */

        return $this->response->setJSON([
            'success' => true
        ]);
    }
}
