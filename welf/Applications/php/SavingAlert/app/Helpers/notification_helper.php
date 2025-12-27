<?php

// function send_mobile_otp(string $mobile_number): void
// {
//     if (strlen($mobile_number) !== 10) return;

//     $otp = random_int(100000, 999999);
//     session()->set('mobile_otp', $otp);

//     $user = getenv('SMS_USER');
//     $pass = getenv('SMS_PASS');

//     $url = "https://gateway.nixilo.com/sms.php?user={$user}&pass={$pass}&phone={$mobile_number}&message={$otp}";
//     @file_get_contents($url);
// }

function get_cur_otp(): ?int
{
    return session()->get('mobile_otp');
}

function mail_me(string $to, string $subject, string $message): void
{
    $email = \Config\Services::email();

    $email->setTo($to);
    $email->setFrom('noreply@savingalert.com', 'Saving Alert');
    $email->setSubject($subject);
    $email->setMessage($message);
    $email->send();
}
