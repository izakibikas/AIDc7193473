<?php
$title = "Register";
$needsGuest = true;
$head = "<script src='https://www.google.com/recaptcha/api.js'></script>";
include('includes/views/header.php');
?>

<main class="container site-content">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="mt-5">Register</h1>
			<p class="lead">Register now and you can also submit events nearyby you!</p>
		</div>
	</div>

	<?php showFlashMessage(); ?>

	<div class="card">
		<div class="card-body">
			<form method="POST" action="<?php echo url('form-action/register.php') ?>">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Your Full Name</label>
							<input type="text" name="name" class="form-control" placeholder="E.g. John Doe" value="<?php echo getOldFormData('name'); ?>" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" placeholder="E.g. john@email.com" value="<?php echo getOldFormData('email'); ?>" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-6">
							<label>Password</label>
							<input type="password" name="password" class="form-control" required>
						</div>
						<div class="col-sm-6">
							<label>Re type Password</label>
							<input type="password" name="re_password" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITEKEY; ?>"></div>
				<div class="text-center">
					<input type="submit" name="submit" value="Register" class="btn btn-success btn-lg">
				</div>
			</form>
		</div>
	</div>

</main>

<?php
include('includes/views/footer.php');
?>