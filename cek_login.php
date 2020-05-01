<?php 
 
// menghubungkan php dengan koneksi database
include 'config/functions.php';
 
$myfunc = new functions();

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($myfunc->conn,"SELECT * FROM users WHERE username='$username' AND password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['level']=="admin"){ 
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		$link = $myfunc->base_url . "admin/index.php";
		header("location:$link");
 
	// cek jika user login sebagai user
	}else if($data['level']=="user"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "user";
		// alihkan ke halaman dashboard user
		$link = $myfunc->base_url . "index.php";
		header("location:$link");

	}else{
		$link = $myfunc->base_url . "login.php?pesan=gagal";
		header("location:$link");
	}
 }
?>