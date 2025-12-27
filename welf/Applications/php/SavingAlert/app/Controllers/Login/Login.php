<?php

namespace App\Controllers\Login;

use App\Controllers\BaseController;
use App\Models\Login\FrontLoginModel;

class Login extends BaseController
{

    public function __construct()
    {
        helper(['sms']);
    }

    /**
     * Show login form
     */
    public function index()
    {
        return view('login/login');
    }

    /**
     * Send OTP to mobile
     */
    public function sendOtp()
    {
        $mobile = $this->request->getPost('mobile');

        if (!$mobile) {
            return redirect()->back()->with('error', 'Mobile number required');
        }

        // ✅ Correct model loading
        $model  = new FrontLoginModel();
        $result = $model->login_validate($mobile);

        if (!$result['valid']) {
            return redirect()->back()->with('error', 'Unable to send OTP');
        }

        // ✅ Correct keys
        session()->set([
            'otp_user_id' => $result['user_id'],
            'otp_mobile'  => $result['mobile'],
        ]);

        return redirect()->to(base_url('login/verify'));
    }

    /**
     * Show OTP verification page
     */
    public function verify()
    {
        return view('login/verify');
    }

    /**
     * Confirm OTP
     */
    public function confirmOtp()
    {
        $otp    = $this->request->getPost('otp');
        $userId = session()->get('otp_user_id');

        if (!$otp || !$userId) {
            return redirect()->back()->with('error', 'Session expired');
        }

        // ✅ Correct model loading
        $model = new FrontLoginModel();

        // ✅ Correct method name & argument order
        $isValid = $model->verify_otp($userId, $otp);

        if (!$isValid) {
            return redirect()->back()->with('error', 'Invalid or expired OTP');
        }

        // ✅ Login success
        session()->set([
            'front_logged_in' => true,
            'front_user_id'   => $userId,
        ]);

        return redirect()->to(base_url('request-blood'));
    }
}
