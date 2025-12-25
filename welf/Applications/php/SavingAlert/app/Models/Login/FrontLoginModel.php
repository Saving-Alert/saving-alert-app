<?php
namespace App\Models;

use CodeIgniter\Model;

class FrontLoginModel extends Model
{
    protected $table = 'front_users';

    public function login_validate($email)
    {
        $builder = $this->db->table($this->table);
        $user = $builder->where('email', $email)
                        ->where('active', 1)
                        ->get()
                        ->getRow();

        $otp = random_int(100000, 999999);

        if ($user) {
            if ($user->dynamic_login == 1) {
                $builder->where('id', $user->id)
                        ->update(['dynamic_code' => (string)$otp]);
            }

            return [
                'valid' => true,
                'id' => $user->id,
                'email' => $user->email,
                'active' => $user->active,
                'dyanmic' => true
            ];
        }

        // New user
        $builder->insert([
            'email' => $email,
            'active' => 1,
            'dynamic_login' => 1,
            'dynamic_code' => (string)$otp,
        ]);

        return [
            'valid' => true,
            'id' => $this->db->insertID(),
            'email' => $email,
            'active' => 1,
            'dyanmic' => true
        ];
    }

    public function login_confirm($otp, $id)
    {
        $user = $this->db->table($this->table)
                         ->where('id', $id)
                         ->where('active', 1)
                         ->get()
                         ->getRow();

        return ['valid' => $user && $user->dynamic_code === $otp];
    }
}

}