<?php
require('init.php');
if(isset($needsGuest)){
	needsGuest();
}
if(isset($needsAuth)){
	needsAuth();	
}
if(isset($needsAdmin)){
	needsAdmin();	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="View Events posted by people around you!">
	<meta name="author" content="Bikash Shrestha">

	<title><?php echo isset($title) ?  $title : 'Events'; ?></title>

	<link rel="shortcut icon" href="<?php echo url('favicon.ico'); ?>">

	<link href="https://fonts.googleapis.com/css?family=Black+And+White+Picture" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Bootstrap core CSS -->
	<link href="<?php echo url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?php echo url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
	<link href="<?php echo url('assets/css/custom.css') ?>" rel="stylesheet">

	<?php
	if(isset($head)){
		echo $head;
	}
	?>

</head>

<body class="site">

	<?php
	include('navbar.php');
	?>