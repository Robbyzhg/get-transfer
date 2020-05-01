<?php 


$myfunc = new functions();

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<title>Admin Get Transfer</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-success">
	  <a class="navbar-brand" href="index.php">Admin</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Beranda</a>
	      </li>
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Input Mobil</a>
	      </li>
	      <li class="nav-item active">
	        <a class="nav-link" href="<?= $myfunc->baseurl ?>admin/cek_pesanan.php">Cek Pesanan</a>
	      </li>
	    </ul>
	    <ul class="navbar-nav ml-auto">
	    	<li class="nav-item active">
	    		<a class="nav-link" href="../logout.php">Logout</a>
	    	</li>
	    </ul>
	  </div>
	</nav>