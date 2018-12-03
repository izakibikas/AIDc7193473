<?php
require_once('../init.php');

if(isset($_POST['submit'])){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$userId = user('id');

	$oldFormData = array('name' => $name, 'email' => $email);
	saveOldFormData($oldFormData);

	$errors = array();

	if(strlen($name)<3){
		$errors[] = "Please enter your full name!";
	}
	else{
		$name = sanitize($name);
	}

	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		$email = sanitize($email);
		$user = $mysqli->select('users','count(id) as num',"where email='$email' and id!=$userId");
		if($user[0]['num']>0){
			$errors[] = "This email address is already in use by someone else! Please use a different email address to register!";
		}
	}
	else{
		$errors[] = "Please provide a valid email address!";
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
		$user = $mysqli->update('users',"name='$name',email='$email'","where id=$userId");

		if($user=='11'){
			$userType = user('type');
			saveLoginState($userId,$name,$email,$userType);
			$messageType = 'success';
			$message .= 'Your profile has been successfully updated!';
			flash($message,$messageType);
		}
		else{
			$messageType = 'danger';
			$message .= 'An unknown error has occured!';
			flash($message,$messageType);
		}
	}
	redirect('profile.php');
	
}

redirect('profile.php');
?>