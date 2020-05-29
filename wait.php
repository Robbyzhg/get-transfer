<?php include 'templates/header.php' ?>
<div class="container">
	<div class="row mt-5">
		<div class="col-12">
			<div class="">
			  <center><h1 class="display-4">
			  	<?php if ( $_SESSION["lang"] == "id" ): ?>
				  	Silahkan Tunggu Pesanan Anda
				<?php else: ?>
					Please wait for your Order
				<?php endif ?>
			  </h1></center>
			  <center><p class="lead">
			  	<?php if ( $_SESSION["lang"] == "id" ): ?>
				  	Silahkan Cek Pesanan di Email Anda
				<?php else: ?>
					Please check your order on your email
				<?php endif ?>
			  </p></center>
			  <hr class="my-4">
			  <center><a class="btn btn-primary btn-lg" href="index.php" role="button">
			  	<?php if ( $_SESSION["lang"] == "id" ): ?>
				  	Kembali
				<?php else: ?>
					Go Back
				<?php endif ?>
			  </a></center>
			</div>
		</div>
	</div>
</div>