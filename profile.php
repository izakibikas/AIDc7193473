<?php
$needsAuth = true;
$title = "My Profile";
include('includes/views/header.php');
?>

<main class="container site-content">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="mt-5">My Profile</h1>
			<p class="lead">Update your profile using the form below!</p>
		</div>
	</div>

	<?php showFlashMessage(); ?>

	<div class="card">
		<div class="card-body">
			<form method="POST" action="<?php echo url('form-action/profile.php') ?>">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Your Full Name</label>
							<input type="text" name="name" class="form-control" placeholder="E.g. John Doe" value="<?php echo user('name'); ?>" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" placeholder="E.g. john@email.com" value="<?php echo user('email'); ?>" required>
						</div>
					</div>
				</div>
				<div class="text-center">
					<input type="submit" name="submit" value="Update Profile" class="btn btn-success btn-lg">
				</div>
			</form>
		</div>
	</div>

</main>

<?php
include('includes/views/footer.php');
?>