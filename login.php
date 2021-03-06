<?php
$title = "Login";
$head = "<script src='https://www.google.com/recaptcha/api.js'></script>";
$needsGuest = true;
include('includes/views/header.php');
require('class/reCAPTCHA/src/autoload.php');
$recaptcha = new \ReCaptcha\ReCaptcha(RECAPTCHA_SECRET);
?>

<main class="container site-content">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="mt-5">Login</h1>
		</div>
	</div>

	<?php showFlashMessage(); ?>

	<div class="mx-auto col-md-6 col-md-offset-3">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?php echo url('form-action/login.php') ?>">
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" value="<?php echo getOldFormData('email'); ?>" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>

					<div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITEKEY; ?>"></div>

					<br>

					<div class="text-center">
						<input type="submit" name="submit" value="Login" class="btn btn-success btn-lg">
					</div>
				</form>
				<hr>
				<div class="text-center">
					<a href="<?php echo url('forgot_password.php'); ?>">Forgot password?</a>
				</div>
			</div>
		</div>
	</div>

</main>

<?php
include('includes/views/footer.php');
?>