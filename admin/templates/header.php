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

<style>
	#body-row {
	    margin-left:0;
	    margin-right:0;
	}
	#sidebar-container {
	    min-height: 100vh;   
	    background-color: #333;
	    padding: 0;
	}


	.sidebar-expanded {
	    width: 230px;
	}
	.sidebar-collapsed {
	    width: 60px;
	}


	#sidebar-container .list-group a {
	    height: 50px;
	    color: white;
	}


	#sidebar-container .list-group .sidebar-submenu a {
	    height: 45px;
	    padding-left: 30px;
	}
	.sidebar-submenu {
	    font-size: 0.9rem;
	}


	.sidebar-separator-title {
	    background-color: #333;
	    height: 35px;
	}
	.sidebar-separator {
	    background-color: #333;
	    height: 25px;
	}
	.logo-separator {
	    background-color: #333;    
	    height: 60px;
	}


	#sidebar-container .list-group .list-group-item[aria-expanded="false"] .submenu-icon::after {
	  content: " \f0d7";
	  font-family: FontAwesome;
	  display: inline;
	  text-align: right;
	  padding-left: 10px;
	}

	#sidebar-container .list-group .list-group-item[aria-expanded="true"] .submenu-icon::after {
	  content: " \f0da";
	  font-family: FontAwesome;
	  display: inline;
	  text-align: right;
	  padding-left: 10px;
	}

	 
</style>
	<!-- Start Sidebar -->
	<nav class="navbar navbar-expand-md navbar-dark bg-success">
	  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <a class="navbar-brand" href="index.php">
	    <img src="../assets/img/gettransok.png" width="30" height="30" class="d-inline-block align-top" alt="">
	    <span class="menu-collapsed">GetTransfer Admin</span>
	  </a>
	  <div class="collapse navbar-collapse" id="navbarNavDropdown">
	    <ul class="navbar-nav">     
	      <li class="nav-item dropdown d-sm-block d-md-none">
	        <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Menu
	        </a>
	        <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
	            <a class="dropdown-item" href="index.php">Dashboard</a>
	        </div>
	      </li>
	    </ul>
	    <a href="../logout.php" class="btn btn-danger ml-auto">Logout</a>
	  </div>
	</nav>


	<div class="row" id="body-row">
	    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
	        <ul class="list-group">
	            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
	                <div class="d-flex w-100 justify-content-start align-items-center">
	                    <span class="menu-collapsed">Menu</span>
	                </div>
	            </a>
	            <div id='submenu1' class="collapse sidebar-submenu">
	                <a href="cek_pesanan.php" class="list-group-item list-group-item-action bg-dark text-white">
	                    <span class="menu-collapsed">Cek Pesanan</span>
	                </a>
	            </div> 
	        </ul>
	    </div> <!-- End Sidebar -->
