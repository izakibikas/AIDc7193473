<?php
$needsAuth = true;
$title = "Add an Event";
include('includes/views/header.php');
?>

<main class="container site-content">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="mt-5">Add an Event</h1>
		</div>
	</div>

	<?php showFlashMessage(); ?>

	<div class="card">
		<div class="card-body">
			<form enctype="multipart/form-data" method="POST" action="<?php echo url('form-action/event_add.php') ?>">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Event Name</label>
							<input type="text" name="name" class="form-control" minlength="5" maxlength="50"placeholder="E.g. Sabin Rai Live" value="<?php echo getOldFormData('name'); ?>" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Location</label>
							<input type="text" minlength="5" maxlength="200" name="location" class="form-control" placeholder="E.g. Tundikhel, Kathmandu" value="<?php echo getOldFormData('location'); ?>" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Event Description</label>
					<textarea name="description" minlength="30" class="form-control" rows="7" required><?php echo getOldFormData('description'); ?></textarea>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Event Date</label>
							<input type="date" class="form-control" name="date" min="<?php echo date('Y-m-d'); ?>" required>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label>Event Time</label>
							<input type="time" class="form-control" name="time" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label>Event Photo</label>
					<input type="file" class="form-control" name="photo" accept=".jpg,.png,.jpeg,.gif">
				</div>

				<div class="text-center">
					<input type="submit" name="submit" value="Add Event" class="btn btn-success btn-lg">
				</div>
			</form>
		</div>
	</div>

</main>

<?php
include('includes/views/footer.php');
?>