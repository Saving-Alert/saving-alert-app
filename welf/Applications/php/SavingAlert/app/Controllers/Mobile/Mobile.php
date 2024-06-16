<?php

namespace App\Controllers\Mobile;
use App\Controllers\BaseController;

class Mobile extends BaseController
{

    public function __construct(){
        helper("shuja");
    }

    public function index()
    {

        $request_id = $this->request->getGet("reqid");
        $get_uuid = $this->request->getGet("uuid");

        $data = [];

        $data["request_id"] = $request_id;
        $data["get_uuid"] = $get_uuid;


        echo view("Mobile/sms_page", $data);



    }


    public function approve_sms(){



        $postData = $this->request->getRawInput(true);

        echo "ff";

        if (!empty($postData['reqid']) && !empty($postData['get_uuid']) ) {

            echo "--ff";

            $db = \Config\Database::connect();
            $builder = $db->table("front_claims");

            $insertData = [
                'donation_id' => $postData["reqid"],
                'requester_id' => get_donation_data($postData["reqid"])->front_user_id,
                'donator_id' => $postData['get_uuid'],
                'message' => "Please give it",
                'rdate' => date('Y-m-d'),
                'rtime' => date('H:i:s'),
                'listed_donation' => 'Y',
                'req_qty' => 1,
                'approved' => 'N'
            ];


            $builder->insert($insertData);


        }





    }



}
