<?php 
	include 'config/functions.php';

	$myfunc = new functions();

	if ( isset($_GET['setlang']) ) {
			$myfunc->set_lang($_GET['setlang']);
		} elseif ( !isset($_SESSION["lang"]) ) {
			$myfunc->set_lang("id");
		}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootstrap.min.js.map"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-52V-kcWKfmd9Bd29vqMZ1HM1ccAZjg4&v=3.exp&sensor=true&libraries=places"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
	
	
	<title>Gettrans.id</title>
</head>
<style>
	html{
		scroll-behavior: smooth;
	}
</style>
<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light navbar-bgtrans">
	  <div class="container">
	    <a class="navbar-brand" href="index.php"><img src="assets/img/logo-nav.png" width="60px" pading="10px"></a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarNavDropdown">
	      <ul class="navbar-nav ml-auto">
	        <li class="nav-item active">
	          <a class="nav-link" href="#section1">Why Us?</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="#section2">Our Service</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="#section3">Testimoni</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="#section4">About</a>
	        </li>
	        <li class="nav-item">
	          <?php if ( isset($_SESSION["level"]) == "user" ): ?>
	          	<a href="logout.php" class="btn btn-outline-danger ml-2">Logout</a>
	          <?php else: ?>
	          	<a href="login.php" class="btn btn-outline-light">Login</a>
	          <?php endif ?>
	        </li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<!-- Akhir Navbar -->
	