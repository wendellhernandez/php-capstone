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

		<script src="/assets/js/global/global.js"></script>
		<script src="/assets/js/global/signup.js"></script>
		<link rel="stylesheet" href="/assets/css/custom/global.css">
		<link rel="stylesheet" href="/assets/css/custom/signup.css">
	</head>
	<body>
		<div class="wrapper">
			<a href="/products"><img src="/assets/images/organic_shop_logo_large.svg" alt="Organic Shop"></a>
			<?= form_open("/users/signup_user") ?>
				<h2>Signup to order.</h2>
				<a href="/login">Already a member? Login here.</a>
				<p class="form_success"></p>
				<ul>
					<li>
						<input type="text" name="first_name">
						<label>First Name</label>
						<div id="first_name" class="validation_error"></div>
					</li>
					<li>
						<input type="text" name="last_name">
						<label>Last Name</label>
						<div id="last_name" class="validation_error"></div>
					</li>
					<li>
						<input type="text" name="email">
						<label>Email</label>
						<div id="email" class="validation_error"></div>
					</li>
					<li>
						<input type="password" name="password">
						<label>Password</label>
						<div id="password" class="validation_error"></div>
					</li>
					<li>
						<input type="password" name="confirm_password">
						<label>Confirm Password</label>
						<div id="confirm_password" class="validation_error"></div>
					</li>
				</ul>
				<button class="signup_btn" type="submit">Signup</button>
			<?= form_close() ?>
		</div>
	</body>
</html>