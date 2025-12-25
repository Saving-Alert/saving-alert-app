<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h4 class="text-center mb-4">Login</h4>

            <form method="post" action="<?= base_url('login') ?>">
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email"
                           name="user_email"
                           class="form-control"
                           required>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-3">
                    Send Verification Code
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
