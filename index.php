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
  	<?php endforeach; ?>
</div>
</div>
<br><br>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="whyus text-center">
			<h2>
				<?php if ( $_SESSION["lang"] == "id" ): ?>
					KENAPA HARUS PILIH KAMI?
				<?php else: ?>
					WHY SHOULD CHOOSE US ?
				<?php endif ?>
			</h2>
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
				<h3 class="card-title">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						HARGA TERJANGKAU!
					<?php else: ?>
						AFFORDABLE PRICES!
					<?php endif ?>
				</h3>
				<p class="card-text">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						Harga yang Pas di Kantong
					<?php else: ?>
						Suitable Price
					<?php endif ?>
				</p>
			</div>
		</div>
		<div class="col-4">
			<div style="color: black; border: 0px;" class="card text-center">
				<h3 class="card-title">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						KEAMANAN TERJAMIN!
					<?php else: ?>
						GUARANTEED SECURITY!
					<?php endif ?>
				</h3>
				<p class="card-text">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						Resmi dan dijaga
					<?php else: ?>
						Official and Guarded
					<?php endif ?>
				</p>
			</div>
		</div>
		<div class="col-4">
			<div style="color: black; border: 0px;" class="card text-center">
				<h3 class="card-title">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						TIDAK ADA BAYARAN LEBIH!
					<?php else: ?>
						NO MORE PAYMENT!
					<?php endif ?>
				</h3>
				<p class="card-text">
					<?php if ( $_SESSION["lang"] == "id" ): ?>
						Pajak dan Lain-Lain Sudah Termasuk
					<?php else: ?>
						Including tax and others
					<?php endif ?>
				</p>
			</div>
		</div>
	</div>
</div>
<br><br><br><br><br><br>


<?php include 'templates/footer.php' ?>