<?php
require_once('../init.php');

require PUBLIC_PATH.'/class/PHPMailer/src/Exception.php';
require PUBLIC_PATH.'/class/PHPMailer/src/PHPMailer.php';
require PUBLIC_PATH.'/class/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$contactMessage = $_POST['message'];

	$errors = array();

	if(empty($email)){
		$errors[] = "Please enter your email address.";
	}
	else{
		$email = sanitize($email);
	}

	if(empty($contactMessage) || strlen($contactMessage)<10){
		$errors[] = "Message must be of at least 10 characters.";
	}
	else{
		$message = sanitize($contactMessage);
	}

	if(count($errors)){
		$messageType = 'danger';
		$message = '<li>';
		foreach($errors as $error){
			$message .= '<ul>'.$error.'</ul>';
		}
		$message .= '</li>';
		flash($message,$messageType);
	}
	else{

		$message = '';

		$table = 'messages';
		$columns = "email,message,date";
		$values = "'$email','$contactMessage','".date('Y-m-d')."'";

		if($mysqli->insert('messages',$columns,$values)){

			$mail = new PHPMailer();
			try {
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
				$mail->Subject = 'We hear you!';
				$mail->Body    = 'Thank you for sending us a message! We have received your message.';
				$mail->send();
				$message .= 'An email  has been sent to you and ';
			} catch (Exception $e) {
				$message .= 'Email  could not be sent. Mailer Error: '. $mail->ErrorInfo;
			}

			$messageType = 'success';
			$message .= 'Your  message was successfully  posted!';
			flash($message,$messageType);
		}
		else{
			$messageType = 'danger';
			$message = 'There was an error while  posting your message! ';
			flash($message,$messageType);
		}
	}
	redirect('contact.php');

}
?>