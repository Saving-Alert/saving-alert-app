<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ClaimDonation extends BaseController
{
    public function __construct()
    {
        helper('shuja');
    }

    public function index()
    {
        if (!is_user_logged()) {
            return $this->response->setJSON(['success' => false]);
        }

        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON(['success' => false]);
        }

        $postData = $this->request->getPost();

        $donationId = $postData['don_id'] ?? null;
        $message    = $postData['message'] ?? '';

        if (empty($donationId)) {
            return $this->response->setJSON(['success' => false]);
        }

        // Already claimed check
        if (claim_check(front_user_id(), $donationId)) {
            return $this->response->setJSON(['success' => false]);
        }

        // Phone verification check
        if (!user_phone_verified()) {
            return $this->response->setJSON([
                'phone'   => true,
                'message' => 'You must verify your phone number to claim donations'
            ]);
        }

        $db = \Config\Database::connect();
        $builder = $db->table('front_claims');

        $builder->insert([
            'donation_id'    => $donationId,
            'requester_id'   => front_user_id(),
            'donator_id'     => get_donator_id($donationId),
            'message'        => $message,
            'rdate'          => date('Y-m-d'),
            'rtime'          => date('H:i:s'),
            'listed_donation'=> 'Y',
            'req_qty'        => '1',
            'approved'       => 'N',
        ]);

        return $this->response->setJSON(['success' => true]);
    }
}
