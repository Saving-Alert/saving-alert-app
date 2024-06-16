<?php
namespace App\Controllers;

class BloodbankApi extends BaseController

{
    function insert_me()
    {
        $nic = $this->request->getVar("nic_number");
        $bloodDate = $this->request->getVar("last_blood_giving_date");
        $diseases = $this->request->getVar("diseases");
        $bloodGroup = $this->request->getVar("blood_group");

        $db = \Config\Database::connect();
        $builder3 = $db->table("blood_bank_data");
        $dbData = [
            "nic_number" => $nic,
            "last_blood_giving_date" => $bloodDate,
            "diseases" => $diseases,
            "blood_group" => $bloodGroup
        ];
        $builder3->insert($dbData);

        echo json_encode(
            ["status"=> true]
        );
    }
}

