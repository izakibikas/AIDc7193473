<?php
$needsAuth = true;
require_once('../init.php');

if(isset($_POST['submit'])){

	$password = $_POST['new_password'];
	$rePassword = $_POST['new_re_password'];
	$userId = user('id');

	$errors = array();

	if(strlen($password)<6){
		$errors[] = "Password must be of at least 6 characters!";
	}
	if($password!=$rePassword){
		$errors[] = "Password and re typed password does not match!";
	}
	else{
		$password = sanitize($password);
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
		$newPassword = sha1($password);
		$user = $mysqli->update('users',"password='$newPassword'","where id=$userId");

		if($user=='11'){
			$messageType = 'success';
			$message .= 'Your password has been successfully updated!';
			flash($message,$messageType);
		}
		else{
			$messageType = 'danger';
			$message .= 'An unknown error has occured!';
			flash($message,$messageType);
		}
	}
	redirect('change_password.php');
	
}

redirect('change_password.php');
?>