<!-- Footer -->
<footer class="bg-dark text-white mt-4">
	<div class="container-fluid py-3">
		<p class="text-center">&copy; Bikash Shrestha 2018</p>
	</div>
</footer>

<?php
if(isset($_SESSION['oldformdata'])){
	unset($_SESSION['oldformdata']);
}
?>

<!-- Bootstrap core JavaScript -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

<?php
if(isset($footer_scripts)){
	echo $footer_scripts;
}
?>

</body>
</html>
