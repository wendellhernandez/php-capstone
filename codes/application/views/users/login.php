<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Organic Shop: Let's order fresh items for you.</title>

        <link rel="shortcut icon" href="/assets/images/organic_shop_favicon.ico" type="image/x-icon">

        <script src="/assets/js/vendor/jquery.min.js"></script>
        <script src="/assets/js/vendor/popper.min.js"></script>
        <script src="/assets/js/vendor/bootstrap.min.js"></script>
        <script src="/assets/js/vendor/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="/assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/vendor/bootstrap-select.min.css">

        <script src="/assets/js/global/dashboard.js"></script>
		<script src="/assets/js/global/login.js"></script>
        <link rel="stylesheet" href="/assets/css/custom/global.css">
        <link rel="stylesheet" href="/assets/css/custom/signup.css">
    </head>
    <body>
        <div class="wrapper">
            <a href="/products"><img src="/assets/images/organic_shop_logo_large.svg" alt="Organic Shop"></a>
			<?= form_open("/users/login_user" , "class='login_form'") ?>
                <h2>Login to order.</h2>
                <a href="/signup">New Member? Register here.</a>
                <ul>
                    <li>
                        <input type="text" name="email">
                        <label>Email</label>
						<div id="email" class="validation_error"></div>
                    </li>
                    <li>
                        <input type="password" name="password">
                        <label>Password</label>
						<div id="password" class="validation_error"></div>
						<div id="credentials" class="validation_error"></div>
                    </li>
                </ul>
                <button type="submit" class="login_btn">Login</button>
                <input type="hidden" name="action" value="login">
			<?= form_close() ?>
        </div>
    </body>
</html>