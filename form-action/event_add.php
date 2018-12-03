<?php
require_once('../init.php');

needsAuth();

if(isset($_POST['submit'])){

	$name = $_POST['name'];
	$location = $_POST['location'];
	$description = $_POST['description'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$dateTime = $date.' '.$time;
	$photo = $_FILES['photo'];
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
		$imageName = 'default.jpg';
		$today = date('Y-m-d G:i:s');

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
				redirect('event_add.php');
			}

			$uploaded = move_uploaded_file($_FILES['photo']['tmp_name'], $fileToUpload);
			if(!$uploaded){
				$imageName = 'default.jpg';
			}
		}

		$event = $mysqli->insert('events','user_id,name,location,description,image,datetime',"'$userId','$name','$location','$description','$imageName','$dateTime'");

		if($event=='11'){
			$messageType = 'success';
			$message = 'Your event has been successfully added!';
			flash($message,$messageType);
			redirect('event_my.php');
		}
		else{
			$messageType = 'danger';
			$message = 'An unknown error has occured!';
			flash($message,$messageType);
			redirect('event_add.php');
		}
	}
	
}

redirect('event_add.php');
?>