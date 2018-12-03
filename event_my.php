<?php
$needsAuth = true;
$title = "My Events";
include('includes/views/header.php');
$userId = user('id');
?>

<main class="container site-content">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="mt-5">My Events</h1>
			<p class="lead">Below is a list of your events</p>
		</div>
	</div>

	<?php showFlashMessage(); ?>

	<?php
	$events = $mysqli->select('events','*','',"where user_id='$userId' order by id desc");
	if(count($events)){
		?>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Event Name</th>
					<th>Location</th>
					<th>Date Time</th>
					<th>Description</th>
					<th>Image</th>
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

</main>

<?php
include('includes/views/footer.php');
?>