<?php
require_once('init.php');

needsAdmin();

if(isset($_GET['event_id'])){
	$id = $_GET['event_id'];
	$event = $mysqli->select('events','*',"where id=$id");
	if(count($event)){
		$deleteEvent = $mysqli->delete('events',"where id=$id");
		if($deleteEvent==1){
			$messageType = 'success';
			$message .= "The event has been successfully deleted!";
			flash($message,$messageType);
		}
		else{
			$messageType = 'danger';
			$message .= "Error while deleting event!";
			flash($message,$messageType);
		}
	}
	else{
		$messageType = 'danger';
		$message .= "The event doesn't exist!";
		flash($message,$messageType);
	}
}

redirect('admin_panel.php');
?>