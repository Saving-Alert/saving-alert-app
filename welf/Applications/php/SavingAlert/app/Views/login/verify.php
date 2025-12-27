<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <h4 class="text-center mb-4">Enter OTP</h4>


            <p class="text-danger text-center">
                TEST OTP: <?= session()->get('test_otp') ?>
            </p>
            <form method="post" action="<?= base_url('login/confirm') ?>">
                <input type="text"
                       name="otp"
                       class="form-control"
                       placeholder="6-digit OTP"
                       required>

                <button type="submit" class="btn btn-success mt-3">
                    Verify
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
