<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Donation extends BaseController
{
    public function __construct()
    {
        helper('shuja');
    }

    public function index()
    {
        if (!is_user_logged()) {
            return;
        }

        if ($this->request->getMethod() !== 'get') {
            return;
        }

        $itemId = $this->request->getGet('item');

        if (empty($itemId)) {
            return;
        }

        $db = \Config\Database::connect();
        $builder = $db->table('donation_table');

        $builder->where([
            'id'     => $itemId,
            'active' => 'Y'
        ]);

        $query = $builder->get();

        if ($query->getNumRows() < 1) {
            return;
        }

        $row = $query->getRow();

        $data = [
            'don_id'         => $row->id,
            'front_user_id'  => $row->front_user_id,
            'title'          => $row->title,
            'description'    => $row->description,
            'dontation_type' => $row->dontation_type,
            'image_url'      => $row->image_url,
            'food_type'      => $row->food_type,
            'area_1'         => $row->area_1,
            'area_2'         => $row->area_2,
            'qty'            => $row->qty,
            'unit'           => $row->unit,
            'rdate'          => $row->rdate,
            'rtime'          => $row->rtime,
            'claim_check'    => claim_check(front_user_id(), $row->id),
            'own_check'      => own_donation_check($row->id, front_user_id()),
        ];

        echo view('header');
        echo view('single_donations', $data);
        echo view('footer');
        echo view('scripts/login_jax');
        echo view('scripts/single_donation_page_script');
    }
}
