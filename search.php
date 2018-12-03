<?php
include('includes/views/header.php');
?>

<main class="container site-content">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="mt-5">Search</h1>
		</div>
	</div>

	<div class="mb-20"></div>

	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="card">
				<div class="card-body text-center">
					<form action="<?php echo url('form-action/search.php') ?>" method="POST">
						<div class="form-group">
							<input type="text" name="search_data" class="form-control" placeholder="Enter Event Location">
						</div>
						<input type="submit" name="submit" class="btn btn-primary btn-lg" value="Search">
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>

	<?php
	showFlashMessage();
	?>

	<div class="row">
		<?php
		if(isset($_SESSION['search_data'])){
			$events = $_SESSION['search_data'];
			if(count($events)){
				$cols = 2;
				$count = 0;
				$colWidth = 12/$cols;
				foreach($events as $row){

					?>

						<div class="col-sm-6">
							<div class="card">
								<div class="card-header"><h4 class="text-center"><?php echo $row['name']; ?></h4></div>
								<div class="card-body">
									<img src="<?php echo asset('images/events/'.$row['image']); ?>" class="img-fluid rounded">
									<p class="card-text"><?php echo substr($row['description'],0,30).'...'; ?></p>
									<div class="text-center">
										<a href="<?php echo url('event.php?event_id='.$row['id']); ?>" class="btn btn-info">View More</a>
									</div>
								</div>
								<div class="card-footer text-muted text-center">
									<i class="fa fa-calendar"></i> 
									<?php
									$dateTime = strtotime($row['datetime']);
									echo date('D, d M Y',$dateTime);
									?>
								</div>
							</div>
						</div>

					<?php
					$count++;
					if($count%$cols == 0){
						echo '</div><div class="row">';
					}
				}
			}
			else{
				echo '<p class="lead">No results were found!</p>';
			}
			unset($_SESSION['search_data']);
		}
		?>
	</div>
</div>

</main>

<?php
include('includes/views/footer.php');
?>