<?php

namespace App\Controllers;

class Requests extends BaseController
{
    public function __construct(){
        helper("shuja");
    }


    public function index()
    {
        echo view('header');
        echo view('requests');
        echo view('footer');
        echo view('scripts/login_jax');
        echo view('scripts/request_page_script');


    }


    public function show_req(){

        $postData = $this->request->getRawInput(true);

        if(is_user_logged()){

            if($postData["have_have"] != ""){

                $don_data = get_donation_data($postData["have_have"]);

                $req_udata = get_user_info($don_data->front_user_id);

                $data = [];

                $req_name = $req_udata->name;

                $fr_r_user_name = strlen($req_name) == 0 ? "User-00".$req_udata->id : $req_name;

                $data["success"] = true;
                $data["pub_phone"] = $don_data->public_phone;
                $data["title"] = $don_data->title;
                $data["blood_group"] = $don_data->blood_group;
                $data["desc"] = $don_data->description;
                $data["district"] = $don_data->area_1;
                $data["city"] = $don_data->area_2;
                $data["uname"] = $fr_r_user_name;
                $data["date_r"] = $don_data->rdate;
                $data["time_r"] = $don_data->rtime;

                echo json_encode($data);

            }

        }

    }

    public function accept_blood(){

        $postData = $this->request->getRawInput(true);

        if(is_user_logged() && user_phone_verified()){
            
            if($postData["have_have"] != ""){
                $data = [];

                $insertData = [
                    'donation_id' => $postData["have_have"],
                    'requester_id' => get_logged_in_user_id(), // Assuming a function that gets the logged-in user ID
                    'donator_id' => get_donator_id($postData["have_have"]), // Assuming a function to get the donator ID
                    'message' => "Please give it", // Example message
                    'rdate' => date('Y-m-d'), // Current date
                    'rtime' => date('H:i:s'), // Current time
                    'listed_donation' => 'Y', // Example value
                    'req_qty' => 1, // Example quantity
                    'approved' => 'Y' // Example approval status
                ];

                $builder->insert($insertData);

                if ($db->affectedRows() > 0) {
                    $data["success"] = true;
                    $data["message"] = "Donation accepted successfully.";
                } else {
                    $data["success"] = false;
                    $data["message"] = "Failed to accept donation.";
                }
               // $data["success"] = true;

                echo json_encode($data);

            }

        }

    }

}