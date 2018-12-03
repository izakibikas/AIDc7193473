<?php
session_start();

require_once('includes/constants.php');
require_once('includes/autoload.php');
require_once('class/InputSanitizer.php');

$mysqli = new DBFunctions(DB::getInstance());

function url($val){
	return SITE_URL.'/'.$val;
}

function asset($val){
	return SITE_URL.'/assets/'.$val;
}

function flash($message,$type){
	$_SESSION['message_type'] = $type;
	$_SESSION['message'] = $message;
}

function showFlashMessage(){
	if(isset($_SESSION['message']) && isset($_SESSION['message_type'])){
		$message = $_SESSION['message'];
		$type = $_SESSION['message_type'];
		echo  '<div class="alert alert-'.$type.'">'.$message.'</div>';
		unset($_SESSION['message']);
		unset($_SESSION['message_type']);
	}
}

function sanitize($data){
	return InputSanitizer::sanitize(DB::getInstance(),$data);
}

function redirect($url){
	header('location: '.SITE_URL.'/'.$url);
	die;
}

function saveOldFormData($array){
	$_SESSION['oldformdata'] = $array;
}

function getOldFormData($fieldName){
	if(isset($_SESSION['oldformdata'])){
		$oldFormData = $_SESSION['oldformdata'];
		return $oldFormData[$fieldName];
	}
	return '';
}

function saveLoginState($id,$name,$email,$userType){
	$user = array('id' => $id, 'name' => $name, 'email' => $email, 'type' => $userType);
	$_SESSION['auth'] = $user;
}

function guest(){
	return !isset($_SESSION['auth']);
}

function admin(){
	if(isset($_SESSION['auth'])){
		$auth = $_SESSION['auth'];
		$userType = $auth['type'];
		return $userType == 'admin';
	}
	return false;
}

function user($fieldName){
	if(isset($_SESSION['auth'])){
		$auth = $_SESSION['auth'];
		return $auth[$fieldName];
	}
	return '';
}

function needsGuest(){
	if(isset($_SESSION['auth'])){
		header('location: '.SITE_URL);
		die;
	}
}

function needsAuth(){
	if(!isset($_SESSION['auth'])){
		flash('Please login to continue.','warning');
		header('location: '.SITE_URL.'/login.php');
		die;
	}
}

function needsAdmin(){
	if(!isset($_SESSION['auth'])){
		header('location: '.SITE_URL);
		die;
	}
	else{
		$auth = $_SESSION['auth'];
		$userType = $auth['type'];
		if($userType != 'admin'){
			header('location: '.SITE_URL);
			die;
		}
	}
}

