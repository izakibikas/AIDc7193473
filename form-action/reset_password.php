<?php
require_once('../init.php');

if(isset($_POST['submit'])){

	$password = $_POST['password'];
	$rePassword = $_POST['re_password'];
	$email = $_POST['email'];
	$code = $_POST['res'];

	$oldFormData = array('email' => $email);
	saveOldFormData($oldFormData);

	$errors = array();

	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		$email = sanitize($email);
		$user = $mysqli->select('users','count(id) as num',"where email='$email'");
		if($user[0]['num']<1){
			$errors[] = "The user you are trying to reset password for doesn't exist!";
		}
	}
	else{
		$errors[] = "Please provide a valid email address!";
	}

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
		redirect('reset_password.php?res='.$code);
	}
	else{
		$newPassword = sha1($password);
		$user = $mysqli->update('users',"password='$newPassword'","where email='$email'");

		if($user=='11'){
			$messageType = 'success';
			$message .= 'Your password has been successfully updated! Login using your email and new password';
			flash($message,$messageType);
		}
		else{
			$messageType = 'danger';
			$message .= 'An unknown error has occured!';
			flash($message,$messageType);
		}
	}
	redirect('login.php');
	
}

redirect('forgot_password.php');
?>