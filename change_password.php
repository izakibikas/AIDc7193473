<?php
$needsAuth = true;
$title = "Change Password";
include('includes/views/header.php');
?>

<main class="container site-content">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="mt-5">Change Password</h1>
		</div>
	</div>

	<?php showFlashMessage(); ?>

	<div class="card">
		<div class="card-body">
			<form method="POST" action="<?php echo url('form-action/change_password.php') ?>">
				<div class="form-group">
					<label>Old Password</label>
					<input type="password" name="old_password" class="form-control" required>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>New Password</label>
							<input type="password" name="new_password" class="form-control" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Retype new password</label>
							<input type="password" name="new_re_password" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="text-center">
					<input type="submit" name="submit" value="Change Password" class="btn btn-success btn-lg">
				</div>
			</form>
		</div>
	</div>

</main>

<?php
include('includes/views/footer.php');
?>