<?php
require_once('../init.php');

needsAdmin();

if(isset($_POST['submit'])){

	$eventId = $_POST['event_id'];
	$name = $_POST['name'];
	$location = $_POST['location'];
	$description = $_POST['description'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$dateTime = $date.' '.$time;
	$photo = $_FILES['photo'];

	$eventData = $mysqli->select('events','*',"where id=$eventId");

	if(!count($eventData)){
		$message = 'Event not found!';
		$messageType = 'danger';
		flash($message,$messageType);
		redirect('admin_panel.php');
	}

	if($_FILES['photo']['error']==4){
		$photo = 0;
	}
	$userId = user('id');

	$oldFormData = array('name' => $name, 'location' => $location, 'description' => $description);
	saveOldFormData($oldFormData);

	$errors = array();

	if(strlen($name)<3){
		$errors[] = "Event name must consist of more than 3 characters!";
	}
	else{
		$name = sanitize($name);
	}

	if(strlen($location)<3){
		$errors[] = "Location name must consist of more than 3 characters!";
	}
	else{
		$location = sanitize($location);
	}

	if(strlen($description)<20){
		$errors[] = "Description must consist of more than 20 characters!";
	}
	else{
		$description = sanitize($description);
	}

	if(count($errors)){
		$messageType = 'danger';
		$message = '<ul>';
		foreach($errors as $error){
			$message .= '<li>'.$error.'</li>';
		}
		$message .= '</ul>';
		flash($message,$messageType);
	}
	else{
		$eventData = $mysqli->select('events','*',"where id=$eventId");
		$imageName = $eventData[0]['image'];

		if($photo!=0){
			$uploadDir = '../assets/images/events/';
			$fileType = strtolower(pathinfo(basename($_FILES['photo']['name']),PATHINFO_EXTENSION));
			$imageName = substr(sha1(time()),0,16).'.'.$fileType;
			$fileToUpload = $uploadDir.$imageName;

			$checkImage = getimagesize($_FILES['photo']['tmp_name']);

			if($checkImage === false){
				$message = 'Only image files are allowed to be uploaded!';
				$messageType = 'danger';
				flash($message,$messageType);
				redirect('event_edit.php');
			}

			$uploaded = move_uploaded_file($_FILES['photo']['tmp_name'], $fileToUpload);
			if(!$uploaded){
				$imageName = $eventData[0]['image'];
			}
		}

		$event = $mysqli->update('events',"name='$name',location='$location',description='$description',image='$imageName',datetime='$dateTime'","where id=$eventId");

		if($event=='11'){
			$messageType = 'success';
			$message = 'Event has been successfully edited!';
			flash($message,$messageType);
			redirect('admin_panel.php');
		}
		else{
			$messageType = 'danger';
			$message = 'An unknown error has occured!';
			flash($message,$messageType);
			redirect('event_edit.php');
		}
	}
	
}

redirect('event_edit.php');
?>