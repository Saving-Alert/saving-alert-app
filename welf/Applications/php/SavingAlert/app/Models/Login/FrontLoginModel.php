<?php

namespace App\Models\Login;

use CodeIgniter\Model;

class FrontLoginModel extends Model
{
    protected $table      = 'front_users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'mobile',
        'email',
        'dynamic_code',
        'otp_expires_at',
        'dynamic_login',
        'active'
    ];

    /**
     * Generate & send OTP via SMS
     */
    public function login_validate(string $mobile): array
    {
        $otp = random_int(100000, 999999);
        $expiresAt = date('Y-m-d H:i:s', time() + 300); // 5 minutes

        $user = $this->where('phone', $mobile)
                     ->where('active', 1)
                     ->first();

        if ($user) {
            $this->update($user['id'], [
                'dynamic_code'    => $otp,
                'otp_expires_at'  => $expiresAt,
                'dynamic_login'   => 1
            ]);

            send_mobile_otp($mobile, $otp);

            return [
                'valid'   => true,
                'user_id' => $user['id'],
                'mobile'  => $mobile
            ];
        }

        // New user
        $this->insert([
            'phone'           => $mobile,
            'active'           => 1,
            'dynamic_login'    => 1,
            'dynamic_code'     => $otp,
            'otp_expires_at'   => $expiresAt
        ]);

        send_mobile_otp($mobile, $otp);

        return [
            'valid'   => true,
            'user_id' => $this->insertID(),
            'mobile'  => $mobile
        ];
    }

    /**
     * Verify OTP
     */
    public function verify_otp(int $userId, string $otp): bool
    {
        $user = $this->where('id', $userId)
                     ->where('dynamic_code', $otp)
                     ->where('otp_expires_at >=', date('Y-m-d H:i:s'))
                     ->first();

        return (bool) $user;
    }
}
