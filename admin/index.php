<?php
include '../config/functions.php';
include 'templates/header.php';

session_start();

if ($_SESION['level']=="") {
	header("location:login.php?pesan=gagal");
}
?>

