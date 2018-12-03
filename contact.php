<?php
include('includes/views/header.php');
?>

<main class="container site-content">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="mt-5">Contact Us</h1>
			<p class="lead">Fill and submit the form below and we will get back to you!</p>
		</div>
	</div>

	<?php showFlashMessage(); ?>

	<div class="card">
		<div class="card-body">
			<form method="POST" action="<?php echo url('form-action/contact.php') ?>">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="email" name="email" class="form-control" placeholder="E.g. john@email.com" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Message</label>
					<div class="col-sm-10">
						<textarea name="message" rows="5" class="form-control" required></textarea>
					</div>
				</div>
				<div class="text-center">
					<input type="submit" name="submit" value="Send message" class="btn btn-success btn-lg">
				</div>
			</form>
		</div>
	</div>

</main>

<?php
include('includes/views/footer.php');
?>