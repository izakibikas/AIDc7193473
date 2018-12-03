<?php
require_once('../init.php');
require(PUBLIC_PATH.'/class/reCAPTCHA/src/autoload.php');
$recaptcha = new \ReCaptcha\ReCaptcha(RECAPTCHA_SECRET);

if(isset($_POST['submit'])){

	$email = $_POST['email'];
	$password = $_POST['password'];

	$oldFormData = array('email' => $email);
	saveOldFormData($oldFormData);

	$errors = array();

	if(!isset($_POST['g-recaptcha-response'])){
		$errors[] = "Please complete the captcha!";
	}

	$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

	if(!$resp->isSuccess()){
		$errors[] = "Please complete the captcha!";
	}

	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		$email = sanitize($email);
	}
	else{
		$errors[] = "Please provide a valid email address!";
	}

	$password = sanitize($password);

	if(count($errors)){
		$messageType = 'danger';
		$message = '<ul>';
		foreach($errors as $error){
			$message .= '<li>'.$error.'</li>';
		}
		$message .= '</ul>';
		flash($message,$messageType);
		redirect('login.php');
	}
	else{
		$password = sha1($password);

		$user = $mysqli->select('users','*',"where email='$email' and password='$password'");
		if($user[0]['id']>0){
			saveLoginState($user[0]['id'],$user[0]['name'],$user[0]['email'],$user[0]['type']);
			$messageType = 'success';
			$message .= 'Welcome '.$user[0]['name'];
			flash($message,$messageType);
			if($user[0]['type']=='admin'){
				redirect('admin_panel.php');
			}
			redirect('index.php');
		}
		else{
			$messageType = 'danger';
			$message .= 'Invalid email or password!';
			flash($message,$messageType);
			redirect('login.php');
		}
	}
	
}

redirect('login.php');
?>