<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Tracking extends BaseController
{

    public function __construct(){
        helper("shuja");
    }

    public function index()
    {

        if(is_user_logged()){

            echo view('header');
            echo view('tracking_page');
            echo view('footer');
            echo view('scripts/tracking_script');
            echo view('scripts/tracking_script_ar');
            

        }


    }
    public function accept_donation()
    {
        $postData = $this->request->getRawInput(true);

        if (is_user_logged()) {
            $data = array(
                'approved' => 'Y',
            );
            $this->db->where('id', $postData["app_id"]);
            $this->db->update('front_claims', $data);

            $data2 = array(
                'last_donate_data' => date('Y-m-d'),
            );
            $this->db->where('donator_id', $postData["user_id"]);
            $this->db->update('front_users', $data2);
        }

    }

    public function reject_donation()
    {
        $postData = $this->request->getRawInput(true);

        if (is_user_logged()) {
            $data = array(
                'reject' => 'R',
            );
            $this->db->where('id', $postData["app_id"]);
            $this->db->update('users', $data);
        }

    }
}
