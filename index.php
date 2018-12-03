<?php
include('includes/views/header.php');
?>

<main class="container site-content">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="mt-5">Upcoming Events</h1>
		</div>
	</div>
	
	<?php showFlashMessage(); ?>

	<div class="row">
		<div class="col-sm-8">

			<div class="row">
				<?php
				$today = date('Y-m-d G:i:s');
				$getTotalEvents = $mysqli->select('events','count(id) as num',"where datetime>'$today'");

				$page = 1;
				$perPage = 6;

				if(isset($_GET['page'])){
					$page = (int) sanitize($_GET['page']);
				}

				$totalEvents = $getTotalEvents[0]['num'];
				$leftEvents = $totalEvents - ($page * $perPage);

				$lastPage = ceil($totalEvents/$perPage);

				if($page > $lastPage){
					$page = $lastPage;
				}
				if($page < 1){
					$page = 1;
				}

				$limit = 'LIMIT '.($page - 1) * $perPage.', '.$perPage;

				
				$events = $mysqli->select('events','*',"where datetime>'$today'","order by datetime asc","$limit");
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
				?>
			</div>
			<br>
			<nav>
				<ul class="pagination justify-content-center">
					<?php
					if($page == 1){
						echo '<li class="page-item disabled"><a class="page-link" href="#">FIRST</a></li>';
						echo '<li class="page-item disabled"><a class="page-link" href="#">PREV</a></li>';
					}
					else{
						$prevPage = $page - 1;
						echo '<li class="page-item"><a class="page-link" href="'.url('index.php').'">FIRST</a></li>';
						echo '<li class="page-item"><a class="page-link" href="'.url('index.php?page='.$prevPage).'">PREV</a></li>';
					}
					echo '<li class="page-item"><span class="page-link">Page '.$page.' of '.$lastPage.'</span></li>';
					if($page == $lastPage){
						echo '<li class="page-item disabled"><a class="page-link" href="#">NEXT</a></li>';
						echo '<li class="page-item disabled"><a class="page-link" href="#">LAST</a></li>';
					}
					else{
						$nextPage = $page + 1;
						echo '<li class="page-item"><a class="page-link" href="'.url('index.php?page='.$nextPage).'">NEXT</a></li>';
						echo '<li class="page-item"><a class="page-link" href="'.url('index.php?page='.$lastPage).'">LAST</a></li>';
					}
					?>
				</ul>
			</nav>
		</div>
		<div class="col-sm-4">
			<?php include(PUBLIC_PATH.'/includes/views/sidebar.php'); ?>
		</div>
	</div>
</div>

</main>

<?php
include('includes/views/footer.php');
?>