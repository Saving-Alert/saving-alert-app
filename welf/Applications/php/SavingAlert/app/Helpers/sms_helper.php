<?php

if (! function_exists('send_mobile_otp')) {

    function send_mobile_otp(string $mobile, int $otp): bool
    {
        if (strlen($mobile) < 9) {
            log_message('error', 'Invalid mobile number: ' . $mobile);
            return false;
        }
        

        $user = getenv('SMS_USER');
        $pass = getenv('SMS_PASS');

        if (empty($user) || empty($pass)) {
            log_message('error', 'SMS credentials missing in .env');
            return false;
        }

        $message = urlencode("Your SavingAlert OTP is: {$otp}");

        $url = "https://gateway.nixilo.com/sms.php?user={$user}&pass={$pass}&phone={$mobile}&message={$message}";

        $response = @file_get_contents($url);

        // LOG OTP FOR TESTING
        log_message('info', "OTP {$otp} sent to {$mobile}");
        log_message('info', "SMS gateway response: " . ($response ?: 'NO RESPONSE'));

        return true;
    }
}
