<?php
if(isset($_GET['event_id'])){
	$eventId = $_GET['event_id'];
}
else{
	header('location: index.php');
	die;
}

$title = "View Event";
include('includes/views/header.php');
$eventId = sanitize($eventId);

$eventData = $mysqli->select('events','*',"where id=$eventId");

if(!count($eventData)){
	$message = 'Event not found!';
	$messageType = 'danger';
	flash($message,$messageType);
	redirect('index.php');
}
?>

<main class="container site-content">

	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="mt-5"><?php echo $eventData[0]['name']; ?></h1>
		</div>
	</div>
	<div class="jumbotron text-center">
		<img src="<?php echo asset('images/events/'.$eventData[0]['image']); ?>" class="img-fluid rounded">
		<hr>
		<p class="lead">
			<i class="fa fa-calendar"></i> <?php echo date('D, F jS, Y',strtotime($eventData[0]['datetime'])); ?>
		</p>
		<hr>
		<p class="lead">
			<?php echo nl2br($eventData[0]['description']); ?>
		</p>
	</div>


</main>

<?php
include('includes/views/footer.php');
?>