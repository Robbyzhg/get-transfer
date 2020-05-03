<?php
include '../config/functions.php';

$myfunc = new functions();

include 'templates/header.php';

if (isset($_POST['submit'])) {
	// var_dump($_FILES); die;
	$myfunc->inputpromo_add($_POST);
}

 ?>

 <style>
	body{
		background-color: #2ecc71;
	}
</style>
	<div class="col-9 ml-5 mt-5">
		<div class="card">
			<div class="card-header">
				Input Promo
			</div>
			<div class="card-body">
				<?php if ( isset($_SESSION["flash_data"]) ): ?>
					<div class="alert alert-<?= $_SESSION["flash_data"]['status'] ?>" role="alert">
						<?= $_SESSION["flash_data"]['message'] ?>
					</div>
					<?php unset($_SESSION["flash_data"]) ?>
				<?php endif ?>
				<form method="post" action="" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama Promo</label>
						<input type="text" name="nama_promo" class="form-control">
					</div>
					<div class="form-group">
						<label>Gambar Promo</label>
						<input type="file" name="gambar_promo" class="form-control">
					</div>
					<div class="form-group">
						<input type="submit" value="Input" name="submit" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>
	</div>