<?php
require_once('../init.php');
require(PUBLIC_PATH.'/class/reCAPTCHA/src/autoload.php');

require PUBLIC_PATH.'/class/PHPMailer/src/Exception.php';
require PUBLIC_PATH.'/class/PHPMailer/src/PHPMailer.php';
require PUBLIC_PATH.'/class/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$recaptcha = new \ReCaptcha\ReCaptcha(RECAPTCHA_SECRET);

if(isset($_POST['submit'])){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['re_password'];

	$oldFormData = array('name' => $name, 'email' => $email);
	saveOldFormData($oldFormData);

	$errors = array();

	if(!isset($_POST['g-recaptcha-response'])){
		$errors[] = "Please complete the captcha!";
	}

	$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

	if(!$resp->isSuccess()){
		$errors[] = "Please complete the captcha!";
	}

	if(strlen($name)<3){
		$errors[] = "Please enter your full name!";
	}
	elseif(!ctype_alpha(str_replace(' ','',$name))){
		$errors[] = "Name must only contain characters from A-Z.";
	}
	else{
		$name = sanitize($name);
	}

	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		$email = sanitize($email);
		$user = $mysqli->select('users','count(id) as num',"where email='$email'");
		if($user[0]['num']>0){
			$errors[] = "This email address is already in use! Please use a different email address to register!";
		}
	}
	else{
		$errors[] = "Please provide a valid email address!";
	}

	if(strlen($password)<6){
		$errors[] = "Password must be of at least 6 characters!";
	}
	if($password!=$repassword){
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
		redirect('register.php');
	}
	else{
		$password = sha1($password);

		$user = $mysqli->insert('users','name,email,password',"'$name','$email','$password'");

		if($user=='11'){
			$mail = new PHPMailer();

			$mail->isSMTP();
			$mail->Host = EMAIL_HOST;
			$mail->SMTPAuth = true;
			$mail->Username = EMAIL_USERNAME;
			$mail->Password = EMAIL_PASSWORD;
			$mail->SMTPSecure = 'tls';
			$mail->Port = EMAIL_PORT;
			$mail->setFrom(EMAIL_FROM_ADDRESS, EMAIL_FROM_NAME);
			$mail->addAddress($email);
			$mail->isHTML(true);
			$mail->Subject = 'Registration successful!';
			$mail->Body    = 'Thank you for registering with us! You can now add events nearby you!';
			$mail->send();

			$messageType = 'success';
			$message = 'You have successfully registered! You can now login using your email and password!';
			flash($message,$messageType);
			redirect('login.php');
		}
		else{
			$messageType = 'danger';
			$message .= 'An unknown error has occured!';
			flash($message,$messageType);
			redirect('register.php');
		}
	}
	
}

redirect('register.php');
?>