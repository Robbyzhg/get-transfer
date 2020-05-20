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
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootstrap.min.js.map"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-52V-kcWKfmd9Bd29vqMZ1HM1ccAZjg4&v=3.exp&sensor=true&libraries=places"></script>
	
	<title>Get Transfer</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-success">
	 
	    <a class="navbar-brand" href="index.php">
	          <img src="assets/img/gettransok.png" width="50" height="50" alt="Malas Ngoding">
	        </a>
	 
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	 
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	 
	      <ul class="navbar-nav ml-auto">
	        <li class="nav-item">
	          	<a class="nav-link" href="index.php">
	          		<?php if ( $_SESSION["lang"] == "id" ): ?>
	          			Kenapa Kami?
          			<?php else: ?>
		          		Why Us?
	          		<?php endif ?>
	      		</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="catalog.php">
	          	<?php if ( $_SESSION["lang"] == "id" ): ?>
          			Layanan Kami
      			<?php else: ?>
		          	Our Service
          		<?php endif ?>
	          </a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="catalog.php">
	          	<?php if ( $_SESSION["lang"] == "id" ): ?>
          			Komentar
      			<?php else: ?>
		          	Feedback
          		<?php endif ?>
	          </a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="catalog.php">
	          	<?php if ( $_SESSION["lang"] == "id" ): ?>
          			Tentang Kami
      			<?php else: ?>
		          	About us
          		<?php endif ?>
	          </a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="catalog.php">
	          	<?php if ( $_SESSION["lang"] == "id" ): ?>
          			Kontak Kami
      			<?php else: ?>
		          	Contact Us
          		<?php endif ?>
	          </a>
	        </li>
	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	            <?php if ( $_SESSION["lang"] == "id" ): ?>
		            Bahasa
      			<?php else: ?>
		          	Languange
          		<?php endif ?>
	          </a>
	          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	            <a class="dropdown-item" href="?setlang=en">English</a>
	            <a class="dropdown-item" href="?setlang=id">Indonesia</a>
	          </div>
	        </li>
	      </ul>
	      <?php if ( isset($_SESSION["level"]) == "user" ): ?>
		      <a href="logout.php" class="btn btn-outline-light ml-2">Logout</a>
	      <?php else: ?>
		      <a href="login.php" class="btn btn-outline-light ml-2">Login</a>
	      <?php endif ?>
	   </div>
	</nav>
