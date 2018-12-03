<?php
if(isset($_GET['event_id'])){
	$eventId = $_GET['event_id'];
}
else{
	header('location: index.php');
	die;
}
$needsAdmin = true;
$title = "Edit an Event";
include('includes/views/header.php');
$eventId = sanitize($eventId);

$eventData = $mysqli->select('events','*',"where id=$eventId");

if(!count($eventData)){
	$message = 'Event not found!';
	$messageType = 'danger';
	flash($message,$messageType);
	redirect('admin_panel.php');
}
?>

<main class="container site-content">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="mt-5">Edit Event</h1>
		</div>
	</div>

	<?php showFlashMessage(); ?>

	<div class="card">
		<div class="card-body">
			<form enctype="multipart/form-data" method="POST" action="<?php echo url('form-action/event_edit.php') ?>">
				<input type="hidden" name="event_id" value="<?php echo $eventData[0]['id']; ?>">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Event Name</label>
							<input type="text" name="name" class="form-control" placeholder="E.g. Sabin Rai Live" value="<?php echo $eventData[0]['name']; ?>" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Location</label>
							<input type="text" name="location" class="form-control" placeholder="E.g. Tundikhel, Kathmandu" value="<?php echo $eventData[0]['location']; ?>" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Event Description</label>
					<textarea name="description" class="form-control" rows="7" required><?php echo $eventData[0]['description']; ?></textarea>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Event Date</label>
							<input type="date" class="form-control" name="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo substr($eventData[0]['datetime'],0,10); ?>" required>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							<label>Event Time</label>
							<input type="time" class="form-control" name="time" value="<?php echo substr($eventData[0]['datetime'],11,19); ?>" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label>Old Event Photo</label>
					<img src="<?php echo asset('images/events/'.$eventData[0]['image']); ?>" class="img-fluid">
				</div>

				<div class="form-group">
					<label>New Event Photo</label>
					<input type="file" class="form-control" name="photo" accept=".jpg,.png,.jpeg,.gif">
				</div>

				<div class="text-center">
					<input type="submit" name="submit" value="Edit Event" class="btn btn-success btn-lg">
				</div>
			</form>
		</div>
	</div>

</main>

<?php
include('includes/views/footer.php');
?>