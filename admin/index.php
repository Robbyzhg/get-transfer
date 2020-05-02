<?php
include '../config/functions.php';
include 'templates/header.php';

if ($_SESSION['level']=="") {
	header("location:login.php?pesan=gagal");
}
?>

<div class="col mt-5 text-center">
	<div class="jumbotron">
	  <h1 class="display-4">Selamat Datang Admin!</h1>
	  <p class="lead">Selamat Bekerja!</p>
	</div>
</div>

