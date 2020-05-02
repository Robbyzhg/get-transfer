<?php 
 
include 'config/functions.php';
 
$myfunc = new functions();

$username = $_POST['username'];
$password = $_POST['password'];
 
$login = mysqli_query($myfunc->conn,"SELECT * FROM users WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($login);
 
if($cek > 0){
	$data = mysqli_fetch_assoc($login);

	if($data['level']=="admin"){ 
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		$link = $myfunc->base_url . "admin/index.php";
		header("location:$link");

	} else if($data['level']=="user"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "user";
		$link = $myfunc->base_url . "index.php";
		header("location:$link");
	}
} else {
	$link = $myfunc->base_url . "login.php?pesan=gagal";
	header("location:$link");
}

?>