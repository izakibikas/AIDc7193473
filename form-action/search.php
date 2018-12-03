<?php
require_once('../init.php');

if(isset($_POST['submit'])){
	$searchData = $_POST['search_data'];

	$errors = array();

	if(empty($searchData)){
		$errors[] = "Please enter event name or location to search for!";
	}
	else{
		$searchData = sanitize($searchData);
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

		$result = $mysqli->select('events','*',"where name like '%".$searchData."%' or location like '%".$searchData."%'");

		$_SESSION['search_data'] = $result;

		$messageType = 'success';
		$message .= 'You searched for - '.$searchData;
		flash($message,$messageType);
	}
	redirect('search.php');
}

?>