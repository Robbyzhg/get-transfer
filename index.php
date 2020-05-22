<?php 

include 'templates/header.php'; 

$get = $myfunc->promo_get();

?>
<div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
  	<?php foreach ($get as $row): ?>
        <div class="carousel-item active" data-interval="10000">
        	<img src="assets/promo/<?= $row['gambar_promo'] ?>" height="500" class="d-block w-100">
        </div>
		<a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		</a>
		<div class="carousel-caption d-none d-md-block">
	        <a href="pesan.php" class="btn btn-danger">
	        	<?php if ($_SESSION['lang'] == "id"): ?>
	        		Pesan Sekarang!
	        	<?php else: ?>
	        		Order Now!
	        	<?php endif ?>
	        </a>
		</div>
  	<?php endforeach; ?>
</div>
</div>
<br><br>

<div id="section2" class="container">
	<div class="row">
		<div class="col-12">
			<div class="ourservice text-center">
			<h2>
				<?php if ( $_SESSION["lang"] == "id" ): ?>
					Layanan Kami
				<?php else: ?>
					Our Service
				<?php endif ?>
			</h2>
			<hr style="color: green;" size="15px" color="green" width="1000px">
		</div>
		</div>
	</div>
</div>
<div class="container" style="height: 300px;">
	<div style="background-color: green;" class="row rounded">
		<div class="col-4">
			<br>
			<div style="color: black; border: 0px;" class="text-center">
				<img class="border border-white rounded" src="assets/img/mobil2.jpg" width="100px;" height="100px;">
				<strong><p style="color: white;">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						Sewa Mobil
					<?php else: ?>
						Car Rental
					<?php endif ?>
				</p></strong>
			</div>
		</div>
		<div class="col-4">
			<br>
			<div style="color: black; border: 0px;" class="text-center">
				<img class="border border-white rounded" src="assets/img/travel.jpg" width="100px;" height="100px;">
				<strong><p style="color: white;">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						Perjalanan
					<?php else: ?>
						Travel
					<?php endif ?>
				</p></strong>
			</div>
		</div>
		<div class="col-4">
			<br>
			<div style="color: black; border: 0px;" class="text-center">
				<img class="border border-white rounded" src="assets/img/hotel.jpg" width="100px;" height="100px;">
				<strong><p style="color: white;">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						Penginapan
					<?php else: ?>
						Hotel
					<?php endif ?>
				</p></strong>
			</div>
		</div>
	</div>
</div>
<div id="section2" class="container">
	<div class="row">
		<div class="col-12">
			<div class="ourservice text-center">
			<strong><h2>
				<?php if ( $_SESSION["lang"] == "id" ): ?>
					Kenapa Kami?
				<?php else: ?>
					Why Us?
				<?php endif ?>
			</h2></strong>
			<hr style="color: green;" size="15px" color="green" width="1000px">
		</div>
		</div>
	</div>
</div>
<div class="container" style="height: 300px;">
	<div style="background-color: green;" class="row rounded">
		<div class="col-4">
			<br>
			<div style="color: black; border: 0px;" class="text-center">
				<img src="assets/img/payment.png" width="100px;" height="100px;">
				<strong><p class="mt-2" style="color: white;">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						HARGA TERJANGKAU
					<?php else: ?>
						AFFORDABLE PRICE
					<?php endif ?>
				</p></strong>
				<h5 style="color: white; border: 1px solid white;">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						Harga yang Pas di Kantong
					<?php else: ?>
						The Price is Right in The Bag
					<?php endif ?>
				</h5>
			</div>
		</div>
		<div class="col-4">
			<br>
			<div style="color: black; border: 0px;" class="text-center">
				<img src="assets/img/shield.png" width="100px;" height="100px;">
				<strong><p class="mt-2" style="color: white;">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						KEAMANAN TERJAMIN
					<?php else: ?>
						GUARANTEED SECURITY
					<?php endif ?>
				</p></strong>
				<h5 style="color: white; border: 1px solid white;">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						Resmi dan Dijaga
					<?php else: ?>
						Official and Guarded
					<?php endif ?>
				</h5>
			</div>

		</div>
		<div class="col-4">
			<br>
			<div style="color: black; border: 0px;" class="text-center">
				<img src="assets/img/payment2.png" width="100px;" height="100px;">
				<strong><p class="mt-2" style="color: white;">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						TIDAK ADA BAYARAN LEBIH
					<?php else: ?>
						THERE IS NO MORE PAYMENT
					<?php endif ?>
				</p></strong>
				<h5 style="color: white; border: 1px solid white;">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						Sudah Termasuk Pajak dan Lain-lain
					<?php else: ?>
						Including Tax and Others
					<?php endif ?>
				</h5>
			</div>
		</div>
	</div>
</div>

