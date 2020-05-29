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
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootstrap.min.js.map"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-52V-kcWKfmd9Bd29vqMZ1HM1ccAZjg4&v=3.exp&sensor=true&libraries=places"></script>
	
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
	    <a class="navbar-brand" href="#"><img src="assets/img/logo-nav.png" width="90px" pading="10px"></a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarNavDropdown">
	      <ul class="navbar-nav ml-auto">
	        <li class="nav-item active">
	          <a class="nav-link" href="#section1">
          		<?php if ( $_SESSION["lang"] == 'id' ): ?>
          			KENAPA KAMI?
          		<?php else: ?>
          			WHY US?
          		<?php endif ?>
	           </a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="#section2">
	          	<?php if ( $_SESSION["lang"] == 'id' ): ?>
	          		LAYANAN KAMI
	          	<?php else: ?>
	          		OUR SERVICE
	          	<?php endif ?>
	      	  </a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="#section3">
	          	<?php if ( $_SESSION["lang"] == 'id' ): ?>
	          		TESTIMONI
	          	<?php else: ?>
	          		TESTIMONI
	          	<?php endif ?>
	      	  </a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="#section4">
	          	<?php if ( $_SESSION["lang"] == 'id' ): ?>
	          		TENTANG
	          	<?php else: ?>
	          		ABOUT
	          	<?php endif ?>
	      	  </a>
	        </li>
	         <li class="nav-item dropdown">
	          <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	            <?php if ( $_SESSION["lang"] == "id" ): ?>
		            <img style="width: 50px; height: 20px;" src="assets/img/indonesia.jpg">
	  			<?php else: ?>
		          	<img style="width: 50px; height: 50px;" src="assets/img/english.png">
	      		<?php endif ?>
	          </a>
	          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	            <a class="dropdown-item" href="?setlang=en">
	            	<img style="width: 50px; height: 50px;" src="assets/img/english.png">
	            	ENG
	            </a>
	            <a class="dropdown-item" href="?setlang=id">
	            	<img style="width: 50px; height: 50px;" src="assets/img/indonesia.jpg">
	            	ID
	        	</a>
	          </div>
	        </li>
	        <li class="nav-item">
	          <?php if ( isset($_SESSION["level"]) == "user" ): ?>
	          	<a href="logout.php" class="btn btn-danger ml-2">Logout</a>
	          <?php else: ?>
	          	<a href="register.php" class="btn btn-primary ml-2">Join Us</a>
	          <?php endif ?>
	        </li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<!-- Akhir Navbar -->

