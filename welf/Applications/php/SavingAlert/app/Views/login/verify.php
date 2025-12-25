<?php
$session = session();

if (!$session->get('front_valid')) {
    return redirect()->to(base_url('login'));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <h4 class="text-center mb-4">
                Enter Verification Code
            </h4>

            <form method="post" action="<?= base_url('login/verify') ?>">
                <div class="form-group">
                    <input type="text"
                           name="user_password"
                           class="form-control"
                           placeholder="6-digit OTP"
                           required>
                </div>

                <button type="submit" class="btn btn-success btn-block mt-3">
                    Verify & Login
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
