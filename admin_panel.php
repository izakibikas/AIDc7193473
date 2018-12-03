<?php
$needsAdmin = true;
$title = "Admin Panel";
include('includes/views/header.php');
$userId = user('id');
?>

<main class="container site-content">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="mt-5">All Events</h1>
			<p class="lead">Below is a list of all events</p>
		</div>
	</div>

	<?php showFlashMessage(); ?>

	<?php
	$events = $mysqli->select('events','*','',"order by id desc");
	if(count($events)){
		?>

		<table class="table table-responsive">
			<thead>
				<tr>
					<th>Event Name</th>
					<th>Location</th>
					<th>Date Time</th>
					<th>Description</th>
					<th>Image</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($events as $row){
					echo '<tr>';
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$row['location'].'</td>';
					echo '<td>'.$row['datetime'].'</td>';
					echo '<td>'.$row['description'].'</td>';
					echo '<td><img src="'.asset('images/events/'.$row['image']).'" class="img-fluid"></td>';
					echo '<td><p><a class="btn btn-warning" href="'.url("event_edit.php?event_id=".$row['id']).'">Edit</a></p> <p><a id="deleteBtn" data-toggle="modal" data-id="'.$row['id'].'" data-target="#deleteEventModal" class="btn btn-danger">Delete</a></p></td>';
					echo '</tr>';
				}
				?>
			</tbody>
		</table>

		<?php
	}
	else{
		echo '<p class="lead">No events found.</p>';
	}
	?>


	<div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete Event</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Are you sure you want to delete this event?
				</div>
				<div class="modal-footer">
					<a id="modalDeleteBtn" href="" class="btn btn-primary">Yes</a>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>

</main>

<?php
$footer_scripts = '
<script type="text/javascript">
	$("#deleteBtn").click(function(){
		var id = $(this).data("id");
		$("#modalDeleteBtn").attr("href","'.url("event_delete.php?event_id=").'"+id);
	});
</script>
';
?>

<?php
include('includes/views/footer.php');
?>