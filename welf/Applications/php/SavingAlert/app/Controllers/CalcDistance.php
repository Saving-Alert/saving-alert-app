<?php

namespace App\Controllers;

class CalcDistance extends BaseController
{

    public function __construct(){
        helper("shuja");
    }

    public function callfunc(){

        $calc_mod = model("App\Models\Calc\CalcDistance", false);

        $blood_comp = model("App\Models\Calc\BloodComp", false);

        //echo $calc_mod->calcuser(7.2699, 80.5938, 7.2906, 80.6337, "K");

        //print_r($blood_comp->isCompatible("AB+", "AB+") );

        //send_unsent_sms();

        //$four_month = date("Y-m-d", strtotime("-2 months"));

        //echo $four_month;

        get_all_front_users();

    }



}