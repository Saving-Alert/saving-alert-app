<?php

namespace App\Controllers;

class RequestDonation extends BaseController
{

    public function __construct(){
        helper("shuja");
    }

    public function index()
    {

        if(is_user_logged()){

            if(user_phone_verified() && is_user_dynamic(front_user_id())  ){

                $veri_pps = get_user_info(front_user_id())->reciver;

                if($veri_pps == "Y"){

                    echo view('header');
                    echo view('request_blood');
                    echo view('footer');
                    echo view('scripts/request_jax.php');

                }else{
                    echo '<script>alert("You must be a registerd member to submit donation requests"); history.back();</script>';
                }


            }



        }





    }


    public function request_donation(){

        if(is_user_logged()){

            $postData = $this->request->getVar(null);

            $location = "";

            $location2 = "empty_image/empty.jpg";

            // if($postData["badu_have"] != "false"){

            //     if($_FILES['file']['name'] != ''){
            //         $test = explode('.', $_FILES['file']['name']);
            //         $extension = end($test);
            //         $name = uniqid().rand(100,999).'.'.$extension;

            //         $location = '/home/welf/domains/welfarearo/uploads/'.$name;

            //         $location2 = $name;

            //             if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){

            //             }
            //     }

            // }

            $front_uid = $this->session->get('front_id');

            $submit_mod = model("App\Models\Account\DonationRequest", false);

            $ret_data = $submit_mod->request_donation($postData, $location2, $front_uid);


            //alert users

            if($postData["urgency_level"] == "Emergency"){

                $calc_mod = model("App\Models\Calc\CalcDistance", false);

                $all_users = get_all_front_users();

                $users_nearby = [];

                foreach($all_users as $one_user){

                    if($one_user->loc_lat != "" && $one_user->loc_long != "" && $one_user->phone_number != "" && $one_user->blood_type != ""
                        && $one_user->diseases != "" && $one_user->diseases == "None" && $one_user->health_status != "" && $one_user->health_status == "None" && $one_user->bmi_value >= 18.5){

                        $logic_true = false;

                        $cur_logged_id = front_user_id();
                        $cur_user_data = get_user_info($cur_logged_id);

                        $hospital_lat = $cur_user_data->loc_lat;
                        $hospital_long = $cur_user_data->loc_long;

                        $one_user_lat = $one_user->loc_lat;
                        $one_user_long = $one_user->loc_long;

                        $km = $calc_mod->calcuser($hospital_lat, $hospital_long, $one_user_lat, $one_user_long, "K");

                        ///Blood Check////

                        $one_user_blood = $one_user->blood_type;

                        $blood_comp = model("App\Models\Calc\BloodComp", false);

                        $recepiant_blood = $postData["blood_group"];

                        if($blood_comp->isCompatible($one_user_blood, $recepiant_blood)){

                            //distance////

                            //echo $km . "--";

                            if($km <= 10){


                                $one_u_id = $one_user->id;
                                $one_u_phone = $one_user->phone_number;

                                $single_arr = [];

                                $single_arr[] = $one_u_id;
                                $single_arr[] = $ret_data["last_ins_id"];
                                $single_arr[] = $one_u_phone;

                                $users_nearby[] = $single_arr;

                                $logic_true = true;

                            }

                            ///////////////////


                        }

                        ////////////////////

                        if($logic_true){

                            foreach($users_nearby as $sing_nearby){

                                // print_r($sing_nearby);

                                $message_text = "Blood type ".$postData["blood_group"]." is required immediately at ".$postData["dontitile"]." for a critical patient. ".base_url()."/Mobile/Mobile?reqid=".$sing_nearby[1]."&uuid=".$sing_nearby[0]."";


                                $dbsms = \Config\Database::connect();
                                $builderSMS = $dbsms->table("alerts_sent");
                                $dbData = [
                                    "number" => $sing_nearby[2],
                                    "msg_text" => $message_text,
                                    "sent" => "N"
                                ];

                                $builderSMS->insert($dbData);


                            }

                        }

                    }

                }



            }

            //

            echo json_encode($ret_data);

        }

    }


    public function sms_worker(){

        send_unsent_sms();


    }



}