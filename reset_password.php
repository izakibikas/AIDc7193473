<?php
$title = "Reset Password";
$needsGuest = true;
include('includes/views/header.php');
if(!isset($_GET['res'])){
	redirect('forgot_password.php');
}
$code = sanitize($_GET['res']);
$checkCode = $mysqli->select('password_resets','*',"where code='$code'");
if($checkCode[0]['id']<1){
	$message = "This link has expired. Please reset your password again.";
	$messageType = "danger";
	flash($message,$messageType);
	redirect('forgot_password.php');
}
$codeSent = strtotime($checkCode[0]['time']);
if(time()-$codeSent>3600){
	$message = "This link has expired. Please reset your password again.";
	$messageType = "danger";
	flash($message,$messageType);
	redirect('forgot_password.php');
}
$email = $checkCode[0]['email'];
?>

<main class="container site-content">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h1 class="mt-5">Reset Password</h1>
		</div>
	</div>

	<?php showFlashMessage(); ?>

	<div class="mx-auto col-md-6 col-md-offset-3">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?php echo url('form-action/reset_password.php') ?>">
					<input type="hidden" name="email" value="<?php echo $email; ?>">
					<input type="hidden" name="res" value="<?php echo $code; ?>">
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Retype Password</label>
						<input type="password" name="re_password" class="form-control" required>
					</div>
					<div class="text-center">
						<input type="submit" name="submit" value="Reset Password" class="btn btn-success btn-lg">
					</div>
				</form>
			</div>
		</div>
	</div>

</main>

<?php
include('includes/views/footer.php');
?>