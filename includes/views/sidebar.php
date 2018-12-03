<div class="card">
	<div class="card-header bg-success text-light text-center">New Event</div>
	<div class="card-body mx-auto">
		<a href="<?php echo url('event_add.php') ?>" class="btn btn-success">Add New Event</a>
	</div>
</div>

<div class="card">
	<div class="card-header bg-primary text-light text-center">Search</div>
	<div class="card-body">
		<form action="<?php echo url('form-action/search.php') ?>" method="POST">
			<div class="form-group">
				<input type="text" name="search_data" class="form-control" placeholder="Enter Event Location" required>
			</div>
			<input type="submit" name="submit" class="btn btn-primary" value="Search">
		</form>
	</div>
</div>

<div class="mb-20"></div>

<div class="card">
	<div class="card-header bg-danger text-light text-center">Events Today</div>
	<div class="card-body">
		<?php
		$events = $mysqli->select('events','*',"where datetime between '".date('Y-m-d G:i:s')."' and '".date('Y-m-d',strtotime(date('Y-m-d'))+86400)."'",'','limit 8');
		if(count($events)){
			foreach($events as $row){
				echo '<p class="lead">'.$row['name'].'</p>';
				echo '<p> <i class="fa fa-map-marker"></i> '.$row['location'].' <br> <i class="fa fa-clock-o"></i> '.date('h:i:s A',strtotime($row['datetime'])).' </p>';
				echo '<hr>';
			}
		}
		else{
			echo '<p class="lead">No Events Today.</p>';
		}
		?>
	</div>
</div>