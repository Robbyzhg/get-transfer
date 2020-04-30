<?php 
session_start();
if ($_SESSION['level']=="") {
	header("location:login.php?pesan=gagal");
}

include 'templates/header.php' 


?>

<div class="header">
	<br><br><br><br><br>
	<h1>Penjemputan Aman, Nyaman, dan Terpercaya!</h1>
	<br><br>
	<a href="pesan.php" class="btn btn-outline-success rounded-pill">Pesan Sekarang</a>
</div>
<br><br><br>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="whyus text-center">
			<h2>KENAPA HARUS PILIH KAMI?</h2>
			<hr style="color: green;" size="15px" color="green" width="450px">
		</div>
		</div>
	</div>
</div>
<br><br><br>
<div class="container">
	<div class="row">
		<div class="col-4">
			<div style="color: black; border: 0px;" class="card text-center">
				<h3 class="card-title">HARGA TERJANGKAU!</h3>
				<p class="card-text">Harga yang Pas di Kantong</p>
			</div>
		</div>
		<div class="col-4">
			<div style="color: black; border: 0px;" class="card text-center">
				<h3 class="card-title">KEAMANAN TERJAMIN!</h3>
				<p class="card-text">Resmi dan dijaga</p>
			</div>
		</div>
		<div class="col-4">
			<div style="color: black; border: 0px;" class="card text-center">
				<h3 class="card-title">TIDAK ADA BAYARAN LEBIH!</h3>
				<p class="card-text">Pajak dan Lain-Lain Sudah Termasuk</p>
			</div>
		</div>
	</div>
</div>
<br><br><br><br><br><br>
<div class="container">
	<div class="row">
		<div class="col-12 text-center">	
			<h2 style="color: black;">Layanan Kami</h2>
			<hr style="color: green;" size="15px" color="green" width="200px">
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-12 text-center">
			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner">
			    <div class="carousel-item active">
			      <img src="assets/img/mobil3.jpg" class="d-block w-100">
			    </div>
			    <div class="carousel-item">
			      <img src="assets/img/mobil1.jpeg" class="d-block w-100">
			    </div>
			    <div class="carousel-item">
			      <img src="assets/img/mobil2.jpg" class="d-block w-100">
			    </div>
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		</div>
	</div>
</div>


<?php include 'templates/footer.php' ?>