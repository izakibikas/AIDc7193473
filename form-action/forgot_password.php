<?php
require_once('../init.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require(PUBLIC_PATH.'/class/reCAPTCHA/src/autoload.php');

require PUBLIC_PATH.'/class/PHPMailer/src/Exception.php';
require PUBLIC_PATH.'/class/PHPMailer/src/PHPMailer.php';
require PUBLIC_PATH.'/class/PHPMailer/src/SMTP.php';

$recaptcha = new \ReCaptcha\ReCaptcha(RECAPTCHA_SECRET);

if(isset($_POST['submit'])){

	$email = $_POST['email'];

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

	if(count($errors)){
		$messageType = 'danger';
		$message = '<ul>';
		foreach($errors as $error){
			$message .= '<li>'.$error.'</li>';
		}
		$message .= '</ul>';
		flash($message,$messageType);
		redirect('forgot_password.php');
	}
	else{

		$user = $mysqli->select('users','id',"where email='$email'");
		$message = "";
		if($user[0]['id']>0){
			$code = substr(sha1(mt_rand(111111,999999).$email.time()),5,18);
			$mailMessage = "Your password reset link is: <a href=".url('reset_password.php?res='.$code).">".url('reset_password.php?res='.$code)."</a> <br> This link is only valid for the next 60 minutes!";
			try{
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
				$mail->Subject = 'Password Reset';
				$mail->Body    = $mailMessage;
				$mail->send();
			}
			catch(Exception $e){
				$messageType = 'success';
				$message = $mail->ErrorInfo;
				flash($message,$messageType);
				redirect('forgot_password.php');
			}

			$table = 'password_resets';
			$columns = "email,code,time";
			$values = "'$email','$code','".date('Y-m-d h:i:s')."'";

			if($mysqli->insert($table,$columns,$values)){
				$messageType = 'success';
				$message = 'An email has been sent to '.$email.' with a link to reset your password.';
				flash($message,$messageType);
			}
			else{
				$messageType = 'success';
				$message = 'An unexpected error has occured. Please try again later.';
				flash($message,$messageType);
			}
			redirect('login.php');
		}
		else{
			$messageType = 'danger';
			$message = 'No such email found!';
			flash($message,$messageType);
		}
	}
}
redirect('forgot_password.php');
?>