<?php
include '../config/functions.php';
include 'templates/header.php';

if ($_SESSION['level']=="") {
	header("location:login.php?pesan=gagal");
}
?>

