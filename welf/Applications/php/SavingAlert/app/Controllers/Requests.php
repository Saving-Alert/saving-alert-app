<?php

namespace App\Controllers;

class Requests extends BaseController
{
    public function index()
    {
        echo view('header');
        echo view('requests');
        echo view('footer');
        echo view('scripts/login_jax');
        echo view('scripts/request_page_script');
    }

    public function show_req()
    {
        $postData = $this->request->getRawInput(true);

        if (!is_user_logged()) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not logged in']);
        }

        if (empty($postData['have_have'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $don_data = get_donation_data($postData['have_have']);
        $req_udata = get_user_info($don_data->front_user_id);

        $req_name = $req_udata->name;
        $fr_r_user_name = strlen($req_name) === 0 ? "User-00" . $req_udata->id : $req_name;

        $data = [
            'success' => true,
            'pub_phone' => $don_data->public_phone,
            'title' => $don_data->title,
            'blood_group' => $don_data->blood_group,
            'desc' => $don_data->description,
            'district' => $don_data->area_1,
            'city' => $don_data->area_2,
            'uname' => $fr_r_user_name,
            'date_r' => $don_data->rdate,
            'time_r' => $don_data->rtime
        ];

        return $this->response->setJSON($data);
    }

    public function accept_blood()
    {
        $postData = $this->request->getRawInput(true);

        if (!is_user_logged()) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not logged in']);
        }

        if (!user_phone_verified()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Phone not verified']);
        }

        if (empty($postData['have_have'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        // You can add logic to save acceptance in the database here

        return $this->response->setJSON(['success' => true]);
    }
}
