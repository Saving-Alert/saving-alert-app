<?php

namespace App\Controllers;

class Logout extends BaseController
{   
    public function __construct(){
        helper("shuja");
    }

    public function index()
    {

        if(is_user_logged()){

            if(session_destroy()){
                echo '<script>location.href = "'.base_url().'"</script>';
            }

        }
    }
}